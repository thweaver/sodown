    </div>
    <div id="footer-test" class="social-media">
    	<ul class="sm-group-1">
    		<li class="sm-item">
    			<a href="<?php the_field('facebook', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-facebook.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('twitter', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-twitter.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('instagram', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-instagram.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('youtube', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-youtube.png">
    			</a>
    		</li>
    	</ul>
    	<ul class="sm-group-2">
    		<li class="sm-item">
    			<a href="<?php the_field('snapchat', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-snapchat.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('spotify', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-spotify.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('soundcloud', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-soundcloud.png">
    			</a>
    		</li>
    		<li class="sm-item">
    			<a href="<?php the_field('itunes', 'option'); ?>" target="_blank">
    				<img src="<?php bloginfo('template_url'); ?>/img/icon-apple.png">
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
    
    <div id="background" class="background hero-bg">
        <?php if ( is_front_page() ) { ?>
            <div id="bg-1" class="background-img background-img-hero">
        		<video poster="img/bg-photo-1.jpg" playsinline autoplay muted loop id="bgvid">
        		    <source src="<?php bloginfo('template_url'); ?>/vid/hero.mp4" type="video/mp4">
        		    <source src="<?php bloginfo('template_url'); ?>/vid/hero.webm" type="video/webm">
        		</video>
        	</div>
        	<div id="bg-2" class="background-img background-img-tour"></div>
        	<div id="bg-3" class="background-img background-img-music"></div>
        	<div id="bg-4" class="background-img background-img-shop"></div>
        	<div id="bg-5" class="background-img background-img-video"></div>
        	<div id="bg-6" class="background-img background-img-photo"></div>
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