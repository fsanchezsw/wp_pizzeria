<?php
  //Inicializa la creación de las tablas nuevas
  function lapizzeria_database() {
    //WPDB nos da los métodos para trabajar con tablas
    global $wpdb;
    //Agregamos la versión
    global $lapizzeria_dbversion;
    $lapizzeria_dbversion = '1.0';

    //Obtenemos el prefijo
    $table = $wpdb->prefix . 'reservations';
    //Obtenemos el collation de la instalación
    $charset_collate = $wpdb->get_charset_collate();
    //Agregamos la estructura de la BD
    $sql = "CREATE TABLE $table (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      name varchar(50) NOT NULL,
      createdAt datetime NOT NULL,
      email varchar(50) DEFAULT '' NOT NULL,
      phone varchar(50) NOT NULL,
      message longtext,
      PRIMARY KEY (id)
    ) $charset_collate; ";

    //Se necesita dbDelta para ejecutar el SQL y está en la siguiente dirección
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    //Agregamos la versión de la BD para compararla con futuras actualizaciones
    add_option('lapizzeria_dbversion', $lapizzeria_dbversion);

    //Actualizar version
    $actual_version = get_option('lapizzeria_dbversion');
    //Comparamos las dos versiones
    if($lapizzeria_dbversion != $actual_version) {
      $table = $wpdb->prefix . 'reservations';
      //Aquí realizarías las actualizaciones
      $sql = "CREATE TABLE $table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        createdAt datetime NOT NULL,
        email varchar(50) DEFAULT '' NOT NULL,
        phone varchar(50) NOT NULL,
        message longtext,
        PRIMARY KEY (id)
      ) $charset_collate; ";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
      //Actualizamos a la versión actual si es necesario
      update_option('lapizzeria_dbversion', $lapizzeria_dbversion);
    }
  }

  add_action('after_setup_theme', 'lapizzeria_database');


  //Función para comprobar que la versión instalada es igual que la BD nueva
  function lapizzeriadb_check() {
    global $lapizzeria_dbversion;
    if(get_site_option('lapizzeria_dbversion') != $lapizzeria_dbversion) {
      lapizzeria_database();
    }
  }

  add_action('plugins_loaded', 'lapizzeriadb_check');
?>
