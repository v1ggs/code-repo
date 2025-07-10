<?php

namespace Code_Repo;

/**
 * NOTE:
 * This filter does not remove blocks, it just hides them from the inserter.
 * This ensures no errors occur, when a hidden block is found in the content.
 */

/**
 * @see https://developer.wordpress.org/reference/hooks/allowed_block_types_all/#user-contributed-notes
 */
function allowed_post_type_blocks_per_post_type($allowed_block_types, $editor_context)
{
    if ('news' === $editor_context->post->post_type) {
        return array(
            'core/paragraph',
            'core/quote',
        );
    }

    if ('faqs' === $editor_context->post->post_type) {
        return array(
            'core/paragraph',
            'core/buttons',
        );
    }

    return $allowed_block_types;
}

add_filter('allowed_block_types_all', __NAMESPACE__ . '\\allowed_post_type_blocks_per_post_type', 10, 2);
