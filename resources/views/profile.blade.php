<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="profile-page">

<!-- Include the site header (reusable component) -->
@include('components.header')

<!-- Profile wrapper to center the content -->
<div class="profile-wrapper">
    <div class="profile-card">

        <!-- Display welcome message with user's name -->
        <h2 class="profile-title">Welcome, {{ $user->name }}</h2>

        <!-- Section to show user's name and email -->
        <div class="profile-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <!-- 🔹 Button to navigate to Create Post form -->
        <div class="create-post-button">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create New Post</a>
        </div>

        <!-- 🔹 List of the user's posts -->
        <div class="user-posts">
            <h3>Your Posts:</h3>

            <!-- Check if the user has any posts -->
            @if($user->posts->count())
                <ul>
                    <!-- Loop through each post and display title and body -->
                    @foreach($user->posts as $post)
                        <li>
                            <strong>{{ $post->title }}</strong><br>
                            {{ $post->body }}
                        </li>
                    @endforeach
                </ul>
            @else
                <!-- If no posts exist, show a message -->
                <p>You haven't created any posts yet.</p>
            @endif
        </div>

        <!-- Logout form with CSRF protection -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</div>

<!-- Include the site footer (reusable component) -->
@include('components.footer')

</body>
</html>
