<?php
  require get_template_directory() . '/inc/database.php';
  require get_template_directory() . '/inc/reservations.php';
  require get_template_directory() . '/inc/options.php';

  //Adding ReCaptcha
  function lapizzeria_add_recaptcha() { ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php
  }

  add_action('wp_head', 'lapizzeria_add_recaptcha');


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
    //Añadir titulo a la pestaña del navegador
    add_theme_support('title-tag');

    //Añadir nuevo tamaño de imagen
    add_image_size('nosotros', 437, 291, true);
    add_image_size('especialidades', 768, 515, true);
    add_image_size('especialidades_portrait', 435, 526, true);

    //Modificar tamaños imagen
    update_option('thumbnail_size_w', 253);
    update_option('thumbnail_size_h', 164);
  }

  add_action('after_setup_theme', 'lapizzeria_setup');


  //Poder cambiar logo desde el admin
  function lapizzeria_custom_logo() {
    $logo = [
      'height' => 220,
      'width'=> 280
    ];
    add_theme_support('custom-logo', $logo);
  }

  add_action('after_setup_theme', 'lapizzeria_custom_logo');


  //Creación de estilos
  function lapizzeria_styles() {
    //Registrar estilos
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', [], '5.0.0');
    wp_register_style('googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', ['normalize'], '1.0.0');
    wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', ['normalize'], '4.7.0');
    wp_register_style('fluidbox', get_template_directory_uri() . '/css/fluidbox.min.css', ['normalize'], '2.0.5');
    wp_register_style('datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', ['normalize'], '2.0.5');
    wp_register_style('style', get_template_directory_uri() . '/style.css', ['normalize'], '1.0');
    //Llamar estilos
    wp_enqueue_style('normalize');
    wp_enqueue_style('googlefonts');
    wp_enqueue_style('fontawesome');
    wp_enqueue_style('fluidbox');
    wp_enqueue_style('datetime-local');
    wp_enqueue_style('style');

    //Registrar scripts
    $apikey = esc_html(get_option('lapizzeria_gmap_apikey'));
    wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?key=' . $apikey . '&callback=initMap', [], '1.0.0', true);
    wp_register_script('fluidbox', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', [], '1.0.0', true);
    wp_register_script('datetime-local-polyfill', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', [], '1.0.0', true);
    wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', [], '2.8.3', true);
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', [], '1.0.0', true);
    //Llamar scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('fluidbox');
    wp_enqueue_script('datetime-local-polyfill');
    wp_enqueue_script('modernizr');
    wp_enqueue_script('scripts');
    wp_enqueue_script('maps');

    //Pasar variables de PHP a Javascript
    wp_localize_script( 'scripts', 'options', [
      'latitude' => get_option('lapizzeria_gmap_latitude'),
      'longitude' => get_option('lapizzeria_gmap_longitude'),
      'zoom' => get_option('lapizzeria_gmap_zoom')
    ]);
  }

  add_action('wp_enqueue_scripts', 'lapizzeria_styles');


  //Creación de scripts para el admin
  function lapizzeria_admin_scripts() {
    wp_enqueue_style('sweetalert', get_template_directory_uri() . '/css/sweetalert2.min.css');
    wp_enqueue_script('sweetalert', get_template_directory_uri() . '/js/sweetalert2.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/admin-ajax.js', ['jquery'], '1.0', true);
    //Pasar la URL de WP Ajax al adminjs
    wp_localize_script('adminjs', 'url_delete', ['ajaxurl' => admin_url('admin-ajax.php')]);
  }

  add_action('admin_enqueue_scripts', 'lapizzeria_admin_scripts');


  //Creación de los estilos y scripts para el login del admin
  function lapizzeria_login_admin_scripts() {
    //Styles para el login del admin
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', [], '5.0.0');
    wp_enqueue_style('vegascss', get_template_directory_uri() . '/css/vegas.min.css', ['normalize'], '2.4.4');
    wp_enqueue_style('logincss', get_template_directory_uri() . '/css/login.css', ['normalize'], '1.0.0');
    //Scripts para el login del admin
    wp_enqueue_script('jquery');
    wp_enqueue_script('vegasjs', get_template_directory_uri() . '/js/vegas.min.js', ['jquery'], '2.4.4', true);
    wp_enqueue_script('loginjs', get_template_directory_uri() . '/js/login-scripts.js', ['jquery'], '1.0.0', true);

    wp_localize_script('loginjs', 'login_images', [
      'path' => get_template_directory_uri()
    ]);
  }

  add_action('login_enqueue_scripts', 'lapizzeria_login_admin_scripts', 10);


  //Agregar async y defer para poder cargar el script de Google Maps
  function add_async_defer($tag, $handle) {
    if('maps' !== $handle) return $tag;
    return str_replace(' src', ' async="async" defer="defer" src', $tag);
  }

  add_filter('script_loader_tag', 'add_async_defer', 10, 2);


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



  /**
   * Plugin Name: Get Post Gallery Polyfill
   * Plugin URI: https://prothemedesign.com
   * Description: Make Get_Post_Gallery work for Gutenberg powered sites.
   * Author: Ben Gillbanks
   * Version: 1.0
   * Author URI: https://prothemedesign.com
   *
   * @package ptd
   */

  /**
   * A get_post_gallery() polyfill for Gutenberg
   *
   * @param string $gallery The current gallery html that may have already been found (through shortcodes).
   * @param int $post The post id.
   * @return string The gallery html.
   */
  function bm_get_post_gallery( $gallery, $post ) {

  	// Already found a gallery so lets quit.
  	if ( $gallery ) {
  		return $gallery;
  	}

  	// Check the post exists.
  	$post = get_post( $post );
  	if ( ! $post ) {
  		return $gallery;
  	}

  	// Not using Gutenberg so let's quit.
  	if ( ! function_exists( 'has_blocks' ) ) {
  		return $gallery;
  	}

  	// Not using blocks so let's quit.
  	if ( ! has_blocks( $post->post_content ) ) {
  		return $gallery;
  	}

  	/**
  	 * Search for gallery blocks and then, if found, return the html from the
  	 * first gallery block.
  	 *
  	 * Thanks to Gabor for help with the regex:
  	 * https://twitter.com/javorszky/status/1043785500564381696.
  	 */
  	$pattern = "/<!--\ wp:gallery.*-->([\s\S]*?)<!--\ \/wp:gallery -->/i";
  	preg_match_all( $pattern, $post->post_content, $the_galleries );
  	// Check a gallery was found and if so change the gallery html.
  	if ( ! empty( $the_galleries[1] ) ) {
  		$gallery = reset( $the_galleries[1] );
  	}

  	return $gallery;

  }

  add_filter( 'get_post_gallery', 'bm_get_post_gallery', 10, 2 );


  //Export Advanced Custom Fields al theme para no tener la dependencia del plugin
  define('ACF_LITE', true);
  include_once('advanced-custom-fields/acf.php');
  if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
    	'key' => 'group_5c921a5fda6db',
    	'title' => 'Especialidades',
    	'fields' => array(
    		array(
    			'key' => 'field_5c921a652166c',
    			'label' => 'Precio',
    			'name' => 'precio',
    			'type' => 'number',
    			'instructions' => 'Añade el precio al plato',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'min' => '',
    			'max' => '',
    			'step' => '',
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'especialidades',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => true,
    	'description' => '',
    ));

    acf_add_local_field_group(array(
    	'key' => 'group_5c99e0d77e335',
    	'title' => 'Inicio',
    	'fields' => array(
    		array(
    			'key' => 'field_5c99e0fa9f189',
    			'label' => 'Contenido',
    			'name' => 'contenido',
    			'type' => 'wysiwyg',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'tabs' => 'all',
    			'toolbar' => 'full',
    			'media_upload' => 1,
    			'delay' => 0,
    		),
    		array(
    			'key' => 'field_5c99e1159f18a',
    			'label' => 'Imagen',
    			'name' => 'imagen',
    			'type' => 'image',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'url',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => '',
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'page',
    				'operator' => '==',
    				'value' => '7',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => true,
    	'description' => '',
    ));

    acf_add_local_field_group(array(
    	'key' => 'group_5c90dbe0bddad',
    	'title' => 'Sobre nosotros',
    	'fields' => array(
    		array(
    			'key' => 'field_5c90dcadf5ad6',
    			'label' => 'Imagen 1',
    			'name' => 'imagen_1',
    			'type' => 'image',
    			'instructions' => 'Sube una imagen',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'id',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => '',
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    		array(
    			'key' => 'field_5c90dd42f5adb',
    			'label' => 'Descripcion 1',
    			'name' => 'descripcion_1',
    			'type' => 'wysiwyg',
    			'instructions' => 'Agrega aquí la descripción',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'tabs' => 'all',
    			'toolbar' => 'full',
    			'media_upload' => 1,
    			'delay' => 0,
    		),
    		array(
    			'key' => 'field_5c90dd18f5ad9',
    			'label' => 'Imagen 2',
    			'name' => 'imagen_2',
    			'type' => 'image',
    			'instructions' => 'Sube una imagen',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'id',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => '',
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    		array(
    			'key' => 'field_5c90dd65f5adc',
    			'label' => 'Descripcion 2',
    			'name' => 'descripcion_2',
    			'type' => 'wysiwyg',
    			'instructions' => 'Agrega aquí la descripción',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'tabs' => 'all',
    			'toolbar' => 'full',
    			'media_upload' => 1,
    			'delay' => 0,
    		),
    		array(
    			'key' => 'field_5c90dd19f5ada',
    			'label' => 'Imagen 3',
    			'name' => 'imagen_3',
    			'type' => 'image',
    			'instructions' => 'Sube una imagen',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'return_format' => 'id',
    			'preview_size' => 'thumbnail',
    			'library' => 'all',
    			'min_width' => '',
    			'min_height' => '',
    			'min_size' => '',
    			'max_width' => '',
    			'max_height' => '',
    			'max_size' => '',
    			'mime_types' => '',
    		),
    		array(
    			'key' => 'field_5c90dd66f5add',
    			'label' => 'Descripcion 3',
    			'name' => 'descripcion_3',
    			'type' => 'wysiwyg',
    			'instructions' => 'Agrega aquí la descripción',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array(
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'tabs' => 'all',
    			'toolbar' => 'full',
    			'media_upload' => 1,
    			'delay' => 0,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param' => 'page',
    				'operator' => '==',
    				'value' => '11',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => true,
    	'description' => '',
    ));

  endif;
?>
