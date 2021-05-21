<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class VehicleType extends Model
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'vehicle_type','deleted_at','created_at', 'updated_at','created_by','updated_by','deleted_by'
    ];
}
