<?php
/**   
 * Plugin Name: Assets Ninja
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: simple hack of assets
 * Author: pappu
 * Text Domain: assets-ninja
 * Domain Path: '/languages' 
 * **/
define("ASSETS_NINJA_DIR",plugin_dir_url(__FILE__)."/assets");
define("ASSETS_NINJA_PUBLIC_DIR",plugin_dir_url(__FILE__)."/assets/public");
define("ASSETS_NINJA_ADMIN_DIR",plugin_dir_url(__FILE__)."/assets/admin");
 class AssetsNinja{
    private $version;
    public function __construct(){
        $this->version = time();
        add_action('init', [$this,'asnInit']);
        add_action('plugins_loaded',[$this, 'loadTextDoamin']);
        add_action('wp_enqueue_scripts',[$this, 'loadFrontEndAssets']);
        add_action('admin_enqueue_scripts',[$this, 'loadAdminAssets']);
    }

    function asnInit(){
        // wp_deregister_style('twenty-twenty-one-print-style');
        // wp_register_style('twenty-twenty-one-print-style','//cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css');
    }

    function loadTextDoamin(){
        load_plugin_textdomain('assets-ninja', false, plugin_dir_url(__FILE__).'/languages');
    }

    function loadAdminAssets($screen){
        if($screen == 'post-new.php')
        {
            wp_enqueue_script('assets-ninja-admin-main-js',ASSETS_NINJA_ADMIN_DIR.'/js/main.js', array('jquery'), $this->version,true );
        }
    }

    function loadFrontEndAssets(){
        wp_enqueue_script('assets-ninja-main-js',ASSETS_NINJA_PUBLIC_DIR.'/js/main.js', array('jquery','assets-ninja-another-js'), $this->version,true );
        wp_enqueue_script('assets-ninja-another-js',ASSETS_NINJA_PUBLIC_DIR.'/js/another.js', array('jquery'), $this->version,true );
        wp_enqueue_script('assets-ninja-more-js',ASSETS_NINJA_PUBLIC_DIR.'/js/more.js', array('jquery'), $this->version,true );

        $data = array(
            'name' => 'lwhh',
            'url' => 'https://learnwith.hasinhayder.com/',
        );
        wp_localize_script('assets-ninja-more-js', 'site_data',$data );

        wp_enqueue_style('asn-main-css',ASSETS_NINJA_PUBLIC_DIR.'/css/main.css',null, $this->version );
        // $data = 'body{background: red !important}';
        // wp_add_inline_style('asn-main-css',$data);
    }



 }
 new AssetsNinja;