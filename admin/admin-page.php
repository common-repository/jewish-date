<?php
/**
 * The admin-specific functionality of the Jewish Date plugin.
 *
 * @package JewishDate
 */

/** Creates and registers a submenu under Settings */
function pwpjd_add__settings_menu() {
	add_options_page(
		__( 'Jewish Date Settings', 'jewish-date' ),
		__( 'Jewish Date', 'jewish-date' ),
		'manage_options',
		'pwpjd_jewish_date',
		'pwpjd_jewish_date_option_page'
	);
}
add_action( 'admin_menu', 'pwpjd_add__settings_menu' );

/** Creates the plugin admin page */
function pwpjd_jewish_date_option_page() {
	?>
	<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form id="options" action="options.php" method="post">
		<?php
		do_settings_sections( 'pwpjd_jewish_date' );
		settings_fields( 'pwpjd_jewish_date_options' );
		submit_button( __( 'Save Changes', 'jewish-date' ), 'primary' );
		?>
	</form> 
	<hr/>
	<div id="credits">
		<p><?php esc_html_e( 'Plugin developed by ', 'jewish-date' ); ?><a href="mailto:alexia.kikipress@gmail.com">kikipress</a></p>
	</div>
	<?php
}

/** Registers and defines the settings */
function pwpjd_jewish_date_admin_init() {
	$args = array(
		'type'              => 'string',
		'sanitize_callback' => 'pwpjd_jewish_date_validate_options',
		'default'           => null,
	);

	register_setting( 'pwpjd_jewish_date_options', 'pwpjd_jewish_date_options', $args );

	add_settings_section( 'pwpjd_jewish_date_main', '', 'pwpjd_jewish_date_section_text', 'pwpjd_jewish_date' );

	add_settings_field(
		'pwpjd_jewish_date_post',
		__( 'Add Jewish date to posts?', 'jewish-date' ),
		'pwpjd_jewish_date_post',
		'pwpjd_jewish_date',
		'pwpjd_jewish_date_main'
	);

	add_settings_field(
		'pwpjd_jewish_date_comment',
		__( 'Add Jewish date to comments?', 'jewish-date' ),
		'pwpjd_jewish_date_comment',
		'pwpjd_jewish_date',
		'pwpjd_jewish_date_main'
	);
}
add_action( 'admin_init', 'pwpjd_jewish_date_admin_init' );

/** Creates the section text */
function pwpjd_jewish_date_section_text() {
	echo '<p>';
	esc_html_e( 'Enter your settings here.', 'jewish-date' );
	echo '</p>';
}

/** Creates the radio button input fields for posts */
function pwpjd_jewish_date_post() {
	$options          = get_option( 'pwpjd_jewish_date_options', array( 'jewish_date_post' => 'disabled' ) );
	$jewish_date_post = $options['jewish_date_post'];

	echo "<label class='radio'><input " . checked( $jewish_date_post, 'enabled', false ) . "value= '" . esc_attr( 'enabled' ) . "' name='pwpjd_jewish_date_options[jewish_date_post]'
    type='radio'/>" . esc_html__( 'enabled', 'jewish-date' ) . '</label>';
	echo "<label class='radio'><input " . checked( $jewish_date_post, 'disabled', false ) . "value= '" . esc_attr( 'disabled' ) . "' name='pwpjd_jewish_date_options[jewish_date_post]'
    type='radio'/>" . esc_html__( 'disabled', 'jewish-date' ) . '</label><br/>';

}

/** Creates the radio button input fields for comments */
function pwpjd_jewish_date_comment() {
	$options             = get_option( 'pwpjd_jewish_date_options', array( 'jewish_date_comment' => 'disabled' ) );
	$jewish_date_comment = $options['jewish_date_comment'];

	echo "<label class='radio'><input " . checked( $jewish_date_comment, 'enabled', false ) . "value= '" . esc_attr( 'enabled' ) . "' name='pwpjd_jewish_date_options[jewish_date_comment]'
    type='radio'/>" . esc_html__( 'enabled', 'jewish-date' ) . '</label>';
	echo "<label class='radio'><input " . checked( $jewish_date_comment, 'disabled', false ) . "value= '" . esc_attr( 'disabled' ) . "' name='pwpjd_jewish_date_options[jewish_date_comment]'
    type='radio'/>" . esc_html__( 'disabled', 'jewish-date' ) . '</label><br/>';
}

/** Validates user input
 *
 * @param array $input Contains the user's date choices for posts and comments.
 */
function pwpjd_jewish_date_validate_options( $input ) {
	$valid                        = array();
	$valid['jewish_date_post']    = sanitize_text_field( $input['jewish_date_post'] );
	$valid['jewish_date_comment'] = sanitize_text_field( $input['jewish_date_comment'] );
	return $valid;
}
?>
