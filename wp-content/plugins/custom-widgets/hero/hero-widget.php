<?php
namespace Elementor;

if (!defined('ABSPATH')) exit;

class Hero_Widget extends Widget_Base {

    public function get_name() {
        return 'hero_widget';
    }

    public function get_title() {
        return 'Hero';
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenido', 'plugin-name'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Imagen para desktop
        $this->add_control(
            'hero_image',
            [
                'label' => __('Imagen de fondo (desktop)', 'plugin-name'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Imagen para móvil
        $this->add_control(
            'hero_image_mobile',
            [
                'label' => __('Imagen de fondo (móvil)', 'plugin-name'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'hero_title',
            [
                'label' => __('Título', 'plugin-name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Título del Hero', 'plugin-name'),
                'placeholder' => __('Escribe el título aquí', 'plugin-name'),
            ]
        );

        $this->add_control(
            'hero_text',
            [
                'label' => __('Texto', 'plugin-name'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Este es el texto de descripción del hero.', 'plugin-name'),
                'placeholder' => __('Escribe el texto aquí', 'plugin-name'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Texto del botón', 'plugin-name'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Haz clic aquí', 'plugin-name'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Enlace del botón', 'plugin-name'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://tusitio.com', 'plugin-name'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="custom-hero">
            <img class="hero-image desktop" src="<?php echo esc_url($settings['hero_image']['url']); ?>" alt="">
            <img class="hero-image mobile" src="<?php echo esc_url($settings['hero_image_mobile']['url']); ?>" alt="">

            <div class="hero-content">
                <h2><?php echo esc_html($settings['hero_title']); ?></h2>
                <p><?php echo esc_html($settings['hero_text']); ?></p>
                <?php if (!empty($settings['button_text'])) : ?>
                    <a class="hero-button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php
    }
}
