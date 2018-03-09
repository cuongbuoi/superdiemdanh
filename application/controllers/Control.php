<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	public function index()
	{
		$this->load->view('index');

    }
    public function admin()
    {
        echo "thằng buôi đầu cặc lõ";
    }

	

	public function hello()
	{
		print "hello cc!";
	}
	public function dashboard(){
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$this->load->view('dashboard',$data);
	}

}
