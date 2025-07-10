<?php

namespace Your_Namespace;

// Use this to hide the "Screen Options" panel everywhere.
add_filter('screen_options_show_screen', '__return_false');

// Use this to hide the "Screen Options" panel for all users except Administrator.
function hide_screen_options_panel()
{
    if (!current_user_can('manage_options')) {
        return false;
    }

    return true;
}

add_filter('screen_options_show_screen', __NAMESPACE__ . '\\hide_screen_options_panel');
