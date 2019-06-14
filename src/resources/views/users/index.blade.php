@extends('layouts.main')

@section('content')
<div class="posts-table user-list">
    <table>
        <thead>
            <tr>
                <th class="user-top" colspan="2">Users List</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</th>
                <td><a href="{{ url('users/' . $user->id) }}">{{ $user->name }}</a></th>
            </tr>
            @endforeach
        </tbody>
    </table>
{{ $users->links() }}
</div>
@endsection