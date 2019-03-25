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
      <main style="text-align: center; display: inline-block" class="page-content">
        <?php the_content(); ?>
      </main>
    </div>
  <?php endwhile; ?>
<?php get_footer(); ?>
