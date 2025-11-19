<?php

namespace Code_Repo;

// Customize admin footer text
// https://developer.wordpress.org/reference/hooks/admin_footer_text/
function custom_admin_footer_text()
{
    echo '<a href="' . esc_url(home_url('/')) . '" target="_blank" rel="noopener">' . esc_html(get_bloginfo('name')) . '</a>';
}

add_filter('admin_footer_text', __NAMESPACE__ . '\\custom_admin_footer_text');


// Replace WP version from admin footer
add_filter('update_footer', fn() => '<a href="https://igorvracar.com" target="_blank" rel="noopener">Developer website</a>
', 999);
