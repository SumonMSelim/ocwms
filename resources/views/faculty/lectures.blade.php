@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <div class="well">
        <a href="{{ url('faculty/create_lecture') }}" class="btn btn-primary">Add A Lecture</a>
        <div class="main-container">
            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif

            @if(count($lectures) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Lecture Title</th>
                        <th>Lecture Description</th>
                        <th>Course Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lectures as $lecture)
                        <tr>
                            <td>{{ $lecture->lecture_title }}</td>
                            <td>{{ $lecture->lecture_description }}</td>
                            <td>{{ $lecture->course->course_title }}</td>
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
