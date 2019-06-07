@extends('layouts.main')

@section('content')
<h1>Users.Edit</h1>
<div class="user-edit">
    <form action="{{ url('users/' . $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-item">
            <label for="name">Username</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
