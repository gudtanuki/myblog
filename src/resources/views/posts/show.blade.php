@extends('layouts.main')

@section('content')
<h1>Posts.Show</h1>
<div>
    @can('update', $post)
    <div class="post-btns">
        <div class="edit-btn">
            <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-primary">Edit</a>
        </div>
        <div class="delete-btn">
            @component('components.delete-btn')
                @slot('controller', 'posts')
                @slot('id', $post->id)
                @slot('name', $post->title)s
            @endcomponent
        </div>
    </div>
    @endcan
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Posted by</th>
                <th>Body</th>
                <th>Image</th>
                <th>Created</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $post->title }}</td>
                <td><a href="{{ url('users/' . $post->user->id) }}">{{ $post->user->name }}</a></td>
                <td>{{ $post->body }}</td>
                <td>
                    @if ($post->image !== null)
                    <img src="data:image/png;base64,{{ $post->image }}">
                    @else
                    no
                    @endif
                </td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <div class="comment-list">
        <ul>Comments
            @foreach ($post->comments as $comment)
            <li>
                {{ $comment->body }}
                @can('update', $post)
                <form style="display:inline" action="{{ url('comments/' . $comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
                @endcan
            </li>
            @endforeach
        </ul>
    </div>
    <div class="comment-form">
        <form action="{{ url('comments') }}" method="post">
            @csrf
            @method('POST')
            <div>
                <label for="body">Comment</label>
                <textarea name="body" id="body" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>
@endsection
