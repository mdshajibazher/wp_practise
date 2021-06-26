<?php
/**   
 * Plugin Name: Tinymce Demo
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: display qr code under every posts
 * Author: pappu
 * Text Domain: tiny-mce-demo
 * Domain Path: '/languages' 
 * **/
class TinyMceDemo{

    function __construct(){
        add_action('admin_init',[$this,'tmc_admin_assets']);
    }

    function tmc_admin_assets(){
        add_filter('mce_external_plugins',[$this,'tmc_external_plugins']);
        add_filter('mce_buttons',[$this,'tmc_external_buttons']);
    }

    function tmc_external_buttons($buttons){
        $buttons[] = 'tmc_button_one';
        $buttons[] = 'tmc_button_two';
        return $buttons;
    }


    function tmc_external_plugins($plugins){
        $plugins['tmcd_plugin'] = plugin_dir_url(__FILE__)."assets/js/tmce.js";
        return $plugins;
    }


 }
 new TinyMceDemo;