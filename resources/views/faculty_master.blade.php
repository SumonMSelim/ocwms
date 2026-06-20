<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @section('title')
    @show
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="{{ asset('assets/css/bureau.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/daterangepicker-bs3.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('faculty') }}">Faculty Panel</a>
        </div>
        <div class="collapse navbar-collapse">
            @auth
                @if(auth()->user()->isFaculty())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('faculty/courses') }}">Courses</a></li>
                        <li><a href="{{ url('faculty/lectures') }}">Lectures</a></li>
                        <li><a href="{{ url('faculty/assignments') }}">Assignments</a></li>
                    </ul>
                @endif
            @endauth

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ url('faculty/registration') }}">Register</a></li>
                @else
                    <li><a href="{{ url('faculty/logout') }}">Logout</a></li>
                @endguest
            </ul>
        </div>
    </div>
</div>

<div class="container">
    @yield('body')
</div>

@section('footer')
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
@show

</body>
</html>
