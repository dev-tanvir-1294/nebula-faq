<?php

/**
 * Handle shortcode rendering.
 */
class Nebula_Shortcode
{
    /**
     * Render the nebula_faq shortcode.
     */
    public function render_faq($atts)
    {
        $atts = shortcode_atts(
            array(
                'id'   => '',
                'name' => '',
            ),
            $atts,
            'nebula_faq'
        );

        $faq_id = $atts['id'];

        // If name is provided, find the ID by slug
        if (!empty($atts['name'])) {
            $posts = get_posts(array(
                'name'           => $atts['name'],
                'post_type'      => 'nebula_faq',
                'post_status'    => 'publish',
                'posts_per_page' => 1
            ));

            if ($posts) {
                $faq_id = $posts[0]->ID;
            }
        }

        if (empty($faq_id)) {
            return '';
        }

        $faq_items = get_post_meta($faq_id, '_nebula_faq_items', true);

        if (empty($faq_items) || !is_array($faq_items)) {
            return '';
        }

        ob_start();
        ?>
        <div class="nebula-faq-container" id="nebula-faq-<?php echo esc_attr($atts['id']); ?>">
            <?php foreach ($faq_items as $index => $item) : ?>
                <div class="nebula-faq-item">
                    <div class="nebula-faq-question" role="button" aria-expanded="false">
                        <span class="nebula-faq-title"><?php echo esc_html($item['q']); ?></span>
                        <span class="nebula-faq-icon"></span>
                    </div>
                    <div class="nebula-faq-answer">
                        <div class="nebula-faq-answer-content">
                            <?php echo wp_kses_post($item['a']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
