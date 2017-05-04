<?php
   $post = get_post($_POST['id']);
?>
<?php while (have_posts()) : the_post(); ?>
	<?php the_field('video_url'); ?>
<?php endwhile;?> 