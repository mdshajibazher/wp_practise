<?php
/* 
Plugin Name: Dashboard Widget Demo
Plugin URI: test.com
Version: 1.0.0
Description: for adminpanel dashboard information at a glance
Author: pappu
Text Domain: dashboard-demo
Domain Path: '/languages' 
*/


class DashboardWidgetDemo{
    function __construct(){
        add_action('plugins_loaded',[$this,'DWD_LoadTextDomain']);
        add_action('wp_dashboard_setup',[$this,'DWD_DashboardWidget']);
    }

    function DWD_LoadTextDomain(){
        load_plugin_textdomain("dashboard-demo", false,plugin_dir_path(__FILE__)."/languages");
    }

    function DWD_DashboardWidget(){
        if(current_user_can('edit_dashboard')) :
            wp_add_dashboard_widget('dwd_unique_dashboard_widget_id',__('DashboardWidget','dashboard-demo'),[$this,
            'DWD_DashboardWidgetOutput'],[$this,'ConfigureDWD_DashboardWidget']);
        else : 
            wp_add_dashboard_widget('dwd_unique_dashboard_widget_id',__('DashboardWidget','dashboard-demo'),[$this,
            'DWD_DashboardWidgetOutput']);
        endif;
    }

    function DWD_DashboardWidgetOutput(){
        $number_of_posts = get_option('dwd_dashboard_widget_nop',5);
       $feeds = [
            [
                'url' => 'https://wptavern.com/feed',
                'items' => $number_of_posts,
                'show_summary' => 0,
                'show_author' => 0,
                'show_date' => 1,
            ],
        ];

        wp_dashboard_primary_output('dwd_unique_dashboard_widget_id',$feeds);
    }


    function ConfigureDWD_DashboardWidget(){ 
        $number_of_posts = get_option('dwd_dashboard_widget_nop',5);
        if(isset($_POST['dashboard-widget-nonce']) && wp_verify_nonce($_POST['dashboard-widget-nonce'],'edit-dashboard-widget_dwd_unique_dashboard_widget_id')) :

            if(isset($_POST['dwd_dashboard_widget_nop']) && $_POST['dwd_dashboard_widget_nop'] > 0) : 

                $number_of_posts = sanitize_text_field($_POST['dwd_dashboard_widget_nop']);
                update_option('dwd_dashboard_widget_nop',$number_of_posts);

            endif;
            
        endif;
    ?>
    <p>
      <label for="dwd_dashboard_widget_nop">Number of Post</label>
      <input type="text" class="widefat" name="dwd_dashboard_widget_nop" value="<?php echo  $number_of_posts; ?>"> 
    </p> 

    <?php }
}
new DashboardWidgetDemo;