<?php

// Shortcodes
function hero_shortcode() {
    ob_start();
    get_template_part('template-parts/hero');
    return ob_get_clean();
}
add_shortcode('hero', 'hero_shortcode');


function objectifs_shortcode() {
    ob_start();
    get_template_part('template-parts/objectifs');
    return ob_get_clean();
}
add_shortcode('objectifs', 'objectifs_shortcode');

// Actions
add_action('admin_menu', function() {
    // Remove Posts
    remove_menu_page('edit.php');
    // Remove Pages
    // remove_menu_page('edit.php?post_type=page');
    // Remove Comments
    remove_menu_page('edit-comments.php');
    // Remove Appearance
    // remove_menu_page('themes.php');
    // Remove Plugins
    // remove_menu_page('plugins.php');
    // Remove Tools
    remove_menu_page('tools.php');
    // Remove Settings
    // remove_menu_page('options-general.php');
    // Remove Media
    // remove_menu_page('upload.php');
    // Remove Users
    // remove_menu_page('users.php');
    // Remove Custom Post Type (example: 'collection')
    remove_menu_page('edit.php?post_type=collection');
});