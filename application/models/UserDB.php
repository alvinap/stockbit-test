<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDB extends CI_Model {
	
	function get_active_record()
	{
		$this->db->from('user');
		$q = $this->db->get();
		$res = $q->result();
		if ($res) {
			foreach ($res as $row) {
				$parent = $this->get_username_by_id($row->parent);
				$row->parent_username = $parent?$parent->username:null;
			}
		} else
			$res = [];
		return $res;
	}

	function get_username_by_id($id)
	{
		$this->db->select('username');
		$this->db->from('user');
		$this->db->where('id', $id);
		$q = $this->db->get();
		$res = $q->row();
		if (!$res)
			$res = null;
		return $res;
	}

	function get_raw_query()
	{
		$sql = '
			SELECT
				a.id AS id,
				a.username AS username,
				(
					SELECT 
						username 
					FROM 
						user 
					WHERE 
						id = a.parent
				) AS parent_username
			FROM 
				user a
			ORDER BY
				id ASC
		';
		$res = $this->db->query($sql);
		$res = $res->result();
		return $res;
	}
}
