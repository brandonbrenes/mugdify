<?php
/**
 * Template Name: Acerca de Mugdify
 * Description: Página "Acerca de" para la tienda de tazas personalizadas
 */

get_header();
?>

<main id="primary" class="about-mugdify">
    <!-- Hero Section -->
    <section class="mugdify-hero">
        <div class="container">
            <h1>Acerca de Mugdify</h1>
            <p class="hero-subtitle">Donde la creatividad se encuentra con tu taza favorita</p>
        </div>
    </section>

    <!-- Nuestra Historia -->
    <section class="our-story">
        <div class="container">
            <div class="section-header">
                <h2>Nuestra Historia</h2>
                <p>Mugdify nació de la pasión por combinar tecnología, diseño y productos de calidad</p>
            </div>
            <div class="story-content">
                <div class="story-text">
                    <p>En la era digital actual, identificamos la necesidad de ofrecer una experiencia única de personalización de tazas que permita a los clientes expresar su creatividad de forma intuitiva.</p>
                    <p>Fundada en 2025, Mugdify se ha convertido en la plataforma líder en Costa Rica para crear tazas personalizadas con nuestro innovador editor 2D y previsualización 3D.</p>
                </div>
                <div class="story-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mugdify-team.jpg" alt="Equipo Mugdify">
                </div>
            </div>
        </div>
    </section>

    <!-- Misión, Visión y Valores -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-icon">🎯</div>
                    <h3>Misión</h3>
                    <p>Brindar a nuestros clientes la oportunidad de expresar su creatividad y emociones a través de tazas personalizadas, combinando tecnología, diseño y un producto final de calidad.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">👁️</div>
                    <h3>Visión</h3>
                    <p>Ser la tienda digital de tazas número uno en Costa Rica y Centroamérica en personalización de tazas.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">❤️</div>
                    <h3>Valores</h3>
                    <ul>
                        <li>Creatividad</li>
                        <li>Compromiso con la calidad</li>
                        <li>Accesibilidad tecnológica</li>
                        <li>Respeto y atención al cliente</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestro Proceso -->
    <section class="process-section">
        <div class="container">
            <h2>Nuestro Proceso</h2>
            <div class="process-steps">
                <div class="step">
                    <span class="step-number">1</span>
                    <h3>Diseña</h3>
                    <p>Usa nuestro editor intuitivo para crear tu diseño único</p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <h3>Visualiza</h3>
                    <p>Previsualiza en 3D cómo quedará tu taza</p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <h3>Compra</h3>
                    <p>Paga de forma segura con múltiples métodos</p>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <h3>Recibe</h3>
                    <p>Obten tu taza personalizada con impresión de alta calidad</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipo -->
    <section class="team-section">
        <div class="container">
            <h2>Conoce al Fundador</h2>
            <div class="team-member">
                <div class="member-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/brandon-brenes.jpg" alt="Brandon Brenes">
                </div>
                <div class="member-info">
                    <h3>Brandon Brenes</h3>
                    <p class="position">Fundador & CEO</p>
                    <p>Desarrollador Full Stack y diseñador con pasión por crear experiencias digitales únicas. Combinó sus habilidades técnicas y creativas para hacer realidad Mugdify.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();