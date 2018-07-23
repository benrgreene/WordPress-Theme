<?php 

// Setup the archive delegator
$archive_type = 'post';
if( $wp_query->query && isset( $wp_query->query['post_type'] ) ):
  $archive_type = $wp_query->query['post_type'];
endif;
$archive_loader = new BG_Post_Archive_Delegator( $archive_type );

// header
include 'header.php';

do_action( 'before_site_content' );

echo "<div class='grid-contain l-contain'>";
$archive_loader->get_next_posts();
echo "</div>";

$archive_loader->print_ajax_button();

// footer
do_action( 'after_site_content' );

include 'footer.php';