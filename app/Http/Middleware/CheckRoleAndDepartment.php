<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAndDepartment
{
    public function handle(Request $request, Closure $next, $role, $department = null)
    {
        $user = auth()->user();

        // Cek apakah user memiliki role yang diperlukan
        if (!$user || !$user->hasRole($role)) {
            abort(403, 'Anda Tidak Memiliki Akses halaman ini.');
        }

        // Jika department juga diberikan, cek apakah user berada di department tersebut
        if ($department && !$user->isInDepartment($department)) {
            abort(403, 'Cek Bagian Anda Tidak Memiliki Akses halaman ini.');
        }

        return $next($request);
    }
}
