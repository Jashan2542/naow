<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-page">

    <div class="login-container">
        <h2 class="login-title">Admin Login</h2>

        <!-- Show validation error if any -->
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Admin login form -->
        <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
            @csrf

            <!-- Email input -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required class="form-input">

            <!-- Password input -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required class="form-input">

            <!-- Submit button -->
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>

</body>
</html>
