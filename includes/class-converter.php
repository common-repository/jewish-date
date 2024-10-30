<?php
/**
 * Creates the Converter class.
 *
 * @package JewishDate
 */

/** The Converter class converts the Gregorian date to the Jewish date */
class PWPJD_Converter {

	/** Converts the Gregorian date to the Julian date, and the Julian date to the Jewish date
	 *
	 * @param string $greg_month The Gregorian month.
	 * @param string $greg_day The Gregorian day of the month.
	 * @param string $greg_year The Gregorian year.
	 */
	public function convert( $greg_month, $greg_day, $greg_year ) {
		$julian_date          = gregoriantojd( $greg_month, $greg_day, $greg_year );
		$jewish_date          = jdtojewish( $julian_date );
		$jewish_date_split_up = explode( '/', $jewish_date );
		$jewish_month         = $jewish_date_split_up[0];
		$jewish_day           = $jewish_date_split_up[1];
		$jewish_year          = $jewish_date_split_up[2];

		/* Checks whether Jewish year is a leap year and change over to respective month names*/
		if ( 0 === $jewish_year % 19 || 3 === $jewish_year % 19 || 6 === $jewish_year % 19
			|| 8 === $jewish_year % 19 || 11 === $jewish_year % 19 || 14 === $jewish_year % 19
			|| 17 === $jewish_year % 19 ) {
			$jewish_month_names_leap = array(
				0  => __( 'Tishri', 'jewish-date' ),
				1  => __( 'Heshvan', 'jewish-date' ),
				2  => __( 'Kislev', 'jewish-date' ),
				3  => __( 'Tevet', 'jewish-date' ),
				4  => __( 'Shevat', 'jewish-date' ),
				5  => __( 'Adar I', 'jewish-date' ),
				6  => __( 'Adar II', 'jewish-date' ),
				7  => __( 'Nisan', 'jewish-date' ),
				8  => __( 'Iyar', 'jewish-date' ),
				9  => __( 'Sivan', 'jewish-date' ),
				10 => __( 'Tammuz', 'jewish-date' ),
				11 => __( 'Av', 'jewish-date' ),
				12 => __( 'Elul', 'jewish-date' ),
			);
			$jewish_month            = $jewish_month_names_leap[ $jewish_month - 1 ];
		} else {
			$jewish_month_names_non_leap = array(
				0  => __( 'Tishri', 'jewish-date' ),
				1  => __( 'Heshvan', 'jewish-date' ),
				2  => __( 'Kislev', 'jewish-date' ),
				3  => __( 'Tevet', 'jewish-date' ),
				4  => __( 'Shevat', 'jewish-date' ),
				5  => '',
				6  => __( 'Adar', 'jewish-date' ),
				7  => __( 'Nisan', 'jewish-date' ),
				8  => __( 'Iyar', 'jewish-date' ),
				9  => __( 'Sivan', 'jewish-date' ),
				10 => __( 'Tammuz', 'jewish-date' ),
				11 => __( 'Av', 'jewish-date' ),
				12 => __( 'Elul', 'jewish-date' ),
			);
			$jewish_month                = $jewish_month_names_non_leap[ $jewish_month - 1 ];
		}
		$jewish_date = $jewish_day . '. ' . $jewish_month . ' ' . $jewish_year;
		return $jewish_date;
	}
}
