<?php

namespace Code_Repo;

/**
 * Fully customizes the WordPress admin menu by rebuilding the `$menu` array.
 * This allows adding, removing, and reordering top-level items, including
 * separators and CPT entries.
 *
 * How to use:
 * - Adjust the `$menu = array(...)` list to define the exact menu structure.
 * - Use numeric indexes (menu positions) to include items you want to keep.
 * - Any item not listed is effectively removed from the admin menu.
 *
 * Debugging:
 * - Enable `debug_admin_menu()` by uncommenting its `add_action` line.
 * - It prints the raw `$menu` array so you can inspect all available positions,
 *   including CPTs and reserved core positions.
 *
 * Notes:
 * - WordPress automatically merges consecutive separators.
 * - CPTs and some plugins occupy their own numeric positions; include them
 *   explicitly if you want them visible.
 */
function customize_admin_menu()
{
    global $menu;
    $menu = array(
        $menu[2], // Dashboard
        $menu[4], // Separator 1
        $menu[6], // CPT
        $menu[20], // Pages
        $menu[25], // Comments
        $menu[59], // Separator 2
        $menu[10], // Media
        $menu[70], // Users
        $menu[65], // Plugins
        $menu[75], // Tools
        $menu[80], // Settings
    );
}

add_action('admin_menu', __NAMESPACE__ . '\\customize_admin_menu');


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
