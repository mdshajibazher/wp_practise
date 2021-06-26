<?php
/**   
 * Plugin Name: Quick Tags
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: display qr code under every posts
 * Author: pappu
 * Text Domain: test-quick-tags
 * Domain Path: '/languages' 
 * **/

 class TestQuickTags{

    function __construct(){
        add_action('admin_enqueue_scripts',[$this,'qtsd_assets']);
    }

    function qtsd_assets($screen){
        if('post-new.php' == $screen){
            wp_enqueue_script('qtsd-main-js',plugin_dir_url(__FILE__)."assets/js/qt.js",['quicktags','thickbox']);
            wp_enqueue_style('qtsd-f-awesome',"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css");
            
            wp_localize_script('qtsd-main-js','qtsd',['preview' => plugin_dir_url(__FILE__)."/assets/fap.php"]);
        }
    }
 }
 new TestQuickTags;