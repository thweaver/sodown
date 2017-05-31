<?php session_start(); ?>
<!doctype html>
<!--[if lt IE 7]><html class="lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="<?php bloginfo('language'); ?>"><![endif]-->
<!--[if IE 7]><html class=" lt-ie10 lt-ie9 lt-ie8 ie7" lang="<?php bloginfo('language'); ?>"><![endif]-->
<!--[if IE 8]><html class="lt-ie10 lt-ie9 ie8" lang="<?php bloginfo('language'); ?>"><![endif]-->
<!--[if IE 9]><html class="lt-ie10 ie9" lang="<?php bloginfo('language'); ?>"><![endif]-->
<!--[if gt IE 9]><!--><html lang="<?php bloginfo('language'); ?>"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php tfg_title(); ?></title>
<meta name="description" content="<?php tfg_description(); ?>" />
<meta property="og:title" content="<?php tfg_title(); ?>" />
<meta property="og:description" content="<?php tfg_description(); ?>" />
<meta property="og:site_name" content="<?php bloginfo(); ?>" />
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/fb.png?v=4" />
<meta property="og:url" content="<?php current_url(); ?>" />
<meta name="google-site-verification" content="quJEH4DeWCtmZZFwTTcU7Wn6rgEys4drBk1UM9NKHOQ" />
<meta property="og:type" content="website" />
<!--[if IE]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.min.css?v=5" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.ico?v=1" />
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script>if(typeof Modernizr == 'undefined'){document.write(unescape("%3Cscript src='<?php bloginfo('template_url'); ?>/js/modernizr.min.js'%3E%3C/script%3E"));}</script>
<?php wp_head(); ?>
</head>
<?php 
    $body_class = 'non-admin-wp';
    if(!empty($tfg_page['parent'])){
        $body_class .= ' page-'.$tfg_page['parent'];
    }
    if(!empty($tfg_page['subparent'])){
        $body_class .= ' subpage-'.$tfg_page['subparent'];
    }
?>
<body <?php body_class($body_class); ?>>
<p class="ie-upgrade browserupgrade">You are using an <strong>outdated</strong> browser. <br/>Please upgrade your browser to view this website.</p>
<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. <br/>Please upgrade your browser to view this website.</p>
<![endif]-->

	<div class="loader-container">
		<div class="loader">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<nav>
		<?php if ( is_front_page() ) { ?>
			<div class="nav-group">
				<ul class="nav-group-1">
					<li class="nav-item main-nav-item" id="nav-tour">
						<a href="#tour">Tour</a>
					</li>
					<li class="nav-item main-nav-item" id="nav-music">
						<a href="#music">Music</a>
					</li>
					<li class="nav-item main-nav-item" id="nav-shop">
						<a href="#shop">Shop</a>
					</li>
				</ul>
				<ul class="nav-group-2">
					<li class="nav-item main-nav-item" id="nav-videos">
						<a href="#videos">Videos</a>
					</li>
					<li class="nav-item main-nav-item" id="nav-photos">
						<a href="#photos">Photos</a>
					</li>
					<li class="nav-item" id="nav-contact">
						<a href="<?php bloginfo('url'); ?>/contact">Contact</a>
					</li>
				</ul>
			</div>
			<h1 class="site-logo main-site-logo">
				<a href="#home">SoDown</a>
			</h1>
		<?php } ?>
		<?php if ( is_page('contact') ) { ?>
		    <div class="nav-group">
		    	<ul class="nav-group-1">
		    		<li class="nav-item" id="nav-tour">
		    			<a href="<?php bloginfo('url'); ?>#tour">Tour</a>
		    		</li>
		    		<li class="nav-item" id="nav-music">
		    			<a href="<?php bloginfo('url'); ?>#music">Music</a>
		    		</li>
		    		<li class="nav-item" id="nav-shop">
		    			<a href="<?php bloginfo('url'); ?>#shop">Shop</a>
		    		</li>
		    	</ul>
		    	<ul class="nav-group-2">
		    		<li class="nav-item" id="nav-videos">
		    			<a href="<?php bloginfo('url'); ?>#videos">Videos</a>
		    		</li>
		    		<li class="nav-item" id="nav-photos">
		    			<a href="<?php bloginfo('url'); ?>#photos">Photos</a>
		    		</li>
		    		<li class="nav-item nav-item-current" id="nav-contact">
		    			<a href="<?php bloginfo('url'); ?>/contact">Contact</a>
		    		</li>
		    	</ul>
		    </div>
		    <h1 class="site-logo">
		    	<a href="<?php bloginfo('url'); ?>">SoDown</a>
		    </h1>
		<?php } ?>


		<div class="hamburger">
			<a href="#">
				<span></span>
			</a>
		</div>
	</nav>
	<div class="wrapper">