@extends('layouts.main')

@section('content')
<div class="auth-register">
        <h1>Register</h1>
        <form action="{{ route('register') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-item form-group">
                <label for="name" class="name">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-item form-group">
                <label for="email" class="email">Emali</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                <label for="password-confirm" class="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
    
            <div class="login-btn">
                <button type="submit" class="btn btn-primary btn-login">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
