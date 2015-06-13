<?php
 /**
  * Plugin Name: Old-School Themes Admin
  * Plugin URI:  http://wpmulti.org/old-school-themes-admin
  * Description: Display links to the wp-admin appearance themes admin pages in both the dashboard and in the front-end toolbar.
  * Version:     0.1.1
  * Author:      Martin Robbins
  * Author URI:  http://wpmulti.org
  * License:     GPL2 or later
  * License URI: https://www.gnu.org/licenses/gpl-2.0.html
  */

// Show hidden old school items in the Dashboard Appearance Menu. Then hide the customize items.
add_action( 'admin_enqueue_scripts', 'osta_style' );
function osta_style() {
	if ( is_admin() ) {
		wp_enqueue_style( 'osta-style' , plugins_url( 'osta-style.css', __FILE__ ) , false );
	}
}

// Show all the items in the front-end Toolbar Appearance Menu
add_action( 'wp_enqueue_scripts', 'osta_toolbar_style' );
function osta_toolbar_style() {
	if ( is_user_logged_in() && !is_admin() ) {
		wp_enqueue_style( 'osta-toolbar-style' , plugins_url( 'osta-toolbar-style.css', __FILE__ ) , false );
	}
}

// Modify the titles for Dashboard items Header and Background
add_action ( '_admin_menu', 'osta_modify_submenus', 999 );
function osta_modify_submenus() {
	
	global $submenu;

	// the customize items	
	if ( current_theme_supports( 'custom-header' ) ) {
		$submenu['themes.php'][15][0] =  __( 'Customize Header' );
	}
	if ( current_theme_supports( 'custom-background' ) ) {
		$submenu['themes.php'][20][0] =  __( 'Customize Background' );
	}
/*	
	// the old school items	
	if ( current_theme_supports( 'custom-header' ) ) {
		$submenu['themes.php'][21][0] =  __( 'Old-School Header' );
	}
	if ( current_theme_supports( 'custom-background' ) ) {
		$submenu['themes.php'][22][0] =  __( 'Old-School Background' );
	}
*/
}


// Modify the titles for Toolbar Appearance Menu old school items
add_action( 'admin_bar_menu', 'osta_modify_nodes', 999 );

function osta_modify_nodes( $wp_admin_bar ) {

	$osta_modify_nodes = $wp_admin_bar->get_nodes();

	foreach ( $osta_modify_nodes as $node ) {
		
		// use the same node's properties
		$args = $node;

		// prepend the title of some nodes only where id != customize-x
		$old_school = array (
			'themes',
			'widgets',
			'menus',
			'background',
			'header',		
		);
		if ( in_array ( $node->id ,  $old_school ) ) {
			$prepend = 'Old-School ';			
//			$args->title = '<span class="old-school">' . $prepend . '</span>' . $node->title;
			$args->title = $prepend . $node->title;
		}

		// update the Toolbar node
		$wp_admin_bar->add_node( $args );
	}
}

?>