<?php

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
