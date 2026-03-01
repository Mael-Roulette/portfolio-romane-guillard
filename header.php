<?php
/**
 * Header / En-tête de page
 */

// Contenu
$header = get_field("header", 16); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header" id="navbarWrapper">
    <div class="header-navbar-wrapper" id="navbar">
      <nav class="header-navbar section-inner">
        <?php get_site_logo("header-navbar-logo"); ?>

        <?php if (has_nav_menu("main") || has_nav_menu("socials")): ?>
          <div class="header-menu-wrapper" id="navbarNavigation">
            <?php wp_nav_menu([
                "theme_location" => "main",
                "menu_class" => "header-menu",
                "container" => false,
            ]); ?>
          </div>

          <?php wp_nav_menu([
              "theme_location" => "socials",
              "menu_class" => "header-social-menu",
              "container" => false,
          ]); ?>

          <button type="button" class="header-toggle modal-trigger" data-target="navbarNavigation">
            <span class="header-toggle-bars"></span>
            <span class="screen-reader-text">Menu</span>
          </button>
        <?php endif; ?>
      </nav>
    </div>
  </header>
