<?php

namespace Code_Repo;

// The show_admin_bar filter toggles the display status of the Toolbar
// for the front side of your website (you cannot turn off the toolbar
// on the WordPress dashboard anymore).
// Returning false to this hook is the recommended way to hide the admin bar.
// The user's display preference is used for logged in users.
// https://developer.wordpress.org/reference/hooks/show_admin_bar/
add_filter('show_admin_bar', '__return_false');


// This would hide the Toolbar for all users except Administrators.
// https://developer.wordpress.org/reference/hooks/show_admin_bar/#user-contributed-notes
function hide_admin_bar($show_admin_bar)
{
    // You can check against specific roles instead of capabilities, but it's not recommended—
    // the results might not be reliable in all cases.
    // More details: https://wordpress.org/documentation/article/roles-and-capabilities/#capability-vs-role-table
    return ( current_user_can('manage_options') ) ? $show_admin_bar : false;
}

add_filter('show_admin_bar', __NAMESPACE__ . '\\hide_admin_bar');
