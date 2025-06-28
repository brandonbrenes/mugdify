<?php
/*
Plugin Name: WooCommerce Productos Personalizables
Plugin URI: https://ejemplo.com
Description: Permite a los clientes personalizar productos con imágenes editables
Version: 1.0.0
Author: Brandon
Author URI: https://ejemplo.com
License: GPL-2.0+
Text Domain: wc-custom-products
Domain Path: /languages
*/

defined('ABSPATH') || exit;

// Comprobar si WooCommerce está activo
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}

// Definir constantes
define('WC_CUSTOM_PRODUCTS_VERSION', '1.0.0');
define('WC_CUSTOM_PRODUCTS_PATH', plugin_dir_path(__FILE__));
define('WC_CUSTOM_PRODUCTS_URL', plugin_dir_url(__FILE__));
define('WC_CUSTOM_PRODUCTS_BASENAME', plugin_basename(__FILE__));

// Cargar clases
require_once WC_CUSTOM_PRODUCTS_PATH . 'includes/class-custom-product.php';
require_once WC_CUSTOM_PRODUCTS_PATH . 'includes/class-custom-product-admin.php';
require_once WC_CUSTOM_PRODUCTS_PATH . 'includes/class-custom-product-frontend.php';
require_once WC_CUSTOM_PRODUCTS_PATH . 'includes/class-custom-product-cart.php';

// Inicializar
function wc_custom_products_init() {
    WC_Custom_Product::get_instance();
    WC_Custom_Product_Admin::get_instance();
    WC_Custom_Product_Frontend::get_instance();
    WC_Custom_Product_Cart::get_instance();
}
add_action('plugins_loaded', 'wc_custom_products_init');