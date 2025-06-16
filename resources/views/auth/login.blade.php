<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">

<!-- Include header layout -->
@include('components.header')

<div class="login-wrapper">
    <div class="login-box">
        <h2>Login</h2>

        <!-- Login form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- CSRF token for form security -->

            <!-- Email input field -->
            <input type="email" name="email" placeholder="Email" required>

            <!-- Password input field -->
            <input type="password" name="password" placeholder="Password" required>
            
            <!-- Display validation error for email -->
            @if ($errors->has('email'))
                <div class="error-message">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Submit login button -->
            <button type="submit">Login</button>

            <!-- Link to registration page -->
            <a href="{{ route('register.form') }}" class="nav-link">Register</a> 
        </form>

        <!-- Optional message element -->
        <p id="msg"></p>
    </div>
</div>

<!-- Include footer layout -->
@include('components.footer')

</body>
</html>