<?php
// Register Programs CPT
function register_programs_cpt()
{
    register_post_type('program', [
        'label' => 'Programs',
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
}
add_action('init', 'register_programs_cpt');

// Register Careers CPT
function register_careers_cpt()
{
    register_post_type('career', [
        'label' => 'Careers',
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor'],
    ]);
}
add_action('init', 'register_careers_cpt');