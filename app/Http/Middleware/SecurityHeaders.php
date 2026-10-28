<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Header keamanan dasar untuk semua halaman.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $headers = $response->headers;
        // Situs lain tidak boleh memuat halaman ini di dalam iframe (clickjacking)
        $headers->set('X-Frame-Options', 'SAMEORIGIN');
        // Browser tidak menebak jenis file sendiri (mis. file upload dibaca sebagai script)
        $headers->set('X-Content-Type-Options', 'nosniff');
        // Alamat lengkap (termasuk kode link personal) tidak dikirim ke situs lain
        $headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Paksa HTTPS setelah online (diabaikan browser pada koneksi http)
        if (app()->isProduction() && $request->isSecure()) {
            $headers->set('Strict-Transport-Security', 'max-age=31536000');
        }

        return $response;
    }
}
