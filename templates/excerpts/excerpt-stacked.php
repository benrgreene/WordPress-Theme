<a href="<?php the_permalink( $post->ID ); ?>" class='post--stacked'>
  <div class="post__media"><?php echo get_the_post_thumbnail(); ?></div>
  <div class='post-info-container'>
    <h3 class='post__title'><?php echo $post->post_title; ?></h3>
    <div class='post__excerpt'><?php echo $post->post_excerpt; ?></div
    >
  </div>
</a>