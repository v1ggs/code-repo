<?php

namespace Code_Repo;

// Dequeue jQuery and jQuery-migrate on front-end.
function dequeue_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-migrate');
    }
}

add_filter('wp_enqueue_scripts', __NAMESPACE__ . '\\dequeue_jquery', 100);
