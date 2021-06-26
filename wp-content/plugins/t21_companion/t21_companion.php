<?php
/**   
 * Plugin Name: T21 Companion
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: some test shortcode
 * Author: pappu
 * Text Domain: t21-companion
 * Domain Path: '/languages' 
 * **/


function cptui_register_my_cpts_book() {

/**
 * Post Type: Books.
 */

$labels = [
    "name" => __( "Books", "twentytwentyone" ),
    "singular_name" => __( "book", "twentytwentyone" ),
    "all_items" => __( "My Books", "twentytwentyone" ),
    "featured_image" => __( "Book Cover", "twentytwentyone" ),
];

$args = [
    "label" => __( "Books", "twentytwentyone" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => "books",
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => true,
    "rewrite" => [ "slug" => "book", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "excerpt", "page-attributes" ],
    "show_in_graphql" => false,
];

register_post_type( "book", $args );
}

add_action( 'init', 'cptui_register_my_cpts_book' );
