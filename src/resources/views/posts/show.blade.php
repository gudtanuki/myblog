@extends('layouts.main')

@section('content')
<div class="post-show">
    <h1>{{ $post->title }}</h1>
    <a class="username" href="{{ url('users/' . $post->user->id) }}">by {{ $post->user->name }}</a>
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
    <div class="post-info">
        <hr>
        <p class="datetime">created:{{ $post->created_at->format('Y-m-d') }}</p>
        <p class="datetime">updated:{{ $post->updated_at->format('Y-m-d') }}</p>
        <hr>
        <p class="post-body">{!! nl2br(e($post->body)) !!}</p>
        <hr>
        @if ($post->image !== null)
        <div class="image">
            <img class="image-size" src="data:image/png;base64,{{ $post->image }}">
        </div>
        <hr>
        @endif
    </div>
    <div class="comment-list">
        <h2>Comments</h2>
        <table>
            <tbody>
                @foreach ($post->comments as $comment)
                <tr>
                    <td>{{ $loop->iteration }}, </td>
                    <td>{{ $comment->body }}</td>
                    <td class="datetime">{{ $comment->created_at->format('Y-m-d') }}</td>
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
    <hr>
    <div class="comment-form">
        <form action="{{ url('comments') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
