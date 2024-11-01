<?php
/*
Plugin Name: Simple Admin Columns
Plugin URI: https://wpflask.com/simple-admin-columns/
Description: You can create a Modified Date sortable column and Post Thumbnail column for posts and pages in WordPress admin area by using a friendly interface.
Author: WPFlask.com
Author URI: https://wpflask.com
Text Domain: wpflask-admin-columns
Domain Path: /languages/
Version: 1.0.1
License: GPL v3

Simple Admin Columns Plugin
Copyright (C) 2015-2016, WPFlask.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Constants
 */
define( 'WPFLASK_AC_VERSION', '1.0.1' );
define( 'WPFLASK_AC_BASENAME', plugin_basename( __FILE__ ) );
define( 'WPFLASK_AC_DIR_BASENAME', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
define( 'WPFLASK_AC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WPFLASK_AC_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * For admin only
 */
if ( ! is_admin() ) {
	return false;
}

// Redirect to welcome screen upon plugin activation.
function wpflask_ac_activation_redirect( $plugin ) {

	if ( $plugin === WPFLASK_AC_BASENAME ) {
		exit( wp_redirect( add_query_arg( array( 'page' => 'wpflask-admin-columns' ), admin_url( 'options-general.php' ) ) ) );
	}

}
add_action( 'activated_plugin', 'wpflask_ac_activation_redirect' );

/**
 * Load plugin textdomain.
 */
function wpflask_ac_load_textdomain() {
  load_plugin_textdomain( 'wpflask-admin-columns', false, WPFLASK_AC_DIR_BASENAME. 'languages/' );
}
add_action( 'plugins_loaded', 'wpflask_ac_load_textdomain' );

/**
 * Custom functions.
 */
require WPFLASK_AC_DIR . 'inc/extras.php';

/**
 * Admin Page
 */
require WPFLASK_AC_DIR . 'inc/admin.php';
