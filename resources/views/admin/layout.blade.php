<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">

    <!-- Navigation Bar -->
    <nav class="admin-nav">
        <div class="nav-container">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.users') }}" class="nav-link">Users Details</a>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main class="admin-content">
        @yield('content') 
    </main>

</body>
</html>
