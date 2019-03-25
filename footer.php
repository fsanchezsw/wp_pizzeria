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
        <p><?php echo esc_html(get_option('lapizzeria_address')); ?></p>
        <p>Teléfono: <?php echo esc_html(get_option('lapizzeria_phone')); ?></p>
      </div>
      <p class="copyright">
        <i class="fa fa-copyright" aria-hidden="true"></i> Todos los derechos reservados <?php echo date('Y'); ?>
      </p>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
