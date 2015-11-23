@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="main-container">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
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
                            <td>{{ $course->course_title }}</td>
                            <td>
                                @if(UC::where(['course_id' => $course->id, 'user_id' => Session::get('user_id')])->count() == 0)
                                    <a class="btn btn-sm btn-success"
                                       href="{{ URL::to('student/enroll', $course->id) }}">Enroll</a></td>
                            @else
                                Enrolled
                            @endif
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