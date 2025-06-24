<!-- Extend the admin layout -->
@extends('admin.layout')

<!-- Define the content section -->
@section('content')
    <!-- Display a welcome message with the authenticated user's name -->
    <h2>Welcome, {{ auth()->user()->name }}</h2>
@endsection
