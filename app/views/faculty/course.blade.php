@extends('faculty_master')

@section('title')
    <title>{{ $page_title }} | Faculty Panel</title>
@stop

@section('body')
    <div class="well">
        <div class="main-container">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
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
                            <td>{{ $student->user->first_name ." ". $student->user->last_name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>
                                @if(!empty($student->grade))
                                    {{ $student->grade }}
                                @else
                                    {{ Form::open(['class'=>'form-inline']) }}
                                    <select name="grade">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="F">F</option>
                                    </select>
                                    <input name="user_id" value="{{ $student->user_id }}" type="hidden">
                                    <div class="form-group">
                                        {{ Form::submit('Submit', ['class'=>'btn btn-sm btn-success']) }}
                                    </div>
                                    {{ Form::close() }}
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
@stop