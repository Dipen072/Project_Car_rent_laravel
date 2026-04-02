<?php
	function active($currect_page){
	  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ; // current page url
	  $url = end($url_array);  // tours 
	  if($currect_page == $url){
		  echo 'active'; //class name in css 
	  } 
	}
	?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{url ('website/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{url ('website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{url ('website/css/aos.css')}}">

    <link rel="stylesheet" href="{{url ('website/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{url ('website/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{url ('website/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{url ('website/css/style.css')}}">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index">Car<span>Book</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index" class="nav-link">Home</a></li>
            
	          <li class="nav-item"><a href="about" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="services" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="pricing" class="nav-link">Pricing</a></li>
	          <li class="nav-item"><a href="car" class="nav-link">Cars</a></li>
	          <li class="nav-item active"><a href="blog" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->