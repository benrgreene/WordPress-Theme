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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
		<?php load_theme_info(); ?>
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
				<button id="menu-toggle" class="mobile-only menu-toggle"><i class="fas fa-bars"></i></button>
			</div>
		</div>
		<dialog id="js-dialog"><div class="dialog-content"><?php echo do_shortcode( '[search_bar]' ); ?></div><i class="dialog-close fa fa-times-circle"></i></dialog>
		<div class='site-content'>