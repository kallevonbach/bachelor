<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           grupper
 *
 * @wordpress-plugin
 * Plugin Name:       Pakhuset grupper
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       grupper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GRUPPER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-grupper-activator.php
 */
function activate_grupper() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grupper-activator.php';
	Grupper_Activator::activate();
}

function denypermission() {
 	$currentPermissionsArray = get_option('groups_requests');
    $userid = sanitize_text_field($_POST['userid']);
    $groupId = sanitize_text_field($_POST['groupId']);

    $usermeta = get_user_meta($userid);
    $usermetagrupper = $usermeta['Gruppe_medlemskaber'];
    $unserializeddata = unserialize($usermetagrupper[0]);   
  
    
    $userindex = array_search($userid, $currentPermissionsArray[$groupId]);
    unset($currentPermissionsArray[$groupId][$userindex]);
    update_option( 'groups_requests', $currentPermissionsArray );
    wp_redirect(admin_url('edit.php?post_type=grupper_post&page=grupper-administration'));
	}		



function grantpermission() {
 	$currentPermissionsArray = get_option('groups_requests');
    $userid = sanitize_text_field($_POST['userid']);
    $groupId = sanitize_text_field($_POST['groupId']);

    $usermeta = get_user_meta($userid);
    $usermetagrupper = $usermeta['Gruppe_medlemskaber'];
    $unserializeddata = unserialize($usermetagrupper[0]);   
  
    
    if (!in_array($groupId, $unserializeddata)) {
        array_push($unserializeddata, $groupId);
        update_user_meta( $userid, 'Gruppe_medlemskaber',  $unserializeddata);          
    }
    $userindex = array_search($userid, $currentPermissionsArray[$groupId]);
    unset($currentPermissionsArray[$groupId][$userindex]);
    update_option( 'groups_requests', $currentPermissionsArray );
    wp_redirect(admin_url('edit.php?post_type=grupper_post&page=grupper-administration'));
	}		

add_action( 'admin_post_grantpermission', 'grantpermission');
add_action( 'admin_post_denypermission', 'denypermission');

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-grupper-deactivator.php
 */
function deactivate_grupper() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grupper-deactivator.php';
	Grupper_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_grupper' );
register_deactivation_hook( __FILE__, 'deactivate_grupper' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-grupper.php';

$wphd_user_capability = 'edit_posts';

/**
 * Handle custom Toolbar links.
 *
 * WordPress 3.1 introduced the toolbar in both the admin area and the public-facing
 * site (if enabled). For subscribers, there's now a link to the Dashboard when they
 * are on the public-facing site. Let's remove the Dashboard link and customize the
 * links in the admin bar.
 *
 * @since 2.2
 */
function wphd_custom_admin_bar_links() {
	global $blog, $current_user, $id, $wp_admin_bar, $wphd_user_capability, $wp_db_version;

	// Bail if earlier version than 3.4.0.
	if ( $wp_db_version < 20596 ) {
		return;
	}

	if ( ! current_user_can( $wphd_user_capability )
		&& is_admin_bar_showing()
		&& is_user_logged_in()
		&& $wp_db_version >= 20596
	) {

		// If single site, remove Dashboard link on public-facing site and WordPress logo menu everywhere.
		if ( ! is_multisite() && ! is_admin() ) {
			// Hide Dashboard link on public-facing site.
			$wp_admin_bar->remove_menu( 'dashboard' );
		}

		// Hide WordPress logo menu completely.
		$wp_admin_bar->remove_menu( 'wp-logo' );

		$user_id = get_current_user_id();
		$blogs = get_blogs_of_user($user_id);

		// If Multisite, check whether they are assigned to any network sites before removing links.
		if ( is_multisite() ) {

			/* Show only user account menu if the user is assigned to no sites. */
			if ( count( $wp_admin_bar->user->blogs ) == 0 ) {
				// Hide WordPress logo menu completely.
				$wp_admin_bar->remove_menu( 'wp-logo' );
				return;
			}

			// Show single site menu if the user is assigned to only 1 site.
			if ( count($wp_admin_bar->user->blogs ) == 1 ) {
				if ( ! is_admin() ) {
					// Hide Dashboard link on public-facing site.
					$wp_admin_bar->remove_menu( 'dashboard' );
				}
				// Hide WordPress logo menu completely.
				$wp_admin_bar->remove_menu( 'wp-logo' );

				//Hide My Sites menu.
				$wp_admin_bar->remove_menu( 'my-sites' );
				return;
			}

			/*
			 * Remove Dashboard and Visit Site links from My Sites menu if the user is assigned
			 * to two or more sites.
			 */
			if ( count( $wp_admin_bar->user->blogs ) >= 2 ) {
				// Hide Dashboard link on public-facing site.
				$wp_admin_bar->remove_menu( 'dashboard' );

				foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
					$menu_d = 'blog-'.$blog->userblog_id.'-d';
					$menu_v = 'blog-'.$blog->userblog_id.'-v';

					// Remove Dashboard link from My Sites menu.
					$wp_admin_bar->remove_menu( $menu_d );

					// Remove Visit Site link from My Sites menu
					$wp_admin_bar->remove_menu( $menu_v );
				}

				// Change URL for each site from admin URL to site URL */
				$blavatar = '<div class="blavatar"></div>';

				foreach ( (array) $wp_admin_bar->user->blogs as $blog ) {
					$menu_id  = "blog-{$blog->userblog_id}";
					$blogname = ucfirst( $blog->blogname );

					$wp_admin_bar->add_menu( array(
						'parent' => 'my-sites-list',
						'id'     => $menu_id,
						'title'  => $blavatar . $blogname,
						'href'   => get_site_url( $blog->userblog_id ),
					) );
				}
				return;
			}
		}
	}
}
add_action( 'wp_before_admin_bar_render', 'wphd_custom_admin_bar_links' );

