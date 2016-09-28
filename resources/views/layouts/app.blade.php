<!DOCTYPE html>
<html lang="en" ng-app="app" ng-cloak>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','TECcargo')</title>

    <!-- Fonts -->
    <base href="/"/>
    <link rel="icon" href="images/logo.png" type="image/png"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/app.css" rel="stylesheet"/>
    <!-- Styles -->
    @yield('stylesheets')

</head>
<body ng-controller="mainController">
<div class="row-expanded hide-for-print">
    <header class="header">
        <h1 class="headline text-white lighter brand"><span>TEC</span>cargo</h1>
        <ul class="header-subnav">
            <li><a href="/" {{ Request::is('/') ? 'class=is-active' : null }}><i class="fa fa-home"></i> Home</a></li>
            @if(Auth::check())
                <li><a href="/history" {{ Request::is('history') ? 'class=is-active' : null }}><i
                                class="fa fa-clipboard"></i>
                        Ordre historik</a>
                </li>
            @endif
            <li><a href="/order" {{ Request::is('order') ? 'class=is-active' : null }}><i class="fa fa-truck"></i>
                    Bestil Levering</a></li>
            <li><a href="/tracking" {{ Request::is('tracking') ? 'class=is-active' : null }}><i
                            class="fa fa-search"></i>
                    Tracking</a></li>

            @if(Auth::check())
                @if(Auth::user()->can('update-tracking'))
                    <li><a href="/update-tracking" {{ Request::is('update-tracking') ? 'class=is-active' : null }}><i
                                    class="fa fa-eye"></i>
                            Opdater Tracking</a></li>
                @endif
                <li><a href="/logout"><i class="fa fa-close"></i> Logout</a></li>
            @else
                <li><a href="/login" {{ Request::is('login') ? 'class=is-active' : null }}><i class="fa fa-key"></i>
                        Login</a></li>
            @endif
        </ul>
    </header>
</div>
<div class="row content-wrapper">
    <div class="small-12 columns">
        @yield('content')
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/underscore.js"></script>
<script src="js/app.js"></script>

@yield('scripts')
</body>
</html>
