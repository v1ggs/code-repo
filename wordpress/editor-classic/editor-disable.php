<?php

namespace Code_Repo;

/**
 * METHODS FOR DISABLING THE CLASSIC EDITOR
 *
 * This file lists approaches for removing the classic (TinyMCE) editor.
 * Use only the option that fits your use case.
 */

/**
 * ------------------------------------------------------------
 * OPTION A: Disable Classic Editor by omitting 'editor' support
 * ------------------------------------------------------------
 * If a post type does NOT declare 'editor' support, the classic
 * editor is removed entirely. If show_in_rest is also false,
 * Gutenberg will not load either.
 *
 * Use this for CPTs that should not have any editor UI.
 */
register_post_type('your_cpt', [
    'label' => 'Your CPT',
    'public' => true,
    'supports' => [
        'title', // include only what the CPT actually needs
    ],
    'show_in_rest' => false, // prevents Gutenberg from loading
]);



/**
 * ------------------------------------------------------------------
 * OPTION B: Remove Classic Editor support after registration
 * ------------------------------------------------------------------
 * This removes only the classic editor. If Gutenberg is enabled
 * elsewhere, it will still load unless disabled separately.
 *
 * Use this when you must modify an existing post type created
 * by core or a plugin.
 */
function remove_classic_editor_support(): void
{
    remove_post_type_support('post', 'editor');
}
add_action('init', __NAMESPACE__ . '\\remove_classic_editor_support');
