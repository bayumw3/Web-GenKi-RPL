<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna login terlebih dahulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Pastikan pengguna yang login adalah admin
        if (Auth::user()->email !== 'admin@admin.com') {
            return abort(403, 'Unauthorized action.');
        }

        // Jika sudah admin, lanjutkan ke rute berikutnya
        return $next($request);
    }
}
