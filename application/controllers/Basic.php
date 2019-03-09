<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic extends CI_Controller {

	public function a()
	{
		// Parameter for sending
		$param = 'string';

		$param = 1;
		
		$param = [
			'alvin',
			'ashari'
		];
		
		$param = [
			['name', 'alvin'],
			['city', 'jakarta']
		];
		
		// $param = [
		// 	['name' => 'alvin'],
		// 	['city' => 'jakarta']
		// ];
		
		// $param = [
		// 	['name' => [
		// 		'first' => 'alvin',
		// 		'second' => 'ashari'
		// 		]
		// 	],
		// 	['city' => 'jakarta']
		// ];
		
		// Send Parameter
		$this->throwparam($param);
	}
		private function throwparam($param)
		{
			$output = $param;
			if (is_array($param)) {
				$output = '';
				foreach ($param as $k => $val)
					$output .= $this->loop($val);
			}
			$this->output->set_output($output);
		}
		private function loop($param)
		{
			$output = '';
			if (is_array($param)) {
				foreach ($param as $k => $val) {
					$_output = '';
					if (!is_array($val)) {
						$val = $k.' => '.$val;
						$_output = $val.'<br/>';
					} else
						$_output = $this->loop($val);
					$output .= $_output;
				}
			} else
				$output = $param.'<br/>';
			return $output;
		}

	public function b()
	{
		// Parameter for sending
		$string = '(28 Maret 2018) Some string is below here (please note below): The dummy formula is a=(x+y)+100.';

		// Proccess
		$res = '';
		$exp1 = explode('(', $string);
		unset($exp1[0]); // remove array index 0
		foreach ($exp1 as $k => $row) {
			$exp2 = explode(')', $row);
			if (count($exp2)>1)
				$res .= $exp2[0].'<br/>';
		}
		$this->output->set_output($res);
	}
}
