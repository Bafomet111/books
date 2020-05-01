<?php


namespace App\Http\Fasades;


use Illuminate\Support\Facades\Facade;

class BooksFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Books';
    }
}