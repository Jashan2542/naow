<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="profile-page">

<!-- Include the header component -->
@include('components.header')

<!-- Profile wrapper to center the card -->
<div class="profile-wrapper">
    <div class="profile-card">
        <!-- Greeting with the logged-in user's name -->
        <h2 class="profile-title">Welcome, {{ $user->name }}</h2>

        <!-- User information section -->
        <div class="profile-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <!-- Logout form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- CSRF token for security -->
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</div>

<!-- Include the footer component -->
@include('components.footer')

</body>
</html>
