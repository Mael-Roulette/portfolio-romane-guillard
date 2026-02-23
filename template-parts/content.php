<?php 
/**
 * Contenu d'un post
 */
?>

<div class="post-title-wrapper">
  <h1 class="post-title section-inner"><?php the_title(); ?></h1>
</div>

<div class="post-content section-inner">
  <?php the_content(); ?>
</div>