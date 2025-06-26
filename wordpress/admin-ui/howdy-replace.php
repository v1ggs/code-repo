<?php

namespace Your_Namespace;

function replace_howdy($wp_admin_bar)
{
    $current_user = wp_get_current_user();
    $greeting = 'Welcome, ' . esc_html($current_user->display_name);

    $wp_admin_bar->add_node([
        'id'    => 'my-account',
        'title' => $greeting,
    ]);
}

add_action('admin_bar_menu', __NAMESPACE__ . '\\replace_howdy', 9992);
