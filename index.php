<?php

include 'header.php';

do_action( 'before_site_content' );

// get hero image if available
$page_loader = new Single_Page_Loader();
$page_loader->the_page_hero();
$page_loader->the_page_layout();

do_action( 'after_site_content' );

include 'footer.php';