<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class AuthService
{
    public function authByLoginAndPassword($login, $password, $token)
    {
        $password = md5(trim($password));
        $result = DB::table('admin')
            ->get()
            ->where('login', trim($login))
            ->where('password', $password)
            ->first();

        if($result) {
            DB::table('admin')
                ->where(['login' => $login], ['password' => $password])
                ->update(['token'=> $token]);
        }
        return $result ? true : false;
    }

    public function authByCookie($token)
    {
        $result = DB::table('admin')
            ->get()
            ->where('token', $token)
            ->first();

        return $result ? true : false;
    }

}