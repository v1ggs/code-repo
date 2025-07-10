<?php

namespace Code_Repo;

function hide_help_panel($panel, $screen_id, $screen)
{
    $screen->remove_help_tabs();
    return $panel;

    // To target a specific screen (e.g., 'post', 'dashboard', 'edit-post')
    // if ($screen_id === 'dashboard') {
    //     $screen->remove_help_tabs();
    // }
}

add_filter('contextual_help', __NAMESPACE__ . '\\hide_help_panel', 999, 3);
