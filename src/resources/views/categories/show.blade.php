@extends('layouts.main')

@section('content')
<div class="categories-show">
        <div class="btns">
                <a href="{{ url('categories/' . $category->id . '/edit') }}" class="btn btn-outline-primary btn-edit">Edit</a>
                @component('components.delete-btn')
                    @slot('controller', 'categories')
                    @slot('id', $category->id)
                    @slot('name', $category->name)
                @endcomponent
            </div>
        <table>
            <thead>
                <tr>
                    <th class="category" colspan="4">Categiry: {{ $category->name }}</th>
                </tr>
                <tr>
                    <th class="users" colspan="4">Users List</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->posts as $key => $post)
                <tr>
                    <td class="post_no">{{ $key + 1 }}</td>
                    <td class="title">
                        <a href="{{ url('posts/' . $post->id . '/edit') }}">{{ $post->title }}</a>
                    </td>
                    <td class="datetime">{{ $post->created_at }}</td>
                    <td class="datetime">{{ $post->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection