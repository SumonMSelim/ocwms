@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')

    {{ Form::open(['url'=>'faculty/login', 'autocomplete' => 'off', 'class'=>'form-signin', 'role'=>'form']) }}
    <h2 class="form-signin-heading">Login</h2>
    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="form-group">
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', '', ['class'=>'form-control','placeholder'=>'Email address','required'=>'true', 'autofocus'=>'true']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class'=>'form-control','placeholder'=>'Password','required'=>'true']) }}
    </div>
    <label class="checkbox" for="remember">
        <input type="checkbox" name="remember" value="remember"> Remember me
    </label>
    {{ Form::submit('Sign in',['class'=>'btn btn-lg btn-primary btn-block']) }}
    {{ Form::close() }}

@stop