<?php
/**
 * Plugin Name: Custom widgets
 * Description: Plugin de widgets personalizados para Elementor
 * Version: 1.0
 * Author: Brandon
 */

// Evita el acceso directo
if (!defined('ABSPATH')) exit;

// Registrar los estilos CSS para los widgets
function register_custom_widget_styles() {

    // Estilos del FAQs Widget
    wp_enqueue_style(
        'faqs-widget-style',
        plugin_dir_url(__FILE__) . 'faqs/faqs-widget.css',
        [],
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'register_custom_widget_styles');

// Incluir los archivos PHP de los widgets y registrarlos
function register_custom_elementor_widgets($widgets_manager) {
    require_once(__DIR__ . '/faqs/faqs-widget.php');

    // Registrar los widgets personalizados
    $widgets_manager->register(new \Elementor\FAQS_Accordion_Widget());
}
add_action('elementor/widgets/register', 'register_custom_elementor_widgets');
