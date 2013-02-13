<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() {
	
		parent::__construct();
		
	}
	
	public function index() {
		if ( $this->input->post( 'action' ) ) {
			$action = $this->input->post( 'action' );
			
			switch ( $action ) {
				case 'change_userlist' : 
					$this->change_userlist( $this->input->post() ); 
					break;
				default:
					return 0;
			}
		}
	}
	
	
	protected function change_userlist( $post ) {
		$this->load->model( 'user_model' );
					
		$type 					= (int) $post['id'];
		$response 				= array();
		$response['users'] 		= $this->user_model->get_unassign_user( $type );
		
		echo  json_encode( $response );
		die();
					
	}

	
}