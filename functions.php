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

// Enqueue WooCommerce scripts and styles
function enqueue_woocommerce_assets()
{
    if (class_exists('WooCommerce')) {
        // Ensure cart fragments work for AJAX updates
        if (is_front_page() || is_shop() || is_product_category() || is_product_tag() || is_product()) {
            wp_enqueue_script('wc-cart-fragments');
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_woocommerce_assets');

// Remove WooCommerce default styles if you want full control
// Uncomment the line below if you want to style everything yourself
// add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Ensure cart works without login
function ensure_cart_works_without_login()
{
    if (!is_admin()) {
        // Start session for guest users
        if (!session_id()) {
            session_start();
        }
    }
}
add_action('init', 'ensure_cart_works_without_login');

// Customize WooCommerce templates in your theme
// This tells WooCommerce to look for template overrides in your theme
function custom_woocommerce_template_path()
{
    return 'woocommerce/';
}
add_filter('woocommerce_template_path', 'custom_woocommerce_template_path');



// Helpers
function is_array_fully_empty($array)
{
    foreach ($array as $value) {
        if (is_array($value)) {
            if (!is_array_fully_empty($value)) {
                return false;
            }
        } else {
            if (!empty($value)) {
                return false;
            }
        }
    }
    return true;
}

function parse_french_string_date_to_english(string $date_string): string|null
{
    $fmt = new IntlDateFormatter(
        'fr_FR', // French locale
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'America/Toronto',
        IntlDateFormatter::GREGORIAN,
        'd MMMM yyyy'
    );

    $timestamp = $fmt->parse($date_string);


    if ($timestamp === false) {
        return null;
    } else {
        $date = (new DateTime())->setTimestamp($timestamp);
        return $date->format('Y-m-d');
    }
}

function calculate_time_difference_between_dates(string $start_date, string $end_date): array
{
    $date1 = DateTime::createFromFormat('Y-m-d', $start_date);
    $date2 = DateTime::createFromFormat('Y-m-d', $end_date);

    if (!$date1 || !$date2) {
        return ['text' => 'Invalid date format.', 'days' => null];
    }

    $interval = $date1->diff($date2);
    $totalDays = (int) $interval->format('%r%a'); // %r for sign

    if ($totalDays < 0) {
        return ['text' => 'Expiré', 'days' => $totalDays];
    } elseif ($totalDays >= 7) {
        $weeks = (int) ceil($totalDays / 7);
        return ['text' => "{$weeks} semaine" . ($weeks > 1 ? "s" : ""), 'days' => $totalDays];
    } else {
        return ['text' => "{$totalDays} jour" . ($totalDays != 1 ? "s" : ""), 'days' => $totalDays];
    }
}

function send_contact_email($form_data)
{
    // Check if PHPMailer is available
    if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        return ['success' => false, 'message' => "PHPMailer n'est pas disponible."];
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($form_data['email'], $form_data['firstName'] . ' ' . $form_data['lastName']);
        $mail->addAddress(SMTP_USERNAME);
        $mail->addReplyTo($form_data['email'], $form_data['firstName'] . ' ' . $form_data['lastName']);

        // Content
        $mail->isHTML(true);
        $domain = parse_url(home_url(), PHP_URL_HOST);
        $mail->Subject = 'Nouveau message de ' . $domain;
        $mail->Body = "<h3>Nouveau message du formulaire de contact</h3>" .
            "<p><strong>Nom:</strong> " . $form_data['firstName'] . " " . $form_data['lastName'] . "</p>" .
            "<p><strong>Courriel:</strong> " . $form_data['email'] . "</p>" .
            (!empty($form_data['phoneNumber'])
                ? "<p><strong>Téléphone:</strong> " . $form_data['phoneNumber'] . "</p>"
                : ""
            ) .
            "<p><strong>Message:</strong><br>" . nl2br(esc_html($form_data['message'])) . "</p>";

        $mail->send();
        return ['success' => true, 'message' => 'Votre message a été envoyé avec succès!'];

    } catch (Exception $e) {
        var_dump("Contact form email error: " . $mail->ErrorInfo);
        return ['success' => false, 'message' => "Erreur lors de l'envoi du message. Veuillez réessayer."];
    }
}

// Enable guest checkout (add this to your existing functions.php)
add_filter('woocommerce_checkout_registration_required', '__return_false');
add_filter('woocommerce_checkout_registration_enabled', '__return_false');

// Improve cart functionality
function improve_cart_functionality()
{
    // Always enqueue cart fragments for AJAX cart updates
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('wc-add-to-cart');
    }
}
add_action('wp_enqueue_scripts', 'improve_cart_functionality');

// Fix cart session issues
function fix_cart_session()
{
    if (class_exists('WooCommerce') && !is_admin()) {
        // Ensure WooCommerce session is started
        if (!WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }
}
add_action('wp_loaded', 'fix_cart_session');

// Add cart count to header (helper function)
function get_cart_count()
{
    if (class_exists('WooCommerce')) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

// Add cart total to header (helper function)
function get_cart_total()
{
    if (class_exists('WooCommerce')) {
        return WC()->cart->get_cart_subtotal();
    }
    return '';
}

// Custom cart fragments for header updates
function custom_cart_fragments($fragments)
{
    $cart_count = WC()->cart->get_cart_contents_count();

    // Create the cart count HTML
    $cart_count_html = '';
    if ($cart_count > 0) {
        $cart_count_html = '<span class="absolute -top-1 -right-1 flex items-center justify-center w-4 h-4 bg-red-500 text-white text-xs rounded-full ring-2 ring-white font-medium">' . $cart_count . '</span>';
    }

    $fragments['.cart-count-indicator'] = '<span class="cart-count-indicator">' . $cart_count_html . '</span>';

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'custom_cart_fragments');

// Ensure jQuery is loaded for cart functionality
function enqueue_cart_scripts()
{
    if (!is_admin()) {
        wp_enqueue_script('jquery');
        if (class_exists('WooCommerce')) {
            wp_enqueue_script('wc-cart-fragments');
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_cart_scripts');

// Custom checkout processing
function handle_custom_checkout()
{
    if (isset($_POST['woocommerce_checkout_place_order'])) {
        // Let WooCommerce handle the checkout process
        WC()->checkout()->process_checkout();
    }
}
add_action('template_redirect', 'handle_custom_checkout');

// Remove default WooCommerce checkout fields we're handling manually
function customize_checkout_fields($fields)
{
    // Keep the fields but we'll style them ourselves
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');

add_action('wp_enqueue_scripts', 'remove_woocommerce_layout_conditionally', 99);
function remove_woocommerce_layout_conditionally()
{
    // Remove only on shop pages
    if (is_woocommerce() || is_cart() || is_checkout()) {
        wp_dequeue_style('woocommerce-layout');
        wp_deregister_style('woocommerce-layout');
    }
}