@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <form method="POST" action="{{ url('faculty/login') }}" autocomplete="off" class="form-signin" role="form">
        @csrf
        <h2 class="form-signin-heading">Login</h2>
        @if(session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>
        <label class="checkbox" for="remember">
            <input type="checkbox" name="remember" id="remember" value="1"> Remember me
        </label>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
    </form>
@endsection
