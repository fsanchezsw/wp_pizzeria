<?php
/*
* Template name: Especialidades
*/
get_header(); ?>
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
  <?php endwhile; ?>

  <div class="specialities container">
    <h3 style="color: #a61206">Pizzas</h3>
    <div class="grid-container">
      <?php
        $args = [
          'post_type' => 'especialidades',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC',
          'category_name' => 'pizzas'
        ];

        $pizzas = new WP_Query($args);
        while($pizzas->have_posts()): $pizzas->the_post();
      ?>
      <div class="columns1-2">
        <?php the_post_thumbnail('especialidades'); ?>
        <div class="speciality-text">
          <h4><?php the_title(); ?> <span><?php the_field('precio'); ?>€</span></h4>
          <?php the_content(); ?>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <h3 style="color: #a61206">Otros</h3>
    <div class="grid-container">
      <?php
        $args = [
          'post_type' => 'especialidades',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC',
          'category_name' => 'otros'
        ];

        $others = new WP_Query($args);
        while($others->have_posts()): $others->the_post();
      ?>
      <div class="columns1-2">
        <?php the_post_thumbnail('especialidades'); ?>
        <div class="speciality-text">
          <h4><?php the_title(); ?> <span><?php the_field('precio'); ?>€</span></h4>
          <?php the_content(); ?>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
<?php get_footer(); ?>
