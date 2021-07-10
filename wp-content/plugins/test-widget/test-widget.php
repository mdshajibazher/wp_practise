<?php
/**   
 * Plugin Name: Test Widget
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: Test
 * Author: pappu
 * Text Domain: test-widget
 * Domain Path: '/languages' 
 * **/

 require_once plugin_dir_path(__FILE__)."widgets/class.demo_widgets.php";

 Class TestWidget{
    function __construct(){
        add_action('plugins_loaded',[$this,'test_widget_load_text_domain']);
        add_action('widgets_init',[$this,'test_widget_register']);
    }
    function test_widget_load_text_domain(){
        load_plugin_textdomain('test-widget',false,plugin_dir_path(__FILE__)."languages/");
    }

    function test_widget_register(){
        register_widget('TestWidgetOperation');
    }
 }
 new TestWidget;

