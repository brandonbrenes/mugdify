<?php
/*
Plugin Name: Woo Custom Mugs
Description: Permite añadir imágenes personalizadas a productos WooCommerce
Version: 1.2
Author: Brandon
*/

// 1. Agregar checkbox en la edición del producto
add_action('woocommerce_product_options_general_product_data', function() {
    woocommerce_wp_checkbox([
        'id' => '_es_personalizable',
        'label' => '¿Es personalizable?',
        'description' => 'Permite subir una imagen personalizada para este producto.',
    ]);
});

// 2. Guardar el valor del checkbox
add_action('woocommerce_process_product_meta', function($post_id) {
    $is_custom = isset($_POST['_es_personalizable']) ? 'yes' : 'no';
    update_post_meta($post_id, '_es_personalizable', $is_custom);
});

// 3. Mostrar campo de subida de imagen y preview
add_action('woocommerce_before_add_to_cart_button', function() {
    global $product;
    if (get_post_meta($product->get_id(), '_es_personalizable', true) === 'yes') {
        ?>
        <div class="custom-image-upload">
            <label for="imagen_personalizada">Sube tu imagen personalizada:</label>
            <input type="file" name="imagen_personalizada" id="imagen_personalizada" accept="image/*" required>
            <div id="image-preview-container" style="display:none;">
                <p>Vista previa:</p>
                <img id="image-preview" src="#" alt="Previsualización" style="max-width: 200px; max-height: 200px;"/>
            </div>
        </div>
        <script>
        document.getElementById('imagen_personalizada').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        });
        </script>
        <?php
    }
});

// 4. Validar y guardar imagen en datos del carrito
add_filter('woocommerce_add_to_cart_validation', function($valid, $product_id) {
    $is_custom = get_post_meta($product_id, '_es_personalizable', true);
    
    if ($is_custom === 'yes' && (!isset($_FILES['imagen_personalizada']) || $_FILES['imagen_personalizada']['error'] !== UPLOAD_ERR_OK)) {
        wc_add_notice('Debes subir una imagen personalizada para este producto', 'error');
        return false;
    }
    return $valid;
}, 10, 2);

// 5. Guardar imagen subida en el carrito
add_filter('woocommerce_add_cart_item_data', function($cart_item_data, $product_id) {
    if (isset($_FILES['imagen_personalizada']) && !empty($_FILES['imagen_personalizada']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        
        $upload = wp_handle_upload($_FILES['imagen_personalizada'], ['test_form' => false]);
        
        if (!isset($upload['error']) && isset($upload['file'])) {
            $filetype = wp_check_filetype(basename($upload['file']));
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title' => sanitize_file_name($_FILES['imagen_personalizada']['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            ];
            
            $attach_id = wp_insert_attachment($attachment, $upload['file']);
            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
            wp_update_attachment_metadata($attach_id, $attach_data);
            
            $cart_item_data['imagen_personalizada_id'] = $attach_id;
        }
    }
    return $cart_item_data;
}, 10, 2);

// 6. Mostrar imagen personalizada en el carrito
add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (isset($cart_item['imagen_personalizada_id'])) {
        $img_url = wp_get_attachment_url($cart_item['imagen_personalizada_id']);
        $item_data[] = [
            'name' => 'Imagen personalizada',
            'value' => '<a href="' . esc_url($img_url) . '" target="_blank" style="display:block;margin-top:5px;">
                        <img src="' . esc_url($img_url) . '" alt="Imagen personalizada" style="max-width:50px;height:auto;">
                        </a>',
        ];
    }
    return $item_data;
}, 10, 2);

// 7. Guardar meta en la orden
add_action('woocommerce_checkout_create_order_line_item', function($item, $cart_item_key, $values, $order) {
    if (isset($values['imagen_personalizada_id'])) {
        $item->add_meta_data('imagen_personalizada_id', $values['imagen_personalizada_id']);
    }
}, 10, 4);

// 8. Mostrar imagen en los detalles del pedido
add_action('woocommerce_order_item_meta_end', function($item_id, $item, $order) {
    $image_id = $item->get_meta('imagen_personalizada_id');
    if ($image_id) {
        $img_url = wp_get_attachment_url($image_id);
        echo '<p><strong>Imagen personalizada:</strong><br>';
        echo '<a href="' . esc_url($img_url) . '" target="_blank">';
        echo '<img src="' . esc_url($img_url) . '" alt="Imagen personalizada" style="max-width:100px;height:auto;">';
        echo '</a></p>';
    }
}, 10, 3);