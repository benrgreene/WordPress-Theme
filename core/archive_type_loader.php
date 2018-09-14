<?php 

class BG_Post_Archive_Delegator {

	private $post_type;
	private $post_on;
	private $num_posts_to_grab;
	private $max_num_posts;

	function __construct( $post_type, $post_on=0, $search_for=false, $in_category=false ) {
		$this->num_posts_to_grab = get_option( 'posts_per_page' );
		$this->post_on = $post_on;

		if( 'search' == $post_type ):
			$this->search_for = $search_for ? $search_for : get_search_query();
			$this->setup_as_search_archive( $post_on, $search_for );
			return;
		endif;

		$args = array( 
			'post_type'			 => $this->post_type,
			'posts_per_page' => -1,
		);

		if( !empty( get_query_var( 'cat' ) ) || false !== $in_category ) {
			$this->category = $in_category ? $in_category : get_category( get_query_var( 'cat' ) )->term_id;			
			$args['category'] = $this->category;
		} else {
			$this->category = false;
		}

		$this->post_type = $post_type;
		$this->max_num_posts = count( get_posts( $args ) );
		error_log( $post_on );
	}

	function setup_as_search_archive( $post_on, $search_for ) {
		$this->post_type = 'search';
		$search_args = array(
			's' 				      => $this->search_for,
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

		$posts_to_print = array();
		$args = array(
			'posts_per_page'	=> $this->num_posts_to_grab,
			'offset'			    => $this->post_on,
			'orderby'		      => 'id',
			'order'			      => 'DESC',
		);
		if( false !== $this->category ) {
			$args['category'] = $this->category;
		}
		
		if( 'search' == $this->post_type ):
			$args['s'] = $this->search_for;
			$posts_to_print = new WP_Query( $args );
			$posts_to_print = $posts_to_print->posts;
		else:
			$args['post_type'] = $this->post_type;
			$posts_to_print = get_posts( $args );
		endif;

		$this->post_on = count( $posts_to_print ) + $this->post_on;
		$this->print_posts( $posts_to_print );
	}

	function print_posts( $all_posts ) {
		foreach ( $all_posts as $post ):
			$this->print_post( $post );
			$this->print_is_last_post( $post );
		endforeach; 
	}

	function print_is_last_post( $post ) {
		if( $this->max_num_posts <= $this->post_on ): ?>
			<input type='hidden' id='last-post-present' value='true' />
		<?php endif;
	}

	// If there are more posts yet to be displayed, 
	// 		print out an AJAX load more button.
	function print_ajax_button() {
		if( $this->max_num_posts > $this->post_on ):
			include locate_template( 'templates/partials/ajax-load-more.php' );
		endif;
	}

	function print_post( $the_post ) {
		global $post;

		// Need the template to display the post with
		$archive_display_type = get_option( 'brg_settings_display_' . $this->post_type, 'grid' );
		// Allow overriding of the templates for specific post types
		$archive_display_type = apply_filters( 'brg/display_archive_' . $this->post_type, $archive_display_type );

		$post = $the_post;
		setup_postdata( $post );
		get_template_part( 'templates/excerpts/excerpt', $archive_display_type );
		wp_reset_postdata();
	}
}