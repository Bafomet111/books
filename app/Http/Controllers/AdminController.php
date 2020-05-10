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
    public function index(Request $request)
    {
        $params['auth'] = false;
        if($token = $request->session()->getToken()) {
            $auth = AdminAuth::authBySessionToken($token);
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
        $token = $request->session()->getToken();

        $auth = AdminAuth::authByLoginAndPassword($login, $password, $token);
        return redirect('/admin');
    }

    public function bookChange(Request $request, $type)
    {
        $bookId = $request->input('book_id', null);
        $newBookName = $request->input('book_name', null);
        $authorIds = $request->input('authors', null);
        $token = $request->input('_token');

        $auth = AdminAuth::authBySessionToken($token);

        if($auth) {
            if ($type == 'update') {
                if (Books::updateBook($newBookName, $bookId, $authorIds)) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            }

            if ($type == 'delete') {
                if (Books::deleteBook($bookId)) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            }
        }

    }

    public function authorChange(Request $request, $type)
    {
        $token = $request->input('_token');

        $auth = AdminAuth::authBySessionToken($token);

        if($auth) {
            $params = $request->input();

            if($type == 'update') {
                if (Authors::update($params)) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            }

            if($type == 'delete') {
                if (Authors::deleteAuthor($params['author_id'])) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            }
        }

    }

    public function addBook(Request $request)
    {
        $authorIds = $request->input('authors');
        $bookName = $request->input('name');
        $token = $request->input('_token');

        if(AdminAuth::authBySessionToken($token)) {
            if(Books::addBook($bookName, $authorIds)) {
                return ['status' => 'ok'];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function addAuthor(Request $request)
    {
        $params = $request->input();
        $token = $request->input('_token');

        if(AdminAuth::authBySessionToken($token)) {
            if(Authors::addAuthor($params)) {
                return ['status' => 'ok'];
            } else {
                return ['status' => 'error'];
            }
        }

        return false;
    }

    public function logout(Request $request)
    {
        $request->session()->clear();
        return redirect('/admin');
    }

}
