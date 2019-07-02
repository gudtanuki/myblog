@extends('layouts.main')

@section('content')
<div class="roles-show">
        <table>
            <thead>
                <tr>
                    <th class="role" colspan="4">{{ $role->name }}</th>
                </tr>
                <tr>
                    <th class="users" colspan="4">Users List</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($role->users as $key => $user)
                <tr>
                    <td class="user_no">{{ $key }}</td>
                    <td class="username">
                        <a href="{{ url('users/' . $user->id . '/edit') }}">{{ $user->name }}</a>
                    </td>
                    <td class="datetime">{{ $user->created_at }}</td>
                    <td class="datetime">{{ $user->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection