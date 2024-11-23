<?php
namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $routeName = $request->route()->getName();
        // dd($routeName);

        if (Auth::check()) {
            $user = Auth::user();

            $userRole = $user->roles->first(); 

            if ($userRole && $userRole->permissions->isEmpty()) {
                $defaultPermissions = Permission::whereHas('roles', function ($query) use ($userRole) {
                    $query->where('roles.id', $userRole->id);
                })->pluck('id');

                $userRole->permissions()->syncWithoutDetaching($defaultPermissions);
            }

            $permission = Permission::where('key', $routeName)->first();

            if ($permission) {
                if ($userRole && $userRole->permissions->contains($permission)) {
                    return $next($request); 
                } else {
                    abort(403);
                }
            } else {
                abort(404); 
            }
        } else {
            return redirect('/');
        }
    }
}
