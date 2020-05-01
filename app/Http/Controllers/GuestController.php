<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Books;

class GuestController extends Controller
{
    public function index()
    {
        //получаем список всех имеющихся книг и их авторов
        $books = Books::loadAllBooksWithAuthors();
        return view('welcome', ['books' => $books]);
    }
}
