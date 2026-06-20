@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="main-container">
            @if(session('message'))
                <div class="alert alert-info">{{ session('message') }}</div>
            @endif
            <h3>Assignment Solutions</h3>

            @if(count($solutions) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student Email</th>
                        <th>Submission Time</th>
                        <th>Solution</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($solutions as $solution)
                        <tr>
                            <td>{{ $solution->student->first_name }} {{ $solution->student->last_name }}</td>
                            <td>{{ $solution->student->email }}</td>
                            <td>{{ $solution->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ asset('uploads/solution_files/'.$solution->submission_files) }}">Download</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No solutions available to view!</div>
            @endif
        </div>
    </div>
@endsection
