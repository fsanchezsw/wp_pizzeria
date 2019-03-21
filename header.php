<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php wp_head(); ?>
  </head>
  <body>
    <header class="site-header">
      <div class="container">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="logo">
          </a>
        </div>
        <div class="header-info">
          <div class="social-networks">
            <?php
              $args = [
                'theme_location' => 'social-menu',
                'container' => 'nav',
                'container_class' => 'socials',
                'container_id' => 'socials',
                'link_before' => '<span class="sr-text">',
                'link_after' => '</span>'
              ];

              wp_nav_menu($args);
            ?>
          </div>
          <div class="address">
            <p>8179 Bay Avenue Mountain View, CA 94043</p>
            <p>Teléfono: +1-92-456-7890</p>
          </div>
        </div>
      </div>
    </header>

    <div class="principal-menu">
      <div class="mobile-menu">
        <a href="#" class="mobile"><i class="fa fa-bars" aria-hidden="true"></i> MENÚ</a>
      </div>
    </div>
      <div class="container navegation">
        <?php
          $args = [
            'theme_location' => 'header-menu',
            'container' => 'nav',
            'container_class' => 'site-menu'
          ];

          wp_nav_menu($args);
        ?>
      </div>
