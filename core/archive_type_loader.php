<?php 

class BG_Post_Archive_Delegator {

	private $post_type;
	private $post_on;
	private $num_posts_to_grab;
	private $max_num_posts;

	function __construct( $post_type, $post_on=0 ) {
		$this->num_posts_to_grab = 3;
		$this->post_on = $post_on;

		if( 'search' == $post_type ):
			$this->setup_as_search_archive( $post_on );
			return;
		endif;

		$this->post_type = $post_type;
		$this->max_num_posts = count( get_posts( array( 
			'post_type'			 => $this->post_type,
			'posts_per_page' => -1,
		) ) );
	}

	function setup_as_search_archive( $post_on ) {
		$this->post_type = 'search';
		$search_args = array(
			's' 				      => get_search_query(),
			'posts_per_page'	=> -1,
			'orderby'		      => 'id',
			'order'			      => 'DESC',
		);

		$this->max_num_posts = count( get_posts( $search_args ) );
	}

	function get_next_posts() {
		if( 0 == $this->max_num_posts ) {
			get_template_part( 'templates/no-posts' );
			return;
		}

		$posts_to_print;
		if( 'search' == $this->post_type ):
			$posts_to_print = get_posts( array (
				's'					      => get_search_query(),
				'posts_per_page'	=> $this->num_posts_to_grab,
				'offset'			    => $this->post_on,
				'orderby'		      => 'id',
				'order'			      => 'DESC',
			) );
		else:
			$posts_to_print = get_posts( array (
				'post_type'			 => $this->post_type,
				'posts_per_page' => $this->num_posts_to_grab,
				'offset'			   => $this->post_on,
				'orderby'		     => 'id',
				'order'			     => 'DESC',
			) );
		endif;

		$this->post_on = count( $posts_to_print ) + $this->post_on;
		$this->print_posts( $posts_to_print );
	}

	function print_posts( $all_posts ) {
		foreach ( $all_posts as $post ):
			$this->print_post( $post );
		endforeach; 
		$this->print_is_last_post( $post );
	}

	function print_is_last_post( $post ) {
		if( $this->max_num_posts <= $this->post_on ): ?>
			<input type='hidden' id='last-post-present' value='true' />
		<?php endif;
	}

	// If there are more posts yet to be displayed, 
	// 		print out an AJAX load more button.
	function print_ajax_button() {
		if( $this->max_num_posts > $this->post_on ): ?>
			<div class='button-container'>
				<div id='js-ajax-load-posts' class='load-posts button'>
					<input type='hidden' id='post-type' value="<?php echo str_replace( 'bgpt_', '', $this->post_type ); ?>">
					<input type='hidden' id='post-on' value="<?php echo $this->post_on; ?>"> Load More Posts
				</div>
			</div>
		<?php endif;
	}

	function print_post( $the_post ) {
		global $post;
		$post = $the_post;
		setup_postdata( $post );
		get_template_part( 'templates/excerpts/excerpt', get_post_format() );
		wp_reset_postdata();
	}
}