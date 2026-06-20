@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Admin Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="form-container">
            <form method="POST" action="{{ url('faculty/create_assignment') }}" class="form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <h2>Add An Assignment</h2>
                @if(session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                <div class="form-group">
                    <label for="course_id">Courses</label>
                    <select name="course_id" id="course_id" class="form-control">
                        @foreach($courses as $id => $title)
                            <option value="{{ $id }}">{{ $title }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ $errors->first('course_id') }}</span>
                </div>
                <div class="form-group">
                    <label for="assignment_title">Assignment Title</label>
                    <input type="text" name="assignment_title" id="assignment_title" class="form-control" required>
                    <span class="help-block">{{ $errors->first('assignment_title') }}</span>
                </div>
                <div class="form-group">
                    <label for="assignment_description">Assignment Description</label>
                    <textarea name="assignment_description" id="assignment_description" class="form-control" required></textarea>
                    <span class="help-block">{{ $errors->first('assignment_description') }}</span>
                </div>
                <div class="form-group">
                    <label for="assignment_file">Assignment File</label>
                    <input type="file" name="assignment_file" id="assignment_file" class="form-control" required>
                    <span class="help-block">{{ $errors->first('assignment_file') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
