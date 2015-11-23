@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Admin Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::open(['class'=>'form', 'files'=>'true', 'autocomplete' => 'off']) }}
            <h2>Add An Assignment</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('course', 'Courses') }}
                {{ Form::select('course_id', $courses, null, ['id'=>'course_id']) }}
                <span class="help-block">{{ $errors->first('course_id') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('title', 'Assignment Title') }}
                {{ Form::text('assignment_title', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('assignment_title') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('assignment_description', 'Assignment Description') }}
                {{ Form::textarea('assignment_description', null, ['class'=>'form-control', 'required'=>'true']) }}
                <span class="help-block">{{ $errors->first('assignment_description') }}</span>
            </div>
            <div class="form-group">
                {{ Form::label('assignment_file', 'Assignment File') }}
                {{ Form::file('assignment_file', null, ['class'=>'form-control']) }}
                <span class="help-block">{{ $errors->first('assignment_file') }}</span>
            </div>
            <div class="form-group">
                {{ Form::submit('Add', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop