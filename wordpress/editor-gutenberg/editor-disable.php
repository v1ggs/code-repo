<?php

namespace Code_Repo;

/**
 * METHODS FOR DISABLING GUTENBERG (BLOCK EDITOR)
 *
 * This file lists multiple approaches. Use only the one that fits your use case.
 * Notes describe scope and limitations of each approach.
 */

/**
 * -------------------------------------------------------
 * OPTION A: Disable Gutenberg for a CPT by not enabling it
 * -------------------------------------------------------
 * Gutenberg loads only when:
 *   - the post type supports 'editor', and
 *   - show_in_rest is true.
 *
 * If you omit 'editor' AND set show_in_rest to false,
 * the CPT has no editor at all (neither block nor classic).
 *
 * Use this for custom post types that should not be editable via UI.
 */
register_post_type('your_cpt', [
    'label' => 'Your CPT',
    'public' => true,
    'supports' => [
        'title',                // keep only what you really need
        // 'editor',            // leave out to disable Classic Editor
        // 'thumbnail',
        // 'excerpt',
        // 'custom-fields',
    ],
    'show_in_rest' => false,    // prevents Gutenberg from loading
]);



/**
 * ------------------------------------------------------------------
 * OPTION B: Disable Gutenberg for specific post types via a filter
 * ------------------------------------------------------------------
 * This filter controls ONLY the block editor.
 * It does NOT remove Classic Editor availability.
 *
 * Use this when you want the classic editor for some post types,
 * but Gutenberg for others.
 *
 * NOT suitable when the post type should have no editor at all.
 */
function disable_gutenberg_for_post_type(bool $use_block_editor, string $post_type): bool
{
    if ($post_type === 'post') {
        return false; // disable Gutenberg for posts only
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', __NAMESPACE__ . '\\disable_gutenberg_for_post_type', 10, 2);



/**
 * ---------------------------------------------------------
 * OPTION C: Disable Gutenberg globally (all post types)
 * ---------------------------------------------------------
 * Completely disables Gutenberg everywhere.
 * Classic Editor remains available for all post types that support it.
 *
 * Use this only if the project never uses Gutenberg.
 */
add_filter('use_block_editor_for_post', '__return_false', 100);
