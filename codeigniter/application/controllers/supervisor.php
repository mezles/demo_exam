<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supervisor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ( ! $this->session->userdata( 'logged_in' ) ) { 
            redirect( 'login' );
        }
	}
	
	public function info() {
	
		$this->load->model( 'user_model' );
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'View Information - Demo Exam';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'View Information';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$this->load->view( 'supervisor/info_view', $data );
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */