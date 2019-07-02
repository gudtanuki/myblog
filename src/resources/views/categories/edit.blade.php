@extends('layouts.main')

@section('content')
<div class="categories-edit">
    <h1>Edit Category</h1>
    <form action="{{ url('categories/' . $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-item form-group">
            <label for="name">Category</label>
            <input class="form-control" id="name" type="text" name="name" value="{{ old('category', $category->name) }}" required autofocus>
        </div>

        <div class="submit-btn">
            <button type="submit" class="submit btn btn-primary btn-submit" name="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
