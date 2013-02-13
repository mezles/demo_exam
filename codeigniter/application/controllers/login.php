<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
	
		parent::__construct();
		
		if ( $this->session->userdata( 'logged_in' ) ) { 
            redirect( 'home' );
			
        }
		
	}
	
	
	public function index() {
		
		$this->load->model( 'login_model' );
		
		$data[ 'site_title' ] 	= 'Login - Demo Exam';
		$data[ 'page_title' ] 	= 'Login Page';
		$data[ 'header' ] 		= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'footer' ] 		= $this->load->view( 'footer/footer.php', '', TRUE );
		$data[ 'error' ]		= '';
		
		if ( $this->input->post( 'login' ) ) {
			//validation
			$this->form_validation->set_rules( 'username', 'Username', 'trim|required|min_length[5]|xss_clean' );
			$this->form_validation->set_rules( 'password', 'Password', 'trim|required|min_length[4]|xss_clean' );
			
			if ( $this->form_validation->run() == FALSE ) {
				// $this->session->set_flashdata( 'error', '<h4>There was an error in logging in.</h4>' );
				$data[ 'error' ] = '<h4>There was an error in logging in.</h4>';
				
			} else {
				$is_login = $this->login_model->check( $this->input->post() );
				
				if ( ! $is_login ) {
					
					// $this->session->set_flashdata( 'error', '<h4>Username and / or password not match.</h4>' );
					$data[ 'error' ] = '<h4>Username and / or password not match.</h4>';
					
				} else {
					redirect( 'home' );
					
				}
				
			}
		
		}
		
		$this->load->view('login_view', $data);
		
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */