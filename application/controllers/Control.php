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
		$data['class']=$this->admin->get_class();
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
		$data['class']=$this->admin->get_class();
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
	public function dashboard4(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/quanly-content';
		$this->load->view('dashboard',$data);
	}
	public function dashboard5(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/suabuoivang-content';
		$this->load->view('dashboard',$data);
	}

	public function get()
	{
		if($this->input->post('malop')&&$this->input->post('mamon')){

		
			$data=$this->admin->get_value($this->input->post('malop'),$this->input->post('mamon'));
			$push=array();
			foreach($data as $key=>$value)
			{
				array_push($data[$key],'<button type="button" onclick="diemdanh(\''.$value['mssv'].'\')" class="btn btn-danger btn-diemdanh">Vắng mặt</button>');
			}
			$re=array("data"=>$data);
			
			echo	json_encode($re,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
	public function get_table()
	{
		$data=$this->admin->deocandiem($this->input->post('class'),$this->input->post('mon'));
		$t="";
		foreach($data as $value)
		{
			$t.="<tr>
				<td>".$value['hoten']."</td>
				<td>".$value['mssv']."</td>
				<td>".$value['tenlop']."</td>
				<td>".$value['tenmonhoc']."</td>
				<td>".$value['diem1']."</td>
				<td>".$value['diem2']."</td>
				<td>".$value['diem3']."</td>
				<td>".round(floatval(($value['diem1']+$value['diem2']+$value['diem3'])/3),2,PHP_ROUND_HALF_UP)."</td>
				</tr>";
		}
		echo $t;
	}
	public function edit_mark(){
		$diem2=$this->input->post('diem2')!='' ? $this->input->post('diem2'): 0;
		$diem3=$this->input->post('diem3')!='' ? $this->input->post('diem3'): 0;
		if((floatval($diem2)>=0 && floatval($diem2)<=10) && (floatval($diem3)>=0 && floatval($diem3)<=10)){
		
			if($this->admin->edit_mark($this->input->post('mssv'),$diem2,$diem3)){
				echo "1";
			}
			else
				echo "0";
		}
		else{
			echo "0";
		}
	}
	public function get_sub()
	{
		$data=$this->admin->get_sub($this->input->post('id'));
		$t="";
		foreach($data as $value){
			$t.= "<option value='".$value["idmonhoc"]."'>".$value["tenmonhoc"]."</option>";
		}
		echo $t;
	}

	public function diemdanh()
    {
		
		$mssv = $this->input->post('mssv');
		$mon = $this->input->post("idmon");
		if($this->admin->diemdanh($mssv,$mon)){
			echo 'ok';
		}
		else{
			echo 'error';
		}
	
		
		
		
	}
	public function study()
	{
	
		if($this->admin->study('HTTT','1'))
			echo "ahihi";
		else
			echo "ahuhu";
		
	}
	public function quanlymon()
	{
		switch($this->input->post('action'))
		{
			case "gettable":
				$data=$this->admin->gettablemonhoc();
				$t="";
				foreach($data as $value){
					$t.="<tr>
							<td>".$value['id']."</td>
							<td>".$value['tenmonhoc']."</td>
							<td>".$value['sotinhchi']."</td>
							<td>".$value['sotiet']."</td>
						</tr>";
				}
				echo $t;		
				break;
			default:
				break;
		}		
	}
	public function editmon()
	{
		$this->admin->editmonhoc($this->input->post('id'),$this->input->post('tenmonhoc'),$this->input->post('sotinhchi'),$this->input->post('sotiet'));
	}

	public function tylevang()
	{
		echo($this->admin->tylevang());
	}

	public function tylediem()
	{
		echo $this->admin->tylediem();
	}



}
