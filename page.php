<?php 
/**
 * Modèle de page intérieur
 */

  get_header();
?>

<main id="site-content">
  <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
</main>

<?php get_footer(); ?>