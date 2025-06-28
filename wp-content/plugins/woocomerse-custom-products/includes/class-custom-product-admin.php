<?php
class WC_Custom_Product_Admin {
    private static $instance = null;
    
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Mostrar imagen personalizada en pedidos
        add_action('woocommerce_order_item_meta_end', array($this, 'display_custom_image_in_order'), 10, 3);
        
        // Permitir descargar la imagen
        add_filter('woocommerce_order_item_display_meta_key', array($this, 'display_custom_image_key'), 10, 3);
        add_filter('woocommerce_order_item_display_meta_value', array($this, 'display_custom_image_value'), 10, 3);
    }
    
    public function display_custom_image_in_order($item_id, $item, $order) {
        $image_id = $item->get_meta('custom_image_id', true);
        
        if ($image_id) {
            $image_url = wp_get_attachment_url($image_id);
            echo '<p><strong>' . __('Imagen personalizada:', 'wc-custom-products') . '</strong><br>';
            echo '<a href="' . esc_url($image_url) . '" target="_blank">';
            echo wp_get_attachment_image($image_id, 'thumbnail');
            echo '</a></p>';
            echo '<p><a href="' . esc_url($image_url) . '" download class="button">' . __('Descargar imagen', 'wc-custom-products') . '</a></p>';
        }
    }
    
    public function display_custom_image_key($display_key, $meta, $item) {
        if ('custom_image_id' === $meta->key) {
            $display_key = __('Imagen personalizada', 'wc-custom-products');
        }
        return $display_key;
    }
    
    public function display_custom_image_value($display_value, $meta, $item) {
        if ('custom_image_id' === $meta->key) {
            $image_url = wp_get_attachment_url($meta->value);
            $display_value = '<a href="' . esc_url($image_url) . '" target="_blank">' . __('Ver imagen', 'wc-custom-products') . '</a>';
        }
        return $display_value;
    }
}