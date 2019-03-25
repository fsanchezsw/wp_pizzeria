<?php get_header(); ?>
  <?php while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
      <div class="hero-content">
        <div class="hero-text">
          <?php the_title('<h1>', '</h1>'); ?>
        </div>
      </div>
    </div>
    <div class="principal container contact">
      <main style="text-align: center; display: inline-block" class="page-content">
        <h3>Realiza una reserva</h3>
        <form class="contact-reservation" method="post">
          <div class="field">
            <label for="name">Nombre *</label>
            <input type="text" name="name" required>
          </div>
          <div class="field">
            <label for="reservation_date">Fecha *</label>
            <input type="datetime-local" name="reservation_date" required>
          </div>
          <div class="field">
            <label for="email">Correo *</label>
            <input type="email" name="email" required>
          </div>
          <div class="field">
            <label for="phone">Teléfono *</label>
            <input type="phone" name="phone" required>
          </div>
          <div class="field">
            <label for="message">Mensaje</label>
            <textarea name="message"></textarea>
          </div>
          <input type="submit" name="Enviar" class="contact-form-button">
        </form>
      </main>
    </div>
  <?php endwhile; ?>
<?php get_footer(); ?>
