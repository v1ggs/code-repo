<?php

namespace Code_Repo;

// Customize admin footer text
// https://developer.wordpress.org/reference/hooks/admin_footer_text/
function custom_admin_footer_text()
{
    echo '<a href="https://example.com/" target="_blank">Footer text here.</a>';
}

add_filter('admin_footer_text', __NAMESPACE__ . '\\custom_admin_footer_text');


// Remove WP version from admin footer
add_filter('update_footer', fn() => '', 999);
