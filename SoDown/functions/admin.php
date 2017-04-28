<?php



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
			#menu-dashboard ul,
			#menu-comments,
			#menu-media,
			#pageparentdiv,
			#menu-plugins,
			#menu-appearance,
			#menu-users,
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


?>