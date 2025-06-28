<?php
/**
 * Template for custom product type
 */
global $product;

if (!$product->is_purchasable()) {
    return;
}

// Precios
$base_price = $product->get_meta('_custom_product_price');
$additional_price = $product->get_meta('_custom_product_additional_price');
$total_price = $base_price + $additional_price;

do_action('woocommerce_before_add_to_cart_form');
?>

<form class="cart custom-product-form" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>
    
    <div class="custom-product-container">
        <div class="custom-product-editor">
            <div class="image-preview-container">
                <div id="image-preview" class="image-preview">
                    <img id="preview-image" src="<?php echo WC_CUSTOM_PRODUCTS_URL . 'assets/images/placeholder.png'; ?>" alt="<?php esc_attr_e('Previsualización', 'wc-custom-products'); ?>">
                </div>
                <div class="image-actions">
                    <label for="image-upload" class="button upload-button">
                        <?php esc_html_e('Subir imagen', 'wc-custom-products'); ?>
                    </label>
                    <input type="file" id="image-upload" accept="image/*" style="display: none;">
                    <button type="button" id="crop-button" class="button crop-button" disabled>
                        <?php esc_html_e('Recortar imagen', 'wc-custom-products'); ?>
                    </button>
                    <button type="button" id="reset-button" class="button reset-button" disabled>
                        <?php esc_html_e('Restablecer', 'wc-custom-products'); ?>
                    </button>
                </div>
                <input type="hidden" name="custom_image_id" id="custom_image_id" value="">
            </div>
            
            <div class="price-display">
                <div class="price-row">
                    <span><?php esc_html_e('Precio base:', 'wc-custom-products'); ?></span>
                    <span class="price-amount">₡<?php echo number_format($base_price, 2); ?></span>
                </div>
                <div class="price-row">
                    <span><?php esc_html_e('Personalización:', 'wc-custom-products'); ?></span>
                    <span class="price-amount">₡<?php echo number_format($additional_price, 2); ?></span>
                </div>
                <div class="price-row total-price">
                    <strong><?php esc_html_e('Total:', 'wc-custom-products'); ?></strong>
                    <strong class="price-amount">₡<?php echo number_format($total_price, 2); ?></strong>
                </div>
            </div>
        </div>
        
        <div class="add-to-cart-container">
            <div class="quantity">
                <?php
                woocommerce_quantity_input(array(
                    'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                ));
                ?>
            </div>
            
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt" disabled>
                <?php echo esc_html($product->single_add_to_cart_text()); ?>
            </button>
        </div>
    </div>
    
    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>