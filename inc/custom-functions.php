<?php
/**
 * Récupérer une image ACF
 */
function get_acf_image($acf_image, $size = "full", $class = "")
{
    if (empty($acf_image)) {
        return;
    }

    if (!empty($acf_image["alt"])) {
        $alt = $acf_image["alt"];
    } else {
        $alt = $acf_image["title"];
    }

    return wp_get_attachment_image($acf_image["ID"], $size, false, [
        "alt" => $alt,
        "class" => $class,
    ]);
}

/**
 * Récupère le logo du site et en fait un lien
 */
function get_site_logo($class = "")
{
    $site_logo = get_theme_mod("custom_logo");
    $site_title = get_bloginfo("name");

    $html =
        '<a class="' .
        $class .
        '" href="' .
        esc_url(home_url("/")) .
        '" rel="home">';

    if (has_custom_logo()) {
        $html .= wp_get_attachment_image($site_logo, "full", false);
    } else {
        $html .= '<span class"logo-title">' . $site_title . "</span>";
    }

    $html .= "</a>";

    echo $html;
}

function get_custom_excerpt($id, $length = 20)
{
    $excerpt = get_the_excerpt($id);
    if (!$excerpt) {
        $excerpt = get_the_content(null, false, $id);
    }
    $words = explode(" ", wp_strip_all_tags($excerpt));
    if (count($words) > $length) {
        return implode(" ", array_slice($words, 0, $length)) . "…";
    }
    return $excerpt;
}
?>
