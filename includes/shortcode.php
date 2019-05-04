<?php
/**
 * Boilerplate - open with `<?php` and a comment explaining the purpose of the
 * file.
 *
 * This file enqueue your shortcode.
 */

// Include this line as the first line of code in every PHP file.
defined( 'ABSPATH' ) or die( 'Direct script access diallowed.' );

add_shortcode( 'erw_widget', function( $atts ) {
  $default_atts = array();
  $args = shortcode_atts( $defaults_array, $atts );


  return "<div id='erw-root'></div>";
});
