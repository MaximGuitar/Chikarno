<?php

  use Placestart\Utils\Assets;

  add_action('wp_enqueue_scripts', 'head_scripts');
  add_action('wp_footer', 'footer_scripts');
  add_filter( 'script_loader_tag', 'filter_script_loader_tag', 10, 2 );

  function head_scripts(){
    $assetManager = new Assets('/wp-content/themes/assembling/dist/');

    wp_enqueue_style('main', $assetManager->getEntry('main.css'), [], null);
    wp_enqueue_script('main', $assetManager->getEntry('main.js'), [], null);
    wp_script_add_data('main', 'defer', true);
  
    the_field('header_script', 'option');
  }
  function footer_scripts(){
    the_field('footer_script', 'option');
  }
  function filter_script_loader_tag( $tag, $handle ) {
  
    foreach ( [ 'async', 'defer' ] as $attr ) {
  
      if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
        continue;
      }
  
      // Prevent adding attribute when already added in #12009.
      if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
        $tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
      }
  
      // Only allow async or defer, not both.
      break;
    }
  
    return $tag;
  }
