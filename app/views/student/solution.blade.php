@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="form-container">
            {{ Form::open(['class'=>'form', 'files'=>'true', 'autocomplete' => 'off']) }}
            <h2>Submit Solution for {{ $assignment->assignment_title }}</h2>
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="form-group">
                {{ Form::label('submission_file', 'Solution File') }}
                {{ Form::file('submission_file', null, ['class'=>'form-control']) }}
                <span class="help-block">{{ $errors->first('submission_file') }}</span>
            </div>
            <div class="form-group">
                {{ Form::submit('Add', ['class'=>'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop