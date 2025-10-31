<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil role user
        $userRole = Auth::user()->role;

        // Cek apakah role user termasuk dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            return abort(403);
        }

        // Jika role cocok, lanjutkan request
        return $next($request);
    }
}
