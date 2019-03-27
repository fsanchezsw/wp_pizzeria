<?php get_header(); ?>
  <?php while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="hero-content">
        <div class="hero-text">
          <h1><?php echo esc_html(get_option('blogdescription')); ?></h1>
          <?php the_content(); ?>
          <?php $url = get_page_by_title('Sobre nosotros'); ?>
          <a class="front-page-button" href="<?php echo get_permalink($url->ID); ?>">Leer más</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
  <div class="principal container">
    <main class="grid-container">
      <h2 style="color: #a61206; text-align: center;">
        Nuestra especialidades
      </h2>
      <?php
        $args = [
          'posts_per_page' => 3,
          'orderby' => 'rand',
          'post_type' => 'especialidades'
        ];
        $specialities = new WP_Query($args);
        while($specialities->have_posts()): $specialities->the_post();
      ?>
          <div class="speciality columns-1-3">
            <div class="speciality-content">
              <?php the_post_thumbnail('especialidades_portrait'); ?>
              <div class="speciality-info">
                <?php the_title('<h3>', '</h3>'); ?>
                <?php the_content(); ?>
                <p class="price"><?php the_field('precio'); ?> €</p>
                <a href="<?php the_permalink(); ?>" class="readmore-button">Leer más</a>
              </div>
            </div>
          </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </main>
  </div>
  <section class="ingredients">
    <div class="container">
      <div style="position: relative;" class="grid-container">
        <?php while(have_posts()): the_post(); ?>
          <div class="columns-1-2 text">
            <?php the_field('contenido'); ?>
            <?php $url = get_page_by_title('Sobre nosotros'); ?>
            <a class="readmore-button" href="<?php echo get_permalink($url->ID); ?>">Leer más</a>
          </div>
          <div class="columns-1-2 image">
            <img src="<?php the_field('imagen'); ?>" alt="ingredients">
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
  <section style="padding-top: 20px;" class="container">
    <div style="text-align: center; display: inline-block">
      <h2 style="color: #a61206; text-align: center;">
        Galería de imágenes
      </h2>
      <?php
        $url = get_page_by_title('Galería');
        echo get_post_gallery($url->ID);
      ?>
    </div>
  </section>
  <section class="reservation-location">
    <div class="grid-container">
      <div class="columns-1-2 map">
        <div id="map" style="height: 400px;"></div>
      </div>
      <div class="columns-1-2 form">
        <?php get_template_part('templates/reservation', 'form'); ?>
      </div>
    </div>
  </section>
<?php get_footer(); ?>
