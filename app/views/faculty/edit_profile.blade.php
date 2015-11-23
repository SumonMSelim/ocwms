@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::model($user, ['class'=>'form']) }}
            <h2>Edit Profile</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('first_name') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('last_name') }}</span>
            </div>
            <div class="form-group">
                {{ Form::submit('Update Profile', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop