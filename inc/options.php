<?php
  //Todo esto se puede hacer con frameworks específicos como REDUX y TITAN
  function lapizzeria_settings() {
    add_menu_page('La pizzeria', 'Ajustes La pizzeria', 'administrator', 'lapizzeria-ajustes', 'lapizzeria_options', '', 20);
    add_submenu_page('lapizzeria-ajustes', 'Reservas', 'Reservas', 'administrator', 'lapizzeria-reservas', 'lapizzeria_reservations');

    //Llamar al registro de las opciones de nuestro tema
    add_action('admin_init', 'lapizzeria_register_settings');
  }

  add_action('admin_menu', 'lapizzeria_settings');

  function lapizzeria_register_settings() {
    //Registrar opciones, una por campo
    register_setting('lapizzeria_options_group', 'lapizzeria_address');
    register_setting('lapizzeria_options_group', 'lapizzeria_phone');

    register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_latitude');
    register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_longitude');
    register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_zoom');
    register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_apikey');
  }

  function lapizzeria_options() {
?>
    <div class="wrap">
      <h1>Ajustes La pizzeria</h1>
      <form action="options.php" method="post">
        <?php
          settings_fields('lapizzeria_options_group');
          do_settings_sections('lapizzeria_options_group');
        ?>
        <h2>Información de contacto</h2>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">Dirección</th>
            <td><input type="text" name="lapizzeria_address" value="<?php echo esc_attr(get_option('lapizzeria_address')); ?>"></td>
          </tr>
          <tr valign="top">
            <th scope="row">Teléfono</th>
            <td><input type="text" name="lapizzeria_phone" value="<?php echo esc_attr(get_option('lapizzeria_phone')); ?>"></td>
          </tr>
        </table>

        <?php
          settings_fields('lapizzeria_options_gmaps');
          do_settings_sections('lapizzeria_options_gmaps');
        ?>
        <h2>Información de Google Maps</h2>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">Latitud</th>
            <td><input type="text" name="lapizzeria_gmap_latitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_latitude')); ?>"></td>
          </tr>
          <tr valign="top">
            <th scope="row">Longitud</th>
            <td><input type="text" name="lapizzeria_gmap_longitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_longitude')); ?>"></td>
          </tr>
          <tr valign="top">
            <th scope="row">Zoom</th>
            <td><input type="number" name="lapizzeria_gmap_zoom" value="<?php echo esc_attr(get_option('lapizzeria_gmap_zoom')); ?>"></td>
          </tr>
          <tr valign="top">
            <th scope="row">API Key</th>
            <td><input type="text" name="lapizzeria_gmap_apikey" value="<?php echo esc_attr(get_option('lapizzeria_gmap_apikey')); ?>"></td>
          </tr>
        </table>
        <?php submit_button(); ?>
      </form>
    </div>
<?php
  }

  function lapizzeria_reservations() {
?>
    <div class="wrap">
      <h1>Reservas</h1>
      <table class="wp-list-table widefat striped">
        <thead>
          <tr>
            <th class="manage-column">ID</th>
            <th class="manage-column">Nombre</th>
            <th class="manage-column">Fecha reserva</th>
            <th class="manage-column">Correo</th>
            <th class="manage-column">Teléfono</th>
            <th class="manage-column">Mensaje</th>
          </tr>
        </thead>
        <tbody>
          <?php
            global $wpdb;
            $reservations = $wpdb->prefix . 'reservations';
            $registers = $wpdb->get_results("SELECT * FROM $reservations", ARRAY_A);
            foreach($registers as $register) {
          ?>
              <tr>
                <td><?php echo $register['id'] ?></td>
                <td><?php echo $register['name'] ?></td>
                <td><?php echo $register['reservation_date'] ?></td>
                <td><?php echo $register['email'] ?></td>
                <td><?php echo $register['phone'] ?></td>
                <td><?php echo $register['message'] ?></td>
              </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
<?php } ?>
