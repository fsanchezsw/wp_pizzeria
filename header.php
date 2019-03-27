<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- IOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="La Pizzeria">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>img/logo.svg">
    <!-- ANDROID -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#a61206">
    <meta name="application-name" content="La Pizzeria">
    <link rel="icon" type="image/svg" href="<?php echo get_template_directory_uri() ?>/img/logo.svg">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="site-header">
      <div class="container">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="logo">
            <?php
              if(function_exists('the_custom_logo')) {
                the_custom_logo();
              }
            ?>
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
            <p><?php echo esc_html(get_option('lapizzeria_address')); ?></p>
            <p>Teléfono: <?php echo esc_html(get_option('lapizzeria_phone')); ?></p>
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
