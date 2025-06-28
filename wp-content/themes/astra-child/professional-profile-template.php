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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/profile-picture.jpg" alt="Brandon Brenes Arias">
                </div>
                <div class="profile-content">
                    <h1>Brandon Brenes Arias</h1>
                    <p class="profile-title">Desarrollador Full Stack & Diseñador</p>
                    
                    <div class="profile-bio">
                        <p>Soy un desarrollador full stack con un perfil dinámico y multidisciplinario. Me apasiona el diseño, la ciberseguridad, la administración de servidores y la programación en Java y Python. Actualmente estoy finalizando la carrera de Informática y Tecnología Multimedia en la Universidad de Costa Rica, donde he desarrollado habilidades que abarcan todo el ciclo de vida del software: desde el diseño UX/UI y la planificación en ingeniería de software, hasta la programación, el aseguramiento de la calidad (QA) y el despliegue en producción. Esta formación me ha permitido construir soluciones tecnológicas integrales y de calidad. Gracias a mi experiencia y enfoque versátil, puedo adaptarme y aportar valor en distintas áreas del diseño y desarrollo de software.

                        </p>
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