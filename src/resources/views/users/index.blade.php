@extends('layouts.main')

@section('content')
    <h1>Users.Index</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</th>
                <td><a href="{{ url('users/' . $user->id) }}">{{ $user->name }}</a></th>
            </tr>
            @endforeach
        </tbody>
    </table>
{{ $users->links() }}
@endsection