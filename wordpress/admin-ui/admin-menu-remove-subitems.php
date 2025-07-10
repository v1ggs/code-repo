<?php

namespace Code_Repo;

function remove_admin_menu_subitems()
{
    // See `admin-menu-remove-items.php` for available pages, or hover over a menu item in
    // the admin to see its URL (e.g. themes.php) — that's the page slug used for menu removal.
    // Then use (uncomment/remove DEBUG_START/DEBUG_END) the code below to see the page's available submenus.

    /****** DEBUG_START *****

    ?>
    <pre><?php
        global $submenu;
        // Add your page here:
        var_dump($submenu['themes.php']);
        exit; ?>
    </pre><?php

    ***** DEBUG_END ******/

    // Remove all but "Menus" from "Appearance":
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'site-editor.php');
    remove_submenu_page('themes.php', 'customize.php?return=%2Fwordpress%2Fwp-admin%2Fedit.php');
}

add_action('admin_menu', __NAMESPACE__ . '\\remove_admin_menu_subitems');
