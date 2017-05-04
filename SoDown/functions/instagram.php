<?php

/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

INSTAGRAM

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/

define( 'INSTAGRAM_USERNAME', 'sodownbassmusic' );

function set_item_image( $post_id, $field_name, $image_url ) {
    $upload_dir = wp_upload_dir(); // Set upload folder
    $image_data = file_get_contents($image_url); // Get image data
    $filename   = basename($image_url); // Create image file name
    $filename = preg_replace('/\?.*/', '', $filename); // remove query string from filename
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }
    file_put_contents( $file, $image_data );
    $wp_filetype = wp_check_filetype( $filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name( $filename ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    update_post_meta( $post_id, $field_name, $attach_id );
    return true;
}

function instagram_item_post_type() {
    $labels = array(
        'name'                => _x( 'Instagram Items', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Instagram Item', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Instagram Items', 'text_domain' ),
        'name_admin_bar'      => __( 'Instagram Items', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Instagram Item:', 'text_domain' ),
        'all_items'           => __( 'All Instagram Items', 'text_domain' ),
        'add_new_item'        => __( 'Add New Instagram Item', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New Instagram Item', 'text_domain' ),
        'edit_item'           => __( 'Edit Instagram Item', 'text_domain' ),
        'update_item'         => __( 'Update Instagram Item', 'text_domain' ),
        'view_item'           => __( 'View Instagram Item', 'text_domain' ),
        'search_items'        => __( 'Search Instagram Items', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' )
    );
    $args = array(
        'label'               => __( 'Instagram Item', 'text_domain' ),
        'description'         => __( 'Items from Instagram', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
    );
    register_post_type( 'instagram_item', $args );
}
add_action( 'init', 'instagram_item_post_type', 0 );

if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array (
        'key' => 'group_5631582785307',
        'title' => 'Instagram Item Fields',
        'fields' => array (
            array (
                'key' => 'field_5631587284a15',
                'label' => 'Instagram Item Account',
                'name' => 'instagram_item_account',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5631589384a16',
                'label' => 'Instagram Item ID',
                'name' => 'instagram_item_id',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_563162f3f0def',
                'label' => 'Instagram Item Permalink',
                'name' => 'instagram_item_permalink',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5631589984a17',
                'label' => 'Instagram Item Date',
                'name' => 'instagram_item_date',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5631598c84a18',
                'label' => 'Instagram Item Image',
                'name' => 'instagram_item_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5631599984a19',
                'label' => 'Instagram Item Image URL',
                'name' => 'instagram_item_image_url',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5631599984a20',
                'label' => 'Instagram Item Video URL',
                'name' => 'instagram_item_video_url',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_563159a284a1a',
                'label' => 'Instagram Item Content',
                'name' => 'instagram_item_content',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'instagram_item',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array (
            0 => 'the_content',
            1 => 'excerpt',
            2 => 'custom_fields',
            3 => 'discussion',
            4 => 'comments',
            5 => 'revisions',
            6 => 'slug',
            7 => 'author',
            8 => 'format',
            9 => 'featured_image',
            10 => 'categories',
            11 => 'tags',
            12 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    ));

endif;

function instagram_get_items() {
    $url = 'https://www.instagram.com/' . INSTAGRAM_USERNAME . '/media/';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);
}

function instagram_get_feed() {
    global $wpdb;
    $items = array();
    $items_base = instagram_get_items();
    foreach( $items_base->items as $item ) {
        $items[] = $item;
    }

    // insert or update wordpress post types based in on item data
    foreach( $items as $item ) {
        $date = date( 'Y-m-d H:i:s', $item->created_time );
        $wp_item_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '" . $item->id . "' AND post_type = 'instagram_item'" );

        if( $wp_item_id ) {
            // item exists, just update it
            $ref_id = $wp_item_id;
        } else {
            // create a post using the item id as the slug
            $inserted_post_id = wp_insert_post(array(
                'post_name'     => $item->id,
                'post_title'    => $item->id,
                'post_status'   => 'publish',
                'post_type'     => 'instagram_item',
                'post_author'   => 2,
                'post_date'     => $date,
                'post_date_gmt' => $date
            ));
            $ref_id = $inserted_post_id;
        }

        // Item Account
        update_post_meta( $ref_id, 'instagram_item_account', INSTAGRAM_USERNAME );

        // Item ID
        update_post_meta( $ref_id, 'instagram_item_id', $item->id );

        // Item Permalink
        update_post_meta( $ref_id, 'instagram_item_permalink', $item->link );

        // Item Date
        update_post_meta( $ref_id, 'instagram_item_date', $item->created_time );

        // Item Image
        if( $item->images->standard_resolution->url != get_field( 'instagram_item_image_url', $ref_id ) ) {
            set_item_image( $ref_id, 'instagram_item_image', $item->images->standard_resolution->url );
        }

        // Item Image URL
        update_post_meta( $ref_id, 'instagram_item_image_url', $item->images->standard_resolution->url );

        // Item Video URL
        if( isset( $item->videos ) ) {
            update_post_meta( $ref_id, 'instagram_item_video_url', $item->videos->standard_resolution->url );
        }

        // Item Content
        if( isset( $item->caption ) ) {
            update_post_meta( $ref_id, 'instagram_item_content', wp_encode_emoji( $item->caption->text ) );
        }
    }

    // do comparison of ids to delete wordpress posts that no longer exist on 3rd party feed as items
    // this has to be done after the creation/update process above
    if(isset($items_base) && isset($items_base->items)) {
        $wp_ids = array();
        $wp_items = get_posts(array(
            'post_type' => 'instagram_item',
            'posts_per_page' => count( $items_base->items ), // grab the same amount that were pulled from the API
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        foreach( $wp_items as $wp_item ) {
            $wp_ids[] = $wp_item->post_name;
        }
        $item_ids = array();
        foreach( $items as $item ) {
            $item_ids[] = (string) $item->id;
        }
        $diff = array_diff( $wp_ids, $item_ids );

        // there is a discrepancy, we need to delete an item from wordpress
        if( count( $diff ) ) {
            foreach( $diff as $diff_id ) {
                $wp_item_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '" . $diff_id . "' AND post_type = 'instagram_item'" );
                $delete_attach_id = get_post_meta( $wp_item_id, 'instagram_item_image', true );
                if( $delete_attach_id ) {
                    wp_delete_attachment( $delete_attach_id, true );
                }
                wp_delete_post( $wp_item_id, true );
            }
        }
    }

    return $items;
}

function instagram_process_feed_cache( $expiration, $force = false ) {
    $transient_name = 'instagram_' . sanitize_title( INSTAGRAM_USERNAME );
    $transient_value = get_transient( $transient_name );
    if( $transient_value === false || $force ) {
        set_transient( $transient_name, 1, $expiration );
        instagram_get_feed();
    }
}

// check for new images no sooner than every 15 minutes
// instagram_process_feed_cache( 60 * 15 );

// use this version to force a refresh of instagram images
instagram_process_feed_cache( 0, true );