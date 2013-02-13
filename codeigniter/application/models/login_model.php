<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function check( $data = null ) {
		$query = $this->db->get_where(
			'users', array(
				'username' => $data[ 'username' ], 
				'password' => sha1( $data[ 'password' ] . ':' . $this->config->item( 'encryption_key' ) ) //md5($data['password'])
			));
			
		$result = $query->row();
		// var_dump($result);die();
		if ( $query->num_rows() > 0 ) {
			$this->session->set_userdata( 'logged_in', $result );
			return TRUE;
			
		} else {
			return FALSE;
			
		}
	}
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */