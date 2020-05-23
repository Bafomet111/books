<?php

namespace App\Http\Middleware;

use Closure;
use AdminAuth;

class apiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->input('token', 'asdfasdf');
        $auth = AdminAuth::authBySessionToken($token);
        if($auth) {
            return $next($request);
        } else {
            return response(['error' => 'Такого пользователя не существует']);
        }
    }
}
