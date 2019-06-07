@extends('layouts.main')

@section('content')
<h1>Users.Show</h1>
<div>
    <div class="user-btns">
        <div class="edit-btn">
            <a href="{{ url('users/' . $user->id . '/edit') }}">Edit</a>
        </div>
        <div class="delete-btn">
            <a href="{{ url('users/' . $user->id . '/delete') }}">Delete</a>
        </div>
    </div>
    <table>
    <thead>
        <tr>
            <th>{{ __('Id') }}</th>
            <th>{{ __('Username') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
        </tr>
    </tbody>
</table>
</div>
@endsection
