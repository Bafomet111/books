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
                    <span>Автор: </span>
                    {{ $bookInfo->first_name }}
                    {{ $bookInfo->last_name }}
                </div>
            @endforeach
            </div>
        @endif
    </div>


    </body>
</html>
