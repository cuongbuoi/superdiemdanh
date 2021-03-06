<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('admin');
		$this->load->database();
		
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
		$data['class']=$this->admin->get_class();
	
		$this->load->view('dashboard',$data);
	}
	public function dashboard4(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		if($this->uri->segment(3)==''){
			$data['header']='module/navbar';
			$data['sidebar']='module/sidebar';
			$data['diemdanh']='module/quanly-content';
			$this->load->view('dashboard',$data);
		}
		else if($this->uri->segment(3)=='insert'){
			
		}
		
	}
	public function dashboard5(){
		if($this->session->userdata('admin') == '')
		{
			redirect(base_url() .'superdiemdanh/');
		}
		$data['header']='module/navbar';
		$data['sidebar']='module/sidebar';
		$data['diemdanh']='module/suabuoivang-content';
		$data['class']=$this->admin->get_class();
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
				<td>".round(floatval(($value['diem1']+$value['diem2']+($value['diem3'])*2)/4),1,PHP_ROUND_HALF_UP)."</td>
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
		$t="<option value='#'></option>";
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
		echo json_encode('ok');
	}

	public function tylevang()
	{
		$class = $this->input->post('idclass');
		$mon = $this->input->post('idmon');
		echo $this->admin->tylevang($class,$mon);
	}
	public function suabuoivang()
	{
		if($this->input->post('malop')&&$this->input->post('mamon')){

			
			$data=$this->admin->get_value($this->input->post('malop'),$this->input->post('mamon'));
			$push=array();
			foreach($data as $key=>$value)
			{
				array_push($data[$key],'<button type="button" class="btn btn-primary btn-suabuoivang" data-toggle="modal" data-target="#suabuoivang" onclick="editbuoivang(\''.$value['mssv'].'\')">
				Sửa buổi vắng
			  </button>');
			}
			$re=array("data"=>$data);
			
			echo	json_encode($re,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
	public function laygido()
	{
		if($this->input->post('mssv')&&$this->input->post('idmonhoc')){
			$data=$this->admin->getvalueeditbuoivang($this->input->post('mssv'),$this->input->post('idmonhoc'));
			if(count($data)>0){
				$t='<table class="table" id="edittable">
				<thead class="thead-light">
					<tr>
						<th style="display:none"></th>
						<th>Mssv</th>
						<th>Họ và Tên</th>
						<th>Vắng ngày</th>  
					</tr>
				</thead>
				<tbody>';
				foreach ($data as $value)
				{
				
					$t.='<tr>
							<td style="display:none">'.$value['mssv'].'|'.$value['buoivang'].'</td>	
							<td>'.$value["mssv"].'</td>
							<td>'.$value["hoten"].'</td>
							<td>'.$value["buoivang"].'</td>
						</tr>';
				}
				echo $t .'</tbody></table>';
			}
			else{
				$t="Sinh viên này không nghỉ ngày nào";
				echo $t;
			}
		}
	}
	public function deletebuoivang()
	{
		if($this->input->post('action')=='delete'){
			$id = $this->input->post('id');
			$this->admin->deletebuoivang($id);
			echo json_encode($this->input->post('action'));
	
		}
		
	}


	public function tylediem()
	{
		if( $this->input->post('idclass') != '' and  $this->input->post('idmon'))
		{
			$class = $this->input->post('idclass');
			  $mon = $this->input->post('idmon');
			 
			echo $this->admin->tylediem($class,$mon);
		}
		else
		{
			echo 'error';
		}
		
		
	}
	public function report()
	{
		$data=$this->db->select('diemdanh.mssv,hoten,tenlop,tenmonhoc,diem1,diem2,diem3,gioitinh')->from('diemdanh')->join('sinhvien','diemdanh.mssv=sinhvien.mssv')
		->join('lop','diemdanh.malop=lop.malop')->join('monhoc','diemdanh.idmonhoc=monhoc.id')->where('diemdanh.malop',	 $this->uri->segment(3, 0))->where('diemdanh.idmonhoc',$this->uri->segment(4, 0))
		->get()->Result_Array();
		if(count( $data)>0)
		{
			$this->load->library('print');
			$this->print->report($data);
		}
		else
		{
			redirect(base_url().'superdiemdanh/control/dashboard2');
		}
	
		
	}
	public function insert()
	{
		if($this->input->post('action')=='insert')
		{
			$config = array(
				array(
								'field' => 'tenmon',
								'label' => 'tenmon',
								'rules' => 'required',
								'errors' => array(
									'required' => 'Tên môn học không được bỏ trống',
					),
				),
				array(
					'field' => 'sotinhchi',
					'label' => 'sotinhchi',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Số tín chỉ không được bỏ trống',
					),
				),
				array(
					'field' => 'sotiet',
					'label' => 'sotiet',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Số tiết không được bỏ trống',
					),
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{	
				$data['header']='module/navbar';
				$data['sidebar']='module/sidebar';
				$data['diemdanh']='module/themmonhoc-content';
				$this->load->view('dashboard',$data);
			}
			else
			{
				if($this->admin->Them_mon_hoc($this->input->post('tenmon'),$this->input->post('sotinhchi'),$this->input->post('sotiet'))==1)
				{
					redirect(base_url().'superdiemdanh/control/dashboard4');
				}
			}
		}else{
			$data['header']='module/navbar';
			$data['sidebar']='module/sidebar';
			$data['diemdanh']='module/themmonhoc-content';
			$this->load->view('dashboard',$data);
		}
			
	}
	public function readexcel()
	{
	   if(isset($_FILES['f']))
	   {
		$config['upload_path'] = 'application/upload/';
		$config['allowed_types'] = 'csv|xls|xlsx';
		$config['overwrite'] = true;
		$this->load->library("upload", $config);
			if($this->upload->do_upload("f"))
			{
				$check = $this->upload->data();
				$this->load->library('print');
				$kk=$this->print->read('application/upload/'.$check['file_name'].'',$this->input->post('lop'));
				$this->db->insert_batch('sinhvien', $kk); 
			
			}
			else
			{
				echo "ahuhu";
			}
				
	   }

	   		$data['header']='module/navbar';
			$data['sidebar']='module/sidebar';
			$data['diemdanh']='module/upload-content';
			$data['lop']=$this->db->get('lop')->result_Array();
			$this->load->view('dashboard',$data);
	}
	public function insertclass()
	{
		if($this->input->post('action')=='insert')
		{
			$config = array(
				array(
								'field' => 'tenmon',
								'label' => 'tenmon',
								'rules' => 'required',
								'errors' => array(
									'required' => 'Mã lớp không được bỏ trống',
					),
				),
				array(
					'field' => 'sotinhchi',
					'label' => 'sotinhchi',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Tên lớp không được bỏ trống',
					),
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{	
				$data['header']='module/navbar';
				$data['sidebar']='module/sidebar';
				$data['diemdanh']='module/themlop-content';
				$this->load->view('dashboard',$data);
			}
			else
			{
				if($this->admin->them_lop($this->input->post('tenmon'),$this->input->post('sotinhchi'))==1)
				{
					redirect(base_url().'superdiemdanh/control/readexcel');
				}
			}
		}else{
			$data['header']='module/navbar';
			$data['sidebar']='module/sidebar';
			$data['diemdanh']='module/themlop-content';
			$this->load->view('dashboard',$data);
		}
	}



}
