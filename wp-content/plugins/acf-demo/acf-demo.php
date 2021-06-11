<?php
/**   
 * Plugin Name: ACF demo
 * Plugin URI: test.com
 * Version: 1.0.0
 * Description: Custom ACF
 * Author: pappu
 * Text Domain: acf-demo
 * Domain Path: '/languages' 
 * **/

require_once(plugin_dir_path(__FILE__)."/libs/class-tgm-plugin-activation.php");
// require_once(plugin_dir_path(__FILE__)."/inc/post-metabox.php");
class AcfDemo extends TGM_Plugin_Activation{
    public function __construct(){
        add_action('plugins_loaded',[$this, 'acf_demo_load_textdomain']);
        add_action( 'tgmpa_register',[$this,'acf_demo_register_required_plugins']);
        add_filter('acf/settings/show_admin', '__return_false');
    }

    public function acf_demo_load_textdomain(){
        load_plugin_textdomain('acf-demo', false, dirname(__FILE__).'/languages');
    }


    public function acf_demo_register_required_plugins() {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
    
            // array(
            //     'name'         => 'TGM New Media Plugin', // The plugin name.
            //     'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
            //     'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
            //     'required'     => true, // If false, the plugin is only 'recommended' instead of required.
            //     'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
            // ),
    

            // array(
            //     'name'      => 'Adminbar Link Comments to Pending',
            //     'slug'      => 'adminbar-link-comments-to-pending',
            //     'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
            // ),
    
            // This is an example of how to include a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'ACF',
                'slug'      => 'advanced-custom-fields/',
                'required'  => true,
            ),
    
    
        );
    

        $config = array(
            'id'           => 'acf-demo',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'plugins.php',            // Parent menu slug.
            'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
    
        );
    
        tgmpa( $plugins, $config );
    }
    
     
   
}

new AcfDemo;