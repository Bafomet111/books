<?php


namespace App\Services;


use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Authors;

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

            foreach($authors as $author) {
                unset($author->author_id);
                unset($author->book_id);
            }

            $book->authors = $authors;
        }

        return $books;
    }

    public function loadById($id)
    {
        $result = DB::table('books')
            ->select('*')
            ->join('book_author', 'book_author.book_id', '=', 'books.id')
            ->join('authors', 'authors.id', '=', 'book_author.author_id')
            ->where('books.id', $id)
            ->get();
        return $result;
    }

    /** Добавление книги
     * @param $name - название книги
     * @param $authorIds - массив id авторов
     * @return bool
     */
    public function addBook($name, $authorIds)
    {
        if(!empty($name)) {
            $id = DB::table('books')->insertGetId(['name' => $name]);
            $data = [];
            if(!empty($authorIds)) {
                foreach ($authorIds as $authorId) {
                    $data[] = ['book_id' => $id, 'author_id' => $authorId];
                }

                DB::table('book_author')
                    ->insert($data);
            }

            return $id === false ? false : true;
        } else {
            return false;
        }
    }

    /** Обновление книги
     * @param $newName - новое название
     * @param $bookId - id книги
     * @param null $authorIds - массив id НОВЫХ авторов книги
     * @param null $authorNames - массив с данными авторов
     * @param bool $update - если true - обновляем авторов, если false - добавляем к существующим
     * @return bool
     */
    public function updateBook($newName, $bookId, $authorIds = null, $authorNames = null, $update = true)
    {
        if(!empty($bookId) && !empty($newName)) {
            $result = DB::table('books')
                ->where('id', $bookId)
                ->update(['name' => $newName]);

            if(!is_null($authorIds) || !is_null($authorNames)) {

                //Формируем данные для записи
                if($authorIds) {

                    foreach ($authorIds as $authorId) {
                        $data[] = ['book_id' => $bookId, 'author_id' => $authorId];
                    }

                } else {
                    foreach ($authorNames as $author) {
                        $authorData['first_name'] = !empty($author['first_name']) ? $author['first_name'] : '';
                        $authorData['last_name'] = !empty($author['last_name']) ? $author['last_name'] : '';
                        $authorData['middle_name'] = !empty($author['middle_name']) ? $author['middle_name'] : '';
                        $authorId = Authors::addAuthor($authorData, true);
                        if($authorId !== false)
                            $data[] = ['book_id' => $bookId, 'author_id' => $authorId];
                    }
                }

                //Удаляем старые связи для этой книги
                if($update) {
                    DB::table('book_author')
                        ->where('book_id', $bookId)
                        ->delete();
                }
                try {
                    if (!empty($data)) {
                        DB::table('book_author')
                            ->insert($data);
                    }
                } catch (QueryException $exception) {
                    foreach ($data as $key=>$row) {
                        //Проверка на наличие записи в таблице со связями
                        $hasData = DB::table('book_author')
                            ->where('book_id', $bookId)
                            ->where('author_id', $row['author_id'])
                            ->exists();
                        if($hasData) unset($data[$key]);
                    }

                    if (!empty($data)) {
                        DB::table('book_author')
                            ->insert($data);
                    }
                }
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