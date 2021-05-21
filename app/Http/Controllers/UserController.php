<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthorizationRole;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Division;
use App\Models\JobLocation;
use App\Models\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use AuthorizationRole;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user_storage_path = 'public/user-picture';
    public $limit_visit = 20;

    /*public function __construct()
    {
    }*/

    protected function getUserFieldList()
    {
        return ['id', 'name', 'pin', 'picture', 'contact_number', 'email', 'gender', 'religion', 'designation_id', 'department_id', 'division_id'];

    }

    public function getUser($searchKey = '', $user_id = '')
    {
        $additionalWhereCond = [];
        if (!empty($user_id)) {
            $additionalWhereCond[] = ['id', '=', $user_id];
        }
        $fields = $this->getUserFieldList();
        if (!empty($searchKey)) {
            return User::whereNull('deleted_at')
                ->select($fields)
                ->with([
                    'userRoles' => function ($query) {
                        return $query->select('id', 'user_id', 'role_id');
                    }
                ])
                ->where(function ($query) use ($searchKey) {
                    $query->where('email', 'like', "%$searchKey%")
                        ->orWhere('pin', 'like', "%$searchKey%")
                        ->orWhere('name', 'like', "%$searchKey%");
                })
                ->where($additionalWhereCond)
                ->orderBy("id", "DESC")
                ->paginate(LIMIT_PER_PAGE_DEFAULT);
        } else {
            return User::whereNull('deleted_at')
                ->select($fields)
                ->with([
                    'userRoles' => function ($query) {
                        return $query->select('id', 'user_id', 'role_id');
                    },
                ])
                ->where($additionalWhereCond)
                ->orderBy("id", "DESC")
                ->paginate(LIMIT_PER_PAGE_DEFAULT);
        }

    }

    public function index(Request $request)
    {

        $searchKey = '';
        if (!empty($request->searchKey)) {
            $searchKey = $request->searchKey;
        }
        if (in_array(ADMIN, Auth::user()->role) || in_array(ROLE_HOD, Auth::user()->role)) {
            $users = $this->getUser($searchKey);
        } else {
            $users = $this->getUser($searchKey, Auth::id());
        }
        //dd($users);
        //dd($users->links());
        //dd($data);
        $departments = (new Department())->getDepartmentList();
        $divisions = (new Division())->getDivisionList();
        $designations = Designation::getDesignationList();
        $religions = RELIGIONS;
        $genders = GENDER;
        $userRoles = ROLES;


        return view('users.index')
            ->with('users', $users)
            ->with('departments', $departments)
            ->with('divisions', $divisions)
            ->with('designations', $designations)
            ->with('religions', $religions)
            ->with('genders', $genders)
            ->with('userRoles', $userRoles)
            ->with('searchKey', $searchKey);

    }

    public function userDetail(Request $request, $user_id)
    {

//        if (in_array(ADMIN, Auth::user()->role) == false && in_array(ROLE_HOD, Auth::user()->role) == false) {
//            $user_id = Auth::id();
//        }
        $departments = (new Department())->getDepartmentList()->toArray();
        $divisions = (new Division())->getDivisionList()->toArray();
        $designations = Designation::getDesignationList()->toArray();
        $userRoles = (new UserRoleController())->getUserRoleList($user_id)->toArray();
        //dd($userRoles);
        $user = User::find($user_id)->toArray();
        $joblocations = JobLocation::all()->pluck('title','id')->toArray();
        //dd($user);
        return view('users.detail')
            ->with('user', $user)
            ->with('departments', $departments)
            ->with('divisions', $divisions)
            ->with('designations', $designations)
            ->with('userRoles', $userRoles)
            ->with('joblocations',$joblocations);
    }

    public function demoUserDetail()
    {

        return view('users.demoDetail');

    }

    public function create()
    {
        $departments = (new Department())->getDepartmentList();
        $divisions = (new Division())->getDivisionList();
        $designations = Designation::getDesignationList();
        $userRoles = [];
        $religions = RELIGIONS;
        $job_locations = JobLocation::all();
        return view('users.create')
            ->with('departments', $departments)
            ->with('divisions', $divisions)
            ->with('designations', $designations)
            ->with('religions', $religions)
            ->with('userRoles', $userRoles)
            ->with('job_locations', $job_locations);
    }


    public function store(Request $request)
    {
        $userData = $request->only('name', 'pin', 'picture', 'password', 'joining_date', 'job_location_id', 'designation_id', 'division_id', 'department_id', 'password_confirmation', 'role', 'gender', 'religion', 'contact_number');
        //dd($userData);
        $userData = CommonController::mergeOnCreate($userData);
        if (!empty($request->email)) {
            $userData['email'] = $request->email;
        }
        $rules = array(
            'name' => 'required|max:255',
            'pin' => 'required|max:255|unique:users',
            'email' => 'email|max:255|unique:users',
            'gender' => 'required',
            'designation_id' => 'required',
            'division_id' => 'required',
            'department_id' => 'required',
            'picture' => 'unique:users|mimes:jpeg,JPEG,JPG,jpg,png,PNG|max:1000',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        );
        $validator = \Validator::make($userData, $rules);

        if ($validator->passes()) {
            if ($request->hasFile('picture')) {
                $maxID = DB::table('users')->max('id');
                $uploadedFileName = CommonController::fileUpload($this->user_storage_path, $request->picture, $maxID);
                if (strlen($uploadedFileName) > 0) $userData['picture'] = $uploadedFileName;
            }
            //$userData['password'] = password_hash($request->password, PASSWORD_BCRYPT);
            $userData['password'] = Hash::make($userData['password']);

            $status = DB::transaction(function () use ($userData, $request) {
                $newlyCreatedUser = User::create($userData);
                if (!empty($request->role_ids) && count($request->role_ids) > 0) {
                    $userRoleToInsert = [];
                    foreach ($request->role_ids as $k => $v) {
                        $userRoleToInsert[$k]['user_id'] = $newlyCreatedUser->id;
                        $userRoleToInsert[$k]['role_id'] = $v;
                        $userRoleToInsert[$k] = CommonController::mergeOnCreate($userRoleToInsert[$k]);
                    }
                }

                $status = 1;
                try {
                    if (count($userRoleToInsert) > 0) {
                        UserRole::insert($userRoleToInsert);
                    }
                } catch (\Exception $e) {
                    //dd($e->getMessage());
                    $status = 0;
                }
                return $status;
            });
            if ($status == 0) {
                $errors = [
                    0 => "fail to save"
                ];
                return redirect()->back()->withErrors($errors);
            }
            Session::flash('message', 'User has been added');
            return redirect()->route('user-list');
        } else {
            $errors = $validator->messages();
            //dd($errors);
            Session::flash('message', 'fail to save');
            return redirect()->back()->withErrors($errors)->withInput();
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        /*$role = Auth::user()->role;
        if (($role != DataClass::USER_ADMIN) && ($role != DataClass::USER_SYSTEM)) {
            $id = Auth::id();
        }*/
        $departments = (new Department())->getDepartmentList();
        $divisions = (new Division())->getDivisionList();
        $designations = Designation::getDesignationList();

        $userRoles = [];
        if (in_array(ADMIN, Auth::user()->role)) {
            $user = User::find($id)->toArray();
            $userRoles = (new UserRoleController())->getUserRoleList($id)->toArray();
        } else {
            $user = User::find(Auth::id())->toArray();
        }

        $job_locations = JobLocation::all();


        return view('users.edit')
            ->with('user', $user)
            ->with('departments', $departments)
            ->with('divisions', $divisions)
            ->with('designations', $designations)
            ->with('userRoles', $userRoles)
            ->with('job_locations', $job_locations);

    }

    public function update(Request $request, $id)
    {

        // $role = Auth::user()->role;
        /*
         * dd($request->all());
        if (($role != DataClass::USER_ADMIN) && ($role != DataClass::USER_SYSTEM)) $id = Auth::id();

        */
        //dd($user);
        $existingUser = User::find($id);
        if (!in_array(ADMIN, Auth::user()->role)) {
            /*employee*/
            $rules = array(
                'name' => 'required|max:255', 'gender' => 'required',
                'picture' => 'unique:users|mimes:jpeg,JPEG,JPG,jpg,png,PNG|max:1000',
                'password' => ['string', 'min:6', 'confirmed'],
            );
            $userData = $request->only('name', 'picture', 'gender', 'religion', 'contact_number', 'joining_date', 'job_location_id');
        } else {
            //echo 'ok';
            /*not employee*/
            $rules = array(
                'name' => 'required|max:255', 'pin' => "required|max:6|unique:users,pin,$id,",
                'email' => "email|max:255|unique:users,email,$id,", 'gender' => 'required',
                'designation_id' => 'required', 'division_id' => 'required',
                'department_id' => 'required', 'password' => ['string', 'min:6', 'confirmed'],
                'picture' => 'unique:users|mimes:jpeg,JPEG,JPG,jpg,png,PNG|max:1000',
            );
            $userData = $request->only('name', 'pin', 'picture', 'designation_id', 'division_id', 'department_id', 'role', 'gender', 'religion', 'contact_number', 'joining_date', 'job_location_id');
            //dd($request->all());
            if (isset($request->email)) {
                $userData['email'] = $request->email;
            }
        }

        //dd($userData);

        if (isset($request->is_password_change)) {
            $userData['password'] = $request->password;
            $userData['password_confirmation'] = $request->password_confirmation;
        }
        $userData = CommonController::mergeOnUpdate($userData);

        $validator = \Validator::make($userData, $rules);

        if ($validator->passes()) {
            if ($request->hasFile('picture')) {
                $uploadedFileName = CommonController::fileUpload($this->user_storage_path, $request->picture, $id);
                if (strlen($uploadedFileName) > 0) $userData['picture'] = $uploadedFileName;
                Storage::delete($this->user_storage_path . '/' . $existingUser->picture);
            }
            if (isset($request->is_password_change)) {
                $userData['password'] = Hash::make($userData['password']);
            }
            // dd($userData);
            $userRoles = [];
            $userRoleToInsert = [];
            $updateIds = [];
            if (in_array(ADMIN, Auth::user()->role)) {
                $userRoles = (new UserRoleController())->getUserRoleList($id, true)->toArray();
                //dd($userRoles);
                if (!empty($request->role_ids) && count($request->role_ids) > 0) {
                    foreach ($request->role_ids as $k => $v) {
                        $insert = [];
                        if (in_array($v, $userRoles)) {
                            $key = array_search($v, $userRoles);
                            array_push($updateIds, $key);
                            unset($userRoles[$key]);
                        } else {
                            $insert['user_id'] = $id;
                            $insert['role_id'] = $v;
                            $insert = CommonController::mergeOnCreate($insert);
                            array_push($userRoleToInsert, $insert);
                        }
                    }
                }
            }

            $status = DB::transaction(function () use ($existingUser, $userData, $userRoleToInsert, $updateIds, $userRoles) {
                $status = 1;
                try {
                    $existingUser->update($userData);
                    if (in_array(ADMIN, Auth::user()->role)) {
                        if (count($userRoleToInsert) > 0) {
                            UserRole::insert($userRoleToInsert);
                        }

                        if (count($updateIds) > 0) {
                            $onUpdate = CommonController::onUpdate();
                            DB::table('user_roles')->whereIn('id', $updateIds)->update($onUpdate);
                        }
                        if (count($userRoles) > 0) {
                            $onDelete = CommonController::onDelete();
                            DB::table('user_roles')->whereIn('id', array_keys($userRoles))->update($onDelete);
                        }
                        //echo "found";die;
                        // User::detroySessionUserRole();
                    }
                } catch (\Exception $e) {
                    $status = 0;
                }
                return $status;
            });
            if ($status == 0) {
                $errors = [
                    0 => "User update/modify failed"
                ];
                Session::flash('message', " User modification failed");
                return redirect()->back()->withErrors($errors);
            }
            Session::flash('message', "User modified successfully");
            return redirect()->route('user-list');
        } else {
            $errors = $validator->messages();
            Session::flash('message', 'fail to update');
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function moveToTrash(Request $request)
    {
        ///echo "Hello Trash";
        if (isset($request->record_id)) {
            if (in_array(ADMIN, Auth::user()->role)) {
                $user = User::find($request->record_id);
                try {
                    $user->delete();
                    Session::flash('message', " name:{$user->name} and pin: {$user->pin} has been moved to trashed");
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['errors' => [0 => $e->getMessage()]]);
                }
            } else {
                abort(404);
            }
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        if (in_array(ADMIN, Auth::user()->role)) {
            $user = User::find($id);
            $name = $user->name;
            try {
                $user->delete();
                Session::flash('message', " $name Has been deleted");
            } catch (\Exception $e) {
                if ($e->getCode() == 23000) {
                    $errors = [
                        0 => " The user named $name can't be deleted
                         because this has been used in another object"
                    ];
                    return redirect()->back()->withErrors($errors);
                }
            }
            return redirect('users');
        } else {
            abort(404);
        }


    }

    function getUsersList($searchKey = '', $limit = 100)
    {
        $conditions = [];
        return DB::table('users as u')
            ->leftJoin('departments as d', 'd.id', '=', 'u.department_id')
            ->leftJoin('designations as de', 'de.id', '=', 'u.designation_id')
            // ->leftJoin('divisions as div','div.id','=','u.division_id')
            ->leftJoin('job_locations as job', 'job.id', '=', 'u.job_location_id')
            ->select('u.id', 'u.picture',DB::raw('IFNULL( job.title, "") as job_title'), DB::raw("CONCAT(u.name,'-',u.pin) AS text"), 'd.label as department', 'de.title as designation')
            ->where($conditions)
            ->where(function ($query) use ($searchKey) {
                if (!empty($searchKey)) {
                    $query->where('u.pin', 'like', "%$searchKey%")
                        ->orWhere('u.name', 'like', "%$searchKey%")
                        ->orWhere('u.email', 'like', "%$searchKey%")
                        ->orWhere('d.label', 'like', "%$searchKey%")
                        ->orWhere('de.title', 'like', "%$searchKey%")//    ->orWhere('div.label', 'like', "%$searchKey%")
                        ->orWhere('job.title', 'like', "%$searchKey%")//    ->orWhere('div.label', 'like', "%$searchKey%")
                    ;
                }
            })
            ->whereNull('u.deleted_at')
            ->orderByDesc('u.id')
            ->limit($limit)
//            ->toSql();
            ->get();

        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
    }

    function getUserDetail($user_id = null)
    {
        return DB::table('users as u')
            ->leftJoin('departments as d', 'd.id', '=', 'u.department_id')
            ->leftJoin('designations as de', 'de.id', '=', 'u.designation_id')
            ->leftJoin('divisions as div', 'div.id', '=', 'u.division_id')
            ->leftJoin('job_locations as job', 'job.id', '=', 'u.job_location_id')
            ->select('u.*','d.label as department', 'de.title as designation', 'div.label as division','job.title as jobLocation')
            //->select('u.id', 'u.picture', DB::raw("CONCAT(u.name,'-',u.pin) AS text"), 'd.label as department', 'de.title as designation', 'div.label')
            ->where('u.id', '=', $user_id)
//            ->toSql();
            ->first();

            //->toArray();

        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
    }
}
