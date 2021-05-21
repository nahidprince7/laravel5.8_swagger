<?php

namespace App\Http\Controllers;

use App\Http\Traits\Date;
use App\Models\Designation;
use App\Models\Division;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        $designationList = $designations->pluck('title', 'id')->toArray();
        return view('designation.designation', [
            'designations' => $designations,
            'designationList' => $designationList
        ]);

    }

    public function designationSave(Request $request)
    {
        //dd($request->all());
        $designation = new Designation();
        $designation->title = $request->designation_name;
        $designation->parent_id = $request->parent_id;
        $designation->save();
        return redirect()->back()->with('message', 'Designation added Successfully');
    }

    public function designationUpdate(Request $request)
    {
        $designation = Designation::find($request->id);

        $designation->title = $request->designation_name;
        $designation->parent_id = $request->parent_id;
        $designation->save();
        return back()->with('message', 'Department Updated Successfully');
    }

    public function sort()
    {
        $designations = Designation::select('id', 'parent_id', 'title')->orderby('parent_id')->get()->toArray();
        $treeList = $this->buildTree($designations);
        $treeList = json_encode($treeList);
        return view('designation.sorting')->with('treeList', $treeList);
    }

    protected function buildTree(array $elements, $parentId = null)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['items'] = $children;
                }
                $element['text'] = $element['title'];
                $element['expanded'] = true;
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function updateHierarchy(Request $request)
    {
       // dd($request->records);
        $status['status'] = 1;
        $status['message'] = "Invalid Request";
        $status['diagramDatasource'] = '';
        $status = DB::transaction(function () use ($request) {
            $status['status'] = 0;
            $status['message'] = 'Invalid Request';
            $status['diagramDatasource'] = '';
            try {
                $cases = [];
                $ids = [];
                $parents = [];

                $rows =[];
                if (isset($request->records) && is_array($request->records) && count($request->records)>0){
                    foreach ($request->records as $record){
                        $cases[] = "WHEN {$record['id']} then ?";
                        $ids[] = $record['id'];
                        $parents[] = $record['parent'];
                    }
                    if (!empty($ids)){
                        $table = Designation::getModel()->getTable();
                        $ids = implode(',', $ids);
                        $cases = implode(' ', $cases);
                        $onUpdate = CommonController::onUpdate();
                        $params = $parents;
                        $params[] = $onUpdate['updated_by'];
                        $params[] = $onUpdate['updated_at'];
                        $params[] = $onUpdate['deleted_at'];
                        //dd($params);
                        //$params[] = CommonController::onUpdate();
                        $statusLocalUpdate = DB::update("UPDATE `{$table}` SET `parent_id` =  CASE `id` {$cases} END, `updated_by` = ?, `updated_at` = ?, `deleted_at` = ? WHERE `id` in ({$ids})", $params);

                        if ($statusLocalUpdate == true){
                            $status['status'] = 1;
                            $status['message'] = 'Successfully Updated';
                        }else{
                            $status['message'] = 'Database Error';
                        }
                    }
                }
                return $status;
            }catch (\Exception $e){
                dd($e->getMessage());
                $status['message'] = 'Database ErrorEE';
                return $status;
            }
        });
        return $status;
    }

    public function moveToTrash(Request $request)
    {
        if (isset($request->record_id)) {
            $designation = Designation::find($request->record_id);
            if ($this->checkIfDesignationHasChild($request->record_id)) {
                return redirect()->back()->withErrors(['errors' => [0 => "Designation:{$designation->title} has child designation! Please remove those first"]]);
            }
            try {
                $designation->delete();
                Session::flash('message', "Designation:{$designation->title} has been moved to trash");
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['errors' => [0 => $e->getMessage()]]);
            }
        }
        return redirect()->back();
    }

    protected function checkIfDesignationHasChild($designation_id)
    {
        $totalChild = Designation::where('parent_id', '=', $designation_id)->count();
        return $totalChild;
    }


}
