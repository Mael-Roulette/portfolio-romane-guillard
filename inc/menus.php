<?php 

/**
 * Ajout de menu dans l'admin
 */
function register_menu () {
  register_nav_menus( array (
    'main'    => 'Menu principal',
    'footer'  => 'Pied de page',
    'legal'   => 'Menu légal',
    'socials' => 'Réseaux sociaux'
  ) );
}

add_action( 'init', 'register_menu' );

function social_links_to_icon ( $item_output, $item, $depth, $args ) {
  if ( 'socials' === $args->theme_location ) {
    $icon = '<span class="fas fa-link"></span>';
    $icon = get_social_icons( $item->title );

    $item_output = str_replace( $args->link_after, '</span>' . $icon, $item_output );
  }

  return $item_output;
}

add_action( 'walker_nav_menu_start_el', 'social_links_to_icon', 10, 4 );

/**
 * Récupération des icones pour le menu des réseaux sociaux
 */

  function get_social_icons ( $key ) {
    $social_icons = array (
      'instagram'  => '<span class="fa-brands fa-instagram"></span>',
      'facebook'   => '<span class="fa-brands fa-facebook"></span>',
      'youtube'    => '<span class="fa-brands fa-youtube"></span>',
      'x'          => '<span class="fa-brands fa-x-twitter"></span>',
      'linkedin'   => '<span class="fa-brands fa-linkedin"></span>',
      'spotify'   => '<span class="fa-brands fa-spotify"></span>',
    );

    foreach ( array_keys( $social_icons ) as $icon ) {
      if ( $key === $icon ) {
        return $social_icons[$icon];
      }
    }
  }
?>