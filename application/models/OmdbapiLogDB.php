<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OmdbapiLogDB extends CI_Model {
	
	function insert($data)
	{
		$this->db->set($data);
		$q = $this->db->insert('omdbapi_log');
		return $q;
	}
}
