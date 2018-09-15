<?php

function the_media_background( $post_id ) {
  echo get_media_background( $post_id );
}

function get_media_background( $post_id ) {
  if( has_post_thumbnail( $post_id ) ):
    return get_the_post_thumbnail_url( $post_id );
  endif;
  return false;
}

// display the categories a post is in
function brg_the_categories() {
  $categories = wp_get_post_categories( get_the_ID() );
  if( !is_wp_error( $categories ) && 0 < count( $categories ) ) {
    echo '<span>Categories:</span>';
    echo '<ul class="post__categories">';
    foreach( $categories as $category ) {
      $term = get_term( $category, 'category' );
      $term_link = get_term_link( $category );
      echo sprintf( '<li><a href="%s">%s</a></li>', $term_link, $term->name );
    }
    echo '</ul>';
  }
}

// Display a table cell containing a select element with the different 'display as' options for archives
function brg_the_display_type_select( $post_type="search" ) { 
  $selected = get_option('brg_settings_display_' . $post_type); ?>
  <td><select name="brg_settings_display_<?php echo $post_type; ?>">
    <option value="grid">Grid</option>
    <option value="stacked"<?php if('stacked' == $selected): echo ' selected="selected"'; endif; ?>>Stacked</option>
  </select></td>
<?php }