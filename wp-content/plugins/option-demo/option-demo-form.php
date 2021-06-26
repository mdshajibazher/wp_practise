<?php
class OptionsDemoTwo{

    public function __construct(){
        add_action('admin_menu',[$this,'optionDemoCreateAdminPage']);
        add_action('admin_post_options_demo_admin_page',[$this,'optionDemoSaveForm']);
    }


    public function optionDemoCreateAdminPage(){
        $page_title = __( 'Options Admin Page', 'optionsdemo' );
		$menu_title = __( 'Options Admin Page', 'optionsdemo' );
		$capability = 'manage_options';
		$slug       = 'optionsdemo_page';
		$callback   = array( $this, 'optionsdemoSettingsContent' );
		// add_options_page( $page_title, $menu_title, $capability, $slug, $callback );
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback );
    }

    public function optionsdemoSettingsContent() { 
        require_once plugin_dir_path(__FILE__)."/form.php";
    }

    public function optionDemoSaveForm(){
        check_admin_referer('options_demo');
        if(isset($_POST['opt_demo_user_name'])){
            update_option('opt_demo_user_name',sanitize_text_field($_POST['opt_demo_user_name']));
        }
        wp_redirect('admin.php?page=optionsdemo_page');
    }

}
new OptionsDemoTwo();