<?php 
  /**
   * Récupérer une image ACF
   */
  function get_acf_image($acf_image, $size = 'full', $class = "" ) {
    if ( empty( $acf_image ) ) {
      return;
    }

    if ( !empty( $acf_image['alt'] ) ) {
      $alt = $acf_image['alt'];
    } else {
      $alt = $acf_image['title'];
    }

    return wp_get_attachment_image( $acf_image['ID'], $size, false, array( 'alt' => $alt, 'class' => $class ) );
  }

  /**
   * Récupère le logo du site et en fait un lien
   */
  function get_site_logo( $class = "" ) {
    $site_logo = get_theme_mod( 'custom_logo' );
    $site_title = get_bloginfo( 'name' );

    $html = '<a class="' . $class . '" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';

    if ( has_custom_logo() ) {
      $html .= wp_get_attachment_image( $site_logo, 'full', false );
    } else {
      $html .= '<span class"logo-title">' . $site_title . '</span>';
    }

    $html .= '</a>';

    echo $html;
  }

  /**
   * Ajout du kit font awesome
   */
  function add_fontawesome_kit () {
    ?>
      <script src="https://kit.fontawesome.com/8b349b5011.js" crossorigin="anonymous"></script>
    <?php
  }

  add_action( 'wp_head', 'add_fontawesome_kit', 100 );
?>