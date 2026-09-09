<?php

/**
 * Register theme custom post types and shared taxonomies.
 */

/**
 * Add existing Categories and Tags to Pages.
 */
function add_categories_and_tags_to_pages() {
    register_taxonomy_for_object_type('category', 'page');
    register_taxonomy_for_object_type('post_tag', 'page');

    if (post_type_exists('reviews')) {
        register_taxonomy_for_object_type('category', 'reviews');
        register_taxonomy_for_object_type('post_tag', 'reviews');
    }
}
add_action('init', 'add_categories_and_tags_to_pages');

/**
 * Register all theme custom post types.
 */
function register_theme_post_types() {
    $post_types = [
        'reviews' => [
            'labels' => [
                'name' => 'Reviews',
                'singular_name' => 'Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Review',
                'edit_item' => 'Edit Review',
                'new_item' => 'New Review',
                'view_item' => 'View Review',
                'search_items' => 'Search Reviews',
                'not_found' => 'No reviews found',
                'not_found_in_trash' => 'No reviews found in Trash',
            ],
            'menu_icon' => 'dashicons-star-filled',
            'rewrite' => ['slug' => 'reviews', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        ],
        'text-review' => [
            'labels' => [
                'name' => 'Text Reviews',
                'singular_name' => 'Text Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Text Review',
                'edit_item' => 'Edit Text Review',
                'new_item' => 'New Text Review',
                'view_item' => 'View Text Review',
                'search_items' => 'Search Text Reviews',
                'not_found' => 'No text reviews found',
                'not_found_in_trash' => 'No text reviews found in Trash',
            ],
            'menu_icon' => 'dashicons-format-quote',
            'rewrite' => ['slug' => 'text-review', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        ],
        'case_result' => [
            'labels' => [
                'name' => 'Case Results',
                'singular_name' => 'Case Result',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Case Result',
                'edit_item' => 'Edit Case Result',
                'new_item' => 'New Case Result',
                'view_item' => 'View Case Result',
                'search_items' => 'Search Case Results',
                'not_found' => 'No case results found',
                'not_found_in_trash' => 'No case results found in Trash',
            ],
            'menu_icon' => 'dashicons-awards',
            'rewrite' => ['slug' => 'case-results', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        ],
       'team_member' => [
    'labels' => [
        'name' => 'Team Members',
        'singular_name' => 'Team Member',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Team Member',
        'edit_item' => 'Edit Team Member',
        'new_item' => 'New Team Member',
        'view_item' => 'View Team Member',
        'search_items' => 'Search Team Members',
        'not_found' => 'No team members found',
        'not_found_in_trash' => 'No team members found in Trash',
    ],

    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,

    'menu_icon' => 'dashicons-id',

    'rewrite' => [
        'slug' => 'team-members',
        'with_front' => false,
        'feeds' => true,
    ],

    'has_archive' => true,

    'supports' => [
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        'revisions',
        'page-attributes',
    ],

    'hierarchical' => true,
],

    ];

    foreach ($post_types as $post_type => $config) {
        if (post_type_exists($post_type)) {
            continue;
        }

        register_post_type($post_type, [
            'labels' => $config['labels'],
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => $config['rewrite'],
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => $config['hierarchical'] ?? false,
            'menu_position' => 5,
            'supports' => $config['supports'],
            'show_in_rest' => true,
            'menu_icon' => $config['menu_icon'],
            'taxonomies' => ['category', 'post_tag'],
        ]);
    }
}
add_action('init', 'register_theme_post_types');
