<?php
function my_hero_shortcode() {
    ob_start();
    get_template_part('template-parts/hero');
    return ob_get_clean();
}
add_shortcode('hero', 'my_hero_shortcode');