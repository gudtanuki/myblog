@extends('layouts.main')

@section('content')
<div class="users-edit">
    <h1>Edit User</h1>
    <form action="{{ url('users/' . $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-item form-group">
            <label for="name">Username</label>
            <input class="form-control @if ($errors->has('name')) is-invalid @endif" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="form-item form-group">
            <label for="name">Email</label>
            <input class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" type="text" name="email" value="{{ old('name', $user->email) }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="submit-btn">
            <button type="submit" class="submit btn btn-primary btn-submit" name="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
