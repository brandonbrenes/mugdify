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

    <!-- Quienes Somos -->
    <section class="who-we-are">
        <div class="container">
            <div class="section-header">
                <h2>Quiénes Somos</h2>
                <p>Conoce más sobre nuestra empresa y lo que nos hace especiales</p>
            </div>
            <div class="who-we-are-content">
                <p>Mugdify es una tienda en línea especializada en tazas personalizadas con diseños únicos. A través de nuestro innovador editor visual 2D con previsualización 3D, los usuarios pueden diseñar sus propias tazas para regalar o uso personal.</p>
                <p>Realizamos nosotros mismos las impresiones de las tazas bajo la técnica de sublimación de alta calidad, garantizando productos duraderos y vibrantes.</p>
                <p>Nuestro objetivo es brindar una experiencia de compra única donde cada cliente pueda expresar su creatividad y obtener un producto que realmente represente su estilo.</p>
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

    <!-- Fundador -->
    <section class="founder-section">
        <div class="container">
            <h2>Nuestro Fundador</h2>
            <a href="<?php echo esc_url(home_url('/perfil-profesional')); ?>" class="founder-card">
                <div class="founder-image">
                    <img src="https://dev-mugdify.pantheonsite.io/wp-content/uploads/2025/06/profile-picture.jpg" alt="Brandon Brenes - Fundador de Mugdify">
                </div>
                <div class="founder-info">
                    <h3>Brandon Brenes</h3>
                    <p class="position">Fundador & desarrollador</p>
                    <p>Desarrollador Full Stack y diseñador con pasión por crear experiencias digitales únicas.</p>
                </div>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();