@extends('layouts.main')

@section('content')
<h1>Posts.Edit</h1>
<div class="post-edit">
    <form action="{ route('posts.edit') }" method="post">
        @csrf
        @method('PUT')
        <div class="form-item">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ $post->title }}" required autofocus>
        </div>
        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="6" value="{{ $post->body }}" required></textarea>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
