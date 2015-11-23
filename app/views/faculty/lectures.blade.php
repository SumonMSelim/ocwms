@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')
    <div class="well">
        {{ HTML::link(URL::to('faculty/create_lecture'), 'Add A Lecture', ['class'=>'btn btn-primary']) }}
        <div class="main-container">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
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
                            <td>{{ $lecture->lecture_description }}</td>                                                  <td>{{ $lecture->course->course_title }}</td>
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