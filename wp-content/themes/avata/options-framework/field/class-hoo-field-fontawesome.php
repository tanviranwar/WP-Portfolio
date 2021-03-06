<?php


/**
 * Field overrides.
 */
class Hoo_Field_FontAwesome extends Hoo_Field {

	/**
	 * Sets the control type.
	 *
	 * @access protected
	 */
	protected function set_type() {

		$this->type = 'hoo-fontawesome';

	}

	/**
	 * Sets the $sanitize_callback
	 *
	 * @access protected
	 */
	protected function set_sanitize_callback() {

		// If a custom sanitize_callback has been defined,
		// then we don't need to proceed any further.
		if ( ! empty( $this->sanitize_callback ) ) {
			return;
		}
		$this->sanitize_callback = 'esc_attr';

	}
}
