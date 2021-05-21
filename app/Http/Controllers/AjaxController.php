<?php

namespace App\Http\Controllers;
use App\Ajax\Ajax;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){

        // Fetch departments
        $districtData['data'] = Ajax::getDistrict();

        // Load index view
        return view('generalSettings.area.add-area',[
            'districts' => $districtData
        ]);
    }

    // Fetch records
    public function getUpazila($districtid=0){

        // Fetch Employees by Departmentid
        $upazila['data'] = Ajax::getUpazila($districtid);

        echo json_encode($upazila);
        exit;
    }

    public function getDistrict(){
        $districtData['data'] = Ajax::getDistrict();
        echo json_encode($districtData);
        exit;
    }

}
