
<?php


/*==============================================================================*/
/* Configuration */
/*==============================================================================*/
$tfg_site = array(
	/*==============================================================================*/
	/* General */
	/*==============================================================================*/
	'title'        => 'Feyline',
	'title_suffix' => '',
	'description'  => 'For over four decades Feyline has been promoting the largest, and most culturally immersive events in the history of live music.',
	'divider'      => ' - ',	
	'url'          => (strstr(current_url(), 'feyline')) ? 'http://www.thefirmgraphics.com/clients/feyline' : '',
	'timezone'     => 'America/Denver',
	'date_format'  => 'M. jS, Y',
	'email'        => '',
	/*==============================================================================*/
	/* Social */
	/*==============================================================================*/
	'facebook'               => '',
	'fb_page_id'             => '',
	'fb_app_id'              => '',
	'fb_admins'              => '',
	'twitter'                => 'FeylineInt',
	'tw_consumer_key'        => 'UXZ63VV3Wq6NDEkNjdHzuw',
	'tw_consumer_secret'     => 'I2LzAZWd4ReWq3PZ4HFhPsQVS4PD4wGD1XnASILNbk',
	'tw_access_token'        => '53450977-BK8JZ6fZo5sOvLcjsAl5O6NhXwa8ao8a3oQrAvhqL',
	'tw_access_token_secret' => 'Lo3ggCmXqblcpgmVMFnl7J4sTPO9EbbNb7fu8teR1m4',		
	'youtube'                => '',
	'instagram'              => '',
	/*==============================================================================*/
	/* Stats */
	/*==============================================================================*/
	'ga_id' => ''
);

/*==============================================================================*/
/* Head/Meta */
/*==============================================================================*/
function tfg_title(){
	global $tfg_site;
	global $tfg_page;
	if(empty($tfg_page['title'])){
		return $tfg_site['title'];
	} else {
		return $tfg_page['title'];
	}
}

function tfg_description(){
	global $tfg_site;
	global $tfg_page;
	if(empty($tfg_page['description'])){
		return $tfg_site['description'];	
	} else {
		return truncate_string($tfg_page['description'], 155, false);
	} 
}

function tfg_image(){
	global $tfg_site;
	global $tfg_page;
	if(empty($tfg_page['image'])){
		return $tfg_site['url'].'/images/fb.png';
	} else {
		return $tfg_page['image'];			
	}	
}


/*==============================================================================
Facebook
==============================================================================*/
function get_facebook_feed(){
	
	$cache_minutes = 15;
	$cache_file = 'cache/facebook/feyline.json';
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
						
		$text = disguise_curl('https://www.facebook.com/feeds/page.php?id=326440257450050&format=json');			
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
	$cache_minutes = 15;
	$cache_file = 'cache/instagram/feylineinternational.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;
	if(!$file_exists || $time_diff > $cache_minutes){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/v1/users/223659977/media/recent?access_token=223659977.1def962.e4069edade374002894f232d2a8dc28d&count=15');
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
	$cache_file = 'cache/twitter/'.$params['screen_name'].'.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;		
	if(!$file_exists || $time_diff > $cache_minutes){
		require_once 'includes/twitteroauth/twitteroauth.php';
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
	$cache_file = 'cache/twitter/'.$params['screen_name'].'-user-info.json';
	$file_exists = file_exists($cache_file);
	$cache_mod_time = ($file_exists) ? filemtime($cache_file) : 0;
	$current_time = time();
	$time_diff = ($current_time - $cache_mod_time) / 60;
		
	if(!$file_exists || $time_diff > $cache_minutes){
		require_once 'includes/twitteroauth/twitteroauth.php';
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

/*==============================================================================*/
/* Forms */
/*==============================================================================*/
function clean_string($string){
  if(get_magic_quotes_gpc()){
		return stripslashes(trim($string));
	} else {
		return trim($string);
	}
}
 
function refill_field($field){
	if(!empty($_POST[$field])){
		return trim(stripslashes($_POST[$field]));
	} else {
		return '';
	}
}
 
function option_select($field, $val){
	if(!empty($_POST[$field]) && $_POST[$field] === $val){ 
		echo ' selected';
	}
}
 
function checkbox_check($field, $val){
	if(!empty($_POST[$field]) && $_POST[$field] == $val){ 
		echo ' checked';
	}
}
 
function show_form_status($id){	
	global $form_errors;
	global $form_success;
	if(isset($_POST[$id]) && !empty($form_errors)){
		echo '<div class="status errors">';
		$count = count($form_errors);
		$tick = 0;
		foreach($form_errors as $error){
			$tick++;
			$class = ($tick == $count) ? ' class="last"' : '';
			echo '<p'.$class.'>'.$error.'</p>';
		}
		echo '</div>';
	} else if(isset($_POST[$id]) && isset($form_success)){
		echo '<div class="status success"><p class="last">'.$form_success.'</p></div>';
	}
}

?>
