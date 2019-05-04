<?php
/**
 * Enqueue scripts and styles in this file. Always open your PHP files with
 * `<?php`. It's also helpful to other developers to open your file with a
 * comment that explains the file's purpose.
 */

// Include this line as the first line of code in every PHP file.
defined( 'ABSPATH' ) or die( 'Direct script access diallowed.' );

// WordPress uses actions as hooks, in this case, `init`. Adding a function to
// the `init` action means that this code is run during the "init" phase of the
// load process, which is after your theme and other plugins have loaded.
add_action( 'init', function() {

  // set the scripts to load with `async defer` when using wp_enqueue_script
  add_filter( 'script_loader_tag', function( $tag, $handle ) {
    if ( ! preg_match( '/^erw-/', $handle ) ) { return $tag; }
    return str_replace( ' src', ' async defer src', $tag );
  }, 10, 2 );

  add_action( 'wp_enqueue_scripts', function() {
    // Parse the asset manifest JSON file
    $asset_manifest = json_decode( file_get_contents( ERW_ASSET_MANIFEST ), true );

    // If any css is loaded in index.js, the `main.css` file will be present
    if ( isset( $asset_manifest[ 'main.css' ] ) ) {
      wp_enqueue_style( 'erw', get_site_url() . $asset_manifest[ 'main.css' ] );
    }
    // Enqueue the React runtime first
    wp_enqueue_script( 'erw-runtime', get_site_url() . $asset_manifest[ 'runtime~main.js' ], array(), null, true );
    // Then enqueue the main JavaScript file
    wp_enqueue_script( 'erw-main', get_site_url() . $asset_manifest[ 'main.js' ], array('erw-runtime'), null, true );

    // Finally, enqueue any other script chunks
    foreach ( $asset_manifest as $key => $value ) {
      if ( preg_match( '@static/js/(.*)\.chunk\.js@', $key, $matches ) ) {
        if ( $matches && is_array( $matches ) && count( $matches ) == 2 ) {
          $name = "erw-" . preg_replace( '/[^A-Za-z0-9_]/', '-', $matches[1] );
          wp_enqueue_script( $name, get_site_url() . $value, array( 'erw-main' ), null, true );
        }
      }
    }
  });
});
