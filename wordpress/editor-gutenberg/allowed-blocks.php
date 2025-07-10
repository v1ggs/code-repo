<?php

namespace Your_Namespace;

/**
 * NOTE:
 * This filter does not remove blocks, it just hides them from the inserter.
 * This ensures no errors occur, when a hidden block is found in the content.
 * @see https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#hiding-blocks-from-the-inserter
 */
function filter_allowed_block_types_when_post_provided($allowed_block_types, $editor_context)
{
    /**
     * Check this list for updates. Blocks get added and removed.
     *
     * @see https://wordpress.org/documentation/article/blocks-list/
     * @see https://developer.wordpress.org/block-editor/reference-guides/core-blocks/
     */
    $allowed_blocks = [
        // ==============
        // Text blocks
        // ==============
        'core/paragraph',
        // 'core/heading',
        // 'core/list',
        // 'core/quote',
        // 'core/code',
        // 'core/details',
        // 'core/preformatted',
        // 'core/pullquote',
        // 'core/table',
        // 'core/verse',
        // 'core/freeform', // classic editor

        // ==============
        // Media blocks
        // ==============
        // 'core/image',
        // 'core/gallery',
        // 'core/audio',
        // 'core/cover',
        // 'core/file',
        // 'core/media-text',
        // 'core/video',

        // ==============
        // Design blocks
        // ==============
        // 'core/buttons',
        // 'core/columns',
        // 'core/group',
        // 'core/row',
        // 'core/stack',
        // 'core/more',
        // 'core/nextpage', // page break
        // 'core/separator',
        // 'core/spacer',

        // ==============
        // Widgets blocks
        // ==============
        // 'core/archives',
        // 'core/calendar',
        // 'core/categories',
        // 'core/html',
        // 'core/latest-comments',
        // 'core/latest-posts',
        // 'core/page-list',
        // 'core/rss',
        // 'core/search',
        // 'core/shortcode',
        // 'core/social-links',
        // 'core/tag-cloud',

        // ==============
        // Theme blocks
        // ==============
        // 'core/navigation',

        // ==============
        // Embed blocks
        // ==============
        // 'core/embed',
        // 'core-embed/twitter',
        // 'core-embed/youtube',
        // 'core-embed/wordpress',
        // 'core-embed/soundcloud',
        // 'core-embed/spotify',
        // 'core-embed/flickr',
        // 'core-embed/vimeo',
        // 'core-embed/animoto',
        // 'core-embed/cloudup',
        // 'core-embed/crowdsignal',
        // 'core-embed/dailymotion',
        // 'core-embed/imgur',
        // 'core-embed/issuu',
        // 'core-embed/kickstarter',
        // 'core-embed/mixcloud',
        // 'core-embed/pocket-casts',
        // 'core-embed/reddit',
        // 'core-embed/reverbnation',
        // 'core-embed/screencast',
        // 'core-embed/scribd',
        // 'core-embed/slideshare',
        // 'core-embed/smugmug',
        // 'core-embed/speaker',
        // 'core-embed/tiktok',
        // 'core-embed/ted',
        // 'core-embed/tumblr',
        // 'core-embed/videopress',
        // 'core-embed/wordpress-tv',
        // 'core-embed/amazon-kindle',
        // 'core-embed/pinterest',
        // 'core-embed/wolfram',

        /**
         * Removed:
         * 'core-embed/facebook',
         * 'core-embed/instagram'
         * @see https://gutenbergtimes.com/embed-blocks-for-facebook-and-instagram-will-be-removed-for-wp-5-6/
         */
    ];

    if (! empty($editor_context->post)) {
        return $allowed_blocks;
    }

    return $allowed_block_types;
}

add_filter('allowed_block_types_all', __NAMESPACE__ . '\\filter_allowed_block_types_when_post_provided', 10, 2);
