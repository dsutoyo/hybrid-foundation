<?php

class Hybrid_Foundation_Divider extends WP_Customize_Control {

/**
	 * The type of customize control being rendered.
	 *
	 * @since  4.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'hf-divider';

	/**
	 * Render the divider.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return bool
	 */
	public function render_content() { ?>
		<hr />
	<?php }
}