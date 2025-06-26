<?php

namespace Your_Namespace;

// Remove customizer options.
function remove_customizer_options($wp_customize)
{
    $wp_customize->remove_panel('themes'); // Change Theme panel
    $wp_customize->remove_section('title_tagline'); // Site Identity
    $wp_customize->remove_panel('nav_menus'); // Menus
    $wp_customize->remove_panel('widgets'); // Widgets
    $wp_customize->remove_section('static_front_page'); // Homepage Settings
    $wp_customize->remove_control('custom_css'); // Additional CSS
}

add_action('customize_register', __NAMESPACE__ . '\\remove_customizer_options', 50);
