<?php get_header(); ?>
  <?php while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="hero-content">
        <div class="hero-text">
          <?php the_title('<h1>', '</h1>'); ?>
        </div>
      </div>
    </div>
    <div style="padding-bottom: 80px;" class="principal container">
      <main style="text-align: center" class="page-content">
        <?php the_content(); ?>
      </main>
    </div>

    <div style="padding-bottom: 80px;" class="principal container comments">
      <?php comment_form(); ?>
    </div>
    <div class="principal container">
      <ol class="comment-list">
        <?php
          $comments = get_comments([
            'post_id' => $post->ID,
            'status' => 'approve'
          ]);
        ?>
        <?php if(count($comments)): ?>
          <h3 style="text-align: center">Comentarios</h3>
        <?php endif; ?>
        <?php
          wp_list_comments([
            'per_page' => 10,
            'reverse_top_level' => false
          ], $comments)
        ?>
      </ol>
    </div>
  <?php endwhile; ?>
<?php get_footer(); ?>
