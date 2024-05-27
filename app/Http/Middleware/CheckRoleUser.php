<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = Auth::user();

        // Memisahkan string roles menjadi array
        $rolesArray = explode('|', $roles);

        // Memeriksa apakah user memiliki salah satu dari peran yang diberikan
        if (in_array($user->role, $rolesArray)) {
            return $next($request);
        }

        // Jika tidak memiliki peran yang diperlukan, munculkan 404
        abort(404);
    }
}
