<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
//    use SoftDeletes;
    protected $fillable = ['title', 'is_active'];

    public function treeDesig()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function FoodSetting()
    {
        return $this->hasOne(FoodSetting::class);
    }

    public static function getDesignations(){
        return Designation::all();
    }

    public static function getDesignationList(){

        return self::getDesignations()->pluck('title','id');
    }


}

