<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function send_email_contact($username, $from, $to)
	{
		//SMTP & mail configuration
		$config = array(
		    'protocol'  => 'smtp',
		    // 'smtp_host' => 'ssl://smtp.gmail.com',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => '__user_email__',
		    'smtp_pass' => '__password_email__',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8',
		    // 'charset'   => 'iso-8859-1',
		    'crlf'      => "\r\n",
            'newline'   => "\r\n"
		);
		$this->email->initialize($config);

		$this->email->from($from, $username);
		$this->email->to($to);

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		//Send email
		try {
			$send = $this->email->send();
			if ($send == false)
		        throw new Exception($this->email->print_debugger());
		    return 'Done!';
		} catch (Exception $e) {
			return $e;
		}
	}

	function curl($attr=[])
	{
		$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $attr['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $attr['method'],
            CURLOPT_POSTFIELDS => json_encode($attr['body']),
            CURLOPT_HTTPHEADER => array(),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err)
            $response = $err;

        return $response;
	}
}