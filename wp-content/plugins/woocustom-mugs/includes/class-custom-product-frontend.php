<?php
class WC_Custom_Product_Frontend {
    private static $instance = null;
    
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Cambiar plantilla para productos personalizados
        add_filter('woocommerce_locate_template', array($this, 'custom_product_template'), 10, 3);
        
        // Cargar scripts y estilos
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }
    
    public function custom_product_template($template, $template_name, $template_path) {
        global $product;
        
        if ('custom_product' === $product->get_type() && 'single-product/add-to-cart/simple.php' === $template_name) {
            $plugin_path = WC_CUSTOM_PRODUCTS_PATH . 'templates/single-product/custom-product.php';
            
            if (file_exists($plugin_path)) {
                return $plugin_path;
            }
        }
        
        return $template;
    }
    
    public function enqueue_scripts() {
        global $post;
        
        if ($post && 'product' === $post->post_type) {
            $product = wc_get_product($post->ID);
            
            if ($product && 'custom_product' === $product->get_type()) {
                // Cropper.js
                wp_enqueue_style('cropper-css', WC_CUSTOM_PRODUCTS_URL . 'assets/css/cropper.min.css', array(), '1.5.12');
                wp_enqueue_script('cropper-js', WC_CUSTOM_PRODUCTS_URL . 'assets/js/cropper.min.js', array('jquery'), '1.5.12', true);
                
                // Scripts personalizados
                wp_enqueue_style('custom-product-css', WC_CUSTOM_PRODUCTS_URL . 'assets/css/custom-product.css', array(), WC_CUSTOM_PRODUCTS_VERSION);
                wp_enqueue_script('custom-product-js', WC_CUSTOM_PRODUCTS_URL . 'assets/js/custom-product.js', array('jquery', 'cropper-js'), WC_CUSTOM_PRODUCTS_VERSION, true);
                
                // Variables para JS
                wp_localize_script('custom-product-js', 'wc_custom_product_params', array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('wc_custom_product_nonce'),
                    'upload_text' => __('Subir imagen', 'wc-custom-products'),
                    'crop_text' => __('Recortar imagen', 'wc-custom-products'),
                    'reset_text' => __('Restablecer', 'wc-custom-products'),
                    'processing_text' => __('Procesando...', 'wc-custom-products'),
                    'error_text' => __('Error al procesar la imagen', 'wc-custom-products')
                ));
            }
        }
    }
}