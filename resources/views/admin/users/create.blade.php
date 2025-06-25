@extends('admin.layout')

@section('content')
<div class="admin-content">
    <h2 class="page-title">Add New User</h2>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <label>Name</label>
        <input type="text" name="name" class="form-input" required>

        <label>Email</label>
        <input type="email" name="email" class="form-input" required>

        <label>Password</label>
        <input type="password" name="password" class="form-input" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-input" required>

        <button type="submit" class="btn-submit">Add User</button>
    </form>
</div>
@endsection
