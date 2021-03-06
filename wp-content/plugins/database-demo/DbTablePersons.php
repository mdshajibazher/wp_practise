<?php

if(!class_exists("WP_List_Table")){
    require_once(ABSPATH."wp-admin/includes/class-wp-list-table.php");
}

class DbTablePersons extends WP_List_Table{

    function __construct($data){
        parent::__construct();
        $this->items = $data;
    }


    function get_columns(){
        return [
            'cb' => '<input type="checkbox"/>',
            'name' => __('Name','db-demo'),
            'email' => __('Email','db-demo'),
            'Action' => __('Action','db-demo'),
        ];
    }

    function column_cb($item){
        return "<input type='checkbox' value='{$item['id']}'";
    }

    function column_action($item){
        $link = wp_nonce_url( admin_url( 'admin.php?page=dbdemo&pid=' ) . $item['id'], "db_demo_edit", 'nonce' );
        // $link =  admin_url( 'admin.php?page=dbdemo&pid=' ) . $item['id'];

		return "<a href='" . esc_url( $link ) . "'>Edit</a>";
    }

    function column_default( $item, $column_name ) {
		return $item[ $column_name ];
	}


    function prepare_items() {
        $this->_column_headers = array($this->get_columns(),[],[]);
		// parent::prepare_items();
	}
}