<!doctype html>
<html class="no-js">
	<head>
		<?php wp_head(); ?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/img/favicon.ico'; ?>" type="image/x-icon">
		<?php load_theme_info(); ?>
		<link rel='stylesheet' type='text/css' href="<?php echo get_template_directory_uri() . '/assets/main.css'; ?>" />
	</head>
	<body class="<?php echo apply_filters('brg/body_class', ''); ?>">
		<input type='hidden' id='site_base_url' value="<?php echo get_site_url(); ?>"/>
		<div class='site-header'>
			<div class='l-contain'>
				<h1 class="site-title"><a class='site-logo' href="<?php echo get_site_url(); ?>">
					<?php bloginfo( 'name' ); ?>
				</a></h1>
				<div class='site-nav-menu'>
					<?php wp_nav_menu( array( 
						'theme_location' => 'primary_menu', 
						'walker' => new BRG_Menu_Walker()
					) ); ?>
				</div>
				<button id="menu-toggle" class="mobile-only menu-toggle"><i class="fas fa-bars">Test</i></button>
			</div>
		</div>
		<div class='site-content'>