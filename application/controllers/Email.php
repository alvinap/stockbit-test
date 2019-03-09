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

		// This function move to ./system/libraries/Email.php start at lines 1723
		/* Write File
		$text = $username.' has just send email';
		if ($send==false)
			$text = $username.' failed send email';
		write_file(APPPATH.'cache/writeme.txt', $text."\n", 'a+');
		*/
		
		$this->output->set_output($send);
	}
}
