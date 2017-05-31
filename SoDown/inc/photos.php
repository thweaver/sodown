<section id="photos" class="photos" data-class="photo-bg">
	<div class="container">
		<h2 class="section-title">
			<span>Photos</span>
		</h2>
		<div class="content photo-container">
			<?php 

			$images = get_field('photos', 'option');

			if( $images ): ?>
			<div class="photo-block">
				<?php foreach( $images as $image ): ?>
					<a href="<?php echo $image['url']; ?>" target="_blank" class="instagram-item venobox" data-gall="gallery" style="background-image:url(<?php echo $image['sizes']['square']; ?>)">
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>	
			<div class="video-buttons">
				<a href="<?php the_field('instagram', 'option'); ?>" class="music-button music-button--text" target="_blank">
					<span>View All</span>
				</a>
			</div>
		</div>
		<form action="//ImSoDown.us10.list-manage.com/subscribe/post?u=036d5e962bf299fc3b5d1f0a7&amp;id=ef258b5804" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate home-newsletter" target="_blank" novalidate>
			<input type="text" class="home-newsletter-input required" id="mce-EMAIL" value="Sign up for my newsletter" onblur="if (this.value == '') {this.value = 'Sign up for my newsletter';}"
onfocus="if (this.value == 'Sign up for my newsletter') {this.value = '';}">
			<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_036d5e962bf299fc3b5d1f0a7_ef258b5804" tabindex="-1" value=""></div>
			<input type="submit" class="home-newsletter-submit" value="Join" id="mc-embedded-subscribe">
		</form>
	</div>
</section>