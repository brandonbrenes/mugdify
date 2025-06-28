<?php
/**
 * Template Name: Professional Profile - Simple
 * Description: Clean profile template with contact info
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="profile-hero">
            <div class="profile-container">
                <div class="profile-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/profile-picture.jpg'); ?>" 
                         alt="Brandon Brenes Arias"
                         onerror="this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/profile-default.jpg'); ?>'">
                </div>
                <div class="profile-content">
                    <h1>Brandon Brenes Arias</h1>
                    <p class="profile-title">Desarrollador Full Stack & Diseñador</p>
                    
                    <div class="profile-bio">
                        <p>Desarrollador con perfil dinámico y multidisciplinario. Apasionado por el diseño, la programación y la creación de soluciones tecnológicas integrales. Combino habilidades técnicas con visión creativa para desarrollar aplicaciones web y productos personalizados.</p>
                    </div>
                    
                    <div class="profile-contact">
                        <a href="https://www.linkedin.com/in/branjo" target="_blank" class="contact-link">
                            <span class="dashicons dashicons-linkedin"></span> linkedin.com/in/branjo
                        </a>
                        <a href="mailto:branjo.dev@gmail.com" class="contact-link">
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