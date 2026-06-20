@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="main-container">
            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif

            @if(count($courses) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->course->course_title }}</td>
                            <td><a class="btn btn-sm btn-success" href="{{ url('student/course/'.$course->course_id) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No data available to view!</div>
            @endif
        </div>
    </div>
@endsection
