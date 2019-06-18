@extends('layouts.main')

@section('content')
<div class="users-show">

    @can('update', $user)
    <div class="btns">
        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-outline-primary btn-edit">Edit</a>
        @component('components.delete-btn')
            @slot('controller', 'users')
            @slot('id', $user->id)
            @slot('name', $user->name)
        @endcomponent
    </div>
    @endcan
    <h1>User:{{ $user->name }}</h1>
</div>
<div class="my-posts-list">
    @if ($user->posts[0])
    <table>
        <thead>
            <tr>
                <th class="post-top" colspan="3">My Posts</th>
            </tr>
            <tr>
                <th>Title</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->posts as $post)
            <tr>
                <td><a href="{{ url('posts/' . $post->id) }}">{{ $post->title }}</a></td>
                <td class="datetime">{{ $post->created_at }}</td>
                <td class="datetime">{{ $post->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $user->posts->links() }}
    @else
    <p class="no-post">No Posts</p>   
    @endif
</div>  
@endsection
