<?php

namespace App\Http\Controllers;
use App\Models\DepartmentHead;
use App\Models\Division;
use App\Models\SubOffice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;


class DivisionController extends Controller
{
    public function index()
    {
       $divisions =  Division::all();
        return view('division.division',[
            'divisions'=> $divisions
            ]
        );
    }

//    function checkAndUpdateDivisionIfDeleted($label){
////        DB::enableQueryLog();
//        return Division::onlyTrashed()
//            ->where('label',$label)
////            ->get()->toArray();
//            ->restore();
//    }

    public function divisionSave(Request $request)
    {

//        $existingUpdate = $this->checkAndUpdateDivisionIfDeleted($request['label']);
//
//        if ($existingUpdate){
//            return redirect()->back()->with('message', 'Division Restored Successfully');
//        }

        if (isset($request->label)) {

            $division = $request->only('label');

            //multiple custom validation

            $rules = array(
                'label'=>'required|unique:divisions,label,NULL,id,deleted_at,NULL',
            );

            $messages = [
                'label.unique' => 'Division name already exists.',

            ];

            $validator = \Validator::make($division, $rules,$messages);

            if ($validator->passes()) {

                $division['created_by'] = Auth::id();
                $division['updated_by'] = Auth::id();

                Division::create($division);
                return redirect()->back()->with('message', 'Division Added Successfully');
            } else {
                $errors = $validator->messages();
//                Session::flash('message', 'failed to Add');
                return redirect()->back()->withErrors($errors)->withInput();
            }

        }


    }

    public function divisionUpdate(Request $request,$id)
    {

//        $existingUpdate = $this->checkAndUpdateDivisionIfDeleted($request['label']);
//
//        if ($existingUpdate){
//                return redirect()->back()->with('message', 'Division Restored successfully');
//            }
//            else{

        $division = Division::find($id);
        $divisionData = $request->only('label');

        $rules = array(
            'label' => "required|max:255|unique:divisions,label,$id,id,deleted_at,NULL",

        );

        $messages = [
            'label.unique' => 'Division already exists.',
        ];


        $validator = \Validator::make($divisionData, $rules, $messages);
        if ($validator->passes()) {
            $divisionData = CommonController::mergeOnUpdate($divisionData);
            $division->update($divisionData);
            return redirect()->back()->with('message', 'Division Updated Successfully');
        } else
            {
            $errorS = $validator->messages();
            //dd($errorS);
            /*for the time being custom validation message*/

            //Session::flash('message', 'Failed to Add');
            return redirect()->back()->withErrors($errorS)->withInput();
        }

//    }

}

    public function divisionMoveToTrash(Request $request)
    {

        if (isset($request->record_id))
        {
            $division = Division::find($request->record_id);
            $deleteData = CommonController::onDelete();
            $update = $division->update($deleteData);
            //$divisionHeadSettings->delete();
            Session::flash('message', " Division has been moved to trashed");
            return redirect()->back();
        } else {
            abort(404);
        }
    }

}
