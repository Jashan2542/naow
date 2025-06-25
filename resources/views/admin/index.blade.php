@extends('admin.layout')

@section('content')
    <!-- Page heading -->
    <h2 class="page-title">All Users</h2>

    <!-- Success message -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- Users Table -->
    <table class="users-table">
        <thead>
            <tr><!-- User table column name -->
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr><!-- Featch user details -->
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <!-- Delete Button -->
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="add-user-wrapper">
    <a href="{{ route('admin.users.create') }}" class="btn-add-user">+ Add User</a>
</div>

@endsection
