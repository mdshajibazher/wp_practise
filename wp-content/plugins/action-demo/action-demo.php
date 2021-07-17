<?php
/* 
Plugin Name: Action Demo
Plugin URI: action.com
Version: 1.0.0
Description: for Plugins Action after activations
Author: pappu
Text Domain: action-demo
Domain Path: '/languages' 
*/


class ActionDemo{
    function __construct(){
        add_action('admin_menu',[$this,'ActionDemoMenu']);
        add_action('activated_plugin',[$this,'redirectProcedure']);
        add_filter('plugin_action_links_'.plugin_basename(__FILE__),[$this,'actionLinks']);
        add_filter('plugin_row_meta',[$this,'rowLinks'],10,2);
    }

    function ActionDemoMenu(){
        add_menu_page(__('Action Links','action-demo'),__('Action Links','action-demo'),'manage_options','action_links',[$this,'MenuCallback']);
    }
    function redirectProcedure($plugin){
        if(plugin_basename(__FILE__) === $plugin) :
            wp_redirect(admin_url('admin.php?page=action_links'));
            die();
        endif;
    }

    function actionLinks($links){
        $link = sprintf("<a style='color: red' href='%s'>%s</a>",admin_url('admin.php?page=action_links'),'Go');
        array_push($links,$link);
        return $links;
    }

    function rowLinks($links,$plugin){
        if(plugin_basename(__FILE__) === $plugin) :
        $link = sprintf("<a style='color: #3498db' href='%s'>%s</a>",esc_url('https://www.google.com'),'Google');
        array_push($links,$link);
        endif;
        return $links;
    }

    function MenuCallback(){ ?>
         <h1>Hello World</h1>
    <?php }
}
new ActionDemo;