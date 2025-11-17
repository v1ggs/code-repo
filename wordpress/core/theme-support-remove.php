<?php

namespace Code_Repo;

/**
 * Disable unused theme supports
 * remove_theme_support() only has an effect if the feature was previously added (by your theme or a parent theme).
 * If you never call add_theme_support() for something, there’s nothing to remove, so those calls are unnecessary.
 * It’s only useful if you’re working off a parent theme or a starter theme that adds features you don’t want.
 */
function remove_theme_supports()
{
    // Visual/appearance features
    remove_theme_support('custom-header');
    remove_theme_support('custom-background');
    remove_theme_support('custom-logo');
    remove_theme_support('post-formats');
    remove_theme_support('title-tag');  // only if you handle titles manually
    remove_theme_support('html5');      // only if you don't need HTML5 outputs
    remove_theme_support('post-thumbnails');

    // Feeds
    remove_theme_support('automatic-feed-links');

    // Gutenberg/FSE
    remove_action('init', 'wp_initialize_theme_preview'); // just in case

    // Other
    remove_theme_support('widgets'); // rarely used
    remove_theme_support('align-wide'); // only relevant for Gutenberg
}

add_action('after_setup_theme', __NAMESPACE__ . '\\remove_theme_supports');
