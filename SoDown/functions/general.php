<?php

/*================================================================================*/
/* Set Timezone */
/*================================================================================*/
date_default_timezone_set(get_option('timezone_string'));

/*================================================================================*/
/* Page and Subpage Parent Checks */
/*================================================================================*/
// Get the id of a page by its name
function get_page_id($page_name){
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name;
}

function is_tree($pid) { 
	global $post; 
	$anc = get_post_ancestors( $post->ID );
	foreach($anc as $ancestor) {
		if(is_page() && $ancestor == $pid) {
			return true;
		}
	}
	if(is_page()&&(is_page($pid)))
		return true;
	else
		return false;
};

/*================================================================================*/
/* Pagination */
/*================================================================================*/

function tfg_pagination($pages = '', $range = 2) {
	$showitems = ($range * 2)+1;  
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
	global $wp_query;
	$pages = $wp_query->max_num_pages;
	if(!$pages)
	{
	$pages = 1;
	}
	}
	if(1 != $pages)
	{
	echo "<ul class='tfg-pagination clearfix'><li class='pageinttl'>Page:</li>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a><li>";
	if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
	for ($i=1; $i <= $pages; $i++)
	{
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	{
	echo ($paged == $i)? "<li><a href='".get_pagenum_link($i)."' class='current'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
	}
	}
	if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
	if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
	echo "</ul>";
	}
}

/*==============================================================================*/
/* Configuration */
/*==============================================================================*/

$tfg_site = array(
	/*==============================================================================*/
	/* Social */
	/*==============================================================================*/
	'title'        => 'Global Dance Festival Colorado 2014',
	'description'  => 'The Official Website for Global Dance Festival Colorado 2014 - July 18, July 19, July 20.',
	'fb_page_id'             => '',
	'fb_app_id'              => '',
	'fb_admins'              => '',
	'facebook'     => 'https://www.facebook.com/globaldancefestival',
	'twitter'      => 'https://twitter.com/globaldancefest',
	'youtube'      => 'GlobalDanceUS',
	'instagram'    => 'http://instagram.com/globaldanceus',
	/*==============================================================================*/
	/* Stats */
	/*==============================================================================*/
	'ga_id' => ''
);

/*==============================================================================
Facebook
==============================================================================*/

function get_facebook_feed(){
	
	$cache_minutes = 0;
	$cache_file = get_theme_root().'/'.get_template().'/cache/facebook/feyline.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;
		
	if(!$file_exists || $time_diff > $cache_minutes){	
		function disguise_curl($url){ 
			$curl = curl_init();		
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
			$header[] = "Cache-Control: max-age=0"; 
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300"; 
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
			$header[] = "Accept-Language: en-us,en;q=0.5"; 
			$header[] = "Pragma: "; 		
			curl_setopt($curl, CURLOPT_URL, $url); 
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla'); 
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
			curl_setopt($curl, CURLOPT_REFERER, ''); 
			curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
			curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($curl, CURLOPT_TIMEOUT, 10); 		
			$html = curl_exec($curl);  
			curl_close($curl);	
			return $html; 
		} 
						
		$text = disguise_curl('https://www.facebook.com/feeds/page.php?id=281515485267298face&format=json');			
		$file_handle = fopen($cache_file, 'w');
		fwrite($file_handle, $text);
		fclose($file_handle);
	} else {
		$text = file_get_contents($cache_file);
	}	
	return json_decode($text);
}

/*==============================================================================
Instagram
==============================================================================*/

function get_instagram_feed(){
	$cache_minutes = 0;
	$cache_file = 'cache/instagram/decadence.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;
	if(!$file_exists || $time_diff > $cache_minutes){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/v1/users/181858497/media/recent?access_token=181858497.5b9e1e6.9aa8b347de1b49ab822d19b191c21e6e&count=9');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$photos = $response;
		$file_handle = fopen($cache_file, 'w');
		fwrite($file_handle, $photos);
		fclose($file_handle);
	} else {
		$photos = file_get_contents($cache_file);
	}
	return json_decode($photos);	
}

