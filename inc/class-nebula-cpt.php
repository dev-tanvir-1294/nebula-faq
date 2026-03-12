<?php

/**
 * Handle Custom Post Type registration.
 */
class Nebula_CPT
{
    /**
     * Register the Custom Post Type.
     */
    public function register_cpt()
    {
        $labels = array(
            'name'               => _x('FAQ Sets', 'post type general name', 'nebula'),
            'singular_name'      => _x('FAQ Set', 'post type singular name', 'nebula'),
            'menu_name'          => _x('Nebula FAQ', 'admin menu', 'nebula'),
            'name_admin_bar'     => _x('FAQ Set', 'add new on admin bar', 'nebula'),
            'add_new'            => _x('Add New', 'faq', 'nebula'),
            'add_new_item'       => __('Add New FAQ Set', 'nebula'),
            'new_item'           => __('New FAQ Set', 'nebula'),
            'edit_item'          => __('Edit FAQ Set', 'nebula'),
            'view_item'          => __('View FAQ Set', 'nebula'),
            'all_items'          => __('All FAQ Sets', 'nebula'),
            'search_items'       => __('Search FAQ Sets', 'nebula'),
            'not_found'          => __('No FAQ sets found.', 'nebula'),
            'not_found_in_trash' => __('No FAQ sets found in Trash.', 'nebula'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'nebula-faq'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'           => 'dashicons-editor-help',
            'supports'           => array('title'),
        );

        register_post_type('nebula_faq', $args);
    }

    /**
     * Add shortcode column to list view.
     */
    public function add_shortcode_column($columns)
    {
        $new_columns = array();
        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;
            if ($key === 'title') {
                $new_columns['shortcode'] = __('Shortcode', 'nebula');
            }
        }
        return $new_columns;
    }

    /**
     * Render shortcode column content.
     */
    public function render_shortcode_column($column, $post_id)
    {
        if ($column === 'shortcode') {
            $post = get_post($post_id);
            echo '<code>[nebula_faq name="' . $post->post_name . '"]</code>';
        }
    }
}
