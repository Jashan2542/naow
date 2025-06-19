<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="create-post-page">

    <!-- Include the header component (e.g., navigation bar) -->
    @include('components.header')

    <!-- Wrapper to center the form card -->
    <div class="form-container">
        <div class="form-card">
            <!-- Page title -->
            <h2 class="form-title">Create a New Post</h2>

            <!-- Form to submit the post -->
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf <!-- CSRF token for form protection -->

                <!-- Input field for post title -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <!-- Textarea for post body/content -->
                <div class="form-group">
                    <label for="body">Your content:</label>
                    <textarea name="body" id="body" rows="6" required></textarea>
                </div>

                <!-- Submit button to save the post -->
                <button type="submit" class="submit-btn">Publish</button>
            </form>
        </div>
    </div>

    <!-- Include the footer component -->
    @include('components.footer')

</body>
</html>
