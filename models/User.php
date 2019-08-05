<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of User
 *
 * @author w1570462
 */
class User extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }    
    
    public function add ( $user_name, $user_username, $user_password ) {
        $data = array ( "user_name" => $user_name,
                        "user_username" => $user_username,
                        "user_password" => $user_password );
                                
        return $this->db->insert ( "Users", $data );        
    }    
    
    public function getNameById ( $user_id ) {
        $this->db->select ("user_name");
        $this->db->where ( "user_id", $user_id );
        $result = $this->db->get ( "Users" ); 
        
        if ( $result->num_rows() != 1 ) {
            return false;
        }        
        return $result->row();
    }   
    
    public function getByUsername ( $username ) {
        $this->db->where ( "user_username", $username );
        $result = $this->db->get ( "Users" ); 
        
        if ( $result->num_rows() != 1 ) {
            return false;
        }        
        return $result->row();
    }   
    
    public function getByUsernameAndPassword ( $username, $password ){
        $result = $this->getByUsername ( $username );
        if(  $result != false ) {
            $hash_password = $result->user_password;            
            return ( password_verify ( $password, $hash_password ) ) ? $result : false;
        }
        return false;
    }   
    
    public function alreadyExists ( $username ) {
        $this->db->where ( "user_username", $username );
        $result = $this->db->get ( "Users" );        
        return ( $result->num_rows () == 1 );
    }  
}
?>