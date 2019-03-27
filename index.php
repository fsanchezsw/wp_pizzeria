<?php get_header(); ?>
  <?php
    $blog_page = get_option('page_for_posts');
    $image_id = get_post_thumbnail_id($blog_page);
    $image = wp_get_attachment_image_src($image_id, 'full');
  ?>
  <div class="hero" style="background-image: url(<?php echo $image[0] ?>)">
    <div class="hero-content">
      <div class="hero-text">
        <h1><?php echo get_the_title($blog_page); ?></h1>
      </div>
    </div>
  </div>
  <div class="principal container">
    <div class="grid-container">
      <main class="columns-2-3 page-content">
        <?php while(have_posts()): the_post(); ?>
          <article class="blog-entry">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('especialidades'); ?>
            </a>
            <header class="entry-info clear">
              <div class="date">
                <time>
                  <?php echo the_time('d'); ?>
                  <span><?php the_time('M'); ?></span>
                </time>
              </div>
              <div class="entry-title">
                <?php the_title('<h2>', '</h2>'); ?>
                <p class="author">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <?php the_author(); ?>
                </p>
              </div>
            </header>
            <div class="entry-content">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="readmore-button">Leer más</a>
            </div>
          </article>
        <?php endwhile; ?>
        <div class="paginator">
          <?php echo paginate_links(); ?>
        </div>
      </main>
      <?php get_sidebar(); ?>
    </div>
  </div>
<?php get_footer(); ?>
