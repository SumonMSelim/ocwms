@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@stop

@section('body')

    {{ Form::open(['url'=>'student/registration', 'autocomplete' => 'off', 'class'=>'form-signin', 'role'=>'form']) }}
    <h2 class="form-signin-heading">Registration</h2>
    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="form-group">
        {{ Form::label('first_name', 'First Name') }}
        {{ Form::text('first_name', '', ['class'=>'form-control','placeholder'=>'First Name','required'=>'true', 'autofocus'=>'true']) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name') }}
        {{ Form::text('last_name', '', ['class'=>'form-control','placeholder'=>'Last Name','required'=>'true']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', '', ['class'=>'form-control','placeholder'=>'Email address','required'=>'true', 'autofocus'=>'true']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class'=>'form-control','placeholder'=>'Password','required'=>'true']) }}
    </div>
    {{ Form::submit('Register',['class'=>'btn btn-lg btn-primary btn-block']) }}
    {{ Form::close() }}

@stop