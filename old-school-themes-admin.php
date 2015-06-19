<?php
 /**
  * Plugin Name: Old-School Themes Admin
  * Plugin URI:  http://wpmulti.org/old-school-themes-admin
  * Description: Display links to the wp-admin appearance themes admin pages in both the dashboard and in the front-end toolbar.
  * Version:     0.1.2
  * Author:      Martin Robbins
  * Author URI:  http://wpmulti.org
  * License:     GPL2 or later
  * License URI: https://www.gnu.org/licenses/gpl-2.0.html
  */

// Add Dashboard Old School items for Header, Background
add_action ( '_admin_menu', 'osta_add_old_school_submenus', 999 );
function osta_add_old_school_submenus() {

	global $submenu;

	// Add a Custom Header menu item
	if ( current_theme_supports( 'custom-header' ) && current_user_can( 'edit_theme_options') ) {
		$submenu['themes.php']['21.4'] = array( __( 'Old-School Custom Header' ), 'edit_theme_options', admin_url( 'themes.php?page=custom-header' ), '', '' );
	}

	// Add a Custom Background menu item 
	if ( current_theme_supports( 'custom-background' ) && current_user_can( 'edit_theme_options') ) {
		$submenu['themes.php']['21.5'] = array( __( 'Old-School Custom Background' ), 'edit_theme_options', admin_url( 'themes.php?page=custom-background' ), '', '' );
	}
}

// Add Toolbar Appearance Old-School container node
add_action( 'admin_bar_menu', 'osta_add_old_school_node', 999 );
function osta_add_old_school_node( $wp_admin_bar ) {
	
	if ( current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'    => 'appearance',
			'id'    => 'osta-old-school',
			'title' => 'Old-School Admin Pages',
			'meta'  => array( 'class' => 'osta-old-school' )
		);
		$wp_admin_bar->add_node( $args );
	}
}

// Add Toolbar Old School items
add_action( 'admin_bar_menu', 'osta_add_old_school_nodes', 999 );
function osta_add_old_school_nodes( $wp_admin_bar ) {

	if ( current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'=> 'osta-old-school',
			'id'    => 'osta-themes',
			'title' => 'Themes',
			'href'  => admin_url( 'themes.php' ),
			'meta'  => array( 'class' => 'osta-themes' )
		);		
		$wp_admin_bar->add_node( $args );
	}

	if ( current_theme_supports( 'widgets' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'=> 'osta-old-school',
			'id'    => 'osta-widgets',
			'title' => 'Widgets',
			'href'  => admin_url( 'widgets.php' ),
			'meta'  => array( 'class' => 'osta-widgets' )
		);		
		$wp_admin_bar->add_node( $args );
	}

	if ( current_theme_supports( 'menus' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'=> 'osta-old-school',
			'id'    => 'osta-menus',
			'title' => 'Menus',
			'href'  => admin_url( 'nav-menus.php' ),
			'meta'  => array( 'class' => 'osta-menus' )
		);		
//		$wp_admin_bar->add_node( $args );
	}

	if ( current_theme_supports( 'custom-header' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'=> 'osta-old-school',
			'id'    => 'osta-header',
			'title' => 'Header',
			'href'  => admin_url( 'themes.php?page=custom-header' ),
			'meta'  => array( 'class' => 'osta-header' )
		);		
		$wp_admin_bar->add_node( $args );
	}

	if ( current_theme_supports( 'custom-background' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'=> 'osta-old-school',
			'id'    => 'osta-background',
			'title' => 'Background',
			'href'  => admin_url( 'themes.php?page=custom-background' ),
			'meta'  => array( 'class' => 'osta-background' )
		);		
		$wp_admin_bar->add_node( $args );
	}

}

?>