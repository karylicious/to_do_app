<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Priority
 *
 * @author w1570462
 */
class Priority extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }    
    
    public function get () {
        $res = $this->db->get ( "Priorities" ); 
       
        if ( $res->num_rows() == 0 ) {
            return false;
        }        

        $output = array();
        $index = 0;
        
        foreach ( $res->result() as $row ) {
            $output [$index ][ "priority_id" ] = $row->priority_id;
            $output[ $index ][ "priority_name" ] = $row->priority_name;
            $index++;
        }
        return $output;
    } 
    
    public function getById ( $priority_id ) {
        $this->db->where ( "priority_id", $priority_id );
        $result = $this->db->get ( "Priorities" ); 
        
        if ( $result->num_rows() != 1 ) {
            return false;
        }        
        return $result->row();
    } 
}
?>