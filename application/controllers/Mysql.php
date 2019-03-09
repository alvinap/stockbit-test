<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mysql extends CI_Controller {

	public function user()
	{
		// Load Model
		$this->load->model('UserDB');

		// Get Record
		$user = $this->UserDB->get_active_record(); // Get with active record
		// $user = $this->UserDB->get_raw_query(); // Get with query raw

		// Set HTML View
		$this->set_table_view($user);
	}

	private function set_table_view($data)
	{
		$table = '';
		$table .= '<table border="1" style="width: 100%;">';
		$table .= '<tr>';
		$table .= '<th>ID</th>';
		$table .= '<th>UserName</th>';
		$table .= '<th>Parent UserName</th>';
		$table .= '</tr>';
		foreach ($data as $row) {
			$table .= '<tr>';
			$table .= '<th>'.$row->id.'</th>';
			$table .= '<th>'.$row->username.'</th>';
			$table .= '<th>'.($row->parent_username?$row->parent_username:'-').'</th>';
			$table .= '</tr>';
		}
		$table .= '</table>';
		$this->output->set_output($table);
	}
}
