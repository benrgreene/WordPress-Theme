<div class='post--grid'>
  <a href="<?php the_permalink( $post->ID ); ?>" class='post-permalink' rel='post-permalink'> 
    <div class='post-info-container'>
      <div class='post-title'><?php echo $post->post_title; ?></div>
      <div class='post-excerpt'><?php echo $post->post_excerpt; ?></div
      >
    </div>
  </a>
</div>