<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function check_teamname( $teamname = null ) {
		$query = $this->db->get_where(
			'teams', array(
				'name' => $teamname, 
			));
			
		$result = $query->row();
		
		if ( $query->num_rows() > 0 )
			return TRUE;
		else
			return FALSE;

	}
	
	public function save_team( $post ) {
		$data = array(
			'name' => $post['teamname']
		);
		
		$this->db->insert( 'teams', $data );
		
		if ( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
		
	}
	
	public function get_all_team() {
		
		$sql = "SELECT * FROM teams ORDER BY id ASC";
		
		$query = $this->db->query( $sql );
		
		return $query->result();
	}
	
	public function get_team_by_id( $id, $row = '' ) {
		$query = $this->db->get_where(
			'user_team', array(
				'user_id' => (int) $id, 
			));
			
		$result = $query->row();
		
		if ( $query->num_rows() > 0 ) {
			$query = $this->db->get_where(
			'teams', array(
				'id' => (int) $result->team_id, 
			));
			
			$result = $query->row();
			
			if ( empty( $row ) ) 
				return $result;
			else
				return $result->$row;
			
		} else {
			return '';
			
		}
		
	}
	
	
	
	public function update_team( $post  = array() ) {
		$data = array(
			'name' => $post[ 'teamname' ]
		);
		
		$this->db->update( 'teams', $data, "id = " . (int) $post[ 'team_id' ] );
		
		if ( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
	
	}
	
	
	public function get_total_member( $id = null ) {
		
		$query = $this->db->get_where(
			'user_team', array(
				'team_id' => (int) $id, 
			));
			
		$result = $query->num_rows();
		return $result;
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */