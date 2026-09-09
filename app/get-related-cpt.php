<?php

function getRelatedCPT($custom_post_type, $num_post_show) {
    $current_post_id = get_the_ID();
    $post_categories = get_the_terms($current_post_id, 'category');
    $post_tags = get_the_terms($current_post_id, 'post_tag');

    $category_ids = array();
    if ($post_categories && !is_wp_error($post_categories)) {
        $category_ids = wp_list_pluck($post_categories, 'term_id');
    }

    $tag_ids = array();
    if ($post_tags && !is_wp_error($post_tags)) {
        $tag_ids = wp_list_pluck($post_tags, 'term_id');
    }

    $related_posts = null;

    if (!empty($category_ids) && !empty($tag_ids)) {
        $args_phase1 = array(
            'post_type'      => $custom_post_type,
            'post_status'    => 'publish',
            'posts_per_page' => $num_post_show,
            'post__not_in'   => array($current_post_id),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $category_ids,
                    'operator' => 'AND',
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id',
                    'terms'    => $tag_ids,
                    'operator' => 'IN',
                ),
            ),
        );
        $related_posts = new WP_Query($args_phase1);
    }

    if ((!$related_posts || !$related_posts->have_posts()) && (!empty($category_ids) || !empty($tag_ids))) {
        $args_phase2 = array(
            'post_type'      => $custom_post_type,
            'post_status'    => 'publish',
            'posts_per_page' => $num_post_show,
            'post__not_in'   => array($current_post_id),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $args_phase2['tax_query'] = array('relation' => 'OR');

        if (!empty($category_ids)) {
            $args_phase2['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category_ids,
            );
        }

        if (!empty($tag_ids)) {
            $args_phase2['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tag_ids,
            );
        }
        $related_posts = new WP_Query($args_phase2);
    }

    if (!$related_posts || !$related_posts->have_posts()) {
        $args_phase3 = array(
            'post_type'      => $custom_post_type,
            'post_status'    => 'publish',
            'posts_per_page' => $num_post_show,
            'post__not_in'   => array($current_post_id),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $related_posts = new WP_Query($args_phase3);
    }

    return $related_posts;
}
