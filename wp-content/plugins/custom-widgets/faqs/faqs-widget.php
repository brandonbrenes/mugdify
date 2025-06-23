<?php
namespace Elementor;

if (!defined('ABSPATH')) exit;

class FAQS_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return 'faq_accordion';
    }

    public function get_title() {
        return 'Acordeón de FAQ';
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => 'Preguntas Frecuentes',
        ]);

        $repeater = new Repeater();

        $repeater->add_control('pregunta', [
            'label' => 'Pregunta',
            'type' => Controls_Manager::TEXT,
            'default' => '¿Cuál es tu pregunta?',
        ]);

        $repeater->add_control('respuesta', [
            'label' => 'Respuesta',
            'type' => Controls_Manager::WYSIWYG,
            'default' => 'Esta es la respuesta a la pregunta.',
        ]);

        $this->add_control('faq_items', [
            'label' => 'Items de FAQ',
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
            'title_field' => '{{{ pregunta }}}',
        ]);

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $id = 'faq-accordion-' . $this->get_id();
        ?>
        <div class="faq-accordion" id="<?php echo esc_attr($id); ?>">
            <?php foreach ($settings['faq_items'] as $index => $item): ?>
                <div class="faq-item" data-index="<?php echo $index; ?>">
                    <h3 class="faq-question">
                        <?php echo esc_html($item['pregunta']); ?>
                        <span class="faq-icon">▼</span>
                    </h3>
                    <div class="faq-answer-wrapper">
                        <div class="faq-answer"><?php echo wp_kses_post($item['respuesta']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            (function($) {
                $(document).ready(function() {
                    var $accordion = $('#<?php echo esc_attr($id); ?>');

                    // Inicializa la altura de todas las respuestas en 0
                    $accordion.find('.faq-answer-wrapper').each(function() {
                        var $wrapper = $(this);
                        var $answer = $wrapper.find('.faq-answer');
                        $wrapper.data('original-height', $answer.outerHeight(true));
                        $wrapper.height(0);
                    });

                    // Al hacer clic en la pregunta
                    $accordion.on('click', '.faq-question', function(e) {
                        e.preventDefault();
                        var $item = $(this).closest('.faq-item');
                        var $wrapper = $item.find('.faq-answer-wrapper');
                        var isActive = $item.hasClass('active');

                        $accordion.find('.faq-item').removeClass('active');
                        $accordion.find('.faq-answer-wrapper').height(0);

                        if (!isActive) {
                            $item.addClass('active');
                            $wrapper.height($wrapper.data('original-height'));
                        }
                    });

                    // Recalcular altura si se redimensiona la ventana
                    $(window).on('resize', function() {
                        $accordion.find('.faq-item.active .faq-answer-wrapper').each(function() {
                            var $wrapper = $(this);
                            var $answer = $wrapper.find('.faq-answer');
                            $wrapper.data('original-height', $answer.outerHeight(true));
                            if ($wrapper.parent().hasClass('active')) {
                                $wrapper.height($wrapper.data('original-height'));
                            }
                        });
                    });
                });
            })(jQuery);
        </script>
        <?php
    }
}