<?php
/**
 * Adds the Jewish date next to the Gregorian post date.
 *
 * @package JewishDate
 */

/** Adds the Jewish date next to the Gregorian post date
 *
 * @param string $post_date Date of the post.
 */
function pwpjd_add_the_jewish_date_posts( $post_date ) {
	$options = get_option( 'pwpjd_jewish_date_options' );
	if ( 'enabled' === $options['jewish_date_post'] ) {

		/* Prepares the Gregorian date for conversion to the Jewish date */
		$greg_month = get_post_time( 'm' );
		$greg_day   = get_post_time( 'd' );
		$greg_year  = get_post_time( 'Y' );

		$date        = new PWPJD_Converter();
		$jewish_date = $date->convert( $greg_month, $greg_day, $greg_year );

		/* Returns the Jewish date next to the Gregorian date if enabled */
		$double_post_date = $post_date . ' / ' . $jewish_date;
		return $double_post_date;
	} else {
		return $post_date;
	}
}
add_filter( 'get_the_date', 'pwpjd_add_the_jewish_date_posts', 10, 3 );
