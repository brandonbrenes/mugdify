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
