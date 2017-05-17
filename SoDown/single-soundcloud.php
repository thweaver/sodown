<?php
   $post = get_post($_POST['id']);
?>
<?php while (have_posts()) : the_post(); ?>
	<div class="music-content">
		<?php if('soundcloud_url') { ?>
			<?php the_field( 'soundcloud_url' ); ?>
		<?php } ?>
		<?php if('spotify_url') { ?>
			<?php the_field( 'spotify_url' ); ?>
		<?php } ?>
	</div>
<?php endwhile;?> 