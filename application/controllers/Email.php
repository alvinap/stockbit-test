<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {

	public function send()
	{
		// Send Mail
		$username = 'Alvin Ashari';
		$from = 'alvinn.ap7@gmail.com';
		$to = 'alvin.ap7@gmail.com';
		$send = $this->send_email_contact($username, $from, $to);

		/* Write File 
		this function is located at /system/libraries/Email.php start at lines 1723,
		this function called after send mail at MY_Controller line 32.
		*/
		
		$this->output->set_output($send);
	}
}
