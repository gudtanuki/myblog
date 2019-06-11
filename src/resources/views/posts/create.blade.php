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
        
        <div class="form-item" id="imageform">
            <label for="image" id="image-label">Image</label>
            <input type="file" name="image" id="image-input">
            <button type="button" id="image_reset">image reset</button>
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
    });
</script>
@endsection