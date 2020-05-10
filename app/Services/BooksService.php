<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class BooksService
{
    public function loadAllBooksWithAuthors()
    {
        $books = DB::table('books')->get();
        foreach ($books as $book) {
            $authors = DB::table('book_author')
                ->join('authors', 'authors.id', '=', 'book_author.author_id')
                ->where('book_author.book_id', $book->id)
                ->get();

            $book->authors = $authors;
        }

        return $books;
    }

    public function addBook($name, $authorIds)
    {
        if(!empty($name)) {
            $id = DB::table('books')->insertGetId(['name' => $name]);
            $data = [];
            foreach ($authorIds as $authorId) {
                $data[] = ['book_id' => $id, 'author_id' => $authorId];
            }

            DB::table('book_author')
                ->insert($data);

            return $id === false ? false : true;
        } else {
            return false;
        }
    }

    public function updateBook($newName, $bookId, $authorIds = [])
    {
        if(!empty($bookId) && !empty($newName)) {
            $result = DB::table('books')
                ->where('id', $bookId)
                ->update(['name' => $newName]);

            if(!empty($authorIds)) {

                //Удаляем старые записи для этой книги
                DB::table('book_author')
                    ->where('book_id', $bookId)
                    ->delete();

                //Формируем данные для записи одним запросом
                foreach ($authorIds as $authorId) {
                    $data[] = ['book_id' => $bookId, 'author_id' => $authorId];
                }

                DB::table('book_author')
                    ->insert($data);
            }

            return $result === false ? false : true;

        } else
            return false;

    }

    public function deleteBook($id)
    {
        $result = DB::table('books')
            ->where('id', $id)
            ->delete();

        DB::table('book_author')
            ->where('book_id', $id)
            ->delete();

        return $result === false ? false : true;
    }
}