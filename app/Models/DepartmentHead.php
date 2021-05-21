<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class DepartmentHead extends Model
{
    use Notifiable, HasRoles, SoftDeletes;

    //protected $with = ['subOffice'];
    protected $fillable = [
        'user_id', 'department_id', 'divisional_head_id', 'backup_user_id', 'deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function subOffice()
    {
        return $this->hasMany(SubOffice::class);
    }

    public function divisionHead()
    {
        return $this->belongsTo(DivisionHead::class,'divisional_head_id','id');
    }

}
