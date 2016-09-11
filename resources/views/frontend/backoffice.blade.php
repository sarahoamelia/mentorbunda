<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Mentor Bunda</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/demo.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/testimonial.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}" />
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="header container">
    <div class="visible-xs visible-sm col-xs-12 col-sm-12 text-center sm-logo">
        <a rel="home" href="#">
            <img src="{{asset('frontend/img/log.png')}}" width="200" alt="logo">
        </a>
    </div>
</div>
<div class="navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Beranda</a></li>
            <li><a href="{{url('/tentang')}}">Tentang</a></li>
            <li><a href="{{url('/galeri')}}">Galeri</a></li>
            <li><a href="{{url('artikel')}}">Artikel</a></li>
            <li class= "hidden-xs hidden-sm">
                <a rel="home" href="{{url('/')}}"><img class="logo" src="{{asset('frontend/img/log.png')}}" width="200" alt="logo"></a>
            </li>
            <li><a href="{{url('/acara')}}">Acara</a></li>
            <li><a href="{{url('/konsultasi')}}">Konsultasi</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/auth/login') }}">Sign In</a></li>
                <li><a href="{{ url('/auth/register') }}">Sign Up</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('editprofil') }}">Edit Profil</a></li>
                        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>

@yield('content')


<div class="clearfix"></div>

<!-- ============FOOTER============= -->
<footer id="footer">
    <div class="footer-content container">
        <div class="footer-adress text-center col-xs-12 col-sm-4 col-md-4">
            <h4>Mentor Bunda</h4>
            <ul class="footer-menus">
                <li>Beranda |</li>
                <li>Tentang </li><br />
                <li>Artikel |</li>
                <li>Galeri |</li>
                <li>Acara</li>
            </ul>
        </div>
        <div class="footer-second col-xs-12 col-sm-4 col-md-4">
            <p class="text-center footer-text1">Jl. Raya Pajajaran</p>
            <p class="text-center footer-text1">0251 7283173</p>
            <p class="text-center footer-text">mentorbunda@info.com</p></div>
        <div class="footer-third col-xs-12 col-sm-4 col-md-4">
            <div class="copyright">
                <span>Copyright Mentor Bunda 2015</span><br>
                <span>All Rights Reserved</span>
            </div>
        </div>
    </div>
    <div class="move-top-page">
    </div>
</footer>

<!-- script references -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/nav-hover.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/jquery.bxslider.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/main.js')}}"></script>
<!-- Place in the <head>, after the three links -->
<script>
    $('.testimonials-slider').bxSlider({
        slideWidth: 800,
        minSlides: 1,
        maxSlides: 1,
        slideMargin: 32,
        auto: true,
        autoControls: true
    });
</script>
<script type="text/javascript">
</script>
</body>
</html>