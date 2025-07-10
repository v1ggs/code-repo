<?php

namespace Code_Repo;

/**
 * Detach default 'category' and 'post_tag' taxonomies from 'post' post type.
 *
 * This hides categories and tags from posts without unregistering the taxonomies globally,
 * which can break core functionality and plugins.
 *
 * What else to do:
 * - Remove or hide related UI elements separately (admin menus, meta boxes) if needed.
 *
 * What NOT to do:
 * - Do NOT unregister or unset these taxonomies globally, as it can cause unexpected issues.
 * - Avoid removing the 'post' post type itself.
 */
function remove_default_taxonomy()
{
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

add_action('init', __NAMESPACE__ . '\\remove_default_taxonomy');
