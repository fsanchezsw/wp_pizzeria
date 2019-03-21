    <footer>
      <?php
        $args = [
          'theme_location' => 'header-menu',
          'container' => 'nav',
          'after' => '<span class="separator"> | </span>'
        ];

        wp_nav_menu($args);
      ?>

      <div class="location">
        <p>8179 Bay Avenue Mountain View, CA 94043</p>
        <p>Teléfono: +1-92-456-7890</p>
      </div>
      <p class="copyright">
        <i class="fa fa-copyright" aria-hidden="true"></i> Todos los derechos reservados <?php echo date('Y'); ?>
      </p>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
