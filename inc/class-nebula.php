<?php

/**
 * The core plugin class.
 */
class Nebula_FAQ
{
    /**
     * Component instances.
     */
    protected $assets;
    protected $cpt;
    protected $meta_box;
    protected $shortcode;

    /**
     * Initialize the plugin.
     */
    public function __construct()
    {
        $this->load_dependencies();
    }

    /**
     * Load dependencies and instantiate classes.
     */
    private function load_dependencies()
    {
        require_once NEBULA_PATH . 'inc/class-nebula-assets.php';
        require_once NEBULA_PATH . 'inc/class-nebula-cpt.php';
        require_once NEBULA_PATH . 'inc/class-nebula-meta-box.php';
        require_once NEBULA_PATH . 'inc/class-nebula-shortcode.php';

        $this->assets    = new Nebula_Assets();
        $this->cpt       = new Nebula_CPT();
        $this->meta_box  = new Nebula_Meta_Box();
        $this->shortcode = new Nebula_Shortcode();
    }

    /**
     * Run the plugin hooks.
     */
    public function run()
    {
        // Assets hooks
        add_action('wp_enqueue_scripts', array($this->assets, 'enqueue_frontend_assets'));
        add_action('admin_enqueue_scripts', array($this->assets, 'enqueue_admin_assets'));

        // CPT hooks
        add_action('init', array($this->cpt, 'register_cpt'));
        add_filter('manage_nebula_faq_posts_columns', array($this->cpt, 'add_shortcode_column'));
        add_action('manage_nebula_faq_posts_custom_column', array($this->cpt, 'render_shortcode_column'), 10, 2);

        // Meta Box hooks
        add_action('add_meta_boxes', array($this->meta_box, 'add_faq_meta_box'));
        add_action('save_post', array($this->meta_box, 'save_faq_data'), 10, 2);

        // Shortcode hooks
        add_shortcode('nebula_faq', array($this->shortcode, 'render_faq'));
    }
}
