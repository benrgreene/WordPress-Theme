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

/**
 * Display an account page with all upcoming events/duties
 */
add_shortcode( 'account_page', 'brg_account_page' );
function brg_account_page( $atts ) {
  ob_start();

  // Get logged in user (or return if not logged in)
  if( ! is_user_logged_in() ) {
    echo '<p>To view your account page, please <a href="' . wp_login_url( get_permalink() ) . '">log in</a></p>';
    return ob_get_clean();
  }
  
  get_template_part( 'templates/fulls/account' );
  return ob_get_clean();
}
