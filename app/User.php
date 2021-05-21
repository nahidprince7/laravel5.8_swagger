<?php

namespace App;

use App\Http\Controllers\DataClass;
use App\Models\AdjustmentComment;
use App\Models\AdjustmentVerification;
use App\Models\ApprovalMatrix;
use App\Models\Designation;
use App\Models\JobLocation;
use App\Models\RequisitionUser;
use App\Models\UserRole;
use App\Models\VerifierMatrix;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'pin', 'email','joining_date', 'job_location_id','password', 'picture', 'contact_number', 'gender', 'religion', 'contact_number', 'user_id', 'designation_id', 'division_id', 'department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function jobLocation()
    {
        return $this->belongsTo(JobLocation::class);
    }

    public function getRoleAttribute()
    {
        if (session()->has('userRole')) {
            // If so return first name
            return session('userRole');
        }
        $roles = $this->userRoles()->select("role_id")->pluck("role_id")->toArray();
        session(['userRole' => $roles]);
        return $roles;

        //return Auth::user()->userRoles()->select("role_id")->pluck("role_id")->toArray();
    }

    public static function detroySessionUserRole()
    {
        if (session()->has('userRole')) {
            session()->forget('userRole');
        }
    }



}