/**
 * Replace toolbar Dashboard link on public-facing site with link to the user's profile.
 *
 * @since 2.2
 */
function wphd_add_admin_bar_profile_link() {
	global $blog, $current_user, $id, $wp_admin_bar, $wphd_user_capability, $wp_db_version;

	// Bail if earlier version than 3.4.0.
	if ( $wp_db_version < 20596 ) {
		return;
	}

	if ( ! current_user_can( $wphd_user_capability )
		&& is_admin_bar_showing()
		&& ! is_admin()
		&& $wp_db_version >= 20596
	) {
		$wp_admin_bar->add_menu( array(
			'parent' => 'site-name',
			'id'     => 'profile',
			'title'  => __( 'Profile' ),
			'href'   => admin_url( 'profile.php' ),
		) );
	}
}
add_action( 'admin_bar_menu', 'wphd_add_admin_bar_profile_link' );

/**
 * Hide the Dashboard & Help menus, Upgrade notices, and Personal Options section.
 *
 * @since 2.2
 */
function wphd_hide_dashboard() {
	global $blog, $current_user, $id, $parent_file, $wphd_user_capability, $wp_db_version;

	// Bail if earlier version than 3.4.0.
	if ( $wp_db_version < 20596 ) {
		return;
	}

	if ( ! current_user_can( $wphd_user_capability ) && $wp_db_version >= 20596 ) {

		// First, let's get rid of the Help menu, Update nag, Personal Options section.
		echo "\n" . '<style type="text/css" media="screen">#your-profile { display: none; } .update-nag, #contextual-help-wrap, #contextual-help-link-wrap { display: none !important; }</style>';
		echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) { $(\'form#your-profile > h3:first\').hide(); $(\'form#your-profile > table:first\').hide(); $(\'form#your-profile\').show(); });</script>' . "\n";

		// Now, let's fix the sidebar admin menu - go away, Dashboard link. */

		// If Multisite, check whether they are in the User Dashboard before removing links.
		$user_id = get_current_user_id();
		$blogs   = get_blogs_of_user( $user_id );

		if ( is_multisite() && is_admin() && empty( $blogs ) ) {
			return;
		} else {
			// Hides Dashboard menu.
			remove_menu_page( 'index.php');

			// Hides separator under Dashboard menu.
			remove_menu_page( 'separator1' );
		}


		// Redirect folks to their profile when they login, or if they try to access the Dashboard via direct URL.
		if ( 'index.php' == $parent_file ) {
			if ( headers_sent() ) {
				echo '<meta http-equiv="refresh" content="0;url=' . admin_url( 'profile.php' ) . '">';
				echo '<script type="text/javascript">document.location.href="' . admin_url( 'profile.php' ) . '"</script>';
			} else {
				if ( wp_redirect( admin_url( 'profile.php' ) ) ) {
					exit();
				}
			}
		}
	}
}
add_action( 'admin_head', 'wphd_hide_dashboard', 0 );



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_grupper() {

	$plugin = new Grupper();
	$plugin->run();

}
run_grupper();
