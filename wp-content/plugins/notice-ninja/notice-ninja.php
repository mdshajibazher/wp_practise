<?php
/* 
Plugin Name: Notice Ninja
Plugin URI: test.com
Version: 1.0.0
Description: for Admin notices
Author: pappu
Text Domain: notice-demo
Domain Path: '/languages' 
*/


class NoticeNinja{
    function __construct(){
        add_action('admin_notices',[$this,'noticeNinjaAdminNotice']);
        add_action('admin_enqueue_scripts',[$this,'noticeNinjaAssetsEnqueue']);
    }

    public function noticeNinjaAssetsEnqueue($hook){
        wp_enqueue_script('notice-ninja-assets',plugin_dir_url(__FILE__)."assets/js/scripts.js",array('jquery'),time());
    }

    public function noticeNinjaAdminNotice(){ 
        global $pagenow;
        if(!isset($_COOKIE['nn-close'])) :
            if($pagenow === 'index.php') :
        ?>
        <div id="notice-ninja" class="notice notice-success is-dismissible">
            <h3 style="margin: 5px 0"><?= $pagenow; ?></h3>
            <p>Hey! here is some information for you</p>
        </div>
    <?php 
            endif;
        endif;    
    }
}
new NoticeNinja;