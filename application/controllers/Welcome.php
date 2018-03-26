<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 if($this->session->userdata('admin') != '')
        {
            redirect(base_url().'superdiemdanh/control/dashboard');
        }
		$this->load->model('login');
		if($this->input->post('action'))
		{
		
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
				if( $this->login->admin_login($this->input->post('username'),$this->input->post('password'))==1)
						redirect(base_url().'superdiemdanh/control/dashboard');
				else{
							$this->session->set_flashdata('error','Sai tài khoản hoặc mật khẩu');
							redirect(base_url().'superdiemdanh/');
				}

			}
		}
		else
			$this->load->view('index');
	}
}
