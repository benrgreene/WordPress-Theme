<div class="post--grid" style="background-image: url(<?php the_media_background( $post->ID ); ?>)">
  <a href="<?php the_permalink( $post->ID ); ?>" class='post-permalink' rel='post-permalink'> 
    <div class='post-info-container'>
      <div class='post__title'><?php echo $post->post_title; ?></div>
      <div class='post__excerpt'><?php echo $post->post_excerpt; ?></div
      >
    </div>
  </a>
</div>