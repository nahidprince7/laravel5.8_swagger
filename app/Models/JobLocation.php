<?php

namespace App\Models;

use App\Http\Controllers\DataClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class JobLocation extends Model
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'title','deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function getJobLocations(){
        return JobLocation::all();
    }
    public function getJobLocationList(){
        return $this->getJobLocations()->pluck('title','id');
    }
}
