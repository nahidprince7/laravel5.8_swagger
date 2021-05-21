<?php

namespace App\Models;

use App\Http\Controllers\DataClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Department extends Model
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'label', 'is_active','deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function getDepartments(){
        return Department::all();
    }
    public function getDepartmentList(){
        return $this->getDepartments()->pluck('label','id');
    }

    public function returnDepartments()
    {
        $conditions[] = ['dept.is_active', '=', DataClass::ACTIVE];

        return DB::table('departments as dept')
            ->select('dept.id',DB::raw("CONCAT(dept.label) AS text"))
            ->where($conditions)
            ->orderByDesc('dept.id')
            ->limit(20)
            ->get();

    }
}
