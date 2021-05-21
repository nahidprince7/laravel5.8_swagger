<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Auth;

trait AuthorizationRole
{
    function role(){
        return Auth::user()->userRoles()->select("role_id")->pluck("role_id")->toArray();
    }
}
