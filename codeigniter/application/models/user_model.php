<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Checks for username in the database
	 *
	 * @access public
	 * @param string $username
	 * @return boolean
	 */
	public function check_username( $username = null ) {
		$query = $this->db->get_where(
			'users', array(
				'username' => $username, 
			));
			
		$result = $query->row();
		
		if ( $query->num_rows() > 0 )
			return TRUE;
		else
			return FALSE;

	}
	
	/**
	 * Saves New User on the database
	 *
	 * @access public
	 * @param array $post
	 * @return boolean
	 */
	public function save_user( $post ) {
		$data = array(
			'username' => $post['username'],
			'password' => sha1( $post[ 'password' ] . ':' . $this->config->item( 'encryption_key' ) ),
			'level' => (int) $post['level']
		);
		
		$this->db->insert( 'users', $data );
		
		if ( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
		
	}
	
	/**
	 * Get all Users from the database
	 *
	 * @access public
	 * @param int $type - user level type
	 * @param array $select - table column to be selected
	 * @param boolean $result_arr - data type format to be returned (obj or array)
	 * @return obj / array
	 */
	public function get_all_user( $type = '', $select = '', $result_arr = FALSE ) {
		$where = 'WHERE level != 1';
		
		switch ( $type ) {
			case 3:
				$where = 'WHERE level = 3';
				break;
			case 2:
				$where = 'WHERE level = 2';
				break;
			default:
				$where = 'WHERE level != 1';
				break;
		}
		
		if ( is_array( $select ) && !empty( $select ) && $select ) {
			$select = implode( ',', $select );
			$sql = "SELECT $select FROM users $where ORDER BY id ASC";
			
		} else {
			$sql = "SELECT id, username, level FROM users $where ORDER BY id ASC";
			
		}
		
		
		$query = $this->db->query( $sql );
		
		if ( $result_arr )
			return $query->result_array();
		else
			return $query->result();
	}
	
	/**
	 * Get unassigned user from the database
	 *
	 * @access public
	 * @param int $type
	 * @return obj data
	 */
	public function get_unassign_user( $type ) {
		$sql = "SELECT a.id, a.username FROM users as a
				LEFT JOIN user_team as b ON a.id = b.user_id
				WHERE a.level =  $type AND b.team_id is NULL";
				
		$query = $this->db->query( $sql );
		return $query->result();
	}
	
	public function get_user_by_id( $id ) {
		$query = $this->db->get_where(
			'users', array(
				'id' => (int) $id, 
			));
			
		$result = $query->row();
		return $result;
		
	}
	
	/**
	 * Updates User in the database
	 *
	 * @access public
	 * @param array $post
	 * return boolean
	 */
	public function update_user( $post  = array() ) {
		if ( isset( $post[ 'change_pass' ] ) ) {
			$data = array(
				'password' => $post[ 'password' ],
				'level' => ( int ) $post[ 'level' ]
			);
		} else {
			$data = array(
				'level' => ( int ) $post[ 'level' ]
			);
		}
		
		$this->db->update( 'users', $data, "id = " . $post[ 'user_id' ] );
		
		if ( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
	
	}
	
	/**
	 * Gets level data by level id
	 *
	 * @access public
	 * @param int $id
	 * @return string
	 */
	public function get_level_by_id( $id ) {
		$query = $this->db->get_where(
			'level_meta', array(
				'level_id' => (int) $id, 
			));
		
		$result = $query->row();
		
		return $result->name;
	}
	
	/**
	 * Assignes user to a team
	 *
	 * @access public
	 * @param int array $post
	 * @return boolean
	 */
	public function assign_user_to_team( $post ) {
		$data = array(
			'user_id' => (int) $post['username'],
			'team_id' => (int) $post['team']
		);
		
		$this->db->insert( 'user_team', $data );
		
		if ( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
	}
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */