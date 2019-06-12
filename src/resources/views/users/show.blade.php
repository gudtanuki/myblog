@extends('layouts.main')

@section('content')
<h1>Users.Show</h1>
<div>
    @can('update', $user)
    <div class="user-btns">
        <div class="edit-btn">
            <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary">Edit</a>
        </div>
        <div class="delete-btn">
            @component('components.delete-btn')
                @slot('controller', 'users')
                @slot('id', $user->id)
                @slot('name', $user->name)
            @endcomponent
        </div>
    </div>
    @endcan
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
            </tr>
        </tbody>
    </table>
    <div class="users-posts">
        <p>MY POSTS</p>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
                @foreach ($user->posts as $post)
                <tr>
                    <td><a href="{{ url('posts/' . $post->id) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                </tr>
                @endforeach
            </thead>
        </table>
    </div>
</div>
@endsection
