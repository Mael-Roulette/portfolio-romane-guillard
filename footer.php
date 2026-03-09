<?php
/**
 * Footer / Pied de page
 */

?>

    <footer class="footer">
      <div class="footer-content-wrapper">
        <div class="footer-content section-inner">
          <?php if ( has_nav_menu("socials") ): ?>
                <?php wp_nav_menu([
                    "theme_location" => "socials",
                    "menu_class" => "footer-content-socials-menu",
                    "container" => false,
                ]); ?>
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