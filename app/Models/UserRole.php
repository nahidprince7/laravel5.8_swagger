<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class UserRole extends Model
{
    use Notifiable,SoftDeletes;
    protected $fillable=[
        'id','user_id','role_id',
        'created_at','updated_at','deleted_at','created_by','updated_by','deleted_by',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /*public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            //dd($user);
            $model->created_by = 1;
            $model->updated_by = 1;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
        static::deleting(function ($model) {
            $user = Auth::user();
            $model->deleted_by = $user->id;
        });
        static::saving(function($table)  {
           // dd("ok");
            $table->created_by = Auth::user()->id;
        });

    }*/
}
