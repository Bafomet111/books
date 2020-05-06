<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use AdminAuth;
use Books;
use Authors;

class AdminController extends Controller
{
    public function index()
    {
        $params['auth'] = false;
        if($token = Cookie::get('authtoken')) {
            $auth = AdminAuth::authByCookie($token);
            $params = [
                'auth' => $auth,
                'books' => Books::loadAllBooksWithAuthors(),
                'authors' => Authors::getAuthorsAndCountBooks()
            ];
        }

        return view('admin', $params);
    }

    public function auth(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $token = Cookie::get('authtoken');

        if(is_null($token)) $token = md5(microtime() * rand());

        $auth = AdminAuth::authByLoginAndPassword($login, $password, $token);
        if($auth) {
            Cookie::queue('authtoken', $token, 3600);
        }

        return redirect('/admin');
    }

}
