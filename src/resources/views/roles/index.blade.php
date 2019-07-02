@extends('layouts.main')

@section('content')
<div class="roles-list">
        <table>
            <thead>
                <tr>
                    <th class="role-top" colspan="4">Roles List</th>
                </tr>
                <tr>
                    <th>Index</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td class="role-index">{{ $role->role_index }}</td>
                    <td class="role-name">
                        <a href="{{ url('roles/' . $role->role_index) }}">{{ $role->name }}</a>
                    </td>
                    <td class="datetime">{{ $role->created_at }}</td>
                    <td class="datetime">{{ $role->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection