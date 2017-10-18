<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- SEO meta and images -->
    <meta name="copyright"   content="Copyright 2017 by MegaProgramming, All Rights Reserved, V 1.0.0" >
    <meta name="author"      content="MegaProgramming" >
    <meta name="Keywords"    content="MegaProgramming" >
    <meta name="description" content="MegaProgramming">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta property="og:image"   content="{{url('/public/img/favicon.png')}}">
    <link rel="shortcut icon" href="{{url('/public/img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('/public/img/favicon.png')}}" type="image/png">
    <link rel="apple-touch-icon" href="{{url('/public/img/apple-touch-icon.png')}}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{url('/public/jquery/bootstrap.min.css')}}" >

    <!-- font-awesome -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" >

    <!-- Custom css-->
    <link rel="stylesheet" href="{{url('/public/css/custom.css')}}" >

    @yield('head')
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{url('/public/jquery/jquery.min.js')}}"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{url('/public/jquery/bootstrap.min.js')}}"></script>
	
	<!--  * Modernizr v2.8.2  -->
	<script src="{{url('/public/jquery/modernizr.js')}}"></script>
	
	<script>	
	// Animate loader off screen
	$(window).load(function() {		
		$(".se-pre-con").fadeOut();
	});
	</script>
	
</head>
<body>
<div class="se-pre-con"></div>

    @if(Auth::check())
        <nav class="navbar navbar-default  navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">
                        <div class="row"  >
                            <div class="col-md-6"><img src="{{url('/public/img/logo.png')}}"  width="30"/></div>
                            <div class="col-md-6 mobile">{{ config('app.name', 'Laravel') }}</div>
                        </div>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="home"><a href="{{url('/home')}}"  >Dashboard</a></li>
                        <li class="dropdown ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{Auth::user()->name}}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">                               
                                <li class="profile"><a href="{{url('/user-update')}}">User Profile</a></li>
                                <li class="divider"></li>
								<li class="tower"><a href="{{url('/tower/create')}}">Add Tower</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    <br><br><br><br>
	@endif

    @yield('content')

    <div class="container-fluid main-container ">
        <footer class="footer navbar-fixed-bottom">
            <div class="col-md-12 text-center">
            Copyright &COPY; by 2017 <a target="_blank" href="//megaprogramming.com">MegaProgramming</a>, All Rights Reserved
            </div>
			<br>
        </footer>
    </div>

    @yield('foot')
	
</body>
</html>
