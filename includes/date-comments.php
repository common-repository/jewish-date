<?php
/**
 * Adds the Jewish date next to the Gregorian comment date.
 *
 * @package JewishDate
 */

/** Adds the Jewish date next to the Gregorian comment date
 *
 * @param string $comment_date Date of the comment.
 */
function pwpjd_add_the_jewish_date_comments( $comment_date ) {
	$options = get_option( 'pwpjd_jewish_date_options' );
	if ( 'enabled' === $options['jewish_date_comment'] ) {

		/* prepares the Gregorian date for conversion to the Jewish date */
		$greg_month = get_comment_time( 'm' );
		$greg_day   = get_comment_time( 'd' );
		$greg_year  = get_comment_time( 'Y' );

		$date        = new PWPJD_Converter();
		$jewish_date = $date->convert( $greg_month, $greg_day, $greg_year );

		/* returns the Jewish date next to the Gregorian date if enabled*/
		$double_comment_date = $comment_date . ' / ' . $jewish_date;
		return $double_comment_date;
	} else {
		return $comment_date;
	}
}
add_filter( 'get_comment_date', 'pwpjd_add_the_jewish_date_comments', 10, 3 );
