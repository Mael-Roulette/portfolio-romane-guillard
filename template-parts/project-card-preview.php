<?php
/**
 * Prévisualisation d'un article
 */

$id = get_the_ID();
$link = get_permalink($id);
?>

<a href="<?php echo $link; ?>" class="project-card">
    <?php if (has_post_thumbnail()): ?>
        <div class="project-card-image">
            <?php echo get_the_post_thumbnail($id, "post-thumbnail"); ?>
        </div>
    <?php endif; ?>
    <div class="project-card-content">
        <h3 class="project-card-title"><?php the_title(); ?></h3>
        <div class="project-card-excerpt"><?php get_custom_excerpt(
            $id,
        ); ?></div>
    </div>
</a>
