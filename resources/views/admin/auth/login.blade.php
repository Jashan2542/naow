<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>

    <!-- Show validation error if any -->
    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Admin login form -->
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf {{-- CSRF protection --}}
        
        <!-- Email input -->
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <!-- Password input -->
        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <!-- Submit button -->
        <button type="submit">Login as Admin</button>
    </form>
</body>
</html>
