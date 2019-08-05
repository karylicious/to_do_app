<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Item
 *
 * @author w1570462
 */
class Item extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }    
    
    public function add ( $list_id, $priority_id, $item_title, $item_url, $item_price ) {
        $data = array ( "list_id" => $list_id,
                        "priority_id" => $priority_id,
                        "item_title" => $item_title,
                        "item_url" => $item_url,
                        "item_price" => $item_price ); 
                                
        $this->db->insert ( "Items", $data );
        return $insert_id = $this->db->insert_id();        
    }  
    
    public function delete ( $item_id ) {
        $this->db->where ('item_id', $item_id );
        $this->db->delete ('Items');
    }
    
    public function getByListId ( $list_id ) {
        $this->db->where ( "list_id", $list_id );
        $this->db->order_by ( "priority_id", "ASC" );        
        $res = $this->db->get ( "Items" ); 
        
        if ( $res->num_rows() == 0 ){
            return false;
        }   

        $output = array();
        $index = 0;
        
        foreach( $res->result() as $row ){
            $output[ $index ][ "list_id" ] = $row->list_id;
            $output[ $index ][ "item_id" ] = $row->item_id; 
            $output[ $index ][ "item_title" ] = $row->item_title; 
            $output[ $index ][ "item_url" ] = $row->item_url; 
            $output[ $index ][ "item_price" ] = $row->item_price; 
            $priority = $this->priority->getById ( $row->priority_id );
            $output [$index ][ "priority_name" ] = $priority->priority_name;
            $output[ $index ][ "priority_id" ] = $priority->priority_id;
            $index++;
        }
        return $output;
    }    
    
    public function update ( $item_id, $priority_id, $item_title, $item_url, $item_price ) {
        $this->db->set ( "priority_id", $priority_id );
        $this->db->set ( "item_title", $item_title );
        $this->db->set ( "item_url", $item_url );
        $this->db->set ( "item_price", $item_price );
        $this->db->where ( "item_id", $item_id );
        $this->db->update ( "Items" );
    }
}
?>