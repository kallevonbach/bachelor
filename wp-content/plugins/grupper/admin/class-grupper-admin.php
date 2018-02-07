<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    grupper
 * @subpackage grupper/admin
 * @author     Your Name <email@example.com>
 */
class Grupper_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $grupper    The ID of this plugin.
	 */
	private $grupper;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $grupper       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $grupper, $version ) {

		$this->grupper = $grupper;
		$this->version = $version;
		
		add_action( 'admin_menu' , array( $this, 'grupper_admin_page' ) );
		
		add_action('admin_post_accept_user_into_group', 'accept_grantpermission');		

	}
	

	
	public function grupper_admin_page() {
		$parent_slug = 'edit.php?post_type=grupper_post';
		$page_title = 'Gruppe administration';
		$menu_title = 'Gruppe administration';
		$capability = 'manage_options';
		$menu_slug = 'grupper-administration';
		
		
		add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'grupper_admin_template'));
		
		
	
	}
	
	
	public function grupper_admin_template() {
		
		
		require(plugin_dir_path( __FILE__ ) . "grupper-admin.php");
		
	} 

	
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	 
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in grupper_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The grupper_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->grupper, plugin_dir_url( __FILE__ ) . 'css/grupper-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in grupper_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The grupper_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->grupper, plugin_dir_url( __FILE__ ) . 'js/grupper-admin.js', array( 'jquery' ), $this->version, false );

	}

}
