<?php 

/* ----- Réglage de l'éditeur Gutemberg ----- */
function block_editor_settings () {
  /* ----- Couleur du thème ----- */
  $color_palette = array (
    array (
      'name'  => __( 'Blanc', 'themeLangDomain' ),
      'slug'  => 'white',
      'color' => '#fff',
    ),
    array (
      'name'  => __( 'Noir', 'themeLangDomain' ),
      'slug'  => 'black',
      'color' => '#000',
    ),
  );

  add_theme_support( 'editor-color-palette', $color_palette );
}

add_action( 'init', 'block_editor_settings' );

/**
 * Permet d'enregistrer de nouveaux styles de blocs
 */
function register_blocks_styles() {
  if ( !function_exists( 'register_block_style' ) ) return;

  /* ----- Style des boutons ----- */

  register_block_style(
    'core/button',
    array (
      'name'  => 'primary',
      'label' => 'Primaire' 
    )
  );

  register_block_style(
    'core/button',
    array (
      'name'  => 'secondary',
      'label' => 'Secondaire' 
    )
  );
}

add_action( 'init', 'block_editor_settings' );

?>