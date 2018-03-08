<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');

    }
    public function admin()
    {
        echo "thằng buôi đầu cặc lõ";
    }

	

	public function hello()
	{
		print "hello cc!";
	}

}
