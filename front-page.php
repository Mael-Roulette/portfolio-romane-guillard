<?php
/**
 * Page d'accueil
 */

get_header();

/* ----- Contenu ----- */
$banner = get_field("banner");
?>


<main id="site-content" class="home-content">
    <section class="banner section-inner">
        <div class="banner-slider swiper">
            <div class="swiper-wrapper">
                <?php
                $slides = $banner["featured_projects"];
                foreach ($slides as $slide) {
                    $large_featured_card = get_field(
                        "large_featured_card",
                        $slide->ID,
                    ); ?>
                    <div class="banner-slider-slide swiper-slide">
                        <?php if ($large_featured_card): ?>
                            <div class="banner-slider-slide-image">
                                <img src="<?php echo $large_featured_card[
                                    "url"
                                ]; ?>" alt="<?php echo $large_featured_card[
        "alt"
    ]; ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
