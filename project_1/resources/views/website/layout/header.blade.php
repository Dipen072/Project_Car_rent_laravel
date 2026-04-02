<?php
function active($currect_page){
	  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ; // current page url
	  $url = end($url_array);  // tours 
	  if($currect_page == $url){
		  echo 'active'; //class name in css 
	  } 
	}
?>



<!doctype >
  <head>
    <title>Car Rent &mdash; Free Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{url ('website/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{url ('website/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/aos.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{url ('website/css/style.css')}}">

  </head>
    
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    @include('sweetalert::alert')

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-2 ">
              <div class="site-logo">
                <a href="index">CarRent</a>
              </div>
            </div>

            <div class="col-10  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="active"><a href="/index" class="<?php active
                  ('index')?>">Home</a></li>
                  <li><a href="/about" class="<?php active('about')?>">About</a></li>
                  <li><a href="/cars" class="<?php active('cars')?>">Cars</a></li>
                  <li><a href="/services" class="<?php active('services')?>">Services</a></li>
                  <li><a href="/blog" class="<?php active('blog')?>">Blog</a></li>
                  <li><a href="/contact" class="<?php active('contact')?>">Contact</a></li>
                  @if(session()->has('user_id'))
                  <li><a href="/booking" class="<?php active('booking')?>">Bookings</a></li>
                  <li><a href="/user-profile">Hi...<i class="fa fa-user"></i> {{session('user_name')}}</a></li>
                  <li><a href="/logout">Logout</a></li>
                  @else
                  <li><a href="/booking" class="<?php active('booking')?>">Booking</a></li>
                  <li><a href="/login" class="<?php active('login')?>">Login</a></li>
							@endif
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>