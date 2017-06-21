<?php

/*================================================================================*/
/* Head */
/*================================================================================*/
add_action('init', 'removeHeadLinks');
function removeHeadLinks() {
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
}

function tfg_title(){
	global $tfg_page;
	if(!empty($tfg_page['title'])){
		echo $tfg_page['title'];
	} else {
		global $page, $paged;	
		if ($paged >= 2 || $page >= 2){
			echo sprintf( __('Page %s', 'tfg'), max($paged, $page)).' | ';
		}	
		wp_title('|', true, 'right');	
		bloginfo();			
	}
}

function tfg_description(){
	global $tfg_page;
	$excerpt = wp_trim_excerpt();
	if(!empty($tfg_page['description'])){
		echo $tfg_page['description'];
	} else if(!empty($excerpt)){
		echo $excerpt;	
	} else {
		echo get_bloginfo('description');
	} 
}

function tfg_image(){
	global $tfg_page;
	if(!empty($tfg_page['image'])){
		echo $tfg_page['image'];
	} else {
		echo bloginfo('template_url').'/images/fb.png';	
	}	
}
/*
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

if (!is_admin()) add_action("wp_enqueue_scripts", "my_modernizr_enqueue", 11);
function my_modernizr_enqueue() {
   wp_deregister_script('modernizr');
   wp_register_script('modernizr', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js", false, null);
   wp_enqueue_script('modernizr');
}*/

/*================================================================================*/
/* Excerpt Fix For Single Post Meta */
/*================================================================================*/
function tfg_excerpt($id=false) {
	global $post;

	$old_post = $post;
	if ($id != $post->ID) {
		$post = get_page($id);
	}

	if (!$excerpt = trim($post->post_excerpt)) {
		$excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt_length = apply_filters('excerpt_length', 45);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '...');

		$words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$excerpt = implode(' ', $words);
			$excerpt = $excerpt . $excerpt_more;
		} else {
			$excerpt = implode(' ', $words);
		}
	}

	$post = $old_post;

	return $excerpt;
}


function current_url(){
	return (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

function truncate_string($string, $length, $ellipsis = true){
	$string = str_replace(array('<br>', '<br/>', '<br />'), ' ', $string);
	$string = str_replace(array('  '), ' ', $string);
	$string = strip_tags($string);
	if($ellipsis){
		return (strlen($string) > ($length+3)) ? substr($string,0,$length).'...' : $string;
	} else {
		return (strlen($string) > ($length)) ? substr($string,0,$length) : $string;
	}
}

function convert_seconds($s){
	$minutes = floor($s/60);
	$seconds = (string) ($s % 60);
	$seconds = (strlen($seconds) == 1) ? '0' + $seconds : $seconds;
	return $minutes.':'.$seconds;
}

function get_relative_time($date) {
	global $tfg_site;
	$diff = time() - strtotime($date);
	if ($diff<60)
		return $diff . " second" . plural($diff) . " ago";
	$diff = round($diff/60);
	if ($diff<60)
		return $diff . " minute" . plural($diff) . " ago";
	$diff = round($diff/60);
	if ($diff<24)
		return $diff . " hour" . plural($diff) . " ago";
	$diff = round($diff/24);
	if ($diff<7)
		return $diff . " day" . plural($diff) . " ago";
	$diff = round($diff/7);
	if ($diff<4)
		return $diff . " week" . plural($diff) . " ago";
	return date($tfg_site['date_format'], strtotime($date));
}

function plural($num) {
	if ($num != 1)
		return "s";
}

function slugify($string){
	$slug = trim($string);
	$slug = strtolower($slug);
	$slug = str_replace(' ', '-', $slug);
	$slug = str_replace('&', 'and', $slug);
	$slug = str_replace('@', 'at', $slug);
	$slug = str_replace('+', 'plus', $slug);
	$slug = str_replace('\'', '', $slug);
	$slug = str_replace(array('----', '---', '--'), '-', $slug);	
	return $slug;
}

/*================================================================================*/
/* Forms */
/*================================================================================*/
function clean_string($string){
	if(get_magic_quotes_gpc()){
		return stripslashes(trim($string));
	} else {
		return trim($string);
	}
}

function refill_field($field){
	if(!empty($_POST[$field])){
		return clean_string($_POST[$field]);
	} else {
		return '';
	}
}

function option_select($field, $val){
	if(!empty($_POST[$field]) && $_POST[$field] === $val){ 
		echo ' selected';
	}
}

function show_form_status(){
	global $form_errors;
	global $form_success;
	if(!empty($form_errors)){
		echo '<div class="status errors">';
		foreach($form_errors as $error){
			echo '<p>'.$error.'</p>';	
		}
		echo '</div>';
	} else if(isset($form_success)){
		echo '<div class="status success"><p>'.$form_success.'</p></div>';
	}
}

?>