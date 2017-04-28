    </div>
    <div id="footer-test" class="social-media">
    	<ul class="sm-group-1">
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-facebook.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-twitter.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-instagram.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-youtube.svg' ?>
    			</a>
    		</li>
    	</ul>
    	<ul class="sm-group-2">
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-snapchat.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-spotify.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-soundcloud.svg' ?>
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="#">
    				<?php include 'img/icon-apple.svg' ?>
    			</a>
    		</li>
    	</ul>
    </div>
    <?php if ( is_front_page() ) { ?>
    <div class="scroll-prompt"></div>
    <?php } ?>
    <div class="site-border site-border--top"></div>
    <div class="site-border site-border--left"></div>
    <div class="site-border site-border--right"></div>
    <div class="site-border site-border--bottom"></div>
    <div class="pattern"></div>
    
    <div class="background">
        <?php if ( is_front_page() ) { ?>
            <div id="bg-1" class="background-img current-bg">
        		<video poster="img/bg-photo-1.jpg" playsinline autoplay muted loop id="bgvid">
        		    <source src="<?php bloginfo('template_url'); ?>/vid/hero.mp4" type="video/mp4">
        		    <source src="<?php bloginfo('template_url'); ?>/vid/hero.webm" type="video/webm">
        		</video>
        	</div>
        	<div id="bg-2" class="background-img"></div>
        	<div id="bg-3" class="background-img"></div>
        	<div id="bg-4" class="background-img"></div>
        	<div id="bg-5" class="background-img"></div>
        	<div id="bg-6" class="background-img"></div>
        <?php } ?>
        <?php if ( is_page('contact') ) { ?>
            <div id="contact-bg" class="background-img current-bg"></div>
        <?php } ?>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/app.min.js"></script>
    <?php wp_footer(); ?>
</body>
</html>