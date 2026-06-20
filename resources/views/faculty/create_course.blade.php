@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="form-container">
            <form method="POST" action="{{ url('faculty/create_course') }}" class="form" autocomplete="off">
                @csrf
                <h2>Add A Course</h2>
                @if(session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                <div class="form-group">
                    <label for="course_title">Course Title</label>
                    <input type="text" name="course_title" id="course_title" class="form-control" required>
                    <span class="help-block">{{ $errors->first('course_title') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