/*==============================================================================
Twitter
==============================================================================*/
function get_twitter_feed($username, $count = 8){
	$params = array(
		'count' => $count,
		'screen_name' => $username,
		'include_rts' => true
	);	

	$cache_minutes = 0;
	$cache_file = get_theme_root().'/'.get_template().'/cache/twitter/'.$params['screen_name'].'.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;		
	if(!$file_exists || $time_diff > $cache_minutes){
		require_once get_theme_root().'/'.get_template().'/includes/twitteroauth/twitteroauth.php';
		
		$consumer_key = '3JcRWX7O3r1f5iDFEnnlQ';
		$consumer_secret = 'ub2QwTfmom1zu2WbXrd7IlTfhG1XKVJ3BThHQYMjvw';
		$access_token = '53450977-QAi4AflzVbFp4jbr5MEMsRyMVJ2jK3DCBAGaIgW6J';
		$access_token_secret = 'luAeDOrZMp3Rlc5j0CR1fTPgyiQ53OCIxIPKrqOXw';		
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
		$tweets = json_encode($connection->get('statuses/user_timeline', $params));				
		$file_handle = fopen($cache_file, 'w');
		fwrite($file_handle, $tweets);
		fclose($file_handle);				
	} else {
		$tweets = file_get_contents($cache_file);
	}			
	return json_decode($tweets);
};

function get_twitter_user_info($username){	
	$params = array(
		'screen_name' => $username
	);
				
	$cache_minutes = 30;
	$cache_file = get_theme_root().'/'.get_template().'/cache/twitter/'.$params['screen_name'].'-user-info.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;
		
	if(!$file_exists || $time_diff > $cache_minutes){
		require_once get_theme_root().'/'.get_template().'/includes/twitteroauth/twitteroauth.php';
		$consumer_key = '3JcRWX7O3r1f5iDFEnnlQ';
		$consumer_secret = 'ub2QwTfmom1zu2WbXrd7IlTfhG1XKVJ3BThHQYMjvw';
		$access_token = '53450977-QAi4AflzVbFp4jbr5MEMsRyMVJ2jK3DCBAGaIgW6J';
		$access_token_secret = 'luAeDOrZMp3Rlc5j0CR1fTPgyiQ53OCIxIPKrqOXw';
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
		$user_info = json_encode($connection->get('users/show', $params));				
		$file_handle = fopen($cache_file, 'w');
		fwrite($file_handle, $user_info);
		fclose($file_handle);				
	} else {
		$user_info = file_get_contents($cache_file);
	}			
	return json_decode($user_info);
};

function linkify_tweet($status_text){
  // linkify URLs
  $status_text = preg_replace(
	'/(https?:\/\/\S+)/',
	'<a href="\1" target="_blank">\1</a>',
	$status_text
  );

  // linkify twitter users
  $status_text = preg_replace(
	'/(^|\s)@(\w+)/',
	'\1<a href="http://twitter.com/\2" target="_blank">@\2</a>',
	$status_text
  );

  // linkify tags
  $status_text = preg_replace(
	'/(^|\s)#(\w+)/',
	'\1<a href="http://twitter.com/search?q=%23\2" target="_blank">#\2</a>',
	$status_text
  );

  return $status_text;
}

/*==============================================================================*/
/* Miscellaneous */
/*==============================================================================*/
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

/*================================================================================*/
/* Soundcloud */
/*================================================================================*/

function sc_embed($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://soundcloud.com/oembed?format=json&amp;color=ea0015e&amp;url='.$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$soundcloud = json_decode($response);
	echo $soundcloud->html;
}

function my_deregister_heartbeat() {
    global $pagenow;

    if ( 'single-soundcloud.php' != $pagenow && 'single-videos.php' != $pagenow ) {
         wp_deregister_script('heartbeat');
         wp_register_script('heartbeat', false);
     }
}
add_action( 'admin_enqueue_scripts', 'my_deregister_heartbeat' );

/*================================================================================*/
/* YouTube */
/*================================================================================*/

function parse_youtube_url($url){
	// http://stackoverflow.com/questions/5830387/php-regex-find-all-youtube-video-ids-in-string/5831191#5831191
	$regexstr = '~
        (?:https?://|www.)         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube\.com    # or youtube.com followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\-\s]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w]*      # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w-]*        # Consume any URL (query) remainder.
        ~ix'; 
	preg_match($regexstr, $url, $parsed);
	
	if(!empty($parsed[1])){
    	return $parsed[1];
	} else {
		return $url;	
	}
}

function fb_embed($url){
	$videos = array('https://www.facebook.com/sodownbassmusic/videos/'.$url.'/', 'https://www.facebook.com/videos/'.$url.'/);');
	foreach($videos as $f_video){
	    preg_match("~/videos/(?:t\.\d+/)?(\d+)~i", $f_video, $matches);
	    print_r($matches);
	}
}


/*==============================================================================
Miscellaneous / Utility / Helper
==============================================================================*/

function random_header_image(){
	$images = glob('images/page-photos/*.jpg');
	$count = count($images);
	return $images[mt_rand(0, $count - 1)];
}

?>