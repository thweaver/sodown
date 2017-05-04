<section id="photos" class="photos" data-class="photo-bg">
	<div class="container">
		<h2 class="section-title">
			<span>Photos</span>
		</h2>
		<div class="content photo-container">
			<div class="photo-block">
				<?php
					$insta_query = new WP_Query(array(
						'posts_per_page' => 7,
						'post_type' => 'instagram_item',
						'meta_key' => 'instagram_item_date',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					));
				?>
				<?php if( $insta_query->have_posts() ) : ?>
					<?php while( $insta_query->have_posts() ) : $insta_query->the_post(); ?>
						<?php
							$item_account = get_field( 'instagram_item_account' );
							$item_id = get_field( 'instagram_item_id' );
							$item_permalink = get_field( 'instagram_item_permalink' );
							$item_date = date( 'Y-m-d', get_field( 'instagram_item_date' ) );
							$item_content = get_field( 'instagram_item_content' );
							$item_video_url = get_field( 'instagram_item_video_url' );
							$item_image_url = get_field( 'instagram_item_image_url' );
							$item_image_id = get_field( 'instagram_item_image' );
							$item_image_array = wp_get_attachment_image_src( $item_image_id, 'full' );
							$item_image = $item_image_array[ 0 ];
							if( !$item_image && $item_image_url ) {
								$item_image = $item_image_url;
							}
						?>
						<?php if( $item_image ) : ?>
							<div>
							<?php if( $item_video_url ) : ?>
								<a href="#insta-<?php echo $item_id; ?>" target="_blank" class="instagram-item venobox" data-gall="gallery" data-type="inline" style="background-image:url(<?php echo $item_image; ?>)">
								</a>
								<div id="insta-<?php echo $item_id; ?>" style="display: none;">
									<div class="insta-video-wrap">
										<video controls>
											<source src="<?php echo $item_video_url; ?>" type="video/mp4">
											Your browser doesn't support HTML5 video tag.
										</video>
									</div>
								</div>
							<?php else : ?>
								<a href="<?php echo $item_image; ?>" target="_blank" class="instagram-item venobox" data-gall="gallery" style="background-image:url(<?php echo $item_image; ?>)">
								</a>
							<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="video-buttons">
				<a href="<?php the_field('instagram', 'option'); ?>" class="music-button music-button--text" target="_blank">
					<span>View All</span>
				</a>
			</div>
		</div>
	</div>
</section>