@extends('layouts.main')

@section('content')
<h1>{{ $post->title }}</h1>
<div>
    @can('update', $post)
    <div class="post-btns">
        <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-primary">Edit</a>
        @component('components.delete-btn')
            @slot('controller', 'posts')
            @slot('id', $post->id)
            @slot('name', $post->title)
        @endcomponent
    </div>
    @endcan
    <div class="posts-table">
        <table>
            <thead>
                <tr>
                    <th>Posted by</th>
                    <th>Body</th>
                    <th>Image</th>
                    <th class="datetime">Created</th>
                    <th class="datetime">Update</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="username"><a href="{{ url('users/' . $post->user->id) }}">{{ $post->user->name }}</a></td>
                    <td>{{ $post->body }}</td>
                    <td>
                        @if ($post->image !== null)
                        <img class="image-size" src="data:image/png;base64,{{ $post->image }}">
                        @else
                        no
                        @endif
                    </td>
                    <td class="datetime">{{ $post->created_at }}</td>
                    <td class="datetime">{{ $post->updated_at }}</td>
                </tr>
            </tbody>
        </table>
        <div class="comment-list">
            <table>
                Comments
                <tbody>
                    @foreach ($post->comments as $comment)
                    <tr>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at }}</td>
                        @can('update', $post)
                        <td>
                            @component('components.delete-btn')
                                @slot('controller', 'comments')
                                @slot('id', $comment->id)
                                @slot('name', $comment->body)
                            @endcomponent
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="comment-form">
            <form action="{{ url('comments') }}" method="post">
                @csrf
                @method('POST')
                <div>
                    <label for="body">Comment</label>
                    <textarea name="body" id="body" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
