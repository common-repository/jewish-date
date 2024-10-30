<?php
/**
 * Clean-up on uninstalling.
 *
 * @package JewishDate
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

unregister_setting( 'pwpjd_jewish_date_options', 'pwpjd_jewish_date_options' );
delete_option( 'pwpjd_jewish_date_options' );

unregister_widget( 'JewishDate_Widget' );
delete_option( 'widget_pwpjd-jewish-date-widget' );
