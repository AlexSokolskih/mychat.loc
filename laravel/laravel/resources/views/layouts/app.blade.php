<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .chat-panel>ul {
            list-style: none;
            height: 50vh;
            overflow-y: scroll;
        }
        .panel-users{
            position: fixed;
            top: 100px;
            right: 100px;
            width: 150px;
            color: white;

            background: -webkit-linear-gradient(#01d9fe, #1558f3);
            background: -o-linear-gradient(#01d9fe, #1558f3);
            background: -moz-linear-gradient(#01d9fe, #1558f3);
            background: linear-gradient(#01d9fe, #1558f3);
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        //прокручиваем в низ окно сообщений в чате
        var block = document.getElementById("chat-panel-messages");
        block.scrollTop = block.scrollHeight;


        // отправляем ajax на отправку сообщения
        'use strict'
        var messageSendForm = document.getElementById("messageSend");
        messageSendForm.onsubmit = function (event) {

            event.preventDefault();
            var xhr = new XMLHttpRequest();

            var message = event.currentTarget.querySelector('textarea[name=message]').value;
            var token = event.currentTarget.querySelector('input[name=_token]').value;


            console.log(token);

            var body = 'message=' + encodeURIComponent(message);
                    + '_token=' + encodeURIComponent(token);
            xhr.open('POST', '/chat', false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);

            xhr.send(body);

            if (xhr.status != 200) {
                // обработать ошибку
                alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
            } else {
                // вывести результат
                document.documentElement.innerHTML = xhr.responseText; // responseText -- текст ответа.
            }
        }


    </script>
</body>
</html>
