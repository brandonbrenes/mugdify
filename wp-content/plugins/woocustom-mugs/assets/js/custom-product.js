jQuery(document).ready(function($) {
    let cropper = null;
    let uploadedImage = null;
    let croppedImage = null;
    
    // Elementos del DOM
    const $uploadInput = $('#image-upload');
    const $previewImage = $('#preview-image');
    const $cropButton = $('#crop-button');
    const $resetButton = $('#reset-button');
    const $customImageId = $('#custom_image_id');
    const $addToCartButton = $('.single_add_to_cart_button');
    
    // Subir imagen
    $uploadInput.on('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Destruir Cropper si existe
                if (cropper) {
                    cropper.destroy();
                }
                
                // Actualizar imagen de vista previa
                $previewImage.attr('src', e.target.result);
                uploadedImage = e.target.result;
                
                // Inicializar Cropper
                cropper = new Cropper($previewImage[0], {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    guides: true,
                    background: false,
                    movable: true,
                    rotatable: true,
                    scalable: true,
                    zoomable: true,
                    cropBoxResizable: true
                });
                
                // Habilitar botones
                $cropButton.prop('disabled', false);
                $resetButton.prop('disabled', false);
            };
            
            reader.readAsDataURL(file);
        }
    });
    
    // Recortar imagen
    $cropButton.on('click', function() {
        if (cropper) {
            // Obtener canvas recortado
            const canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 800
            });
            
            // Convertir a blob
            canvas.toBlob(function(blob) {
                // Crear formulario para enviar
                const formData = new FormData();
                formData.append('action', 'upload_custom_image');
                formData.append('nonce', wc_custom_product_params.nonce);
                formData.append('image', blob, 'custom-product.jpg');
                
                // Mostrar procesando
                $cropButton.text(wc_custom_product_params.processing_text).prop('disabled', true);
                
                // Enviar AJAX
                $.ajax({
                    url: wc_custom_product_params.ajax_url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Actualizar imagen
                            $previewImage.attr('src', response.data.image_url);
                            $customImageId.val(response.data.attachment_id);
                            
                            // Habilitar botón de añadir al carrito
                            $addToCartButton.prop('disabled', false);
                            
                            // Destruir Cropper
                            cropper.destroy();
                            cropper = null;
                            
                            // Restaurar botones
                            $cropButton.text(wc_custom_product_params.crop_text).prop('disabled', true);
                        } else {
                            alert(wc_custom_product_params.error_text + ': ' + response.data);
                        }
                    },
                    error: function() {
                        alert(wc_custom_product_params.error_text);
                    },
                    complete: function() {
                        $cropButton.text(wc_custom_product_params.crop_text).prop('disabled', false);
                    }
                });
            });
        }
    });
    
    // Restablecer
    $resetButton.on('click', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        
        $previewImage.attr('src', wc_custom_product_params.placeholder);
        $uploadInput.val('');
        $cropButton.prop('disabled', true);
        $resetButton.prop('disabled', true);
        $customImageId.val('');
        $addToCartButton.prop('disabled', true);
    });
    
    // Abrir selector de archivos al hacer clic en el botón
    $('.upload-button').on('click', function() {
        $uploadInput.click();
    });
});