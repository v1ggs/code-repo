<?php

namespace Code_Repo;

// Uncomment to use:
// add_action( 'admin_init', __NAMESPACE__ . '\debug_full_dump' );

/**
 * Full WordPress debug dump
 * Prints admin menu, post types, taxonomies, shortcodes, scripts, styles, and current user info.
 * Scripts and styles include source URLs and dependencies.
 * Use in development only. Stops execution after printing.
 */
function debug_full_dump()
{
    global $menu, $submenu, $shortcode_tags, $wp_scripts, $wp_styles;

    $output = '<pre>';

    /**
     * Admin menus
     * Print all registered admin menus
     * Useful to check the menu slugs, titles, and capabilities.
     */
    $output .= "=== Admin Menu ===\n";
    $output .= print_r($menu, true);
    $output .= "\n=== Submenus ===\n";
    $output .= print_r($submenu, true);

    /**
     * Post types
     * Print all registered post types
     * Useful to verify custom post types, labels, and arguments.
     */
    $output .= "\n=== Registered Post Types ===\n";
    $output .= print_r(get_post_types([], 'objects'), true);

    /**
     * Taxonomies
     * Print all registered taxonomies
     * Useful to check taxonomy names, object types, and arguments.
     */
    $output .= "\n=== Registered Taxonomies ===\n";
    $output .= print_r(get_taxonomies([], 'objects'), true);

    /**
     * Shortcodes
     * Print all registered shortcodes
     * Useful to confirm shortcode names and ensure no conflicts.
     */
    $output .= "\n=== Shortcodes ===\n";
    $output .= print_r(array_keys($shortcode_tags), true);

    /**
     * Enqueued scripts
     * Print all enqueued scripts
     * Useful to see handles, sources, and dependencies.
     */
    $output .= "\n=== Enqueued Scripts ===\n";
    foreach ($wp_scripts->queue as $handle) {
        $script = $wp_scripts->registered[ $handle ];
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        $output .= $handle . " -> src: " . $script . ", deps: [" . implode(', ', array_map('esc_html', $script->deps)) . "]\n";
    }

    /**
     * Enqueued styles
     * Print all enqueued styles
     * Useful to see handles, sources, and dependencies.
     */
    $output .= "\n=== Enqueued Styles ===\n";
    foreach ($wp_styles->queue as $handle) {
        $style = $wp_styles->registered[ $handle ];
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        $output .= $handle . " -> src: " . $style . ", deps: [" . implode(', ', array_map('esc_html', $style->deps)) . "]\n";
    }

    /**
     * Current user info
     */
    $output .= "\n=== Current User ===\n";
    $current_user = wp_get_current_user();
    $output .= print_r([
        'ID' => $current_user->ID,
        'login' => $current_user->user_login,
        'roles' => $current_user->roles,
        'capabilities' => $current_user->allcaps,
    ], true);

    $output .= '</pre>';

    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    wp_die($output, 'Debug Dump'); // stops execution and shows nicely formatted output
}
