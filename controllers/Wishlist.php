<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model ( 'wishlists' );
        $this->load->model ( 'item' );
        $this->load->model ( 'user' );
        $this->load->model ( 'priority' );
    }
        
    function index () {        
        if( !$this->session->authenticated ) {
            if ( $this->input->server ( 'REQUEST_METHOD' ) == 'POST') { // Called by the register button
                
                $data = $this->decode_data ($this->input->raw_input_stream); 
                $username = $data [ 'user_username' ]; 

                if( !$this->user->alreadyExists ( $username ) ){
                    $name = $data [ 'user_name' ];
                    $encrypted_password = password_hash ($data [ 'user_password' ], PASSWORD_DEFAULT); //Uses blowfish hash algorithm by default

                    $this->user->add( $name, $username, $encrypted_password );
                    $new_user = $this->user->getByUsername ( $username );

                    $list_name = $data [ 'list_name' ];
                    $list_description = $data [ 'list_description' ];

                    $this->wishlists->add ( $new_user->user_id, $list_name, $list_description  );

                    echo json_encode ( array ( "success" => true, 
                                              "info" => "Account created successfully!" 
                                             ) 
                                     );
                }
                else {
                    echo json_encode ( array ( "success" =>false, 
                                             "info" => "Username already taken! Please try again." 
                                             ) 
                                    );
                }
            }
            else if ( $this->input->server ( 'REQUEST_METHOD' ) == 'GET' ) { // fetch data // Called by the login button 
                $username = $this->input->get ( 'user_username' );            
                $password = $this->input->get ( 'user_password' );  

                if ( $username != "" ) {
                    $user = $this->user->getByUsernameAndPassword ( $username, $password  );

                    if ( $user != false ) {                        
                        $this->session->set_userdata ( "authenticated", true );

                        $list = $this->wishlists->getByUserId ( $user->user_id ); 
                                                    
                        $priority_List = $this->priority->get ();
                        $output = array ( "user_name" => $user->user_name, 
                                            "list_id" => $list->list_id, 
                                            "list_name" => $list->list_name, 
                                            "list_description" => $list->list_description ,
                                            "priority" => $priority_List
                                        );
                            
                        echo json_encode ( $output );
                    }
                    else {
                        echo json_encode ( array ( "success" =>false, 
                                                   "info" => "Username or password is incorret! Please try again." ) 
                                         );      
                    }                        
                }
                else { //Loaded onced
                    $this->load->view ( 'index' );
                }
            }
        }
        else {
            //user is logged in and will be logged out due to refresh of the page
            $this->session->set_userdata ( "authenticated", false );
            $this->load->view ( 'index' );            
        }
    }

    
    function loggout () {
        if ( $this->input->server ( 'REQUEST_METHOD' ) == 'GET' ) {
            $this->session->set_userdata ( "authenticated", false );
        }
    }        
    
    function item () {
        if ( $this->session->authenticated ) {
            if ( $this->input->server ('REQUEST_METHOD') == 'GET' ) {
                $list_id = $this->input->get ( 'list_id' );

                if( $list_id != "" ) {
                    $items = $this->item->getByListId ( $list_id );
                    echo json_encode ( $items );
                }
            }
            else if ( $this->input->server ( 'REQUEST_METHOD' ) == 'POST' ) {
                $data = $this->decode_data ( $this->input->raw_input_stream );    

                $list_id = $data [ 'list_id' ];
                $priority_id = $data [ 'priority_id' ];
                $item_title = $data [ 'item_title' ];
                $item_url = $data [ 'item_url' ];
                $item_price = $data [ 'item_price' ];

                $id = $this->item->add( $list_id, $priority_id, $item_title, $item_url, $item_price );   
                echo json_encode ( array( "item_id" => $id) );             
            }
            else if ( $this->input->server ( 'REQUEST_METHOD' ) == 'DELETE' ) {
                $item_id = $this->input->get ( 'item_id' );
                $this->item->delete ( $item_id );                
            }
            else if ( $this->input->server ( 'REQUEST_METHOD') == 'PUT' ) {
                $data = $this->decode_data ( $this->input->raw_input_stream); 

                $item_id = $data [ 'item_id' ];
                $priority_id = $data [ 'priority_id' ];
                $item_title = $data [ 'item_title' ];
                $item_url = $data [ 'item_url' ];
                $item_price = $data [ 'item_price' ];

                $this->item->update ( $item_id, $priority_id, $item_title, 
                                      $item_url, $item_price 
                                    );                
            }
        }
    } 

    function sharedlist () {
        if ( $this->session->authenticated) {
            $this->session->set_userdata ("authenticated", false);
        }       
  
        if ($this->input->server ('REQUEST_METHOD') == 'GET') {
            $list_id = $this->input->get ( 'id' ); 
            if ( $list_id != "") {
                $list = $this->wishlists->getByListId ( $list_id ); 
                $owner = $this->user->getNameById ( $list->user_id );

                $items = $this->item->getByListId ( $list_id );

                $arrList = array ( "title" => $list->list_name, "description" => $list->list_description );
                $this->load->view ( 'sharedlist',  array("list" => $arrList, 
                                                         "user" => $owner->user_name, 
                                                         "items" => $items 
                                                        )
                                );
            }
        }        
    }

    //This function turns the JSON sent by Backbone model into a PHP array after sanitization    
    private function decode_data ( $data ) {
        $cleanedData = $this->security->xss_clean ( $data );
        return json_decode ( $cleanedData, true );      
    }   
}
?>