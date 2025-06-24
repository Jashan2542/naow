<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <!-- Page Heading -->
    <h1>Admin Panel</h1>

    <!-- Navigation Links -->
    <nav>
        <a href="{{ url('/admin/dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin.users') }}">Users</a>
    </nav>

    <hr>

    <!-- Section where child views will inject their content -->
    @yield('content')
</body>
</html>
