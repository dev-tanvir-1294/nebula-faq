<?php

/**
 * Handle the FAQ Meta Box and Repeater.
 */
class Nebula_Meta_Box
{
    /**
     * Add the custom meta box.
     */
    public function add_faq_meta_box()
    {
        add_meta_box(
            'nebula_faq_items',
            __('FAQ Questions & Answers', 'nebula'),
            array($this, 'render_meta_box'),
            'nebula_faq',
            'normal',
            'high'
        );
    }

    /**
     * Render the meta box HTML with repeater.
     */
    public function render_meta_box($post)
    {
        wp_nonce_field('nebula_faq_meta_box_save', 'nebula_faq_meta_box_nonce');
        
        $faq_items = get_post_meta($post->ID, '_nebula_faq_items', true) ?: array();
        ?>
        <div id="nebula-faq-repeater">
            <div class="faq-items-container">
                <?php foreach ($faq_items as $index => $item) : ?>
                    <div class="faq-item">
                        <p><strong>Question <?php echo $index + 1; ?>:</strong></p>
                        <input type="text" name="faq_items[<?php echo $index; ?>][q]" value="<?php echo esc_attr($item['q']); ?>">
                        <p><strong>Answer:</strong></p>
                        <textarea name="faq_items[<?php echo $index; ?>][a]" rows="3"><?php echo esc_textarea($item['a']); ?></textarea>
                        <button type="button" class="remove-faq-item button secondary" style="margin-top: 10px;">Remove Item</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="add-faq-item" class="button button-primary">Add New FAQ Item</button>

            <script type="text/template" id="faq-item-template">
                <div class="faq-item">
                    <p><strong>Question:</strong></p>
                    <input type="text" name="faq_items[{{index}}][q]" value="">
                    <p><strong>Answer:</strong></p>
                    <textarea name="faq_items[{{index}}][a]" rows="3"></textarea>
                    <button type="button" class="remove-faq-item button secondary" style="margin-top: 10px;">Remove Item</button>
                </div>
            </script>
        </div>
        <?php
    }

    /**
     * Save the meta box data.
     */
    public function save_faq_data($post_id, $post)
    {
        // Check post type
        if ($post->post_type !== 'nebula_faq') {
            return;
        }

        // Security checks
        if (!isset($_POST['nebula_faq_meta_box_nonce']) || !wp_verify_nonce($_POST['nebula_faq_meta_box_nonce'], 'nebula_faq_meta_box_save')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Sanitize and save data
        if (isset($_POST['faq_items']) && is_array($_POST['faq_items'])) {
            $sanitied_items = array();
            foreach ($_POST['faq_items'] as $item) {
                if (!empty($item['q'])) {
                    $sanitied_items[] = array(
                        'q' => sanitize_text_field($item['q']),
                        'a' => wp_kses_post($item['a']),
                    );
                }
            }
            update_post_meta($post_id, '_nebula_faq_items', $sanitied_items);
        } else {
            delete_post_meta($post_id, '_nebula_faq_items');
        }
    }
}
