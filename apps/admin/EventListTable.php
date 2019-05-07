<?php
/**
 *
 */

namespace ems\apps\admin;
 if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class EventListTable extends \WP_List_Table
{


  public function prepare_items(){
    $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']):"" ;
    $order =  isset($_GET['order']) ? trim($_GET['order']):""  ;
    $search_data = isset($_POST['s']) ? $_POST['s']:"";
    $datas = $this->wp_list_table_data_sample($orderby,$order,$search_data);
    $perpage = 2 ;
    $curent_page = $this->get_pagenum();
    $totalitems = count($datas);
    $this->set_pagination_args(array(
      'total_items' => $totalitems,
      'per_page' => $perpage
    ));
    $this->items = array_slice($datas,(($curent_page - 1) * $perpage),$perpage); // $datas;
    $columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $shortable = $this->get_sortable_columns();
    $this->_column_headers =  array($columns,$hidden,$shortable);
  }
  /*
  * all data process
  */
  public function wp_list_table_data_sample($orderby='',$order='',$search_data=''){
    global $wpdb;
    if (!empty($search_data)) {
      $allpost = $wpdb->get_results(
          "SELECT * FROM {$wpdb->posts}
          WHERE post_type='ems_events'
          AND post_status='publish'
          AND ( post_title LIKE '%$search_data%' OR post_content LIKE '%$search_data%' )"
      );
    }else{
      $allpost = get_posts(
        array(
          'post_type'   => 'ems_events',
          'post_status' => 'publish',
          'orderby'     => $orderby,
          'order'       => $order,
        )
      );
    }
    $post_array = array();
    if (count($allpost) > 0) {
      foreach ($allpost as $post) {
        // echo "<br>";
        // print_r($post);
        $post_array[] = array(
          "id"=>$post->ID,
          "title"=>$post->post_title,
          "content"=>$post->post_content,
          "name"=>$post->post_name,
        );
      }
    }
    return $post_array ;
  }
  /*hide some columns*/
  public function get_hidden_columns(){
    // return array('id');
  }
  public function get_sortable_columns(){
    return array(
      "title"=>array("title",false),
      "name"=>array("name",false)
    );
  }
  public function get_bulk_actions(){
    $actions = array(
      "delete"=> "Delete",
      "edit"=> "Edit"
    );
    return   $actions;
  }
  /*register columns*/
  public function get_columns(){
    $columns = array(
      "cb" => "<input type='checkbox' />",
      "id"=>"ID",
      "title"=>"Title",
      "content"=>"content",
      "name"=>"designation"
    );
    return $columns;
  }
  public function column_cb($id){
    return sprintf("<input type='checkbox' name='post[]' value='%s' />" , $id);
  }
  // show columns
  public function column_default($item,$column_name){
    switch ($column_name) {
      case 'id':
      case 'title':
      case 'content':
      case 'name':
        return $item[$column_name];
      default:
        return "No Value";
    }
  }
  public function column_title($item){
    $action = array(
      "edit" => sprintf('<a href="?page=%s&action=%s&post_id=%s">Edit</a>',$_GET['page'],'edit-koro',$item['id']),
      "delete" => sprintf('<a href="?page=%s&action=%s&post_id=%s">Delete</a>',$_GET['page'],'delete-holo',$item['id']),
    );
    return sprintf('%1$s %2$s',$item['title'],$this->row_actions($action));
  }
}