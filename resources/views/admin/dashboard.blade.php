@extends('admin.layout')

@section('content')
    <h2>Welcome, {{ auth()->user()->name }}</h2>

    <div class="stats-grid">
        <div class="stat-box">
            <h3>{{ $usersToday }}</h3>
            <p>Users Registered Today</p>
        </div>

        <div class="stat-box">
            <h3>{{ $usersYesterday }}</h3>
            <p>Users Registered Yesterday</p>
        </div>

        <div class="stat-box">
            <h3>{{ $last7Days }}</h3>
            <p>Users in Last 7 Days</p>
        </div>

        <div class="stat-box">
            <h3>{{ $totalUsers }}</h3>
            <p>Total Users</p>
        </div>
    </div>
@endsection
