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
        $cart_count_html = '<span class="absolute -top-2 -right-2 flex items-center justify-center w-4 h-4 bg-red-500 text-white text-xs rounded-full font-medium">' . $cart_count . '</span>';
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

add_action('wp_enqueue_scripts', 'remove_woocommerce_layout_conditionally', 100);
function remove_woocommerce_layout_conditionally()
{
    // Remove only on shop pages
    if (is_woocommerce() || is_cart() || is_checkout()) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce-general');
    }
}



// TESTING SOMETING
add_action('wp_ajax_update_cart_quantity', 'handle_update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'handle_update_cart_quantity');

function handle_update_cart_quantity()
{
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'update_cart_quantity')) {
        wp_die('Security check failed');
    }

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(['message' => 'WooCommerce not active']);
        return;
    }

    $cart_key = sanitize_text_field($_POST['cart_key']);
    $quantity = intval($_POST['quantity']);

    if (empty($cart_key) || $quantity < 0) {
        wp_send_json_error(['message' => 'Invalid parameters']);
        return;
    }

    try {
        // Update cart quantity
        $updated = WC()->cart->set_quantity($cart_key, $quantity, true);

        if ($updated) {
            // Get cart item to calculate item total
            $cart_item = WC()->cart->get_cart_item($cart_key);
            $item_total = '';

            if ($cart_item && $quantity > 0) {
                $_product = $cart_item['data'];
                $item_total = WC()->cart->get_product_subtotal($_product, $quantity);
            }

            wp_send_json_success([
                'message' => 'Quantité mise à jour',
                'new_quantity' => $quantity,
                'item_total' => $item_total,
                'cart_subtotal' => WC()->cart->get_cart_subtotal(),
                'cart_total' => WC()->cart->get_total(),
                'tax_total' => wc_price(WC()->cart->get_taxes_total()),
                'cart_count' => WC()->cart->get_cart_contents_count()
            ]);
        } else {
            wp_send_json_error(['message' => 'Impossible de mettre à jour la quantité']);
        }
    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
}

// AJAX handler for removing cart item
add_action('wp_ajax_remove_cart_item', 'handle_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'handle_remove_cart_item');

function handle_remove_cart_item()
{
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'remove_cart_item')) {
        wp_die('Security check failed');
    }

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(['message' => 'WooCommerce not active']);
        return;
    }

    $cart_key = sanitize_text_field($_POST['cart_key']);

    if (empty($cart_key)) {
        wp_send_json_error(['message' => 'Invalid cart key']);
        return;
    }

    try {
        // Remove item from cart
        $removed = WC()->cart->remove_cart_item($cart_key);

        if ($removed) {
            wp_send_json_success([
                'message' => 'Article supprimé',
                'cart_subtotal' => WC()->cart->get_cart_subtotal(),
                'cart_total' => WC()->cart->get_total(),
                'tax_total' => wc_price(WC()->cart->get_taxes_total()),
                'cart_count' => WC()->cart->get_cart_contents_count()
            ]);
        } else {
            wp_send_json_error(['message' => 'Impossible de supprimer l\'article']);
        }
    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
}

// Optional: Add some styling for loading states
add_action('wp_head', 'cart_custom_styles');
function cart_custom_styles()
{
    if (is_page_template('page-panier.php')) { // Adjust template name as needed
        ?>
        <style>
            .cart-item.updating {
                opacity: 0.6;
                pointer-events: none;
            }

            .quantity-display {
                min-width: 2rem;
                text-align: center;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }

            .cart-item.updating .quantity-display {
                animation: pulse 1s infinite;
            }
        </style>
        <?php
    }
}

add_filter('woocommerce_checkout_fields', function ($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            $field['input_class'][] = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors';
            $field['label_class'][] = 'block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed';
        }
    }
    return $fields;
});