<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('admin');
			$this->load->helper(array('form', 'url'));
		
	}

	public function index()
	{
		if($this->input->post('action'))
		{
			$this->load->library('form_validation');
			$config = array(
				array(
								'field' => 'username',
								'label' => 'Username',
								'rules' => 'required',
								'errors' => array(
									'required' => 'Tài khoản không được để trống',
					),
				),
				array(
								'field' => 'password',
								'label' => 'Password',
								'rules' => 'required',
								'errors' => array(
												'required' => 'Mật khẩu không được để trống',
								),
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{	
					$this->load->view('index');
			}
			else
			{
				if( $this->admin->admin_login($this->input->post('username'),$this->input->post('password'))==1)
						redirect('http://localhost/superdiemdanh/control/dashboard');
				else{
							$this->session->set_flashdata('error','Sai tài khoản hoặc mật khẩu');
							redirect('http://localhost/superdiemdanh/');
				}

			}
		}
		else
			$this->load->view('index');

		}
		
		public function logout()
		{
			if($this->session->userdata('admin') != "")
			{
				$this->session->unset_userdata('admin');
				redirect('http://localhost/superdiemdanh/');
			}
			else{
				REDIRECT("http://localhost/superdiemdanh/");
			}
		}

	public function dashboard(){
		if($this->session->userdata('admin') == '')
		{
			redirect('http://localhost/superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/diemdanh-content';
		$this->load->view('dashboard',$data);
	}

	public function get()
	{
		$data=$this->admin->get_value();
		$push=array();
		foreach($data as $key=>$value)
		{
		    array_push($data[$key],'<button id="btn-login" type="button" class="btn btn-primary btn-diemdanh">Điểm danh</button>');
		}
		$re=array("data"=>$data);
		
	 echo	json_encode($re,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

}
