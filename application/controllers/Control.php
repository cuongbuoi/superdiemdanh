<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('admin');
		
	}		
	public function logout()
	{
		if($this->session->userdata('admin') != "")
		{
			$this->session->unset_userdata('admin');
			redirect(base_url().'superdiemdanh/');
		}
		else{
			REDIRECT(base_url()."superdiemdanh/");
		}
	}

	public function dashboard(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/diemdanh-content';
		$this->load->view('dashboard',$data);
	}

	public function dashboard2(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/nhapdiem-content';
		$this->load->view('dashboard',$data);
	}
	public function dashboard3(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/thongke-content';
		$this->load->view('dashboard',$data);
	}

	public function get()
	{
		
		$data=$this->admin->get_value();
		$push=array();
		foreach($data as $key=>$value)
		{
		    array_push($data[$key],'<button id="btn-login" type="button" class="btn btn-danger btn-diemdanh">Vắng mặt</button>');
		}
		$re=array("data"=>$data);
		
	 echo	json_encode($re,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	public function checkurl()
	{
		echo $this->uri->segment(2);
	}

}
