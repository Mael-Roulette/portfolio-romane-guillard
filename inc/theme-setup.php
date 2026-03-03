<?php

function theme_support()
{
    add_theme_support("custom-logo");
    add_theme_support("post-thumbnail");

    set_post_thumbnail_size(480, 480);
}

add_action("init", "theme_support");

/**
 * Permet d'ajouter un lien canonical sur chaque page
 */
function add_canonical_url()
{
    global $wp;
    $url = trailingslashit(home_url($wp->request));
    echo '<link rel="canonical" href="' . esc_url($url) . '">';
}

add_action("wp_head", "add_canonical_url");

remove_action("wp_head", "wp_generator");

/* -------------------------------------------------- */
/* ---------- Ajout des styles et scripts ---------- */

/**
 * Ajout des scripts pour le style du site
 */
function add_styles()
{
    wp_register_style(
        "main-style",
        get_template_directory_uri() . "/dist/styles.css",
        [],
        false,
    );
    wp_enqueue_style("main-style");
}
add_action("wp_enqueue_scripts", "add_styles");

function add_scripts()
{
    wp_enqueue_style(
        "swiper",
        "https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css",
        [],
        null,
    );

    wp_enqueue_script(
        "swiper",
        "https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js",
        [],
        null,
        true,
    );

    $dist_path = get_template_directory() . "/dist/";
    $dist_uri = get_template_directory_uri() . "/dist/";

    /* Dépendances entre scripts (handle => [handles requis avant lui]) */
    $js_dependencies = [
        "splash" => ["app"],
        "app" => ["swiper"],
    ];

    /* Ordre de chargement (les scripts absents de cette liste suivent après) */
    $js_priority = ["app", "splash"];

    $js_files = glob($dist_path . "*.js");
    if (empty($js_files)) {
        return;
    }

    usort($js_files, function ($a, $b) use ($js_priority) {
        $pa = array_search(basename($a, ".js"), $js_priority);
        $pb = array_search(basename($b, ".js"), $js_priority);
        return ($pa === false ? 99 : $pa) - ($pb === false ? 99 : $pb);
    });

    foreach ($js_files as $file) {
        $handle = basename($file, ".js");
        $deps = $js_dependencies[$handle] ?? [];

        wp_enqueue_script(
            $handle,
            $dist_uri . basename($file),
            $deps,
            filemtime($file), // cache-busting auto
            true,
        );
    }
}
add_action("wp_enqueue_scripts", "add_scripts");

/**
 * Ajout des scripts pour le style de l'admin
 */
function add_admin_scripts()
{
    wp_register_style(
        "custom_wp_admin_css",
        get_template_directory_uri() . "/assets/css/admin-styles.css",
        false,
        "1.0.0",
    );
    wp_enqueue_style("custom_wp_admin_css");
}
add_action("admin_enqueue_scripts", "add_admin_scripts");

/* -------------------------------------------------- */
/* ---------- Supression ---------- */

/**
 * Suppression de menu
 */
function remove_menus()
{
    remove_menu_page("edit-comments.php");
}

add_action("admin_menu", "remove_menus");

/**
 * Suppression de sousmenu
 */
function remove_submenus()
{
    remove_submenu_page("themes.php", "theme-editor.php");
}

add_action("admin_menu", "remove_submenus", 999);
?>
