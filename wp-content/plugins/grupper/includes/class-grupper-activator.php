<?php
require_once( ABSPATH . 'wp-load.php' );

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    grupper
 * @subpackage grupper/includes
 * @author     Your Name <email@example.com>
 */
class Grupper_Activator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	
	 
	public static function activate() {
  	// Opret disse sider, når pluginet bliver aktiveret
	$page_definitions = array(
		'member-login' => array(
			'title' => __( 'Login medlemmer', 'grupper-login' ),
			'content' => '[member-login-form]'
		),
		'member-account' => array(
			'title' => __( 'Medlemskonto', 'grupper-login' ),
			'content' => '[member-info]'
		),
		'member-register' => array(
			'title' => __( 'Registrer medlemmer', 'grupper-login' ),
			'content' => '[member-register-form]'
		),
		'grupper-oversigt' => array(
			'title' => __( 'Grupper oversigt', 'grupper-login' ),
			'content' => '[gruppe-oversigt]'
		),
		'emne-oversigt' => array(
			'title' => __( 'Emne oversigt', 'grupper-login' ),
			'content' => '[emne-oversigt]'
		),
		'post-oversigt' => array(
			'title' => __( 'Post oversigt', 'grupper-login' ),
			'content' => '[post-oversigt]'
		),
			'applied' => array(
			'title' => __( 'Applied', 'grupper-login' ),
			'content' => '[applied]'
		),
			'insert_post' => array(
			'title' => __( 'insert_post', 'grupper-login' ),
			'content' => '[insert_post]'
		),
		'member-password-lost' => array(
        'title' => __( 'Forgot Your Password?', 'grupper-login' ),
        'content' => '[custom-password-lost-form]'
		),
		'member-password-reset' => array(
        'title' => __( 'Pick a New Password', 'grupper-login' ),
        'content' => '[custom-password-reset-form]'
        )
		
	);
	
	Group::users_can_apply();

	foreach ( $page_definitions as $slug => $page ) {
		// Tjek om siderne eksistere og tilføj dem
		$query = new WP_Query( 'pagename=' . $slug );
		if ( ! $query->have_posts() ) {
			wp_insert_post(
				array(
					'post_content'   => $page['content'],
					'post_name'      => $slug,
					'post_title'     => $page['title'],
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'ping_status'    => 'closed',
					'comment_status' => 'closed',
				)
			);
		}
	}
	}
}
