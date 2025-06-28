<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/*Quita el panel de admin */
function quitar_barra_admin() {
    show_admin_bar(false);
}
add_action('after_setup_theme', 'quitar_barra_admin');

function astra_child_enqueue_styles() {
    // Enqueue the parent theme stylesheet
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue the child theme stylesheet
    wp_enqueue_style(
        'astra-child-style', 
        get_stylesheet_directory_uri() . '/assets/css/styles.css',
        ['astra-parent-style']
    );

    // Cargar about.css solo cuando se use template-about.php
    if (is_page_template('politicas-template.php')) {
        wp_enqueue_style(
            'astra-about-style',
            get_stylesheet_directory_uri() . '/assets/css/politicas.css',
            ['astra-parent-style']
        );
    }

    if (is_page_template('professional-profile-template.php')) {
        wp_enqueue_style(
            'astra-about-style',
            get_stylesheet_directory_uri() . '/assets/css/professional-profile.css',
            ['astra-parent-style']
        );
    }
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

function astra_child_enqueue_scripts() {
    // Enqueue the child theme script
    wp_enqueue_script(
        'astra-child-script', 
        get_stylesheet_directory_uri() . '/assets/js/scripts.js', 
        array('jquery'), 
        null, true
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');

function astra_child_theme_menus() {
    register_nav_menus(
        array(
            'head-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('after_setup_theme', 'astra_child_theme_menus');

// personalización para la imagen del perfíl profesional
function professional_profile_customize_register($wp_customize) {
    // Añadir sección
    $wp_customize->add_section('professional_profile_section', array(
        'title'    => __('Imagen de Perfil Profesional', 'text-domain'),
        'priority' => 30,
    ));

    // Añadir setting para la imagen
    $wp_customize->add_setting('professional_profile_image', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    // Añadir control para la imagen
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'professional_profile_image_control',
        array(
            'label'       => __('Subir Imagen de Perfil', 'text-domain'),
            'description' => __('Se recomienda una imagen cuadrada de al menos 400x400px', 'text-domain'),
            'section'     => 'professional_profile_section',
            'settings'    => 'professional_profile_image',
        )
    ));
}
add_action('customize_register', 'professional_profile_customize_register');


//Custom Post Type para Opiniones
function registrar_cpt_opiniones() {
    $labels = array(
        'name'               => 'Opiniones',
        'singular_name'      => 'Opinión',
        'menu_name'          => 'Opiniones',
        'name_admin_bar'     => 'Opinión',
        'add_new'            => 'Añadir Nueva',
        'add_new_item'       => 'Añadir Nueva Opinión',
        'new_item'           => 'Nueva Opinión',
        'edit_item'          => 'Editar Opinión',
        'view_item'          => 'Ver Opinión',
        'all_items'          => 'Todas las Opiniones',
        'search_items'       => 'Buscar Opiniones',
        'not_found'          => 'No se encontraron opiniones',
        'not_found_in_trash' => 'No hay opiniones en la papelera'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'opinion' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'opinion', $args );
}
add_action( 'init', 'registrar_cpt_opiniones' );

// Añade metabox para valoración con estrellas
function añadir_metabox_valoracion() {
    add_meta_box(
        'valoracion_opinion',
        'Valoración del Cliente',
        'mostrar_metabox_valoracion',
        'opinion',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'añadir_metabox_valoracion' );

function mostrar_metabox_valoracion( $post ) {
    wp_nonce_field( 'guardar_valoracion_opinion', 'valoracion_opinion_nonce' );
    
    $valoracion = get_post_meta( $post->ID, '_valoracion', true );
    ?>
    <label for="valoracion">Seleccione la valoración (1-5 estrellas):</label>
    <select name="valoracion" id="valoracion" style="width:100%; margin-top:5px;">
        <option value="1" <?php selected( $valoracion, '1' ); ?>>★☆☆☆☆</option>
        <option value="2" <?php selected( $valoracion, '2' ); ?>>★★☆☆☆</option>
        <option value="3" <?php selected( $valoracion, '3' ); ?>>★★★☆☆</option>
        <option value="4" <?php selected( $valoracion, '4' ); ?>>★★★★☆</option>
        <option value="5" <?php selected( $valoracion, '5' ); ?>>★★★★★</option>
    </select>
    <?php
}

function guardar_valoracion_opinion( $post_id ) {
    if ( ! isset( $_POST['valoracion_opinion_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['valoracion_opinion_nonce'], 'guardar_valoracion_opinion' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['valoracion'] ) ) {
        update_post_meta( $post_id, '_valoracion', sanitize_text_field( $_POST['valoracion'] ) );
    }
}
add_action( 'save_post', 'guardar_valoracion_opinion' );

// Shortcode para mostrar opiniones
function mostrar_opiniones_shortcode( $atts ) {
    $args = shortcode_atts( array(
        'numero' => 5,
    ), $atts );

    $query = new WP_Query( array(
        'post_type'      => 'opinion',
        'posts_per_page' => $args['numero'],
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    if ( $query->have_posts() ) {
        $output = '<div class="opiniones-clientes">';
        $output .= '<h2>Opiniones de nuestros clientes</h2>';
        $output .= '<div class="lista-opiniones">';

        while ( $query->have_posts() ) {
            $query->the_post();
            $valoracion = get_post_meta( get_the_ID(), '_valoracion', true );
            $estrellas = str_repeat( '★', $valoracion ) . str_repeat( '☆', 5 - $valoracion );
            
            $output .= '<div class="opinion">';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<div class="valoracion">' . $estrellas . '</div>';
            $output .= '<div class="contenido">' . get_the_content() . '</div>';
            $output .= '</div>';
        }

        $output .= '</div></div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>No hay opiniones disponibles.</p>';
    }
}
add_shortcode( 'opiniones_clientes', 'mostrar_opiniones_shortcode' );
?>