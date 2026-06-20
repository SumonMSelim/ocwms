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
            <h3>Students</h3>

            @if(count($students) > 0)
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student Email</th>
                        <th>Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>
                                @if(!empty($student->grade))
                                    {{ $student->grade }}
                                @else
                                    <form method="POST" action="{{ url('faculty/course/'.$course_id) }}" class="form-inline">
                                        @csrf
                                        <select name="grade">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="F">F</option>
                                        </select>
                                        <input name="user_id" value="{{ $student->user_id }}" type="hidden">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                        </div>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No students enrolled!</div>
            @endif
        </div>
    </div>
@endsection
