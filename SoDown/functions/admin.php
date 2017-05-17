<?php

add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function my_login_stylesheet() { ?>
	<link rel="stylesheet"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/css/wp-login.css'; ?>" />
<?php }
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}

/*================================================================================*/
/* Hide Menus and Update */
/*================================================================================*/
function remove_menus(){
    global $menu;
    global $current_user;
    if(!current_user_can('administrator')){
		// remove main menus
        $restricted = array(
            __('Media'),
            __('Links'),
            __('Comments'),
            __('Plugins'),
            __('Tools'),
            __('Settings')
        );
        end ($menu);
        while (prev($menu)){
            $value = explode(' ',$menu[key($menu)][0]);
            if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
            	unset($menu[key($menu)]);
            }
        }
		
		// remove special menu items
		remove_menu_page('ot-settings'); // option tree settings
		remove_menu_page('mf_dispatcher'); // magic fields
		
		// remove update notices
		remove_action('admin_notices', 'update_nag', 3);
		
	
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
			
			remove_menu_page('edit.php?post_type=page');
			remove_menu_page('themes.php');
		
		
    }
}
add_action('admin_menu', 'remove_menus');

// restore edit theme options
$editor = get_role('editor');
$editor->add_cap('edit_theme_options');
$editor->add_cap('edit_pages');
$editor->add_cap('publish_posts');
$editor->add_cap('edit_posts');
//$editor->remove_cap('manage_categories');

add_filter( 'option_page_capability_option_tree', 'filter_theme_options_capabilities' );
function filter_theme_options_capabilities() {
  return 'edit_theme_options';
}

/*================================================================================*/
/* Remove Admin Toolbar Items */
/*================================================================================*/
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


/*================================================================================*/
/* Hide Menus and Update */
/*================================================================================*/
$user_id = get_current_user_id();
if ($user_id == 2) {
	add_action('admin_enqueue_scripts', 'nav_hide_stylesheet');
	function nav_hide_stylesheet() { ?>
		<style>
			#menu-dashboard,
			#menu-dashboard ul,
			#menu-comments,
			#wp-admin-bar-w3tc,
			#menu-media,
			#toplevel_page_edit-post_type-acf-field-group,
			#menu-posts,
			#toplevel_page_cptui_main_menu,
			#toplevel_page_w3tc_dashboard,
			#toplevel_page_Wordfence,
			#menu-pages,
			#menu-plugins,
			#menu-users,
			#pageparentdiv,
			#menu-appearance,
			#menu-tools,
			#menu-settings,
			#toplevel_page_edit-post_type-acf,
			#toplevel_page_cpt_main_menu,
			#toplevel_page_wponlinebackup,
			#wp-admin-bar-updates,
			.wp-submenu,
			#dashboard-widgets-wrap 
			{
				display: none !important;
			}
		</style>
	<?php }	
		
	add_action('admin_menu','wphidenag');
	function wphidenag() {
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
}


/*================================================================================*/
/* ACF Options Page */
/*================================================================================*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Photos',
		'menu_title'	=> 'Photos',
		'menu_slug' 	=> 'photos',
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Contact',
		'menu_title'	=> 'Contact',
		'menu_slug' 	=> 'contact',
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Bio',
		'menu_title'	=> 'Bio',
		'menu_slug' 	=> 'bio',
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Site Links',
		'menu_title'	=> 'Site Links',
		'menu_slug' 	=> 'social-media-inks',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	

	
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Header Settings',
	// 	'menu_title'	=> 'Header',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Footer Settings',
	// 	'menu_title'	=> 'Footer',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));
	
}


?>