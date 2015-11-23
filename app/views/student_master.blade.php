<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @section('title')
        @show

                <!-- Google web fonts -->
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet'>

        {{ HTML::style('assets/css/bureau.css') }}
        {{ HTML::style('assets/css/daterangepicker-bs3.css') }}
        {{ HTML::style('assets/css/signin.css') }}
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
            <a class="navbar-brand" href="{{ URL::to('student') }}">Student Panel</a>
        </div>
        <div class="collapse navbar-collapse">
            {{-- if logged in --}}
            @if ( Sentry::check() )
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('student/courses') }}">My Courses</a></li>
                    <li><a href="{{ URL::to('student/browse') }}">Browse Courses</a></li>
                </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">
                @if (! Sentry::check() )
                    <li><a href="{{ URL::to('student/registration') }}">Register</a></li>
                @else
                    <li><a href="{{ URL::to('student/logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="container">
    @yield('body')
</div>

@section('footer')
    {{ HTML::script('assets/js/jquery.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
@show

</body>
</html>
