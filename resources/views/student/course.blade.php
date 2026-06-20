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
            <h3>{{ $course->course_title }}</h3>

            <div class="alert alert-warning">
                Grade Earned: <strong>{{ $grade?->grade ?? 'Pending' }}</strong>
            </div>

            <div class="alert alert-info">
                <strong>Lectures</strong>
            </div>
            @if(count($course->lectures) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($course->lectures as $lecture)
                        <tr>
                            <td>{{ $lecture->lecture_title }}</td>
                            <td>{{ $lecture->lecture_description }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ asset('uploads/lecture_files/'.$lecture->lecture_files) }}">Download</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No lectures available to view!</div>
            @endif

            <div class="alert alert-info">
                <strong>Assignments</strong>
            </div>
            @if(count($course->assignments) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th>Solution</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($course->assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->assignment_title }}</td>
                            <td>{{ $assignment->assignment_description }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ asset('uploads/assignment_files/'.$assignment->assignment_files) }}">Download</a>
                            </td>
                            <td>
                                @if(\App\Models\Submission::where(['assignment_id' => $assignment->id, 'student_id' => auth()->id()])->count() == 0)
                                    <a class="btn btn-sm btn-danger" href="{{ url('student/assignment_submission/'.$assignment->id) }}">Submit Assignment</a>
                                @else
                                    Submitted
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No assignments available to view!</div>
            @endif
        </div>
    </div>
@endsection
