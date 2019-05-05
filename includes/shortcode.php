<?php
// This file enqueues your shortcode.

defined( 'ABSPATH' ) or die( 'Direct script access disallowed.' );

add_shortcode( 'erw_widget', function( $atts ) {
  $default_atts = array(
    'color' => 'black'
  );
  $args = shortcode_atts( $default_atts, $atts );
  $uniqid = uniqid('id');

  // get the name of the currently logged in user
  global $current_user;
  $display_name = $current_user ? $current_user->display_name : 'World';

  // Capture output into a buffer. Initialize our window-global settings
  // object. Then assign values to a nested object keyed by our unique id.
  ob_start(); ?>
  <script>
  window.erwSettings = window.erwSettings || {};
  window.erwSettings["<?= $uniqid ?>"] = {
    'color': '<?= $args["color"] ?>',
    'name': '<?= $display_name ?>',
  }
  </script>
  <div class="erw-root" data-id="<?= $uniqid ?>"></div>

  <?php
  // return contents of output buffer
  return ob_get_clean();


  return "<div class='erw-root' data-id='{$uniqid}'></div>";
});
