<?php
  //Page Slug Body Class
  function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
      $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
  }

  add_filter( 'body_class', 'add_slug_body_class' );


  //Adición de opciones a wordpress
  function lapizzeria_setup() {
    //Añadir imagen destacada a los posts
    add_theme_support('post-thumbnails');

    //Añadir nuevo tamaño de imagen
    add_image_size('nosotros', 437, 291, true);
    add_image_size('especialidades', 768, 515, true);
  }

  add_action('after_setup_theme', 'lapizzeria_setup');


  //Creación de estilos
  function lapizzeria_styles() {
    //Registrar estilos
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', [], '5.0.0');
    wp_register_style('googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', ['normalize'], '1.0.0');
    wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', ['normalize'], '4.7.0');
    wp_register_style('style', get_template_directory_uri() . '/style.css', ['normalize'], '1.0');
    //Llamar estilos
    wp_enqueue_style('normalize');
    wp_enqueue_style('googlefonts');
    wp_enqueue_style('fontawesome');
    wp_enqueue_style('style');

    //Registrar scripts
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', [], '1.0.0', true);
    //Llamar scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('scripts');
  }

  add_action('wp_enqueue_scripts', 'lapizzeria_styles');


  //Creación de menús
  function lapizzeria_menus() {
    register_nav_menus([
      'header-menu' => __('Header menu', 'lapizzeria'),
      'social-menu' => __('Social menu', 'lapizzeria')
    ]);
  }

  add_action('init', 'lapizzeria_menus');


  //Código pegado por el pancho para poder crear custom posts
  function lapizzeria_especialidades() {
  	$labels = array(
  		'name'               => _x( 'Pizzas', 'lapizzeria' ),
  		'singular_name'      => _x( 'Pizzas', 'post type singular name', 'lapizzeria' ),
  		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
  		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
  		'add_new'            => _x( 'Add new', 'book', 'lapizzeria' ),
  		'add_new_item'       => __( 'Add new pizza', 'lapizzeria' ),
  		'new_item'           => __( 'New pizzas', 'lapizzeria' ),
  		'edit_item'          => __( 'Edit pizzas', 'lapizzeria' ),
  		'view_item'          => __( 'View pizzas', 'lapizzeria' ),
  		'all_items'          => __( 'All pizzas', 'lapizzeria' ),
  		'search_items'       => __( 'Search pizzas', 'lapizzeria' ),
  		'parent_item_colon'  => __( 'Parent pizzas:', 'lapizzeria' ),
  		'not_found'          => __( 'No pizzas found.', 'lapizzeria' ),
  		'not_found_in_trash' => __( 'No pizzas found in Trash.', 'lapizzeria' )
  	);

  	$args = array(
  		'labels'             => $labels,
      'description'        => __( 'Description.', 'lapizzeria' ),
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'especialidades' ),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => 6,
  		'supports'           => array( 'title', 'editor', 'thumbnail' ),
      'taxonomies'          => array( 'category' ),
  	);

  	register_post_type( 'especialidades', $args );
  }

  add_action( 'init', 'lapizzeria_especialidades' );


  //Código para habilitar widgets
  function lapizzeria_widgets() {
    register_sidebar([
      'name' => 'Blog sidebar',
      'id' => 'blog_sidebar',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ]);
  }

  add_action('widgets_init', 'lapizzeria_widgets');
?>
