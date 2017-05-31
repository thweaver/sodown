<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=205938242778556";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
   $post = get_post($_POST['id']);
?>
<?php while (have_posts()) : the_post(); ?>
	<div class="facebook-responsive">
		<?php the_field('video_url'); ?>
	</div>
<?php endwhile;?> 