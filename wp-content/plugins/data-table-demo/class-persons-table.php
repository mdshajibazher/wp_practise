<?php

if(!class_exists("WP_List_Table")){
    require_once(ABSPATH."wp-admin/includes/class-wp-list-table.php");
}
class PersonsTable extends WP_List_Table{
    private $_items;
    function __construct($args = []){
        parent::__construct($args);
    }

    function set_data($data){
        $this->_items = $data;
    }

    function get_columns(){
        return [
            'cb' => '<input type="checkbox/>',
            'name' => __('Name', 'dt-demo'),
            'email' =>  __('Email', 'dt-demo'),
            'age' =>  __('Age', 'dt-demo'),

        ];
    }

    function column_cb($item){
        return '<input type="checkbox" value="'.$item['id'].'"/>';
    }

    function column_email($item){
        return "<strong>{$item['email']}</strong>";
    }

    function prepare_items(){
        $paged = $_REQUEST['paged'] ?? 1;
        $per_page = 3;
        $this->_column_headers = [$this->get_columns(),[],$this->get_sortable_columns()];
        $data_chunks = array_chunk($this->_items ,$per_page);
        $this->items = $data_chunks[$paged-1];
        $this->set_pagination_args([
            'total_items' => count($this->_items),
            'per_page' => $per_page,
            'total_pages' => ceil(count($this->_items)/$per_page),
        ]);

    }

    function column_default($item, $coulmn_name){
        return $item[$coulmn_name];
    }

    function get_sortable_columns(){
        return [
            'age' => ['age', true],
            'name' => ['name', true]
        ];
    }
}