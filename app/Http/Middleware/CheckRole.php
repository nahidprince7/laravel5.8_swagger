<?php

namespace App\Http\Middleware;

use App\Http\Traits\AuthorizationRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    use AuthorizationRole;

    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $allowedRoleType = explode(':', $roles);
        $userHasRole = $this->role();

        if (count($userHasRole) > 0 && count($allowedRoleType) > 0) {
            foreach ($userHasRole as $v) {
                if (in_array($v,$allowedRoleType)){
                    return $next($request);
                }
            }
        }
        abort(403);
    }
}
