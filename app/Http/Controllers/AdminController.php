<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use AdminAuth;

class AdminController extends Controller
{
    public function index()
    {
        $auth = false;
        if(Cookie::get('XSRF-TOKEN')) {
            $auth = AdminAuth::authByCookie(Cookie::get('XSRF-TOKEN'));
        }

        return view('admin', ['auth' => $auth]);
    }

    public function auth(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $token = Cookie::get('XSRF-TOKEN');
        $auth = AdminAuth::authByLoginAndPassword($login, $password, $token);
        if($auth) {
            setcookie('authtoken', $token, '/');
        }

        return redirect('/admin');
    }
}
