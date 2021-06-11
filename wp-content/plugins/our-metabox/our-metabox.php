<?php
/**   
 * Plugin Name: Test Metabox
 * Plugin URI: test.com
 * Version: 1.0.0
 * Description: raw code for metabox
 * Author: pappu
 * Text Domain: test-metabox
 * Domain Path: '/languages' 
 * **/

 class OurMetabox{
     public function __construct(){
         add_action('plugins_loaded',[$this, 'omb_load_textdomain']);
         add_action('admin_menu',[$this, 'omb_add_metabox']);
         add_action('save_post',[$this,'omb_save_metabox']);
     }


     private function is_secured($nonce_field, $action, $post_id){
        $nonce = isset($nonce_field) ? $nonce_field : '';
        if($nonce == ''){
            return false;
        }

        if(!wp_verify_nonce($nonce,$action)){
            return false;
        }

        if(!current_user_can('edit_post',$post_id)){
            return false;
        }

        if(wp_is_post_autosave($post_id)  || wp_is_post_revision($post_id)){
            return false;
        }
        return true;
     }
     public function omb_save_metabox($post_id){
         if(!$this->is_secured('omb_location_field','omb_location',$post_id))
        $location = isset($_POST['omb_location']) ? $_POST['omb_location'] : '';

        if($location == ''){
            return $post_id;
        }

        update_post_meta($post_id, 'omb_location',$location );
     }


     public function omb_add_metabox(){
         add_meta_box(
             'omb_post_location',
             __('Location Info', 'test_metabox'),
             [$this,'omb_display_metabox'],
             'post',
             'side',

            );
     }



     public function omb_display_metabox($post){
         $location = get_post_meta($post->ID,'omb_location',true);
         $is_favorite = get_post_meta($post->ID,'omb_is_favorite',true);
         $checked =    
         $metabox_html = $is_favorite == 1 ? 'checked' : '';
         '<h4 class="text-center">Hello World</h4> <br><input type="text"  name="omb_location" placeholder="test meta" value="'.$location.'"> 
         <label for="omb_is_favorite">'.__('is favorite', 'test-metabox').'</label> 
         <input type="checkbox" name="omb_is_favorite" value="1" >  
         ';


         wp_nonce_field('omb_location','omb_location_field');
         echo $metabox_html;
     }

     public function omb_load_textdomain(){
        load_plugin_textdomain('test-metabox', false, dirname(__FILE__).'/languages');
     }
 }

 new OurMetabox;