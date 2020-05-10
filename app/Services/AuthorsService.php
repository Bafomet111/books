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

    public function update($params)
    {

        if (!empty($params['author_id'])) {
            $data['last_name'] = isset($params['last_name']) ? $params['last_name'] : '';
            $data['first_name'] = isset($params['first_name']) ? $params['first_name'] : '';
            $data['middle_name'] = isset($params['middle_name']) ? $params['middle_name'] : '';

            $result = DB::table('authors')
                ->where('id', $params['author_id'])
                ->update($data);

            return $result === false ? false : true;
        }
    }

    public function addAuthor($params)
    {

        if (!empty($params)) {
            $data['last_name'] = isset($params['last_name']) ? $params['last_name'] : '';
            $data['first_name'] = isset($params['first_name']) ? $params['first_name'] : '';
            $data['middle_name'] = isset($params['middle_name']) ? $params['middle_name'] : '';

            $result = DB::table('authors')->insert($data);

            return $result === false ? false : true;
        }

        return false;
    }

    public function deleteAuthor($authorId)
    {
        if(!empty($authorId)) {
            $result = DB::table('authors')
                ->where('id', $authorId)
                ->delete();

            //Удаляем связи
            DB::table('book_author')
                ->where('author_id', $authorId)
                ->delete();

            return $result === false ? false : true;
        }

        return false;
    }
}