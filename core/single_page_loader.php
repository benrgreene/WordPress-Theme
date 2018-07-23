<?php

class Single_Page_Loader {

	function __construct() {
		the_post();
	}
	
	public function the_page_layout() { ?>
		<div class='l-contain single-page'>
			<?php $this->main_content(); ?>
		</div>
	<?php }

	public function main_content() {
		get_template_part( 'templates/fulls/full', get_post_format() );
	}

	public function the_page_hero() {
		$hero_img_url = get_media_background( get_the_ID() );
		if( $hero_img_url ): ?>
			<div class='page-hero' style="<?php echo 'background-image:url('. $hero_img_url . ')';?>"></div>
		<?php endif;
	}
}