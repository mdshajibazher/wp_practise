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
        add_filter('manage_pages_columns',[$this,'column_demo_pages_operations']);
    
        add_action('manage_posts_custom_column', [$this,'column_demo_custom_column'],10,2);
        add_action('manage_pages_custom_column', [$this,'column_demo_pages_column'],10,2);
        //filter
        add_action('restrict_manage_posts',[$this,'demo_filter']);
        add_action('pre_get_posts',[$this,'filtered_data']);

        add_action('restrict_manage_posts',[$this,'thumbnail_filter']);
        add_action('pre_get_posts',[$this,'thumbnail_filtered_data']);
       
    }


    function thumbnail_filter(){
        if(isset($_GET['post_type'])   && $_GET['post_type'] != 'post'){
            return;
        }


        $values = array(
            0 => 'Thumbnail Status',
            1 => 'Has Thumbnail',
            2 => 'No Thumbnail',
        ); ?>


        <select name="thumbnail_filter" id="">
        <?php 
        foreach($values as $key => $value){ ?>
            <option value="<?php echo  $key ?>" <?php echo isset( $_GET['thumbnail_filter'])  && $_GET['thumbnail_filter'] == $key ? 'selected' : '' ?>><?php echo  $value ?></option>
        <?php } ?>
        
        </select>
        <?php 
    }

    
    function thumbnail_filtered_data($wp_query){
        if(!is_admin()){
            return;
        }

        $filter_value = isset($_GET['thumbnail_filter']) ? $_GET['thumbnail_filter'] : '';
        if($filter_value == 1){
            $wp_query = $wp_query->set('meta_query',
            [
                [
                    'key'=> '_thumbnail_id',
                    'compare' => 'EXISTS', 
                ]
            ]);
        }else if($filter_value == 2){
            $wp_query = $wp_query->set('meta_query',
            [
                [
                    'key'=> '_thumbnail_id',
                    'compare' => 'NOT EXISTS', 
                ]
            ]);
        } 

    }

    function filtered_data($wp_query){
        if(!is_admin()){
            return;
        }

        $filter_value = isset($_GET['demo_filter']) ? $_GET['demo_filter'] : '';
        if($filter_value == 1){
            $wp_query = $wp_query->set('post__in', array(78,75,72));
        }else if($filter_value == 2){
            $wp_query = $wp_query->set('post__in', array(31,25,29));
        } 

    }


    function demo_filter(){
        if(isset($_GET['post_type'])   && $_GET['post_type'] != 'post'){
            return;
        }
        $values = array(
            0 => 'Select',
            1 => 'Last Favorite Three',
            2 => 'First Favorite Three',
        ); ?>
        <select name="demo_filter" id="">
        <?php 
        foreach($values as $key => $value){ ?>
            <option value="<?php echo  $key ?>" <?php echo isset( $_GET['demo_filter']) &&  $_GET['demo_filter'] == $key ? 'selected' : '' ?>><?php echo  $value ?></option>
        <?php } ?>
        
        </select>
        <?php 
 
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
        }else if($column == 'word_count'){
            $post = get_post($post_id);
            $content = $post->post_content;
            $word_count = str_word_count(strip_tags($content));
            // echo "2323";
            echo $word_count;
        }
     }

     
     function column_demo_pages_column($column, $post_id){
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
        $columns['word_count'] = __('Word Count','column-demo');
        return $columns;
     }


     function column_demo_pages_operations($columns){
        $columns['id'] = __('Page ID','column-demo');
        $columns['thumbnail'] = __('Thumbnail','column-demo');
        return $columns;
     }
  

 }
new ColumnDemo;



