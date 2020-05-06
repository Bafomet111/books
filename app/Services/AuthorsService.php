<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class AuthorsService
{
    /** Получаем всех авторов и ко-во книг у каждого
     * @return mixed
     */
    public function getAuthorsAndCountBooks()
    {

        //SELECT *,COUNT(*) as  FROM `authors` LEFT JOIN `book_author` ON `author_id`
        // WHERE `book_author`.`author_id` = `authors`.`id` GROUP BY `book_author`.`author_id`

        $result = DB::table('authors')
            ->leftJoin('book_author', 'book_author.author_id', '=', 'authors.id')
            ->select('*', DB::raw('count(*) as books_count'))
            ->groupBy('author_id')
            ->get();


        return $result;
    }
}