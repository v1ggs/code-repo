<?php

namespace Code_Repo;

function configure_custom_permalinks()
{
    /**
     * Only one structure should be active at a time. Comment/uncomment the one you want.
     */

    // Default: Plain
    // $permalink_structure = '';

    // Day and name
    // $permalink_structure = '/%year%/%monthnum%/%day%/%postname%/';

    // Month and name
    // $permalink_structure = '/%year%/%monthnum%/%postname%/';

    // Numeric
    // $permalink_structure = '/archives/%post_id%';

    // Post name (recommended for SEO)
    $permalink_structure = '/%postname%/';

    // Custom structures examples:
    // Category + post name
    // $permalink_structure = '/%category%/%postname%/';
    // Author + post name
    // $permalink_structure = '/author/%author%/%postname%/';
    // Custom prefix + post name
    // $permalink_structure = '/blog/%postname%/';

    // Apply the structure
    update_option('permalink_structure', $permalink_structure);

    // Flush rewrite rules
    flush_rewrite_rules();
}

// Run once on theme activation
add_action('after_switch_theme', __NAMESPACE__ . '\\configure_custom_permalinks');
// after_setup_theme fires before init, so if you try to flush rewrite rules or set permalinks there,
// WordPress might not have fully initialized its rewrite rules yet.
// In practice, most setups load everything early enough that update_option('permalink_structure')
// doesn’t fail, and flush_rewrite_rules() works—but it’s not 100% foolproof in all environments.
// The safe approach for changing permalinks is either:
// - Hook into init for immediate effect.
// - Hook into a one-time event, like after_switch_theme (theme activation) or plugin activation.
