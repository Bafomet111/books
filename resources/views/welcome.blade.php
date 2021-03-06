<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/gueststyle.css') }}">

        <title>Books</title>


    </head>
    <body>
{{--    <img src="/images/gerlic-saksoniya-germaniya.jpg">--}}
    <div class="wrapper">
        @if(!empty($books))
            <div class="books">
            @foreach($books as $bookInfo)
                <div class="books__book">
                    <h2>{{ $bookInfo->name }}</h2>
                    <div class="authors__list">
                        @if (isset($bookInfo->authors))
                            {{ count($bookInfo->authors) > 1 ? 'Авторы:' :  'Автор:' }}
                        </br>
                            @foreach($bookInfo->authors as $author)
                                <div class="list__author list_item">
                                    <h3 class="author_name">
                                        <span class="first_name">{{ $author->first_name }}</span>
                                        <span class="last_name">{{ $author->last_name }}</span>
                                        <span class="middle_name">{{ $author->middle_name }}</span>
                                    </h3>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>


    </body>
</html>
