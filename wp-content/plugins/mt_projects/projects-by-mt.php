<?php
/*
Plugin Name: Projects by ModernThemes
Plugin URI: http://modernthemes.net/plugins/projects
Description: This is a plugin by ModernThemes that adds Projects post types and widgets.
Version: 1.1.0
Author: ModernThemes
Author URI: http://modernthemes.net
License: GPL2
Text Domain: mtprojects 
Domain Path: /languages/
*/

add_action('admin_init', 'mt_projectssettings_flush' );

function mt_projectssettings_flush(){ 

		if ( isset( $_POST['mt_projectssettings_options'] ) ) {


			flush_rewrite_rules();
		
		}

}

/* Paths for Files */
$mt_projects_main_file = dirname(__FILE__).'/projects-by-mt.php';
$mt_projects_directory = plugin_dir_url($mt_projects_main_file);
$mt_projects_path = dirname(__FILE__);

/* Add css and scripts file */ 
function mt_projects_add_scripts() {
	global $mt_projects_directory, $mt_projects_path; 
		wp_enqueue_style('mt-projects-style', $mt_projects_directory.'css/grid.css'); 
		wp_enqueue_style('mt-projects-style-css', $mt_projects_directory.'css/mt-projects-style.css');  
}
		
add_action('wp_enqueue_scripts', 'mt_projects_add_scripts'); 


class MT_Projects_Widgets {
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'load' ), 9 );
		add_action( 'widgets_init', array( $this, 'init' ), 10 );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );
	}

	public function load() {
		$dir = plugin_dir_path( __FILE__ );

		include_once( $dir . 'inc/widget-mt-projects.php' );
		include_once( $dir . 'inc/mt-projects.php' );
		include_once( $dir . 'inc/shortcodes-mt-projects.php' );  
		
	}

	public function init() {
		if ( ! is_blog_installed() ) {
			return;
		}

		load_plugin_textdomain( 'mtprojects', false, 'mt_projects/languages' );
		
		register_widget( 'mt_projects' ); 
		
	}

	public function uninstall() {}
}

$mt_projects_widgets = new MT_Projects_Widgets(); 