<?php
class WC_Custom_Product {
    private static $instance = null;
    public $product_type = 'custom_product';
    
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Registrar tipo de producto personalizado
        add_action('init', array($this, 'register_custom_product_type'));
        
        // Añadir tipo de producto a la lista de WooCommerce
        add_filter('product_type_selector', array($this, 'add_custom_product_type'));
        
        // Mostrar campos personalizados para el producto
        add_action('woocommerce_product_options_general_product_data', array($this, 'show_custom_product_fields'));
        
        // Guardar campos personalizados
        add_action('woocommerce_process_product_meta', array($this, 'save_custom_product_fields'));
    }
    
    public function register_custom_product_type() {
        class WC_Product_Custom extends WC_Product_Simple {
            public function __construct($product) {
                $this->product_type = 'custom_product';
                parent::__construct($product);
            }
        }
    }
    
    public function add_custom_product_type($types) {
        $types['custom_product'] = __('Producto Personalizable', 'wc-custom-products');
        return $types;
    }
    
    public function show_custom_product_fields() {
        global $product_object;
        
        if ($product_object && 'custom_product' === $product_object->get_type()) {
            echo '<div class="options_group show_if_custom_product">';
            
            // Precio base
            woocommerce_wp_text_input(array(
                'id' => '_custom_product_price',
                'label' => __('Precio base (₡)', 'wc-custom-products'),
                'placeholder' => '',
                'desc_tip' => true,
                'description' => __('Precio base sin personalización', 'wc-custom-products'),
                'type' => 'number',
                'custom_attributes' => array(
                    'step' => 'any',
                    'min' => '0'
                )
            ));
            
            // Precio adicional por personalización
            woocommerce_wp_text_input(array(
                'id' => '_custom_product_additional_price',
                'label' => __('Precio adicional (₡)', 'wc-custom-products'),
                'placeholder' => '',
                'desc_tip' => true,
                'description' => __('Precio adicional por personalización', 'wc-custom-products'),
                'type' => 'number',
                'custom_attributes' => array(
                    'step' => 'any',
                    'min' => '0'
                )
            ));
            
            echo '</div>';
        }
    }
    
    public function save_custom_product_fields($post_id) {
        $product = wc_get_product($post_id);
        
        if ($product->is_type('custom_product')) {
            $price = isset($_POST['_custom_product_price']) ? wc_clean($_POST['_custom_product_price']) : '';
            $additional_price = isset($_POST['_custom_product_additional_price']) ? wc_clean($_POST['_custom_product_additional_price']) : '';
            
            $product->update_meta_data('_custom_product_price', $price);
            $product->update_meta_data('_custom_product_additional_price', $additional_price);
            $product->save();
        }
    }
}