@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::open(['class'=>'form', 'autocomplete'=>'off']) }}
            <h2>Change Password</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('password', 'New Password') }}
                <input type="password" name="password" class="form-control" required>
                <span class="help-block">{{ $errors->first('password') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Retype New Password') }}
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                {{ Form::submit('Change Password', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop