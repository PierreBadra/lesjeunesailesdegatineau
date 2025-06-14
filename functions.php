<?php
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if (class_exists('Dotenv\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
}

define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? '');
define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? '');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? '');

// Make sure WordPress constants are available
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}
if (!defined('WPINC')) {
    define('WPINC', 'wp-includes');
}

// Include PHPMailer classes from WordPress core
require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
require_once ABSPATH . WPINC . '/PHPMailer/SMTP.php';
require_once ABSPATH . WPINC . '/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Shortcodes
function hero_shortcode()
{
    ob_start();
    get_template_part('template-parts/hero');
    return ob_get_clean();
}
add_shortcode('hero', 'hero_shortcode');

function objectifs_shortcode()
{
    ob_start();
    get_template_part('template-parts/objectifs');
    return ob_get_clean();
}
add_shortcode('objectifs', 'objectifs_shortcode');
function explorez_shortcode()
{
    ob_start();
    get_template_part('template-parts/explorez');
    return ob_get_clean();
}
add_shortcode('explorez', 'explorez_shortcode');

// Actions
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');
    remove_menu_page('edit.php?post_type=collection');
});


// Add WooCommerce support to your custom theme
function add_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'add_woocommerce_support');