@extends('layouts.main')

@section('content')
<h1>Users.Edit</h1>
<div class="user-edit">
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
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
