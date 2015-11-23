@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@stop

@section('body')

    <div class="well">
        <div class="alert alert-info">Logged in successfully as <b>{{ Sentry::getUser()->email }}</b></div>

        <div class="alert alert-success">
            <h3>Full Name: {{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}</h3>

            <h3>Last Login: {{ Sentry::getUser()->last_login }}</h3>
        </div>

        <div class="alert alert-info">
            <a class="btn btn-info" href="{{ URL::to('student/edit_profile') }}">Edit Profile</a>
            <a class="btn btn-danger" href="{{ URL::to('student/change_password') }}">Change Password</a>
        </div>

    </div>

@stop
