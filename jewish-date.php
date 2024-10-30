<?php
/**
 * Plugin Name: Jewish Date
 * Plugin URI: https://wordpress.org/plugins/jewish-date
 * Description: A small plugin to show the Jewish date on your WordPress site.
 * Version: 1.0.2
 * Requires PHP: 7.0.0 or higher
 * Author: kikipress
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: jewish-date
 * Domain Path: /languages/
 *
 * @package JewishDate
 */

/** Loads text domain for translation purposes */
function pwpjd_load_textdomain() {
	load_plugin_textdomain(
		'jewish-date',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'pwpjd_load_textdomain' );

/** Enqueues css script */
function pwpjd_load_admin_style() {
	wp_enqueue_style( 'jewish-date-admin', plugins_url( 'css/admin.css', __FILE__ ), '', '1.0.0.' );
}
add_action( 'admin_enqueue_scripts', 'pwpjd_load_admin_style' );

/* Plugin files required for operation */
require plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
require plugin_dir_path( __FILE__ ) . 'includes/date-posts.php';
require plugin_dir_path( __FILE__ ) . 'includes/date-comments.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-converter.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-jewishdate-widget.php';

