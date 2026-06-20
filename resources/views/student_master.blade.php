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
            <a class="navbar-brand" href="{{ url('student') }}">Student Panel</a>
        </div>
        <div class="collapse navbar-collapse">
            @auth
                @if(auth()->user()->isStudent())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('student/courses') }}">My Courses</a></li>
                        <li><a href="{{ url('student/browse') }}">Browse Courses</a></li>
                    </ul>
                @endif
            @endauth

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ url('student/registration') }}">Register</a></li>
                @else
                    <li><a href="{{ url('student/logout') }}">Logout</a></li>
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
