@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <div class="well">
        <a href="{{ url('faculty/create_assignment') }}" class="btn btn-primary">Add An Assignment</a>
        <div class="main-container">
            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif

            @if(count($assignments) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Assignment Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->course->course_title }}</td>
                            <td>{{ $assignment->assignment_title }}</td>
                            <td><a class="btn btn-sm btn-success" href="{{ url('faculty/assignment/'.$assignment->id) }}">View Solutions</a></td>
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
