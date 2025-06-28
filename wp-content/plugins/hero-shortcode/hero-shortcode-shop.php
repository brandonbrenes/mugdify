<?php
/**
 * Plugin Name: Custom Hero Shortcode
 * Description: Hero section como shortcode estático.
 * Version: 1.0
 * Author: Tu Nombre
 */

if (!defined('ABSPATH')) exit; // Evitar acceso directo

// Registrar el estilo del Hero
function custom_hero_register_styles() {
    wp_register_style('custom-hero-style', plugin_dir_url(__FILE__) . 'hero-widget-shop.css');
}
add_action('wp_enqueue_scripts', 'custom_hero_register_styles');

// Shortcode
function custom_hero_shortcode() {
    // Encolar el estilo solo cuando se use el shortcode
    wp_enqueue_style('custom-hero-style');

    // Obtener URL base del plugin para usar imágenes correctamente
    $plugin_url = plugin_dir_url(__FILE__);

    ob_start();
    ?>
    <div class="custom-hero">
        <div class="hero-image-wrapper">
            <img class="hero-image desktop" src="<?php echo esc_url($plugin_url . 'imgs/taza-desktop.png'); ?>" alt="Imagen desktop">
            <img class="hero-image mobile" src="<?php echo esc_url($plugin_url . 'imgs/taza-movil.png'); ?>" alt="Imagen móvil">
        </div>

        <div class="hero-content">
            <h1>Haz que tu taza sea especial</h1>
            <p>En mugdify puedes adquirir tazas con diseños predefinidos, personalizarlos con nuestra herramienta o crear tus propios diseños desde 0 mientras ves el resultado en un modelo 3D en tiempo real.</p>
            <a class="hero-button" href="https://ejemplo.com">Crear diseño</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('custom-hero-shop', 'custom_hero_shortcode');
