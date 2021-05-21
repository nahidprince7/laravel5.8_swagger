<?php

namespace App\Http\Controllers;

use App\Http\Traits\Date;
use App\Models\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserRoleController extends Controller
{

    public function getUserRole($user_id)
    {

        $conditions = [];
        $conditions[] = ["ur.user_id", "=", $user_id];
        return DB::table("user_roles as ur")
            ->selectRaw('ur.*')
            ->whereNull("ur.deleted_at")
            ->where($conditions)
            ->orderByDesc("ur.id")
            ->get();
    }

    public function getUserRoleWithTrash($user_id)
    {
        $conditions = [];
        $conditions[] = ["ur.user_id", "=", $user_id];
        return DB::table("user_roles as ur")
            ->selectRaw('ur.*')
            ->where($conditions)
            ->orderByDesc("ur.id")
            ->get();
    }

    public function getUserRoleList($userId, $withTrash = false)
    {
        if ($withTrash) {
            return $this->getUserRoleWithTrash($userId)->pluck('role_id', 'id');
        }
        return $this->getUserRole($userId)->pluck('role_id', 'id');
    }

    public function assignRolesToUser($userId)
    {
        $userInfo = User::where('id', '=', $userId)->select('id','picture','name')->firstOrFail()->toArray();
       // dd($userInfo);
        $userRoles = $this->getUserRoleList($userId)->toArray();
        //$roles = ROLES;
        //dd($mapped_roles);
        return view('userRole.index', [
            'userInfo' => $userInfo,
            'userRoles' => $userRoles
        ]);
    }

    public function updateUserRoles(Request $request, $user_id)
    {
        //dd($request->all());
        $userRoles = $this->getUserRoleList($user_id, true)->toArray();
        // dd($userRoles);
        $userRoleToInsert = [];
        $updateIds = [];
        if (!empty($request->role_ids) && count($request->role_ids) > 0) {
            foreach ($request->role_ids as $k => $v) {
                $insert = [];
                if (in_array($v, $userRoles)) {
                    $key = array_search($v, $userRoles);
                    array_push($updateIds, $key);
                    unset($userRoles[$key]);
                } else {
                    $insert['user_id'] = $user_id;
                    $insert['role_id'] = $v;
                    $insert['created_at'] = Date::mysqlDefaultDateTimeFormat();
                    $insert['updated_at'] = Date::mysqlDefaultDateTimeFormat();
                    $insert['created_by'] = Auth::id();
                    $insert['updated_by'] = Auth::id();
                    array_push($userRoleToInsert, $insert);
                }
            }
        }
        //dd($userRoleToInsert);
        $status = DB::transaction(function () use ($userRoleToInsert, $updateIds, $userRoles) {
            $status = 1;
            try {
                //echo "whats wrong!!";die;
                if (count($userRoleToInsert) > 0) {
                    //dd($userRoleToInsert);
                    UserRole::insert($userRoleToInsert);
                }

                if (count($updateIds) > 0) {
                   // dd($updateIds);
                    //DB::table('user_roles')->whereIn('id', $updateIds)->update(['deleted_at' => null]);
                    DB::table('user_roles')->whereIn('id', $updateIds)->update(
                        [
                            'updated_at' => Date::mysqlDefaultDateTimeFormat(),
                            'updated_by' => Auth::id(),
                            'deleted_at' => null
                        ]
                    );
                }
                if (count($userRoles) > 0) {
                    // for deleting actually
                    DB::table('user_roles')->whereIn('id', array_keys($userRoles))->update(
                        [
                            'deleted_by' => Auth::id(),
                            'deleted_at' => Date::mysqlDefaultDateTimeFormat()
                        ]
                    );
                    //UserRole::whereIn('id', array_keys($userRoles))->delete();
                }
            } catch (\Exception $e) {
                //dd($e->getMessage());
                $status = 0;
            }
            return $status;
        });
        if ($status == 0) {
            $errors = [
                0 => "User Roles Assign/modify failed"
            ];
            return redirect()->back()->withErrors($errors);
        }
        Session::flash('message', " User Roles modified successfully");
        return redirect()->route('user-list');
    }
}
