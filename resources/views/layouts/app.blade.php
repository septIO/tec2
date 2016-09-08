<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <base href="/"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/app.css" rel="stylesheet"/>

    <!-- Styles -->
    @yield('stylesheets')

</head>
<body>
<div class="row-expanded">
    <header class="header">
        <h1 class="headline text-white lighter brand"><span>TEC</span>cargo</h1>
        <ul class="header-subnav">
            <li><a href="/" {{ Request::is('/') ? 'class=is-active' : null }}><i class="fa fa-home"></i> Home</a></li>
            <li><a href="/order" {{ Request::is('order') ? 'class=is-active' : null }}><i class="fa fa-truck"></i>
                    Bestil Levering</a></li>
            <li><a href="/tracking" {{ Request::is('tracking') ? 'class=is-active' : null }}><i class="fa fa-search"></i>
                    Tracking</a></li>
            <li><a href="/help" {{ Request::is('help') ? 'class=is-active' : null }}><i
                            class="fa fa-question-circle"></i> Hjælp</a></li>
            @if(Auth::check())
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


@yield('scripts')
</body>
</html>
