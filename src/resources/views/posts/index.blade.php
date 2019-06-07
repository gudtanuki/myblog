@extends('layouts.main')

@section('content')
<h1>Posts.Index(TOP)</h1>

<div>
    <table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Posted by</th>
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
            <td>
                <a href="{{ url('users/' . $post->user->id) }}">{{ $post->user->name }}</a>
            </td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
