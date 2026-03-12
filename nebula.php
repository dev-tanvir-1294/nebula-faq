<?php
/**
 * Plugin Name: Nebula FAQ
 * Plugin URI: https://example.com/nebula-faq
 * Description: A dynamic FAQ plugin with a custom repeater interface and premium accordion frontend.
 * Version: 1.0.0
 * Author: Antigravity
 * Author URI: https://antigravity.google
 * License: GPL v2 or later
 * Text Domain: nebula
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('NEBULA_VERSION', '1.0.0');
define('NEBULA_URL', plugin_dir_url(__FILE__));
define('NEBULA_PATH', plugin_dir_path(__FILE__));

// Include the core plugin class
require_once NEBULA_PATH . 'inc/class-nebula.php';

// Initialize the plugin
function run_nebula_faq() {
    $plugin = new Nebula_FAQ();
    $plugin->run();
}

run_nebula_faq();
