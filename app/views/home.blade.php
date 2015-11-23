<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    {{ HTML::style('assets/startup/flat-ui/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('assets/startup/flat-ui/css/flat-ui.css') }}
    {{ HTML::style('assets/startup/common-files/css/icon-font.css') }}
    {{ HTML::style('assets/startup/common-files/css/animations.css') }}
    {{ HTML::style('assets/static/css/style.css') }}

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
                        <a class="brand" href=""><img src="{{ URL::to('assets/startup/common-files/icons/Infinity-Loop@2x.png') }}" width="50"
                                                       height="50" alt=""> OCW Management System</a>
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
                        <a class="btn btn-info" href="{{ URL::to('faculty') }}">Faculty Area</a>
                        <a class="btn btn-success" href="{{ URL::to('student') }}">Student Area</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>