<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SMK JANDA JAYA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/animate.css">
	<link rel="stylesheet" href="/assets/css/icomoon.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/magnific-popup.css">
	<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="/assets/css/flexslider.css">
	<link rel="stylesheet" href="/assets/css/pricing.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	<script src="/assets/js/modernizr-2.6.2.min.js"></script>
	<script src="/assets/js/respond.min.js"></script>
	</head>
	<body>
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-1">
						<div id="fh5co-logo"><a href="#"></i>SMK<span>JANDAJAYA</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="btn-cta"><a href="{{ route('login') }}"><span>Login</span></a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</nav>
	<aside id="fh5co-hero">
		<div class="flexslider">
			<ul class="slides">
                <li style="background-image: url('{{ asset('/assets/images/img_bg_5.jpg') }}');">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>The Roots of Education are Bitter, But the Fruit is Sweet</h1>
									<h2>Brought to you by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p><a class="btn btn-primary btn-lg" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(assets/images/img_bg_6.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>The Great Aim of Education is not Knowledge, But Action</h1>
									<h2>Brought to you by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p><a class="btn btn-primary btn-lg btn-learn" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(assets/images/img_bg_7.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 text-center slider-text">
			   				<div class="slider-text-inner">
			   					<h1>We Help You to Learn New Things</h1>
									<h2>Brought to you by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
									<p><a class="btn btn-primary btn-lg btn-learn" href="#">Start Learning Now!</a></p>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>
	{{--  <footer id="fh5co-footer" role="contentinfo" style="background-image: url(images/img_bg_4.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a> &amp; <a href="https://www.pexels.com/" target="_blank">Pexels</a></small>
					</p>
				</div>
			</div>
		</div>
	</footer>  --}}
	</div>
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery.easing.1.3.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.waypoints.min.js"></script>
	<script src="/assets/js/jquery.stellar.min.js"></script>
	<script src="/assets/js/owl.carousel.min.js"></script>
	<script src="/assets/js/jquery.flexslider-min.js"></script>
	<script src="/assets/js/jquery.countTo.js"></script>
	<script src="/assets/js/jquery.magnific-popup.min.js"></script>
	<script src="/assets/js/magnific-popup-options.js"></script>
	<script src="/assets/js/simplyCountdown.js"></script>
	<script src="/assets/js/main.js"></script>
	<script>
    var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
	</script>
	</body>
</html>

