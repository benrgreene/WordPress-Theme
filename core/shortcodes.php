<?php

/**
 * Display an AJAX search form and results
 */
add_shortcode( 'search_bar', 'print_search_form' );
function print_search_form( $atts ) { 
  $class = isset( $atts['class'] ) ? $atts['class'] : 'search-form';
  ob_start(); ?>
  <form class="<?php echo $class; ?>" action="<?php echo get_site_url(); ?>" method="GET">
    <input name="s" id="s" type="text" placeholder="Search" />
    <input class="button" type="submit" value="Search" />
  </form>
  <div id="search-results" class="search-results-grid"></div>
  <?php return ob_get_clean();
}
