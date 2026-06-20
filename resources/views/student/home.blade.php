@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="alert alert-info">Logged in successfully as <b>{{ auth()->user()->email }}</b></div>
        <div class="alert alert-success">
            <h3>Full Name: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
        </div>
        <div class="alert alert-info">
            <a class="btn btn-info" href="{{ url('student/edit_profile') }}">Edit Profile</a>
            <a class="btn btn-danger" href="{{ url('student/change_password') }}">Change Password</a>
        </div>
    </div>
@endsection
