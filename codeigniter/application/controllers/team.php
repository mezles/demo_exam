<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct() {
	
		parent::__construct();
		if ( ! $this->session->userdata( 'logged_in' ) ) { 
            redirect( 'login' );
			
        }
		
	}
	
	/**
	 * Default action of team controller
	 *
	 * @access public
	 * @param none
	 */
	public function view() {
		
		$this->load->model( 'user_model' ); 
		$this->load->model( 'team_model' ); 
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'View All Teams - Demo Exam';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'View All Teams';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$data[ 'teams' ]			= $this->team_model->get_all_team();
		
		$this->load->view( 'team/list_view', $data );
		
	}
	
	/**
	 * Loads Create Team Page
	 *
	 * @access public
	 * @param none
	 */
	public function create() {
	
		$this->load->model('user_model');
		$this->load->model('team_model');
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'Create Team - Demo Exam';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'Create Team';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		if ( $this->input->post( 'create_team' ) ) {
		
			//validation
			$this->form_validation->set_rules( 'teamname', 'Team Name', 'trim|required|xss_clean' );
			// validation end
			
			if ( $this->form_validation->run() == FALSE ) {
				$this->session->set_flashdata( 'error', '<h4>There was an error in creating team.</h4>' );
				
			} else {
				$team_exist = $this->team_model->check_teamname( $this->input->post( 'teamname' ) );
				
				if ( $team_exist ) {
					$this->session->set_flashdata( 'error', '<h4>Team Name already exist.</h4>' );
					
				} else {
					$save_team = $this->team_model->save_team( $this->input->post() );
					
					if ( ! $save_team ) {
						$this->session->set_flashdata( 'error', '<h4>Error in saving to database.</h4>' );
						
					} else {
						$this->session->set_flashdata( 
							'success', 
							'<h4>' . $this->input->post( 'teamname' ) . ' successfully added.</h4>' );
						redirect( 'team/view' );
						
					}
					
					
				}
			}
			
		}
		
		$this->load->view( 'team/create_view', $data );
		
	}
	
	/**
	 * Loads Edit User Page
	 *
	 * @access public
	 * @param none
	 */
	public function edit() {
	
		$this->load->model('user_model');
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'Edit User - Demo Exam';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'Edit User';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$data[ 'user_id' ]			= $this->uri->segment(3);
		$data['user']				= $this->user_model->get_user_by_id( $data[ 'user_id' ] );
		
		if ( $this->input->post( 'update_user' ) ) {
		
			if ( $this->input->post( 'user_id' ) == $data[ 'user_id' ] ) {
				
				// validation
				// $this->form_validation->set_rules( 'username', 'Username', 'trim|required|min_length[5]|xss_clean' );
				if ( $this->input->post( 'change_pass' ) ) {
					$this->form_validation->set_rules( 'password', 'Password', 'trim|required|min_length[4]|xss_clean' );
				}
				$this->form_validation->set_rules( 'level', 'User Level', 'trim|required|integer|xss_clean' );
				// validation end
				
				if ( $this->form_validation->run() == FALSE ) {
					$this->session->set_flashdata( 'error', '<h4>There was an error in creating user.</h4>' );
					
				} else {
					
					$update_user = $this->user_model->update_user( $this->input->post() );
					
					if ( ! $update_user ) {
						$this->session->set_flashdata( 
							'error', 
							'<h4>User with id ' . $data['user_id'] . ' not updated.</h4>' );
						
					} else {
						$this->session->set_flashdata( 
							'success', 
							'<h4>User with id ' . $data['user_id'] . ' successfully updated.</h4>' );
							
					}
					redirect( 'user/view' );
					
				}
			
			} else {
				$this->session->set_flashdata( 'error', '<h4>User id not match.</h4>' );
				
			}
			
			
		}
		
		$this->load->view( 'user/edit_view', $data );
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */