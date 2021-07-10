<?php
/* 
Plugin Name: Database Demo
Plugin URI: db-test.com
Version: 1.0.0
Description: for custom data table 
Author: pappu
Text Domain: db-demo
Domain Path: '/languages' 
*/


class DBDemo{
    const DB_DEMO_DB_VERSION = '1.6';

    function __construct(){
        register_activation_hook( __FILE__, [$this,'dbDemoInit'] );
        register_deactivation_hook( __FILE__, [$this,'dbDemoFlushData'] );
        add_action('admin_menu',[$this,'DBDataShowInAdmin']);
        add_action('admin_post_dbdemo_add_record',[$this,'dbdemoAddRecord']);
        // add_action('plugins_loaded',[$this,'dbDemoDropColumn']);
    }

    function dbDemoInit(){
        global $wpdb;
        $table_name = $wpdb->prefix."persons";
        $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(250),
            email VARCHAR(250),
            PRIMARY KEY(id)
        );";
        require_once(ABSPATH."wp-admin/includes/upgrade.php");
        dbDelta($sql);

        //add option
        add_option('db_demo_db_version',self::DB_DEMO_DB_VERSION);

        //add some data
        $wpdb->insert($table_name,[
            'name'  => 'John Doe',
            'email' => 'john@doe.com',
        ]);
        $wpdb->insert($table_name,[
            'name'  => 'Marry Moe',
            'email' => 'marry@moe.com',
        ]);
        $wpdb->insert($table_name,[
            'name'  => 'Julia Doe',
            'email' => 'julia@doe.com',
        ]);



        //if version updated
        if(get_option('db_demo_db_version') !== self::DB_DEMO_DB_VERSION) : 
            $sql = "CREATE TABLE {$table_name} (
                id INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(250),
                email VARCHAR(250),
                age INT NULL,
                PRIMARY KEY(id)
            );";
            dbDelta($sql);
            update_option('db_demo_db_version',self::DB_DEMO_DB_VERSION);

            $wpdb->insert($table_name,[
                'name'  => 'John Doe Updated',
                'email' => 'john@doe.com',
                'age' => 34,
            ]);
            $wpdb->insert($table_name,[
                'name'  => 'Marry Moe Updated',
                'email' => 'marry@moe.com',
                'age' => 25,
            ]);
            $wpdb->insert($table_name,[
                'name'  => 'Julia Doe Updated',
                'email' => 'julia@doe.com',
                'age' => 26,
            ]);
        endif;




    }

    function dbDemoDropColumn(){
        global $wpdb;
        $table_name = $wpdb->prefix."persons";
        if(get_option('db_demo_db_version') !== self::DB_DEMO_DB_VERSION) : 
            $query = "ALTER TABLE {$table_name} DROP COLUMN age";
            $wpdb->query($query);
        endif;
    }

    function DBDataShowInAdmin(){
        add_menu_page(__('DB Demo','db-demo'),'DB Demo','manage_options','dbdemo',[$this,'dbDemAdminPage']);
    }

    function dbDemAdminPage(){
        global $wpdb;
        $id = $_GET['pid'] ?? false;
        $id = sanitize_key($id);
          $id ?   $result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}persons WHERE id='{$id}'") : $result= "";
    
        ?>

        <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
        <!-- <p class="notice notice-error is-dismissable">
            some error
        </p> -->
        <?php wp_nonce_field('db_demo','nonce'); ?>
        <input type="hidden" name="action" value="dbdemo_add_record">
           <p> Name: <input type="text" name="name" <?php echo  $id ? "value='{$result->name}'" : "" ?> />  </p>
            <p> Email: <input type="email" name="email" <?php echo  $id ? "value='{$result->email}'" : "" ?> /> </p>
            <?php 
            echo $id ? '<input type="hidden" name="id" value="'.$id.'">'. submit_button('Update Record') : submit_button('Add Record');
             ?>
        </form>
        
   <?php }

function dbdemoAddRecord(){
    global $wpdb;
    if(isset($_POST['submit'])) : 
        $nonce = sanitize_text_field($_POST['nonce']);
        if(wp_verify_nonce( $nonce,'db_demo')) :
            $name   = sanitize_text_field($_POST['name']);
            $email  = sanitize_text_field($_POST['email']);
            $row_id = sanitize_text_field($_POST['id']);
            if($row_id) : 
                $wpdb->update("{$wpdb->prefix}persons", ["name" => $name, "email" => $email], ['id' => $row_id]);
                wp_redirect(admin_url('admin.php?page=dbdemo&&pid='.$row_id));
            else: 
                $wpdb->insert("{$wpdb->prefix}persons", ["name" => $name, "email" => $email]);
                wp_redirect(admin_url('admin.php?page=dbdemo&&pid='.$wpdb->insert_id));
            endif;
        endif;
        
    endif;
}
    /*function dbDemoFlushData(){
        global $wpdb;
        $table_name = $wpdb->prefix."persons";
        $query = "DROP TABLE $table_name";
        $wpdb->query($query);
    }*/
// register_activation_hook(__FILE__,"dbDemoInit");
}
new DBDemo;