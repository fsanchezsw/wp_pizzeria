<?php
  function lapizzeria_delete() {
    //Con el $_POST recoges el objeto pasado al ajax
    if(isset($_POST['type'])) {
      if($_POST['type'] == 'delete') {
        global $wpdb;
        $table = $wpdb->prefix . 'reservations';
        $id_register = $_POST['id'];
        $result = $wpdb->delete($table, ['id' => $id_register], ['%d']);

        if($result == 1) {
          $response = [
            'response' => 1,
            'id' => $id_register
          ];
        } else {
          $response = ['response' => 'error'];
        }
      }
    }
    die(json_encode($response));
  }

  add_action('wp_ajax_lapizzeria_delete', 'lapizzeria_delete');


  function lapizzeria_save() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $captcha = $_POST['g-recaptcha-response'];
      //Campos que deben enviarse
      $fields = [
        'secret' => '6LelT5oUAAAAAHFVsTzhGhT7yuGWoEZdri7QL4Iy',
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
      ];
      //Iniciar sesión en CURL (también se puede usar file_get_contents)
      //Curl es utilizado para acceder en servidores remotos
      $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
      //Configurar opciones de CURL
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 15);
      //Genera una cadena codificada para la URL
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
      //Obtener la respuesta
      $response = json_decode(curl_exec($ch));

      if($response->success) {
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
      } else {
        $url = get_page_by_title('Inicio');
        wp_redirect(get_permalink($url->ID));
        exit();
      }
    }
  }

  add_action('init', 'lapizzeria_save');
?>
