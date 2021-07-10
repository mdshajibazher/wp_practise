<?php
/* 
Plugin Name: Datatable Demo
Plugin URI: dt-test.com
Version: 1.0.0
Description: for custom data table 
Author: pappu
Text Domain: dt-demo
Domain Path: '/languages' 
*/

require_once('class-persons-table.php');
class DataTableDemo extends PersonsTable{
    function __construct(){
        add_action('plugins_loaded',[$this,'dataTableLoadTextDomain']);
        add_action('admin_menu',[$this,'dataTableAdminPage']);
    }

    function dataTableLoadTextDomain(){
        load_plugin_textdomain('dt-demo',false, plugin_dir_path(__FILE__)."/languages");
    }

    function dataTableAdminPage(){
        add_menu_page(
        __('Data Table','dt-demo'),
        __('Data Table','dt-demo'),
        'manage_options',
        'data-table',
        [$this,'dataTableDisplayTable'],
        'dashicons-index-card'
        );
    }

    function dataTableDisplayTable(){
        include_once("dataset.php");
        $table = new PersonsTable;
        $orderBy = $_REQUEST['orderby'] ?? '';
        $orderDirection = $_REQUEST['order'] ?? '';
        if(isset($_REQUEST['s'])){
            $data = array_filter($data,function($item){
                $inputted_name =   sanitize_text_field($_REQUEST['s']);
                $inputted_name =   strtolower($inputted_name);
                $name = strtolower($item['name']);
                if(strpos($name,$inputted_name) !== false){
                    return true;
                }
                return false;
            });
        }

        if($orderBy == 'age'){
            if($orderDirection == 'asc'){
                usort($data,function($item1, $item2){
                    return $item1['age'] <=> $item2['age'];
                });
            }else{
                usort($data,function($item1, $item2){
                    return $item2['age'] <=> $item1['age'];
                });
            }
        }else if($orderBy == 'name'){
            if($orderDirection == 'name'){
                usort($data,function($item1, $item2){
                    return $item1['name'] <=> $item2['name'];
                });
            }else{
                usort($data,function($item1, $item2){
                    return $item2['name'] <=> $item1['name'];
                });
            }
        }


        $table->set_data($data);
        
       
        $table->prepare_items(); ?>

        <div class="wrap">
            <h2><?php _e('Persons', 'dt-demo') ?></h2>
            <form  method="GET">
                <?php $table->search_box('search', 'search-id');  $table->display(); ?>
                
                <input type="hidden" name="page" value="<?= $_REQUEST['page'];  ?>">
            </form>
        </div>
        <?php
        
       
    }

}
new DataTableDemo;