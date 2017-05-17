<section id="videos" class="videos" data-class="video-bg">
	<div class="container">
		<h2 class="section-title">
			<span>Videos</span>
		</h2>
		<div class="content">
			<div class="video-block">
				<?php
					$sc_query = new WP_Query(array(
						'posts_per_page' => 6,
						'post_type' => 'videos',
						'order' => 'ASC'
					));
				?>
				<?php if( $sc_query->have_posts() ) : ?>
					<?php while( $sc_query->have_posts() ) : $sc_query->the_post(); ?>
						<?php
							$video_thumb = get_field( 'video_thumb' );
							$video_thumb = $video_thumb['sizes']['video_img'];
						?>
						<div>
							<a href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>" class="venobox if-link" data-type="ajax" data-gall="video" style="background-image: url(
							<?php if($video_thumb) { ?>
								<?php echo $video_thumb ?>
							<?php } ?>
							<?php if(!$video_thumb) { ?>
								<?php video_thumbnail(); ?>
							<?php } ?>)">
								
							</a>
							<div id="post-<?php the_ID(); ?>" class="iframe-content">
								<div class="video-container ">
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="video-buttons">
				<a href="<?php the_field('facebook', 'option'); ?>" class="music-button music-button--text" target="_blank">
					<span>View All</span>
				</a>
			</div>
		</div>
	</div>
</section>