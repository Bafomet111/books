<head>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admincontent.css') }}" />
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

    <title>Admin</title>

</head>

<body>

<nav>
    <div class="menu">
        <div class="left">
            <div class="book_add"><span>Добавить книгу</span></div>
            <div class="author_add"><span>Добавить автора</span></div>
        </div>
        <div class="right">
            <a href="/admin/logout" >Выйти</a>
        </div>
    </div>
</nav>
    <div class="wrapper">
        <div class="lists">
            <div class="lists__books">
{{--                <h2 class="books__head list_head">Книги</h2>--}}
                <div class="books__list">
                    @if (isset($books))
                        @foreach($books as $book)
                            <div class="list__book list_item">
                                 <h3 class="book_name" >
                                     {{ $book->name }}
                                 </h3>

                                @if(!empty($book->authors))
                                    {{ count($book->authors) > 1 ? 'Авторы:' :  'Автор:' }}
                                @endif
                                </br>
                                @foreach($book->authors as $author)

                                    <span class="author" data-author_id = "{{ $author->id }}">
                                         {{ $author->first_name . ' ' . $author->last_name}}
                                    </span> </br>

                                @endforeach

                                <a id="book_change"  data-book_id="{{ $book->id }}" href="/change" class="redact">Изменить</a>
                                <a id="book_delete" data-book_id="{{ $book->id }}" href="/delete" class="redact">Удалить</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="lists__authors">

                <div class="authors__list">
                    @if (isset($authors))
                        @foreach($authors as $author)
                            <div class="list__author list_item">
                                <h3 class="author_name">
                                    <span class="first_name">{{ $author->first_name }}</span>
                                    <span class="last_name">{{ $author->last_name }}</span>
                                    <span class="middle_name">{{ $author->middle_name }}</span>
                                </h3>
                                <span>Количество книг: {{ $author->books_count}}</span>
                                </br>
                                <a href="/change" data-author_id="{{ $author->id }}" id="author_change" class="redact">Изменить</a>
                                <a href="/delete" data-author_id="{{ $author->id }}" id="author_delete" class="redact">Удалить</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="hidden" id="hidden_book_form">
        <form method="post" action="/book/update" id="book_change_form">

            <table>
                <tr>
                    <td>
                        <input type="text" name="book_name" autocomplete="off" class="book_name" value=""/>
                    </td>
                </tr>
                <tr class="select_authors">
                    <td>
                        <select  name="author">
                            @foreach($authors as $author)
                                <option id="author_{{ $author->id }}" data-author_id="{{ $author->id }}">
                                    {{ $author->first_name . ' ' . $author->last_name}}
                                </option>
                            @endforeach
                        </select>
                        <a class="delete_author is_not_disabled"  href="/delete">- Удалить </a><br/>
                    </td>
                </tr>
            </table>

            <a id="add_author" class="is_not_disabled" href="/add">+ Добавить автора</a><br/>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="submit" value="Сохранить" class="save"/>
            <input type="button" value="Отмена" class="cansel"/>
        </form>
    </div>

    <div class="hidden" id="hidden_author_form">
        <form method="post" action="/author/update" id="author_change_form">
            <table>
                <tr>
                    <td>Фамилия</td>
                    <td>
                        <input type="text" name="last_name" class="last_name" autocomplete="off" value=""/>
                    </td>
                </tr>

                <tr>
                    <td>Имя</td>
                    <td>
                        <input type="text" name="first_name" class="first_name" autocomplete="off" value=""/>
                    </td>
                </tr>

                <tr>
                    <td>Отчество</td>
                    <td>
                        <input type="text" name="middle_name" class="middle_name" autocomplete="off" value=""/>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="submit" value="Сохранить" class="save"/>
            <input type="button" value="Отмена" class="cansel"/>
        </form>
    </div>
</body>
<script src="{{ asset('/js/script.js') }}"></script>
<script src="{{ asset('/js/ajax_submit.js') }}"></script>