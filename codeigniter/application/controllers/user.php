<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
	
		parent::__construct();
		// if logged in session not set, redirects to login page
		if ( ! $this->session->userdata( 'logged_in' ) || $this->session->userdata( 'logged_in' )->level != 1 	) { 
            redirect( 'login' );
			
        }
		
	}
	
	/**
	 * Default action of user controller
	 *
	 * @access public
	 * @param none
	 */
	public function view() {
		// loads model
		$this->load->model( 'user_model' );
		$this->load->model( 'team_model' );
		
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'View All Users - Demo Site';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'View All Users';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$data[ 'users' ]			= $this->user_model->get_all_user();
		
		// loads the view
		$this->load->view( 'user/list_view', $data );
		
	}
	
	/**
	 * Loads Create User Page
	 *
	 * @access public
	 * @param none
	 */
	public function create() {
		// loads model
		$this->load->model('user_model');
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'Create User - Demo Site';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'Create User';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		// if form is submitted, check
		if ( $this->input->post( 'create_user' ) ) {
		
			//form validation
			$this->form_validation->set_rules( 'username', 'Username', 'trim|required|min_length[5]|xss_clean' );
			$this->form_validation->set_rules( 'password', 'Password', 'trim|required|min_length[4]|xss_clean' );
			$this->form_validation->set_rules( 'level', 'User Level', 'trim|required|integer|xss_clean' );
			// validation end
			
			// if error is found while validating, sets error message
			if ( $this->form_validation->run() == FALSE ) {
				$this->session->set_flashdata( 'error', '<h4>There was an error in creating user.</h4>' );
			
			// if no error is found, 			
			} else {
				$user_exist = $this->user_model->check_username( $this->input->post( 'username' ) );
				
				// check if user exists
				if ( $user_exist ) {
					$this->session->set_flashdata( 'error', '<h4>Username already exist.</h4>' );
					
				} else {
					$save_user = $this->user_model->save_user( $this->input->post() );
					
					// if data is not save in the database, sets error message
					if ( ! $save_user ) {
						$this->session->set_flashdata( 'error', '<h4>Error in saving to database.</h4>' );
					// if successfully save, redirect to user view lists	
					} else {
						$this->session->set_flashdata( 
							'success', 
							'<h4>' . $this->input->post( 'username' ) . ' successfully added.</h4>' );
						redirect( 'user/view' );
						
					}
					
					
				}
			}
			
		}
		// loads the view
		$this->load->view( 'user/create_view', $data );
		
	}
	
	/**
	 * Loads Edit User Page
	 *
	 * @access public
	 * @param none
	 */
	public function edit() {
		// loads model
		$this->load->model('user_model');
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' );
		$data[ 'site_title' ] 		= 'Edit User - Demo Site';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'Edit User';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$data[ 'user_id' ]			= $this->uri->segment(3);
		$data['user']				= $this->user_model->get_user_by_id( $data[ 'user_id' ] );
		
		// if form is submitted
		if ( $this->input->post( 'update_user' ) ) {
			// checked submitted user_id on url segment
			if ( $this->input->post( 'user_id' ) == $data[ 'user_id' ] ) {
				
				// form validation
				if ( $this->input->post( 'change_pass' ) ) {
					$this->form_validation->set_rules( 'password', 'Password', 'trim|required|min_length[4]|xss_clean' );
				}
				$this->form_validation->set_rules( 'level', 'User Level', 'trim|required|integer|xss_clean' );
				// validation end
				
				// if error is found while validating, sets error message
				if ( $this->form_validation->run() == FALSE ) {
					$this->session->set_flashdata( 'error', '<h4>There was an error in creating user.</h4>' );
					
				} else {
					
					$update_user = $this->user_model->update_user( $this->input->post() );
					
					// if data is not updated in the database, sets error message
					if ( ! $update_user ) {
						$this->session->set_flashdata( 
							'error', 
							'<h4>User with id ' . $data['user_id'] . ' not updated.</h4>' );
					// if successfully updated, sets success message
					} else {
						$this->session->set_flashdata( 
							'success', 
							'<h4>User with id ' . $data['user_id'] . ' successfully updated.</h4>' );
							
					}
					redirect( 'user/view' );
					
				}
			// if submitted user_id and user_id url segment not matched, sets error message
			} else {
				$this->session->set_flashdata( 'error', '<h4>User id not match.</h4>' );
				
			}
			
			
		}
		
		// loads view
		$this->load->view( 'user/edit_view', $data );
	}
	
	
	/**
	 * Loads Assign Team Page
	 *
	 * @access public
	 * @param none
	 */
	public function assign_team() {
		// loads model
		$this->load->model('user_model');
		$this->load->model('team_model');
		
		$data[ 'logged_in' ] 		= $this->session->userdata( 'logged_in' ); // get user data from logged in session
		$data[ 'site_title' ] 		= 'Assign User to Team - Demo Site';
		$data[ 'page_title' ] 		= 'Welcome ' . $data[ 'logged_in' ]->username . '!';
		$data[ 'page_subtitle' ] 	= 'Assign User to Team';
		$data[ 'header' ] 			= $this->load->view( 'header/header.php', $data, TRUE );
		$data[ 'left_nav' ] 		= $this->load->view( 'left_nav/left_nav_view.php', $data, TRUE );
		$data[ 'footer' ] 			= $this->load->view( 'footer/footer.php', '', TRUE );
		
		$data[ 'users' ]			= $this->user_model->get_unassign_user( 3 ); // get unassign user
		$data[ 'teams' ]			= $this->team_model->get_all_team(); // get all teams
		
		// if form is submitted
		if ( $this->input->post( 'assign_team' ) ) {
			
			$is_assigned = $this->user_model->assign_user_to_team( $this->input->post() );
			
			// if data is not updated in the database, sets error message
			if ( ! $is_assigned ) {
				$this->session->set_flashdata( 
							'error', 
							'<h4>Failed in assigning user to team.</h4>' );
			// else sets success message
			} else {
				$this->session->set_flashdata( 
							'success', 
							'<h4>User successfully assigned to team.</h4>' );
			}
			redirect( 'user/view' );
		}
		
		// loads view
		$this->load->view( 'user/assign_team_view', $data );
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */