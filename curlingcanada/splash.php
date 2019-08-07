<?php
/*
Template Name: Splash Page
*/
?>
<!DOCTYPE html>
<html>
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Curling Canada · The official site for Curling in Canada · Home of Team Canada</title>
	<!-- include the site stylesheet -->
	<link rel="stylesheet" type="text/css" href="//cloud.typography.com/7350954/678686/css/fonts.css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link media="all" rel="stylesheet" href="http://www.curling.ca/wp-content/themes/curlingcanada/css/all.css">
	<link media="all" rel="stylesheet" href="http://brand.curling.ca/css/animate.css">
</head>
<body>

	<!-- PRELOADER -->
	<div class="preloader"></div>
	<!-- /PRELOADER -->

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<div class="block win-height">
			<!-- header of the page -->
			<div class="white-box">
				<!-- switch language links -->
				<div class="language-holder">
					<a href="http://brand.curling.ca/splash-fr.html" class="link-language">Français</a>
				</div>
				<div class="box-holder">
					<div class="box-frame">
						<div class="logo wow fadeInDown animate" data-wow-delay="0.5s">
								<span data-picture data-alt="Curling Canada">
									<span data-src="http://brand.curling.ca/images/logo2-large.png" data-width="145" data-height="208"></span>
									<span data-src="http://brand.curling.ca/images/logo2-large2x.png" data-width="145" data-height="208" data-media="(-webkit-min-device-pixel-ratio:1.5), (min-resolution:1.5dppx)" ></span> <!-- retina 2x desktop -->
									<span data-src="http://brand.curling.ca/images/logo-large.png" data-width="91" data-height="130" data-media="(max-width:767px)" ></span> <!-- retina 1x mobile -->
									<span data-src="http://brand.curling.ca/images/logo-large2x.png"  data-media="(max-width:767px) and (-webkit-min-device-pixel-ratio:1.5), (max-width:767px) and (min-resolution:144dpi)" ></span> <!-- retina 2x mobile -->
									<!--[if (lt IE 9) & (!IEMobile)]>
										<span data-src="http://brand.curling.ca/images/logo-large.png"></span>
									<![endif]-->
									<!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
									<noscript><img src="http://brand.curling.ca/images/logo2-large.png" width="145" height="208" alt="image description" ></noscript>
								</span>
						</div>
						<h1 data-wow-delay="1s" class="wow fadeIn animate">We are Curling Canada.</h1>
						<div class="link-holder">
							<a href="http://brand.curling.ca/" data-wow-delay="1.2s" class="wow fadeIn animate">Learn about the new brand<i class="icon-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div data-wow-delay="1.5s" class="gray-box wow fadeInUp animate">
				<div class="box-holder">
					<div class="box-frame">
						<a href="http://www.curling.ca/homepage/">Continue to curling.ca<i class="icon-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- include jQuery library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="http://brand.curling.ca/js/jquery-1.11.2.min.js"><\/script>')</script>
	<!-- include custom JavaScript -->
	<script type="text/javascript" src="http://brand.curling.ca/js/jquery.main.js"></script>
	<script src="//use.typekit.net/lsm5coc.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script>$(window).load(function() { $(".preloader").delay(100).fadeOut(500); new WOW().init(); });</script>
</body>
</html>
