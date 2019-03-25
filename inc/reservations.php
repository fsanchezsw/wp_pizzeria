<?php
  function lapizzeria_save() {
    global $wpdb;

    if(isset($_POST['Enviar'])) {
      $name = sanitize_text_field($_POST['name']);
      $reservation_date = sanitize_text_field($_POST['reservation_date']);
      $email = sanitize_text_field($_POST['email']);
      $phone = sanitize_text_field($_POST['phone']);
      $message = sanitize_text_field($_POST['message']);

      $table = $wpdb->prefix . 'reservations';
      $data = [
        'name' => $name,
        'reservation_date' => $reservation_date,
        'email' => $email,
        'phone' => $phone,
        'message' => $message
      ];
      $format = ['%s', '%s', '%s', '%s', '%s'];

      $wpdb->insert($table, $data, $format);

      $url = get_page_by_title('Gracias por su reserva');
      wp_redirect(get_permalink($url->ID));
      exit();
    }
  }

  add_action('init', 'lapizzeria_save');
?>
