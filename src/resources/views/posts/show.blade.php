@extends('layouts.main')

@section('content')
<h1>Posts.Show</h1>
<div>
    <div class="post-btns">
        <div class="edit-btn">
            <a href="{{ url('posts/' . $post->id . '/edit') }}">Edit</a>
        </div>
        <div class="delete-btn">
            <a href="{{ url('posts/' . $post->id . '/delete') }}">Delete</a>
        </div>
    </div>
    <table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Posted by</th>
            <th>Body</th>
            <th>Created</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $post->title }}</td>
            <td><a href="{{ url('users/' . $post->user->id) }}">{{ $post->user->name }}</a></td>
            <td>{{ $post->body }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
        </tr>
    </tbody>
</table>
</div>
@endsection
