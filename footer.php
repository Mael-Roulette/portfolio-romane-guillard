<?php
/**
 * Footer / Pied de page
 */

$footer = get_field('footer', 16);

?>

    <footer class="footer">
      <div class="footer-content-wrapper">
        <div class="footer-content section-inner">
          <div class="footer-content-thanks"></div>

          <?php if ( has_nav_menu("socials") ): ?>
            <div class="footer-content-socials-menu-wrapper">
                <h3 class="footer-content-socials-menu-title has-red-line"><?php echo $footer['contact_title']; ?></h3>
                <?php wp_nav_menu([
                    "theme_location" => "socials",
                    "menu_class" => "footer-content-socials-menu socials-menu",
                    "container" => false,
                ]); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="footer-legal-wrapper">
        <div class="footer-legal section-inner">
          <?php if ( has_nav_menu("legal") ): ?>
              <?php wp_nav_menu([
                  "theme_location" => "legal",
                  "menu_class" => "footer-legal-menu",
                  "container" => false,
              ]); ?>
          <?php endif; ?>
        </div>
      </div>
    </footer>

    <?php wp_footer(); ?>

  </body>
</html>