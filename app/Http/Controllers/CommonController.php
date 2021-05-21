<?php

namespace App\Http\Controllers;


use App\Http\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

    }

    public function downloadFile($id, $model, $storage_path, $file_name)
    {
        $model_data = $model::find($id);
        $errors = [];
        if (!empty($model_data->file)) {

            if (File::exists(storage_path("$storage_path/{$file_name}"))) {
                return response()->download(storage_path("$storage_path/{$file_name}"));
            } else {
                $errors[] = " File not found!";
            }
        } else {
            $errors[] = " No file uploaded!";
        }
        return redirect()->back()->withErrors($errors);
    }

    /*upload a file start*/
    static function fileUpload($path, $fileName, $id = '', $from = 'form')
    {
        if ($from == 'form') {
            $originalName = $fileName->getClientOriginalName();
            $modifiedName = self::renameFile($originalName, $id);
            if ($fileName->storeAs($path, $modifiedName)) return $modifiedName;
        } else {
            if ($fileName->storeAs($path, $fileName)) return 1;
        }
        return false;

    }

    static function renameFile($fileName, $id)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        return md5($fileName . microtime()) . ($id + 1) . '.' . $extension;
    }

    /*upload a file end*/
    /*onCreate,onUpdate,onDelete*/

    static function onCreate(){
        $arr['created_by'] = Auth::id();
        $arr['created_at'] = Date::mysqlDefaultDateTimeFormat();

        $arr['updated_by'] = Auth::id();
        $arr['updated_at'] = Date::mysqlDefaultDateTimeFormat();
        return $arr;
    }
    static function onUpdate(){
        $arr['updated_by'] = Auth::id();
        $arr['updated_at'] = Date::mysqlDefaultDateTimeFormat();
        $arr['deleted_at'] = null;
        return $arr;
    }
    static function onDelete(){
        $arr['deleted_by'] = Auth::id();
        $arr['deleted_at'] = Date::mysqlDefaultDateTimeFormat();
        return $arr;
    }

    static function mergeOnCreate($data=[]){
        return array_merge($data,self::onCreate());
    }
    static function mergeOnUpdate($data=[]){
        return array_merge($data,self::onUpdate());
    }
    static function mergeOnDelete($data=[]){
        return array_merge($data,self::onDelete());
    }


}
