<?php

namespace Code_Repo;

/**
 * Admin menu already includes two separators.
 * Use this function to add others; WordPress removes consecutive duplicates.
 *
 * `$menu[number]` = menu position in the admin sidebar.
 * Some positions are reserved. Registered CPTs also occupy positions,
 * so avoid placing separators on any of those.
 *
 * Use `debug_admin_menu()` to inspect the positions.
 */
function add_admin_menu_separators()
{
    global $menu;
    $menu[16] = ['', 'read', 'separator3', '', 'wp-menu-separator'];
    $menu[64] = ['', 'read', 'separator4', '', 'wp-menu-separator'];
}

add_action('admin_menu', __NAMESPACE__ . '\\add_admin_menu_separators', 9);


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
