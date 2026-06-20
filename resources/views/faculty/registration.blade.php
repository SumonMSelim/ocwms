@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <form method="POST" action="{{ url('faculty/registration') }}" autocomplete="off" class="form-signin" role="form">
        @csrf
        <h2 class="form-signin-heading">Registration</h2>
        @if(session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required autofocus>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
    </form>
@endsection
