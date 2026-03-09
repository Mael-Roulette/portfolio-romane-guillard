<?php
/**
 * Page d'accueil
 */

get_header();

/* ----- Contenu ----- */
$banner = get_field("banner");

/* ----- Projets sélectionnés ----- */
$selection_projects = get_field("selection_projects");

$selection_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "post__in" => $selection_projects["projects"],
];

$selection_projects_query = new WP_Query($selection_args);

/* ----- Projets audiovisuel ----- */
$audiovisual_projects = get_field("audiovisual");

$audiovisual_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "audiovisual"
];

$audiovisual_projects_query = new WP_Query($audiovisual_args);

/* ----- Projets créations digitales ----- */
$digital_creations = get_field("digital_creations");

$digital_creations_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "digital-creations"
];

$digital_creations_query = new WP_Query($digital_creations_args);

/* ----- Ajouts récents ----- */
$recent_additions = get_field("recent_additions");

$recent_additions_args = [
    "post_type" => "project",
    "posts_per_page" => 6,
];

$recent_additions_query = new WP_Query($recent_additions_args);

/* ----- Projets youtube ----- */
$youtube_projects = get_field( "youtube_projects" );

$youtube_projects_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "youtube"
];

$youtube_projects_query = new WP_Query($youtube_projects_args);

/* ----- Projets stage ----- */
$internship_projects = get_field( "internship" );

$internship_projects_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "internship"
];
    
$internship_projects_query = new WP_Query($internship_projects_args);

/* ----- Projets live ----- */
$live_projects = get_field( "live" );

$live_projects_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "live"
];

$live_projects_query = new WP_Query($live_projects_args);

/* ----- Projets à écouter ----- */
$listen_projects = get_field( "listen" );

$listen_projects_args = [
    "post_type" => "project",
    "posts_per_page" => -1,
    "category_name" => "listen"
];

$listen_projects_query = new WP_Query($listen_projects_args);
?>

<main id="site-content" class="home-content">
    <section class="banner section-inner">
        <div class="banner-type-selection">
            <a href="#" class="banner-type-selection-item active">Tout</a>
            <a href="#" class="banner-type-selection-item">Vidéos</a>
            <a href="#" class="banner-type-selection-item">Médias</a>
        </div>
        <div class="banner-slider-wrapper">
            <div class="banner-slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    $slides = $banner["featured_projects"];
                    foreach ($slides as $slide) {
                        $large_featured_card = get_field(
                            "large_featured_card",
                            $slide->ID,
                        ); ?>
                        <a href="<?php echo get_permalink(
                            $slide->ID,
                        ); ?>" class="banner-slider-slide swiper-slide">
                            <?php if ($large_featured_card): ?>
                                <div class="banner-slider-slide-image">
                                    <img src="<?php echo $large_featured_card[ "url" ]; ?>" alt="<?php echo $large_featured_card[ "alt" ]; ?>">
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-pagination banner-slider-pagination"></div>
            </div>
        </div>
    </section>

    <section class="selection-projects-wrapper">
        <div class="selection-projects section-inner">
            <?php if ($selection_projects["title"]): ?>
                <h2 class="selection-projects-title has-white-line"><?php echo $selection_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($selection_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($selection_projects_query->have_posts()):
                            $selection_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                    <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="audiovisual-projects-wrapper">
        <div class="audiovisual-projects section-inner">
            <?php if ($audiovisual_projects["title"]): ?>
                <h2 class="audiovisual-projects-title has-circle"><?php echo $audiovisual_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($audiovisual_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($audiovisual_projects_query->have_posts()):
                            $audiovisual_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="digital-creations-projects-wrapper">
        <div class="digital-creations-projects section-inner">
            <?php if ($digital_creations["title"]): ?>
                <h2 class="digital-creations-projects-title"><?php echo $digital_creations[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($digital_creations_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($digital_creations_query->have_posts()):
                            $digital_creations_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="recent-additions-wrapper">
        <div class="recent-additions section-inner">
            <?php if ($recent_additions["title"]): ?>
                <h2 class="recent-additions-title has-white-line"><?php echo $recent_additions[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($recent_additions_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($recent_additions_query->have_posts()):
                            $recent_additions_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class="separator"></div>

    <section class="youtube-projects-wrapper">
        <div class="youtube-projects section-inner">
            <?php if ($youtube_projects["title"]): ?>
                <h2 class="youtube-projects-title"><?php echo $youtube_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($youtube_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($youtube_projects_query->have_posts()):
                            $youtube_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="internship-projects-wrapper">
        <div class="internship-projects section-inner">
            <?php if ($internship_projects["title"]): ?>
                <h2 class="internship-projects-title"><?php echo $internship_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($internship_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($internship_projects_query->have_posts()):
                            $internship_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="live-projects-wrapper">
        <div class="live-projects section-inner">
            <?php if ($live_projects["title"]): ?>
                <h2 class="internship-projects-title"><?php echo $live_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($live_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($live_projects_query->have_posts()):
                            $live_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="listen-projects-wrapper">
        <div class="listen-projects section-inner">
            <?php if ($listen_projects["title"]): ?>
                <h2 class="listen-projects-title"><?php echo $listen_projects[
                    "title"
                ]; ?></h2>
            <?php endif; ?>

            <?php if ($listen_projects_query->have_posts()): ?>
                <div class="home-projects-slider swiper">
                    <div class="swiper-wrapper">
                        <?php
                        while ($listen_projects_query->have_posts()):
                            $listen_projects_query->the_post(); ?>
                                            <div class="banner-slider-slide swiper-slide">
                                                <?php get_template_part(
                                                    "template-parts/project-card-preview",
                                                ); ?>
                                            </div>
                                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                     <div class="swiper-pagination home-projects-slider-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
