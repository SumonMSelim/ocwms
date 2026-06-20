@extends('student_master')

@section('title')
    <title>{{ $page_title }} | Student Panel</title>
@endsection

@section('body')
    <div class="well">
        <div class="form-container">
            <form method="POST" action="{{ url('student/change_password') }}" class="form">
                @csrf
                <h2>Change Password</h2>
                @if(session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <span class="help-block">{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
