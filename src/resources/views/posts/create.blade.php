@extends('layouts.main')

@section('content')
<h1>Posts.Create</h1>
<div class="post-create">
    <form action="{{ url('posts') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-item">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" required autofocus>
        </div>
        <div class="form-item">
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="6" required></textarea>
        </div>
        <div class="form-item">
            <label for="image">Image</label>
            <input type="file" name="image">
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
@endsection
