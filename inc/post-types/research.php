<?php
add_action('init', 'post_type_research');
function post_type_research(){
    $labels = array(
        'name'          => __('Researches'),
        'singular_name' => __('Research'),
        'menu_name'     => __('Research'),
        'add_new'       => __('Add Research Topic', 'New Research Topic'),
        'add_new_item'  => __('New Research Topic'),
        'edit_item'     => __('Edit Research Topic'),
        'new_item'      => __('New Research Topic'),
        'view_item'     => __('View New Research Topic')
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => false,
        'show_in_menu'  => true,
        'menu_position' => 23,
        'menu_icon'     => 'dashicons-welcome-learn-more',
        'supports'      => array('title', 'editor', 'thumbnail')
    );
    register_post_type('research', $args );
}
add_action('init', 'taxonomy_research');
function taxonomy_research(){
    $labels = array(
        'name' => _x( 'Researches Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Research Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Category' ),
    );
    $args = array(
        'hierarchical'      => false,
        'label'             => __( 'Category' ),
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_tag_cloud' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'          => 'research/categories',
            'with_front'    => false,
        ),
    );
    register_taxonomy( 'research_category', 'research', $args );
}