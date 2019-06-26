<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>MyBlog</title>
</head>
<body>
    <header>
        <div class="sign-menu">
            <ul class="sign-items">
                <li class="sign-item top">
                    <a class="item-link" href="{{ url('/') }}">Top</a>
                </li>
                @guest
                    <li class="sign-item unsigned">
                        <a class="item-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="sign-item">
                        <a class="item-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                @else
                    <li class="sign-item signed">
                        <a class="item-link" href="{{ url('posts/create') }}">Post</a>
                    </li>
                    <li class="sign-item signed">
                        <a class="item-link" href="{{ url('users/') }}">Users</a>
                    </li>
                    <li class="sign-item signed">
                        <a class="item-link" href="{{ url('users/' . Auth::user()->id) }}">MyPage</a>
                    </li>
                    <li class="sign-item signed">
                        <a class="item-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            @method('POST')
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
        <div class="blog-title">
            <a class="title" href="{{ url('/') }}">MyBlog</a>
        </div>
        </header>
        <main>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="container">
                @yield('content')
            </div>
        </main>
        <footer>
            <p>2019.6 laravel5.8</p>
        </footer>
    </body>
</html>
