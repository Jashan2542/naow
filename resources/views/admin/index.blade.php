<!-- Extend the admin layout (optional layout) -->
@extends('admin.layout')

<!-- Define the content section -->
@section('content')
    {{-- Page heading --}}
    <h2>All Users</h2>

    <!-- Display success message if user was deleted -->
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <!-- Users table -->
    <table border="1" cellpadding="10" cellspacing="0" >
        <thead>
            <tr>
                <!-- Table headers -->
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through each user -->
            @foreach ($users as $user)
            <tr>
                <!-- Display user data -->
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <!-- Delete button for each user -->
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure to delete this user?');">
                        @csrf {{-- CSRF token --}}
                        @method('DELETE') {{-- Spoofing the DELETE method --}}
                        <button type="submit" style="color: red;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
