<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Makes the page responsive on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registration</title>

    <!-- Link to the external CSS stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Include the site header component -->
    @include('components.header')
</head>
<body>

<!-- Main wrapper to center and style the page -->
<div class="page-wrapper">
    <div class="form-wrapper">
        <!-- Form title -->
        <h2 class="form-title">Register Form</h2>

        <!-- Display validation error messages, if any -->
        @if ($errors->any())
            <div class="form-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> <!-- Each error message -->
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display success message from session -->
        @if (session('success'))
            <p class="form-message">{{ session('success') }}</p>
        @endif

        <!-- Registration form -->
        <form class="register-form" id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf <!-- CSRF protection token -->

            <!-- Name input -->
            <input name="name" placeholder="Name" class="form-input" required><br>

            <!-- Email input -->
            <input name="email" placeholder="Email" type="email" class="form-input" required><br>

            <!-- Password input -->
            <input name="password" placeholder="Password" type="password" class="form-input" required><br>

            <!-- Confirm password input -->
            <input name="password_confirmation" placeholder="Confirm Password" type="password" class="form-input" required><br>

            <!-- Submit button -->
            <button type="submit" class="form-button">Register</button>

            <!-- Link to login page -->
            <a href="{{ route('login.form') }}" class="nav-link">Login</a>
        </form>
    </div>
</div>

<!-- Include the site footer component -->
@include('components.footer')

</body>
</html>