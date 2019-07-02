@extends('layouts.main')

@section('content')
<div class="categories-create">
    <h1>New Category</h1>
    <form action="{{ url('categories') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-item form-group">
            <label for="name">Category</label>
            <input class="form-control" id="name" type="text" name="name" value="{{ old('category') }}" required autofocus>
        </div>

        <div class="submit-btn">
            <button type="submit" class="submit btn btn-primary btn-submit" name="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
