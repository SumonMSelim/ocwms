<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/startup/flat-ui/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/startup/flat-ui/css/flat-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/startup/common-files/css/icon-font.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/startup/common-files/css/animations.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/static/css/style.css') }}" rel="stylesheet">
    <title>Open Courseware Management System</title>
</head>
<body>
<div class="page-wrapper">
    <header class="header-2">
        <div class="container">
            <div class="row">
                <nav class="navbar col-sm-12" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle"></button>
                        <a class="brand" href="">
                            <img src="{{ asset('assets/startup/common-files/icons/Infinity-Loop@2x.png') }}" width="50" height="50" alt="">
                            OCW Management System
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <section class="header-2-sub bg-midnight-blue">
        <div class="background">&nbsp;</div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="hero-unit">
                        <h1>Learn & Teach. Anytime. Anywhere</h1>
                    </div>
                    <div class="btns">
                        <a class="btn btn-info" href="{{ url('faculty') }}">Faculty Area</a>
                        <a class="btn btn-success" href="{{ url('student') }}">Student Area</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
