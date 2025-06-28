<?php
class WC_Custom_Product_Cart {
    private static $instance = null;
    
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Añadir datos personalizados al carrito
        add_filter('woocommerce_add_cart_item_data', array($this, 'add_custom_item_data'), 10, 3);
        
        // Mostrar datos personalizados en el carrito
        add_filter('woocommerce_get_item_data', array($this, 'display_custom_item_data'), 10, 2);
        
        // Añadir datos personalizados al pedido
        add_action('woocommerce_add_order_item_meta', array($this, 'add_custom_order_item_meta'), 10, 3);
        
        // Manejar AJAX para subir imágenes
        add_action('wp_ajax_upload_custom_image', array($this, 'handle_image_upload'));
        add_action('wp_ajax_nopriv_upload_custom_image', array($this, 'handle_image_upload'));
    }
    
    public function add_custom_item_data($cart_item_data, $product_id, $variation_id) {
        if (isset($_POST['custom_image_id']) && !empty($_POST['custom_image_id'])) {
            $cart_item_data['custom_image_id'] = sanitize_text_field($_POST['custom_image_id']);
        }
        return $cart_item_data;
    }
    
    public function display_custom_item_data($item_data, $cart_item) {
        if (isset($cart_item['custom_image_id'])) {
            $image_url = wp_get_attachment_url($cart_item['custom_image_id']);
            
            if ($image_url) {
                $item_data[] = array(
                    'key' => __('Imagen personalizada', 'wc-custom-products'),
                    'value' => '<a href="' . esc_url($image_url) . '" target="_blank">' . __('Ver imagen', 'wc-custom-products') . '</a>'
                );
            }
        }
        return $item_data;
    }
    
    public function add_custom_order_item_meta($item_id, $values, $key) {
        if (isset($values['custom_image_id'])) {
            wc_add_order_item_meta($item_id, 'custom_image_id', $values['custom_image_id']);
        }
    }
    
    public function handle_image_upload() {
        check_ajax_referer('wc_custom_product_nonce', 'nonce');
        
        if (!isset($_FILES['image'])) {
            wp_send_json_error(__('No se recibió el archivo.', 'wc-custom-products'));
        }
        
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        
        $attachment_id = media_handle_upload('image', 0);
        
        if (is_wp_error($attachment_id)) {
            wp_send_json_error($attachment_id->get_error_message());
        }
        
        wp_send_json_success(array(
            'attachment_id' => $attachment_id,
            'image_url' => wp_get_attachment_url($attachment_id)
        ));
    }
}