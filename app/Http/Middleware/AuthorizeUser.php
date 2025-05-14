<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $role): Response
    {
       $user_role = $request->user()->getRole(); // mendapatkan role user
       if (in_array($user_role, $role)) { // jika role user ada di dalam array role
           return $next($request); // lanjutkan ke request selanjutnya
       }
    //    jika tidak  punya role tampilkan error 403
       abort(403, 'Maaf Kamutidak Memiliki Akses');
    }
}
