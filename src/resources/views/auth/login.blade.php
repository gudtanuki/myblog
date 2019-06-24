@extends('layouts.main')

@section('content')
<div class="auth-login">
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-item form-group">
            <label for="email" class="email">Emali</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        
        <div class="form-item form-group">
            <label for="password" class="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-item form-group">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="login-btn">
            <button type="submit" class="btn btn-primary btn-login">Login</button>
        </div>
    </form>
</div>
@endsection
