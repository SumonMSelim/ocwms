@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Admin Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::open(['class'=>'form', 'files'=>'true', 'autocomplete' => 'off']) }}
            <h2>Add A Lecture</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('course', 'Courses') }}
                {{ Form::select('course_id', $courses, null, ['id'=>'course_id']) }}
                <span class="help-block">{{ $errors->first('course_id') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('title', 'Lecture Title') }}
                {{ Form::text('lecture_title', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('lecture_title') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('lecture_description', 'Lecture Description') }}
                {{ Form::textarea('lecture_description', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('lecture_description') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('lecture_file', 'Lecture File') }}
                {{ Form::file('lecture_file', null, ['class'=>'form-control']) }}
                <span class="help-block">{{ $errors->first('lecture_file') }}</span>
            </div>
            <div class="form-group">
                {{ Form::submit('Add', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop