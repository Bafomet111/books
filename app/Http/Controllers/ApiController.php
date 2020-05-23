<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Books;

class ApiController extends Controller
{
    /** Получение списка книг
     * @return mixed
     */
    public function loadAllBooks()
    {
        $data = Books::loadAllBooksWithAuthors();
        return $data;
    }

    /** Получение книги по id
     * @param Request $request
     * @return mixed
     */
    public function loadById(Request $request)
    {
        $bookId = $request->input('book_id');
        if(is_numeric($bookId)) {
            $data = Books::loadById($bookId);
            return $this->responseFormation($data);
        }

        return $this->responseFormation(null, 3, 'id-книги должен быть числом');
    }

    /** Обнвление книги
     * @param Request $request
     */
    public function updateById(Request $request)
    {
        $authors = $request->input('authors');
        $bookId = $request->input('book_id');
        $newName = $request->input('name');
        $update = $request->input('authors_update', 1);
        $update = $update == 0 ? false : true;

        $result = Books::updateBook($newName, $bookId, null, $authors, $update);
        if($result) {
            return $this->responseFormation(null, 1, 'Успешно обновлено');
        }
        return $this->responseFormation(null, 2, 'Не удалось обновить книгу');
    }

    /** Удаление книги
     * @param Request $request
     */
    public function deleteById($id)
    {
        $result = Books::deleteBook($id);

        if($result) {
            return $this->responseFormation(null, 1, 'Успешно удалено');
        }

        return $this->responseFormation(null, 2, 'Не удалось удалить книгу');
    }

    private function responseFormation($data = null, $status = null, $message = null)
    {
        if(is_null($status) && is_null($message)) {
            $status = 1;
            if ($data->isEmpty() || $data === false) {
                $status = 2;
            }
        }
        if(is_null($message)) {
            switch ($status) {
                case '1':
                    $message = 'Есть данные';
                    break;
                case '2':
                    $message = 'Нет данных';
                    break;
                default:
                    $message = 'Неверные параметры запроса';
                    break;
            }
        }

        $result['status'] = $status;
        $result['message'] = $message;
        $result['data'] = $data;

        return $result;
    }

}
