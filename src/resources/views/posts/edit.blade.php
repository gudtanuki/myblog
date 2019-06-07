@extends('layouts.main')

@section('content')
<h1>Posts.Edit</h1>
<div class="post-edit">
    <form action="{{ url('posts/' . $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-item">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ $post->title }}" required autofocus>
        </div>
        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="6" required>{{ $post->body }}</textarea>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
