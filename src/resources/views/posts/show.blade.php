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
            <th>{{ __('Title') }}</th>
            <th>{{ __('Body') }}</th>
            <th>{{ __('Created') }}</th>
            <th>{{ __('Updated') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
        </tr>
    </tbody>
</table>
</div>
@endsection
