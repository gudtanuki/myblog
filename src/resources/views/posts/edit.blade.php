@extends('layouts.main')

@section('content')
<h1>Posts.Edit</h1>
<div class="post-edit">
    <form action="{{ url('posts/' . $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-item">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ $post->title }}" required autofocus>
        </div>
        <div class="form-item">
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="6" required>{{ $post->body }}</textarea>
        </div>
        <div class="form-item">
            <label for="image">Image</label>
            @if ($post->image !== null)
            <img src="data:image/png;base64,{{ $post->image }}">            
            @else
            <input type="file" name="image">
            @endif
            </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
