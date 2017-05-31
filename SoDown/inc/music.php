<section id="music" class="music" data-class="music-bg">
	<div class="container">
		<h2 class="section-title">
			<span>Music</span>
		</h2>
		<div class="content">
		<div class="music-buttons">
			<a href="<?php the_field('spotify', 'option'); ?>" class="music-button" target="_blank">
				<img src="<?php bloginfo('template_url'); ?>/img/logo-spotify.png">
			</a>
			<a href="<?php the_field('soundcloud', 'option'); ?>" class="music-button" target="_blank">
				<img src="<?php bloginfo('template_url'); ?>/img/logo-soundcloud.png">
			</a>
			<a href="<?php the_field('itunes', 'option'); ?>" class="music-button" target="_blank">
				<img src="<?php bloginfo('template_url'); ?>/img/logo-itunes.png">
			</a>
		</div>
		<div class="music-grid">
			<div class="music-content">
				<?php if('soundcloud_url') { ?>
					<?php the_field( 'soundcloud_url', 'option' ); ?>
				<?php } ?>
				<?php if('spotify_url') { ?>
					<?php the_field( 'spotify_url', 'option' ); ?>
				<?php } ?>
			</div>
		</div>
		</div>
	</div>
</section>