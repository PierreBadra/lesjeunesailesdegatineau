<?php
function mytheme_enqueue_styles()
{
  wp_enqueue_style('mytheme-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

// Register navigation menu
function mytheme_register_menus()
{
  register_nav_menus([
    'main-menu' => __('Main Menu', 'mytheme')
  ]);
}
add_action('after_setup_theme', 'mytheme_register_menus');