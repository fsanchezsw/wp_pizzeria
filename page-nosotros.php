<?php get_header(); ?>
  <?php while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="hero-content">
        <div class="hero-text">
          <?php the_title('<h1>', '</h1>'); ?>
        </div>
      </div>
    </div>
    <div class="principal container">
      <main style="text-align: center" class="page-content">
        <?php the_content(); ?>
      </main>
    </div>
    <div class="boxes-info container">
      <div class="box">
        <?php
          $image_id = get_field('imagen_1');
          $image = wp_get_attachment_image_src($image_id, 'nosotros');
        ?>
        <img src="<?php echo $image[0]; ?>" alt="imagen_1">
        <div class="box-content">
          <?php the_field('descripcion_1'); ?>
        </div>
      </div>
      <div class="box">
        <?php
          $image_id = get_field('imagen_2');
          $image = wp_get_attachment_image_src($image_id, 'nosotros');
        ?>
        <img src="<?php echo $image[0]; ?>" alt="imagen_2">
        <div class="box-content">
          <?php the_field('descripcion_2'); ?>
        </div>
      </div>
      <div class="box">
        <?php
          $image_id = get_field('imagen_3');
          $image = wp_get_attachment_image_src($image_id, 'nosotros');
        ?>
        <img src="<?php echo $image[0]; ?>" alt="imagen_3">
        <div class="box-content">
          <?php the_field('descripcion_3'); ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php get_footer(); ?>
