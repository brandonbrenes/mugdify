<?php
/*
Plugin Name: Mugdify Customizer
Description: Plugin para integrar el editor 2D/3D de personalización de tazas en WooCommerce.
Version: 1.0.0
Author: Brandon Brenes
*/

// Evitar acceso directo
if (!defined('ABSPATH')) {
  exit;
}

// 1. Registrar los assets (JS + CSS del editor React)
function mugdify_enqueue_editor_assets() {
  // Cambia estas rutas según la estructura del plugin
  wp_enqueue_script(
    'mugdify-editor',
    plugin_dir_url(__FILE__) . 'build/editor.js',
    array('wp-element'),
    '1.0.0',
    true
  );

  wp_enqueue_style(
    'mugdify-editor-style',
    plugin_dir_url(__FILE__) . 'build/editor.css',
    array(),
    '1.0.0'
  );
}
add_action('wp_enqueue_scripts', 'mugdify_enqueue_editor_assets');

// 2. Inyectar el shortcode del editor en la página de producto
function mugdify_render_editor() {
  // El div donde React montará la app
  return '<div id="mugdify-editor-root"></div>';
}
add_shortcode('mugdify_editor', 'mugdify_render_editor');

// 3. Insertar automáticamente el editor en productos específicos (opcional)
function mugdify_inject_editor_before_cart() {
  if (is_product()) {
    echo do_shortcode('[mugdify_editor]');
  }
}
add_action('woocommerce_before_add_to_cart_button', 'mugdify_inject_editor_before_cart');

// 4. Guardar los datos del diseño como meta en el carrito (falta integración JS)
function mugdify_add_custom_data_to_cart($cart_item_data, $product_id) {
  if (isset($_POST['mugdify_design_data'])) {
    $cart_item_data['mugdify_design_data'] = sanitize_text_field($_POST['mugdify_design_data']);
  }
  return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'mugdify_add_custom_data_to_cart', 10, 2);

// 5. Mostrar diseño en el checkout
function mugdify_display_cart_item_custom_data($item_data, $cart_item) {
  if (isset($cart_item['mugdify_design_data'])) {
    $item_data[] = array(
      'name' => 'Diseño personalizado',
      'value' => esc_html($cart_item['mugdify_design_data'])
    );
  }
  return $item_data;
}
add_filter('woocommerce_get_item_data', 'mugdify_display_cart_item_custom_data', 10, 2);
