<?php

namespace Your_Namespace;

// Use this page to generate a custom color scheme:
// https://wpadmincolors.com/generate
function wpacg_custom_admin_color_scheme()
{
    //Get the theme directory
    $theme_dir = get_stylesheet_directory_uri();

    //Custom Color Scheme
    wp_admin_css_color(
        'custom', // color scheme ID
        __('Custom Color Scheme'), // color scheme name
        $theme_dir . '/custom.css', // URL to the custom CSS file
        array( '#363b3f', '#fff', '#e14d43' , '#69a8bb') // colors to show in the picker
    );
}

add_action('admin_init', __NAMESPACE__ . '\\wpacg_custom_admin_color_scheme');
