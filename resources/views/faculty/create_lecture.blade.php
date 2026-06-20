@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Admin Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="form-container">
            <form method="POST" action="{{ url('faculty/create_lecture') }}" class="form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <h2>Add A Lecture</h2>
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
                    <label for="lecture_title">Lecture Title</label>
                    <input type="text" name="lecture_title" id="lecture_title" class="form-control" required>
                    <span class="help-block">{{ $errors->first('lecture_title') }}</span>
                </div>
                <div class="form-group">
                    <label for="lecture_description">Lecture Description</label>
                    <textarea name="lecture_description" id="lecture_description" class="form-control" required></textarea>
                    <span class="help-block">{{ $errors->first('lecture_description') }}</span>
                </div>
                <div class="form-group">
                    <label for="lecture_file">Lecture File</label>
                    <input type="file" name="lecture_file" id="lecture_file" class="form-control" required>
                    <span class="help-block">{{ $errors->first('lecture_file') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
