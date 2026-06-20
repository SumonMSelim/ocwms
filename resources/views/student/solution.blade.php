@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="form-container">
            <form method="POST" action="{{ url('student/assignment_submission/'.$assignment->id) }}" class="form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <h2>Submit Solution for {{ $assignment->assignment_title }}</h2>
                @if(session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                <div class="form-group">
                    <label for="submission_file">Solution File</label>
                    <input type="file" name="submission_file" id="submission_file" class="form-control" required>
                    <span class="help-block">{{ $errors->first('submission_file') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
