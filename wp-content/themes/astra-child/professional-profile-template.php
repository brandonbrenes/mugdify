<?php
/**
 * Template Name: Professional Profile - Simple
 * Description: Clean profile template with contacto y verificación de imagen
 */

get_header();

// Ruta a imagen por defecto
$default_uri = get_template_directory_uri() . '/assets/imgs/profile-default.jpg';

// Ruta a imagen personalizada (en el servidor)
$profile_path = get_template_directory() . '/assets/imgs/profile-picture.jpg';
$profile_uri = get_template_directory_uri() . '/assets/imgs/profile-picture.jpg';

// Verificar si la imagen personalizada existe
$img_uri = file_exists($profile_path) ? $profile_uri : $default_uri;
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="profile-hero">
            <div class="profile-container"
                style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: center; padding: 2rem;">

                <!-- Imagen de perfil -->
                <div class="profile-image">
                    <?php
                    // Obtiene la imagen personalizada o usa la predeterminada
                    $profile_img = get_theme_mod(
                        'professional_profile_image',
                        get_template_directory_uri() . '/assets/imgs/profile-default.jpg'
                    );
                    ?>
                    <img src="<?php echo esc_url($profile_img); ?>" alt="Foto de perfil profesional"
                        class="profile-photo">
                </div>

                <!-- Contenido de perfil -->
                <div class="profile-content" style="flex: 1; min-width: 250px;">
                    <h1 style="margin-bottom: 0.5rem;">Brandon Brenes Arias</h1>
                    <p class="profile-title" style="font-weight: bold; color: #666; margin-bottom: 1rem;">
                        Desarrollador Full Stack & Diseñador
                    </p>

                    <div class="profile-bio" style="margin-bottom: 1.5rem;">
                        <p>Desarrollador con perfil dinámico y multidisciplinario. Apasionado por el diseño, la
                            programación y la creación de soluciones tecnológicas integrales. Combino habilidades
                            técnicas con visión creativa para desarrollar aplicaciones web y productos personalizados.
                        </p>
                    </div>

                    <div class="profile-contact" style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="https://www.linkedin.com/in/branjo" target="_blank" class="contact-link"
                            style="text-decoration: none; color: #0077b5;">
                            <span class="dashicons dashicons-linkedin"></span> linkedin.com/in/branjo
                        </a>
                        <a href="mailto:branjo.dev@gmail.com" class="contact-link"
                            style="text-decoration: none; color: #333;">
                            <span class="dashicons dashicons-email"></span> branjo.dev@gmail.com
                        </a>
                    </div>
                </div>

            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>