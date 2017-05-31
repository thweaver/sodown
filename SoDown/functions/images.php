<?php

/*================================================================================*/
/* Image Support */
/*================================================================================*/

if(function_exists('add_theme_support')){
	add_theme_support('post-thumbnails');
}

/*================================================================================*/
/* Image Sizes */
/*================================================================================*/

if(function_exists('add_image_size')){ 
	add_image_size( 'square', 400, 400, true);
    add_image_size( 'video_img', 675, 380, true);
    add_image_size( 'page_img', 1130, 450, true);
    add_image_size( 'full', 1200, 2000 );
}

/*==============================================================================
Thumbnail Scale
==============================================================================*/

function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null;

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    if(is_array($crop)) {
        // Handles left, right and center (no change)
        if($crop[ 0 ] === 'left') {
            $s_x = 0;
        } else if($crop[ 0 ] === 'right') {
            $s_x = $orig_w - $crop_w;
        }
        // Handles top, bottom and center (no change)
        if($crop[ 1 ] === 'top') {
            $s_y = 0;
        } else if($crop[ 1 ] === 'bottom') {
            $s_y = $orig_h - $crop_h;
        }
    }

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );

/*================================================================================*/
/* Remove Added Width to Captions */
/*================================================================================*/

class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();



?>