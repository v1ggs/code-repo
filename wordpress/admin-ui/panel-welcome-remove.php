<?php

namespace Code_Repo;

// Use this to hide the "Welcome Panel" for all users
function remove_welcome_panel()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('admin_init', __NAMESPACE__ . '\\remove_welcome_panel');
