<?php 
/* ----- Configuration ACF ----- */

/* -------------------------------------------------- */
/* ---------- Déclaration de la page d'option ---------- */

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
      'page_title' => 'Options du site',
      'menu_title' => 'Options du site',
      'menu_slug'  => 'theme-general-options',
      'capability' => 'edit_posts',
      'redirect'   => false
  ));
}

/* -------------------------------------------------- */
/* ---------- Ajout des blocs ---------- */

function register_acf_blocks () {
  // register_bloc_type( get_template_directory() . '/blocks/slider' );
}

add_action( 'init', 'register_acf_blocks' );

?>