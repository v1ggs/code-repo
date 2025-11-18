<?php

namespace Code_Repo;

/**
 * https://github.com/johnbillion/extended-cpts#usage
 * https://github.com/johnbillion/extended-cpts/wiki
 *
 * Extended CPTs is a library which provides extended functionality to WordPress custom post types
 * and taxonomies.
 * This allows developers to quickly build post types and taxonomies without having to write the same
 * code again and again.
 * Extended CPTs works with both the block editor and the classic editor.
 *
 * Installation:
 *
 * composer require johnbillion/extended-cpts
 *
 * Other means of installation or usage, particularly bundling within a plugin, is not officially
 * supported and done at your own risk.
 *
 * The register_extended_post_type() and register_extended_taxonomy() functions are ultimately
 * wrappers for the register_post_type() and register_taxonomy() functions in WordPress core,
 * so any of the parameters from those functions can be used.
 *
 * https://github.com/johnbillion/extended-cpts/wiki/Registering-Post-Types
 * https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * https://github.com/johnbillion/extended-cpts/wiki/Registering-taxonomies
 * https://developer.wordpress.org/reference/functions/register_taxonomy/
 */


/**
 * The following registers:
 *
 * - A 'Stories' post type, with correctly generated labels and post updated messages,
 *   three custom columns in the admin area (two of which are sortable),
 *   stories added to the main RSS feed, and all stories displayed on the post type archive.
 *
 * - A 'Genre' taxonomy attached to the 'Stories' post type, with correctly generated labels and
 *   term updated messages, and a custom column in the admin area.
 */
add_action( 'init', function() {
	register_extended_post_type( 'story', [

		# Add the post type to the site's main RSS feed:
		'show_in_feed' => true,

		# Show all posts on the post type archive:
		'archive' => [
			'nopaging' => true,
		],

		# Add some custom columns to the admin screen:
		'admin_cols' => [
			'story_featured_image' => [
				'title'          => 'Illustration',
				'featured_image' => 'thumbnail'
			],
			'story_published' => [
				'title_icon'  => 'dashicons-calendar-alt',
				'meta_key'    => 'published_date',
				'date_format' => 'd/m/Y'
			],
			'story_genre' => [
				'taxonomy' => 'genre'
			],
		],

		# Add some dropdown filters to the admin screen:
		'admin_filters' => [
			'story_genre' => [
				'taxonomy' => 'genre'
			],
			'story_rating' => [
				'meta_key' => 'star_rating',
			],
		],

	], [

		# Override the base names used for labels:
		'singular' => 'Story',
		'plural'   => 'Stories',
		'slug'     => 'stories',

	] );

	register_extended_taxonomy( 'genre', 'story', [

		# Use radio buttons in the meta box for this taxonomy on the post editing screen:
		'meta_box' => 'radio',

		# Add a custom column to the admin screen:
		'admin_cols' => [
			'updated' => [
				'title_cb'    => function() {
					return '<em>Last</em> Updated';
				},
				'meta_key'    => 'updated_date',
				'date_format' => 'd/m/Y'
			],
		],

	] );
} );
