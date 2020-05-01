<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class BooksService
{
    public function loadAllBooksWithAuthors()
    {
        $result = DB::table('books')
            ->join('book_author', 'books.id', '=', 'book_author.book_id')
            ->join('authors', 'authors.id', '=', 'book_author.author_id')
            ->get();
        return $result;
    }

    public function addBook($name, $authorId)
    {
        $result = DB::table('books')->insert(['name' => $name, 'author_id' => $authorId]);
        if($result === false) {
            //ошибка
        }
    }

    public function updateBook($newName, $bookId,$authorId)
    {
        $result = DB::table('books')
            ->where('id', $bookId)
            ->update(['name' => $newName, 'author_id' => $authorId]);
        if($result === false) {
            //ошибка
        }
    }

    public function deleteBook($id)
    {
        $result = DB::table('books')
            ->where('id', $id)
            ->delete();
        if($result === false) {
            //ошибка
        }
    }
}