<?php

$labels = array(
    'name' => _x( 'Reminder', 'post type general name', 'svkjremindr' ),
    'singular_name' => _x( 'Reminder', 'post type singular name', 'svkjremindr' ),
    'menu_name' => _x( 'Reminder', 'admin menu', '' ),
    'name_admin_bar' => _x( 'Reminder', 'add new on admin bar', 'svkjremindr' ),
    'add_new' => _x( 'Add New', 'book', 'svkjremindr' ),
    'add_new_item' => __( 'Add New Reminder', 'svkjremindr' ),
    'new_item' => __( 'New Reminder', 'svkjremindr' ),
    'edit_item' => __( 'Edit Reminder', 'svkjremindr' ),
    'view_item' => __( 'View Reminder', 'svkjremindr' ),
    'all_items' => __( 'All Reminders', 'svkjremindr' ),
    'search_items' => __( 'Search Reminders', 'svkjremindr' ),
    'parent_item_colon' => __( 'Parent Reminder:', 'svkjremindr' ),
    'not_found' => __( 'No reminders found.', 'svkjremindr' ),
    'not_found_in_trash' => __( 'No reminders found in Trash.', 'svkjremindr' )
);

$args = array(
    'labels' => $labels,
    'description' => __( 'Description (TODO).', 'svkjremindr' ),
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'reminder' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 25,
    'supports' => array( 'title', 'author', 'comments' )
);

register_post_type( 'svkj-remindr', $args );

return 'svkj-remindr';