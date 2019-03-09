<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends MY_Controller {

	protected $apiurl = 'http://www.omdbapi.com/';

	protected $apikey = 'faf7e5bb';

	public function index()
	{
		$this->load->view('movie');
	}

	public function search()
	{
		// Get Parameter
		$keyword = $this->input->get('keyword');
		if (!$keyword or $keyword == '')
        	return $this->output->set_output('Error Method');

		// Send Request
		$attr = [
            'url' => $this->apiurl.'?apikey='.$this->apikey.'&s='.$keyword.'&page=2',
            'method' => 'GET',
            'body' => array()
        ];
        $curl = $this->curl($attr);
        $result = json_decode($curl);

		// Save to DB Log
		$this->load->model('OmdbapiLogDB');
        $post_data = [
        	'req_time' => date('Y-m-d h:i:s'),
        	'keyword' => $keyword,
        	'result' => json_encode($result)
        ];
        $act = $this->OmdbapiLogDB->insert($post_data);
        if (!$act)
        	return $this->output->set_output('Error DB');

        // Set Data result
        $data = [];
        if (isset($result->Search))
        	$data = $result->Search;

        // Set to Table View
        $this->set_table_view($data);
	}

	private function set_table_view($data)
	{
		$table = '';
		$table .= '<table border="1" style="width: 100%;">';
		$table .= '<tr>';
		$table .= '<th>Title</th>';
		$table .= '<th>Year</th>';
		$table .= '<th>imdbID</th>';
		$table .= '<th>Type</th>';
		$table .= '<th>Poster</th>';
		$table .= '</tr>';
		foreach ($data as $row) {
			$table .= '<tr>';
			$table .= '<th>'.$row->Title.'</th>';
			$table .= '<th>'.$row->Year.'</th>';
			$table .= '<th>'.$row->imdbID.'</th>';
			$table .= '<th>'.$row->Type.'</th>';
			$table .= '<th><img src="'.$row->Poster.'"></th>';
			$table .= '</tr>';
		}
		$table .= '</table>';
		$this->output->set_output($table);
	}
}
