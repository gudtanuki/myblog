@extends('layouts.main')

@section('content')
<h1><span>Posts</span></h1>
<div class="posts-table">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Created</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>
                    <a href="{{ url('posts/' . $post->id) }}">{{ $post->title }}</a>
                </td>
                <td class="username">
                    <a href="{{ url('users/' . $post->user->id) }}">{{ $post->user->name }}</a>
                </td>
                <td class="datetime">{{ $post->created_at }}</td>
                <td class="datetime">{{ $post->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $posts->links() }}
@endsection