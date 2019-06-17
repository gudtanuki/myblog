@extends('layouts.main')

@section('content')
<div class="form-area">
    <h1>Edit Post</h1>
    <form action="{{ url('posts/' . $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-item form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus>
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        <div class="form-item form-group">
            <label for="body">Body</label>
            <textarea class="form-control @if ($errors->has('body')) is-invalid @endif" name="body" id="body" rows="6" required>{{ old('body', $post->body) }}</textarea>
            @if ($errors->has('body'))
                <span class="invalid-feedback">
                    {{ $errors->first('body') }}
                </span>
            @endif
        </div>
        <div class="form-item form-group" id="imageform">
            <label for="image" id="image-label">Image</label>
            @if ($post->image !== null)
            <img id="image-view" src="data:image/png;base64,{{ $post->image }}">
            <button type="button" class="btn btn-secondary" id="image_delete">image delete</button>         
            @endif
            <div>
                <input type="file" class="form-control @if ($errors->has('image')) is-invalid @endif" id="image-input" name="image">
                <button type="button" class="btn btn-secondary" id="image_reset">image reset</button>
            </div>
            @if ($errors->has('image'))
                <span class="invalid-feedback">
                    {{ $errors->first('image') }}
                </span>
            @endif
            </div>
        <button type="submit"  class="submit btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<script>
    $(function() {
        var test = "form-control @if ($errors->has('image')) is-invalid @endif";
        $("#image_reset").on("click", function(){
            $("#image-input").remove();
            $('#image-label').after('<input type="file" class="form-control <?php if ($errors->has("image")){echo "is-invalid";}?>" id="image-input" name="image">');
        });
        $("#image_delete").on("click", function(){
            $("#image-view").remove();
            $("#image_delete").remove();
            $('#image-label').after('<input type="hidden" name="noimage" value="null">');
        });
    });
</script>
@endsection