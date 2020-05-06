<?php


namespace App\Http\Fasades;


use Illuminate\Support\Facades\Facade;

class AuthorsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Authors';
    }
}