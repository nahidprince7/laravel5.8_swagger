<?php

namespace App\Ajax;

use App\District;
use Illuminate\Database\Eloquent\Model;
use DB;
class Ajax extends Model
{
    public static function getDistrict(){

        $value=DB::table('districts')->orderBy('id', 'asc')->get();

        return $value;
    }

    // Fetch employee by department id
    public static function getUpazila($districtid=0){

        $value=DB::table('upazilas')->where('district_id', $districtid)->get();

        return $value;
    }

}
