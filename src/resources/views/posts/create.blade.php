@extends('layouts.main')

@section('content')
<div class="form-area">
    <h1>New Post</h1>
    <form action="{{ url('posts') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-item form-group">
            <label for="title">Title</label>
            <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name="title" value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        <div class="form-item form-group">
            <label for="body">Body</label>
            <textarea class="form-control  @if ($errors->has('body')) is-invalid @endif" id="body" name="body" rows="6" required>{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <span class="invalid-feedback">
                    {{ $errors->first('body') }}
                </span>
            @endif
        </div>
        
        <div class="form-item form-group">
            <label for="image" id="image-label">Image</label>
            <input type="file" class="form-control @if ($errors->has('image')) is-invalid @endif" id="image-input" name="image">
            @if ($errors->has('image'))
                <span class="invalid-feedback">
                    {{ $errors->first('image') }}
                </span>
            @endif
            <button type="button" class="btn btn-secondary" id="image_reset">image reset</button>
        </div>
        <button type="submit" class="submit-btn btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<script>
    $(function() {
        $("#image_reset").on("click", function(){
            $("#image-input").remove();
            $('#image-label').after('<input type="file" class="form-control <?php if ($errors->has("image")){echo "is-invalid";}?>" id="image-input" name="image">');
        });
    });
</script>
@endsection