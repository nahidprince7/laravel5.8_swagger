<?php

namespace App\Http\Controllers;
use App\Category;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department.department',[
            'departments' =>$departments
    ]);
    }

    public function departmentSave(Request $request)
    {
        if (isset($request->label))
        {

            $department = $request->only('label');

            //multiple custom validation

            $rules = array(
                'label'=>'required|unique:departments,label,NULL,id,deleted_at,NULL',
            );

            $messages = [
                'label.unique' => 'Department name already exists.',

            ];

            $validator = \Validator::make($department, $rules,$messages);

            if ($validator->passes()) {

                $department['created_by'] = Auth::id();
                $department['updated_by'] = Auth::id();

                Department::create($department);
                return redirect()->back()->with('message', 'Department Added Successfully');
            } else {
                $errors = $validator->messages();
//                Session::flash('message', 'failed to Add');
                return redirect()->back()->withErrors($errors)->withInput();
            }

        }




//        $department = new Department();
//        $department->label = $request->dept_name;
//
//        $department->save();
//        return redirect()->back()->with('message','Department Added Successfully');
    }

    public function departmentUpdate(Request $request, $id)
    {

        $department = Department::find($id);
        $departmentData = $request->only('label');

        $rules = array(
            'label' => "required|max:255|unique:departments,label,$id,id,deleted_at,NULL",

        );

        $messages = [
            'label.unique' => 'Division already exists.',
        ];


        $validator = \Validator::make($departmentData, $rules, $messages);
        if ($validator->passes()) {
            $departmentData = CommonController::mergeOnUpdate($departmentData);
            $department->update($departmentData);
            return redirect()->back()->with('message', 'Department Updated Successfully');
        } else
        {
            $errorS = $validator->messages();
            //dd($errorS);
            /*for the time being custom validation message*/

            //Session::flash('message', 'Failed to Add');
            return redirect()->back()->withErrors($errorS)->withInput();
        }

//        $department = Department::find($request->id);
//
//        $department->label = $request->dept_name;
//        $department->save();
//        return back()->with('message','Department Updated Successfully');

    }

    public function departmentMoveToTrash(Request $request)
    {

        if (isset($request->record_id))
        {
            $department = Department::find($request->record_id);
            $deleteData = CommonController::onDelete();
            $update = $department->update($deleteData);
            //$departmentHeadSettings->delete();
            Session::flash('message', " Department has been moved to trashed");
            return redirect()->back();
        } else {
            abort(404);
        }
    }
}
