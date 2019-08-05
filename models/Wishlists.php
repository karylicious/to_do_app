<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Wishlists
 *
 * @author w1570462
 */
class Wishlists extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }    
    
    public function add ( $user_id, $list_name, $list_description  ) {
        $data = array ( "user_id" => $user_id,
                        "list_name" => $list_name,
                        "list_description" => $list_description );
        
        return $this->db->insert ( "Wishlists", $data );     
    }    
    
    public function getByUserId ( $user_id ) {
        $this->db->where ( "user_id", $user_id );
        $result = $this->db->get ( "Wishlists" ); 
        
        if ( $result->num_rows() != 1 ) {
            return false;
        }        
        return $result->row();
    }    

    public function getByListId ( $list_id ) {
        $this->db->where ( "list_id", $list_id );
        $result = $this->db->get ( "Wishlists" ); 
        
        if ( $result->num_rows() != 1 ){
            return false;
        }        
        return $result->row();
    }    
    
    public function update ( $user_id, $list_name, $list_description ) {
        $this->db->set ( "list_name", $list_name );
        $this->db->set ( "list_description", $list_description );
        $this->db->where ( "user_id", $user_id );
        $this->db->update ( "Wishlists" );
    }
}
?>