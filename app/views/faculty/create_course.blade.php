@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::open(['class'=>'form', 'autocomplete'=>'off']) }}
            <h2>Add A Course</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('course_title', 'Course Title') }}
                {{ Form::text('course_title', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('course_title') }}</span>
            </div>

            <div class="form-group">
                {{ Form::submit('Add', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop