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
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

// Filters
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <span id="cart-dot-indicator">
        <?php if (WC()->cart->get_cart_contents_count() > 0): ?>
            <span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
        <?php endif; ?>
    </span>
    <?php
    $fragments['#cart-dot-indicator'] = ob_get_clean();
    return $fragments;
});


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