<?php

namespace Code_Repo;

/**
 * Adds a standalone top-level “Menus” entry to the admin sidebar.
 * This exposes `nav-menus.php` without requiring users to open
 * the Appearance menu first.
 *
 * The page is registered at position 28, before the standard
 * Appearance → Menus location.
 *
 * Debugging:
 * - Uncomment the `debug_admin_menu()` hook to inspect the current
 *   `$menu` array and verify the final menu structure.
 */
function add_edit_menus_page()
{
    add_menu_page(
        'Menus',
        'Menus',
        'edit_theme_options',
        'nav-menus.php',
        '',
        'dashicons-menu',
        28
    );
}

add_action('admin_menu', __NAMESPACE__ . '\\add_edit_menus_page', 9);


// Debug hook: comment out the line below when not debugging.
// add_action('admin_menu', __NAMESPACE__ . '\\debug_admin_menu', 1);
function debug_admin_menu()
{
    global $menu;

    echo '<pre>';
    var_dump($menu);
    echo '</pre>';
    exit;
}


// https://developer.wordpress.org/reference/functions/register_post_type/#menu_position

/*
    Core positions:
    2. Dashboard
    4. Separator
    5. Posts
    10. Media
    15. Links
    20. Pages
    25. Comments
    59. Separator
    60. Appearance
    65. Plugins
    70. Users
    75. Tools
    80. Settings
*/
