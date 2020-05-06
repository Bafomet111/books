<head>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admincontent.css') }}" />
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

    <title>Admin</title>

</head>

<body>
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
                                <span>Автор: {{ $book->first_name . ' ' . $book->last_name}}</span> </br>
                                <a id="book_change" data-book_id="{{ $book->book_id }}" href="/change" class="redact">Изменить</a>
                                <a id="book_delete" data-book_id="{{ $book->book_id }}" href="/delete" class="redact">Удалить</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="lists__authors">
{{--                <h2 class="authors__head list_head">Аторы</h2>--}}
                <div class="authors__list">
                    @if (isset($authors))
                        @foreach($authors as $author)
                            <div class="list__author list_item">
                                <h3 class="author_name">
                                    {{ $author->first_name . ' ' . $author->last_name}}
                                </h3>
                                <span>Количество книг: {{ $author->books_count}}</span>
                                </br>
                                <a href="/change" data-author_id="{{ $author->author_id }}" id="author_change" class="redact">Изменить</a>
                                <a href="/delete" data-author_id="{{ $author->author_id }}" id="author_delete" class="redact">Удалить</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="hidden" id="hidden_book_form">
        <form method="post" action="/update">
            <input type="text" name="book_name" autocomplete="off" class="book_name" value=""/>
            <select>
                @foreach($authors as $author)
                    <option data-author_id="{{ $author->id }}">
                        {{ $author->first_name . ' ' . $author->last_name}}
                    </option>
                @endforeach
            </select> </br>
            <input type="submit" value="Сохранить" id="save"/>
            <input type="button" value="Отмена" id="cansel"/>

        </form>
    </div>
</body>
<script src="{{ asset('/js/script.js') }}"></script>