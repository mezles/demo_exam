<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index() {
		$data['site_title'] = 'Logout - Demo Exam';
		$data['page_title'] = 'Thank you come again!';
		$data['header'] = $this->load->view('header/header.php', $data, TRUE);
		$data['footer'] = $this->load->view('footer/footer.php', '', TRUE);
		
		if($this->input->post('action') == 'logout') {
			$this->session->sess_destroy();
		}
		
		$this->load->view('logout_view', $data);
		
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */