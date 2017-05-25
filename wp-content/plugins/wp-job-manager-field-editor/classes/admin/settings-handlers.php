<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class WP_Job_Manager_Field_Editor_Settings_Handlers
 *
 * @since 1.1.9
 *
 */
class WP_Job_Manager_Field_Editor_Settings_Handlers extends WP_Job_Manager_Field_Editor_Settings_Fields {

	/**
	 * Settings Button Method Handler
	 *
	 *
	 * @since 1.1.9
	 *
	 * @param $input
	 *
	 * @return bool
	 */
	public function button_handler( $input ) {

		if ( empty( $_POST[ 'button_submit' ] ) || ( $this->button_count > 0 ) ) return $input;

		$action = filter_input( INPUT_POST, 'button_submit', FILTER_SANITIZE_STRING );

		switch ( $action ) {

			case 'remove_all':

				$this->fields()->remove_all_fields();
				$this->add_updated_alert( __( 'All custom posts removed!', 'wp-job-manager-field-editor' ) );
				break;

			case 'purge_options':

				$purged = $this->fields()->cpt()->purge_options();

				if( ! is_array( $purged ) ) {
					$this->add_error_alert( __( 'There are not any fields that need options purged.', 'wp-job-manager-field-editor' ) );
					break;
				}

				$count = $purged[ 'count' ];
				$purged_fields = $purged[ 'purged_fields' ];

				$this->add_updated_alert( __( 'Options were purged from', 'wp-job-manager-field-editor' ) . " {$count} " . __( 'fields:', 'wp-job-manager-field-editor' ) . '<br/>' .implode(', ', $purged_fields ) );
				break;

			case 'force_register_i18n':
				$has_values = WP_Job_Manager_Field_Editor_Translations::register_all();

				if( $has_values ){
					$this->add_updated_alert( __( 'All custom fields with translatable configuration values have been registered in string translation.', 'wp-job-manager-field-editor' ) );
				} else {
					$this->add_error_alert( __( 'There are not any custom fields to add to string translation.  Please setup some custom fields.', 'wp-job-manager-field-editor' ) );
				}

				break;

		}

		$this->button_count ++;

		return FALSE;

	}

	/**
	 * Add WP Updated Alert
	 *
	 *
	 * @since 1.1.9
	 *
	 * @param $message
	 */
	function add_updated_alert( $message ) {

		add_settings_error(
			$this->settings_group,
			esc_attr( 'settings_updated' ),
			$message,
			'updated'
		);

	}

	/**
	 * Add WP Error Alert
	 *
	 *
	 * @since 1.1.9
	 *
	 * @param $message
	 */
	function add_error_alert( $message ) {

		add_settings_error(
			$this->settings_group,
			esc_attr( 'settings_error' ),
			$message,
			'error'
		);

	}

	/**
	 * Escape HTML Pre-Save Handler
	 *
	 *
	 * @since 1.4.0
	 *
	 * @param $input
	 *
	 * @return string
	 */
	function esc_html_handler( $input ){

		$esc_html = htmlentities( $input );

		return $esc_html;

	}

	/**
	 * Settings Button Handler
	 *
	 *
	 * @since 1.1.9
	 *
	 * @param $input
	 *
	 * @return bool
	 */
	public function submit_handler( $input ) {

		if ( empty( $input ) ) return FALSE;

		return $input;

	}

	/**
	 * Checkboxes Handler
	 *
	 * Serializes array data from checkboxes before saving
	 *
	 *
	 * @since 1.4.0
	 *
	 * @param $input
	 *
	 * @return mixed
	 */
	function checkboxes_handler( $input ){

		if( is_array( $input ) ) $input = maybe_serialize( array_values( $input ) );

		return $input;
	}

	/**
	 * Settings Cache Button Method Handler
	 *
	 *
	 * @since @@since
	 *
	 * @param $input
	 * @param $option
	 *
	 * @return bool
	 */
	public function cache_button_handler( $input, $option = false ) {

		if ( empty( $_POST[ 'button_submit' ] ) || ( $this->process_count > 0 ) ) return $input;

		$action = filter_input( INPUT_POST, 'button_submit', FILTER_SANITIZE_STRING );

		switch( $action ) {

			case 'cache_purge_all':
				$cache = WP_Job_Manager_Field_editor_Transients::get_instance();
				$cache->purge();
				$cache->purge( FALSE );
				$this->add_updated_alert( __( 'All cache (with AND without expirations) has been purged/removed!', 'wp-job-manager-field-editor' ) );
				break;

			case 'cache_flush_all':
				wp_cache_flush();
				wp_cache_init();
				$this->add_updated_alert( __( 'The core WordPress cache has been flushed!', 'wp-job-manager-field-editor' ) );
				break;

		}

		$this->process_count ++;

		return FALSE;

	}
}