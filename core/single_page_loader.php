<?php

class Single_Page_Loader {

	private $has_sidebar;

	function __construct( $has_sidebar=true ) {
		$this->has_sidebar = $has_sidebar;
		the_post();
	}
	
	public function the_page_layout() { ?>
		<div class="l-contain">
		<div class="single-page <?php if( $this->has_sidebar ): echo 'single-page--sidebar'; endif; ?>">
			<?php get_template_part( 'templates/fulls/full', get_post_format() ); ?>
			<?php if( $this->has_sidebar ): ?>
				<?php get_template_part( 'templates/partials/sidebar' ); ?>
			<?php endif; ?>
		</div>
		</div>
	<?php }

	public function the_page_hero() {
		$hero_img_url = get_media_background( get_the_ID() );
		if( $hero_img_url ): ?>
			<div class='page-hero' style="<?php echo 'background-image:url('. $hero_img_url . ')';?>"></div>
		<?php endif;
	}
}