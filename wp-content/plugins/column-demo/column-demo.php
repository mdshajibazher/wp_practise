<?php
/**   
 * Plugin Name: Column Demo
 * Plugin URI: test.com
 * Version: 1.0.0
 * Description: raw code for column demo
 * Author: pappu
 * Text Domain: column-demo
 * Domain Path: '/languages' 
 * **/

 class ColumnDemo{

    public function __construct(){
        add_action('plugins_loaded',[$this,'column_demo_bootstrap']);
        add_filter('manage_posts_columns',[$this,'column_demo_operations']);
        add_action('manage_posts_custom_column', [$this,'column_demo_custom_column'],10,2);
    }

    function column_demo_bootstrap(){
        load_plugin_textdomain('column-demo', false, dirname(__FILE__).'/languages');
     }

     function column_demo_custom_column($column, $post_id){
        if($column == 'id'){
            echo $post_id;
        }else if($column == 'thumbnail'){
            $thumbnail = get_the_post_thumbnail($post_id,array(50,50));
            echo $thumbnail;
        }
     }

    function column_demo_operations($columns){
        unset( $columns['tags'] );
        $columns['id'] = __('Post ID','column-demo');
        $columns['thumbnail'] = __('Thumbnail','column-demo');
        return $columns;
     }
  

 }
new ColumnDemo;



