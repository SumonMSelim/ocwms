@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@stop

@section('body')
    <div class="well">
        {{ HTML::link(URL::to('faculty/create_assignment'), 'Add An Assignment', ['class'=>'btn btn-primary']) }}
        <div class="main-container">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            @if(count($assignments) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Assignment Title</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->id }}</td>
                            <td>{{ $assignment->course->course_title }}</td>
                            <td>{{ $assignment->assignment_title }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No data available to view!</div>
            @endif
        </div>
    </div>
@stop