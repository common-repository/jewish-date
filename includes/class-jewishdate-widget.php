<?php
/**
 * Adds the JewishDate_Widget widget.
 *
 * @package JewishDate
 */

/** Registers the JewishDate widget
 */
function pwpjd_register_jewish_date_widget() {
	register_widget( 'JewishDate_Widget' );
}
add_action(
	'widgets_init',
	'pwpjd_register_jewish_date_widget'
);

/** Creates the JewishDate_Widget class  */
class JewishDate_Widget extends WP_Widget {

	/** Sets up the widget */
	public function __construct() {
		parent::__construct(
			'pwpjd-jewish-date-widget', // Base ID.
			__( 'Jewish Date', 'jewish-date' ),   // Title.
			array( 'description' => __( 'Shows the current Jewish date', 'jewish-date' ) ) // Args.
		);
	}

	/** Determines the current Gregorian date */
	public function calculateGregDate() {

		$greg_date = date_i18n( 'j. F Y' );
		return $greg_date;
	}

	/** Calculates the current Jewish date */
	public function calculateJewishDate() {

		$greg_month = gmdate( 'm' );
		$greg_day   = gmdate( 'd' );
		$greg_year  = gmdate( 'Y' );

		$date        = new PWPJD_Converter();
		$jewish_date = $date->convert( $greg_month, $greg_day, $greg_year );
		return $jewish_date;

	}

	/**
	 * Front-end display of the widget.
	 *
	 * @param array $sidebar Widget arguments.
	 * @param array $instance Saved values from the database.
	 *
	 * @see WP_Widget::widget()
	 */
	public function widget( $sidebar, $instance ) {
		echo $sidebar['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $sidebar['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, esc_html( $this->id_base ) ) .
			$sidebar['after_title'];
		}

		/* Outputs the current Gregorian and Hebrew dates */
		if ( 'on' === $instance['show'] ) {
			echo '<p>' . esc_html( $this->calculateJewishDate() ) . '<br/>(' . esc_html( $this->calculateGregDate() ) . ')</p>';
		} else {
			echo '<p>' . esc_html( $this->calculateJewishDate() ) . '</p>';
		}

		echo $sidebar['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 *
	 * @see WP_Widget::form()
	 */
	public function form( $instance ) {
		$defaults = array(
			'title' => __( 'Current Jewish Date', 'jewish-date' ),
			'show'  => 'off',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"> <?php esc_attr_e( 'Title', 'jewish-date' ); ?> </label>
		<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
		value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		<label for="<?php echo esc_attr( $this->get_field_id( 'show' ) ); ?>"> <?php esc_attr_e( 'Show Gregorian date, too?', 'jewish-date' ); ?> </label>
		<input type="checkbox" class="widefat" <?php checked( $instance['show'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show' ) ); ?>" 
		name="<?php echo esc_attr( $this->get_field_name( 'show' ) ); ?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from the database.
	 *
	 * @return array Updated safe values to be saved.
	 * @see WP_Widget::update()
	 */
	public function update( $new_instance, $old_instance ) {

		$instance          = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['show']  = $new_instance['show'];

		return $instance;
	}
}
