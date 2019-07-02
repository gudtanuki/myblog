@extends('layouts.main')

@section('content')
<a href="{{ url('categories/create') }}">CategoryCreate</a>
<div class="categories-list">
        <table>
            <thead>
                <tr>
                    <th class="category-top" colspan="4">Categories List</th>
                </tr>
                <tr>
                    <th>No.</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="category-no">{{ $category->id }}</td>
                    <td class="role-name">
                        <a href="{{ url('categories/' . $category->id) }}">{{ $category->name }}</a>
                    </td>
                    <td class="datetime">{{ $category->created_at }}</td>
                    <td class="datetime">{{ $category->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection