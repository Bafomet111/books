<head>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />

    <title>Admin</title>

</head>

<body>
    <div class="auth">
        <form class="auth__form" method="post" action="/admin">

            <div class="form__field">
                <input name = "login" autocomplete="off" type="text" placeholder="your login">
            </div>
            <div class="form__field">
                <input name = "password" type="password" placeholder="your password">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button>Войти</button>
        </form>
    </div>
</body>