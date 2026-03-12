<?php

/**
 * Handle plugin assets.
 */
class Nebula_Assets
{
    /**
     * Enqueue admin assets.
     */
    public function enqueue_admin_assets($hook)
    {
        global $post_type;
        if ($post_type !== 'nebula_faq') {
            return;
        }

        wp_enqueue_script('nebula-admin-js', NEBULA_URL . 'assets/js/admin.js', array('jquery'), NEBULA_VERSION, true);
        wp_enqueue_style('nebula-admin-css', NEBULA_URL . 'assets/css/admin.css', array(), NEBULA_VERSION);
    }

    /**
     * Enqueue frontend assets.
     */
    public function enqueue_frontend_assets()
    {
        wp_enqueue_style('nebula-faq-style', NEBULA_URL . 'assets/css/style.css', array(), NEBULA_VERSION);
        wp_enqueue_script('nebula-faq-script', NEBULA_URL . 'assets/js/script.js', array('jquery'), NEBULA_VERSION, true);
    }
}
