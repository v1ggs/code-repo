<?php

namespace Code_Repo;

// Uncomment to use:
// add_action('admin_init', __NAMESPACE__ . '\debug_full_dump');

/**
 * Full WordPress debug dump
 * Prints selected site information and stops execution.
 * Intended for development use only.
 */
function debug_full_dump()
{
    global $menu, $submenu, $shortcode_tags, $wp_scripts, $wp_styles;

    /**
     * Sections control
     * Set true to print, false to skip.
     */
    $sections = [
        'menus'         => true,    // Top-level admin menus
        'submenus'      => false,   // Submenus
        'post_types'   => true,     // Registered post types
        'taxonomies'   => false,    // Registered taxonomies
        'shortcodes'   => false,    // Registered shortcodes
        'scripts'      => false,    // Enqueued scripts
        'styles'       => false,    // Enqueued styles
        'blocks'       => false,    // Registered Gutenberg blocks
        'current_user' => true,     // Current user info
    ];

    $output = '<pre>';

    /**
     * Admin menus
     * Prints all registered admin menus
     * Useful to check menu slugs, titles, and capabilities.
     */
    if ($sections['menus']) {
        $output .= "=== Admin Menu ===\n";
        $output .= print_r($menu, true);
    }

    /**
     * Admin submenus
     * Prints all registered admin menus
     * Useful to check menu slugs, titles, and capabilities.
     */
    if ($sections['submenus'] && !empty($submenu)) {
        $output .= "\n=== Submenus ===\n";
        foreach ($submenu as $parent_slug => $items) {
            $output .= "Parent menu: " . $parent_slug . "\n";
            foreach ($items as $item) {
                // $item structure: [0 => title, 1 => capability, 2 => menu_slug, ...]
                $output .= "- " . $item[0] . " (slug: " . $item[2] . ", capability: " . $item[1] . ")\n";
            }
        }
    }

    /**
     * Post types
     * Print all registered post types
     * Useful to verify custom post types, labels, and arguments.
     */
    if ($sections['post_types']) {
        $output .= "\n=== Registered Post Types ===\n";
        $output .= print_r(get_post_types([], 'objects'), true);
    }

    /**
     * Taxonomies
     * Print all registered taxonomies
     * Useful to check taxonomy names, object types, and arguments.
     */
    if ($sections['taxonomies']) {
        $output .= "\n=== Registered Taxonomies ===\n";
        $output .= print_r(get_taxonomies([], 'objects'), true);
    }

    /**
     * Shortcodes
     * Print all registered shortcodes
     * Useful to confirm shortcode names and ensure no conflicts.
     */
    if ($sections['shortcodes']) {
        $output .= "\n=== Shortcodes ===\n";
        $output .= print_r(array_keys($shortcode_tags), true);
    }

    /**
     * Gutenberg blocks
     * Prints all registered Gutenberg blocks
     * Useful to see block name, title, category, and supports for debugging.
     */
    if ($sections['blocks']) {
        $output .= "\n=== Registered Gutenberg Blocks ===\n";
        if (class_exists('WP_Block_Type_Registry')) {
            $blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
            foreach ($blocks as $name => $block) {
                $output .= $name
                    . " -> title: " . ($block->title ?? 'N/A')
                    . ", category: " . ($block->category ?? 'unknown')
                    . ", supports: " . json_encode($block->supports) // phpcs:ignore
                    . "\n";
            }
        } else {
            $output .= "Gutenberg is not active or WP_Block_Type_Registry does not exist.\n";
        }
    }

    /**
     * Enqueued scripts
     * Prints all enqueued scripts
     * Useful to see handles, source URLs, and dependencies.
     */
    if ($sections['scripts']) {
        $output .= "\n=== Enqueued Scripts ===\n";
        foreach ($wp_scripts->queue as $handle) {
            $script = $wp_scripts->registered[$handle];
            $output .= $handle . " -> src: " . $script->src . ", deps: [" . implode(', ', array_map('esc_html', $script->deps)) . "]\n";
        }
    }

    /**
     * Enqueued styles
     * Prints all enqueued styles
     * Useful to see handles, source URLs, and dependencies.
     */
    if ($sections['styles']) {
        $output .= "\n=== Enqueued Styles ===\n";
        foreach ($wp_styles->queue as $handle) {
            $style = $wp_styles->registered[$handle];
            $output .= $handle . " -> src: " . $style->src . ", deps: [" . implode(', ', array_map('esc_html', $style->deps)) . "]\n";
        }
    }

    /**
     * Current user info
     * Prints ID, login, roles, and capabilities
     * Useful to check user permissions during development.
     */
    if ($sections['current_user']) {
        $output .= "\n=== Current User ===\n";
        $current_user = wp_get_current_user();
        $output .= print_r([
            'ID'           => $current_user->ID,
            'login'        => $current_user->user_login,
            'roles'        => $current_user->roles,
            'capabilities' => $current_user->allcaps,
        ], true);
    }

    $output .= '</pre>';

    // Stop execution and print the debug dump
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    die($output);
}
