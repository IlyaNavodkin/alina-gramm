<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link type="image/x-icon" href="{{ asset('img/chat-logo-sidebar.png') }}" rel="shortcut icon">

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/setka.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src={{ asset('js/chat.js') }}></script>
    <script src={{ asset('js/contact-menu.js') }}></script>
    <script src={{ asset('js/sidebar.js') }}></script>



</head>
    <body>
        <div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('main_content')
        </div>

    </body>
</html>
