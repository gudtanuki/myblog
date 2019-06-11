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
        <div class="form-item" id="imageform">
            <label for="image" id="image-label">Image</label>
            @if ($post->image !== null)
            <img id="image-view" src="data:image/png;base64,{{ $post->image }}">
            <button type="button" id="image_delete">image delete</button>         
            @else
            <input type="file" name="image" id="image-input">
            <button type="button" id="image_reset">image reset</button>
            @endif
            </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<script>
    $(function() {
        $("#image_reset").on("click", function(){
            $("#image-input").remove();
            $('#image-label').after('<input type="file" name="image" id="image-input">');
        });

        $("#image_delete").on("click", function(){
            $("#image-view").remove();
            $("#image_delete").remove();
            $('#image-label').after('<input type="file" name="image" id="image-input" value="null"><button type="button" id="image_reset">image reset</button>');
        });
    });
</script>
@endsection
