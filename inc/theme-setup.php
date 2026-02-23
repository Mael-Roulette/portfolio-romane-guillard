<?php 

  function theme_support () {
    add_theme_support( 'custom-logo' );
    add_theme_support( 'post-thumbnail' );

    set_post_thumbnail_size( 480, 480 );
  }

  add_action( 'init', 'theme_support' );


  /**
   * Permet d'ajouter un lien canonical sur chaque page
   */
  function add_canonical_url () {
    global $wp;
    $url = home_url( $wp->request . '/' );

    echo '<link rel=canonical href="' . $url . '">';
  }

  add_action( 'wp_head', 'add_canonical_url' );

  remove_action( 'wp_head', 'wp_generator' );


  /* -------------------------------------------------- */
  /* ---------- Ajout des styles et scripts ---------- */

  /**
   * Ajout des scripts pour le style du site
   */
  function add_scripts () {
    /* ----- Ajout du css ----- */
    wp_register_style( 'main-style', get_template_directory_uri() . '/dist/styles.css', array(), false );
    wp_enqueue_style( 'main-style' );

    /* ----- Ajout du js ----- */
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/dist/app.js', array(), false, true );
  }

  add_action( 'wp_enqueue_scripts', 'add_scripts' );


    /**
   * Ajout des scripts pour le style de l'admin
   */
  function add_admin_scripts () {
    /* ----- Ajout du css admin ----- */
    wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/css/admin-styles.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
  }

  add_action( 'admin_enqueue_scripts', 'add_admin_scripts');


  /* -------------------------------------------------- */
  /* ---------- Supression ---------- */

  /**
   * Suppression de menu
   */
  function remove_menus () {
    remove_menu_page('edit-comments.php');
  }

  add_action( 'admin_menu', 'remove_menus' );

  /**
   * Suppression de sousmenu
   */
  function remove_submenus () {
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
  }

  add_action( 'admin_menu', 'remove_submenus', 999 );
?>