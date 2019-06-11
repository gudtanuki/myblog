<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>MyBlog</title>
</head>
<header>
    <div class="blog-title">
        <h1><a class="navbar-brand" href="{{ url('/') }}">MyBlog</a></h1>
    </div>
    <div class="sign-nav">
        <!-- Right Side Of Navbar -->
        <ul class="sign-items">
            <!-- Authentication Links -->
            @guest
                <li class="sign-item unsigned">
                    <a class="item-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="sign-item">
                        <a class="item-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="sign-item signed">
                    name:
                    <a class="item-link" href="{{ url('users/' . Auth::user()->id) }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                </li>
                <li class="sign-item signed">
                    <a class="item-link" href="{{ route('logout') }}">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</header>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</body>
<footer>
    <p>2019.6 laravel5.8</p>
</footer>
</html>
