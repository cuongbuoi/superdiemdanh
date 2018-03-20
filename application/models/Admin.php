<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('admin') == '')
        {
            redirect(base_url().'superdiemdanh/');
        }
    }
    public function get_value()
    { 
        $count = array('sinhvien.mssv',
        'sinhvien.hoten',
        'gioitinh',
        'lop.tenlop as lop',
        'count(buoivang) as bv');
        $data=$this->db->select($count)->from('sinhvien')->join('buoivang','sinhvien.mssv = buoivang.mssv','left')->join('lop','lop.malop = sinhvien.malop')->group_by('sinhvien.mssv')->get()->result_array();
        return $data;
    }


    public function deodihoc()
    {
        $id = $this->input->post('mss');
    }
    public function deocandiem($class,$sub)
    {
        
        $data=$this->db->from('diemdanh')->join('sinhvien','sinhvien.mssv=diemdanh.mssv','right')->join('monhoc','diemdanh.idmonhoc=monhoc.id','left')->join('lop','sinhvien.malop=lop.malop')->where(array('diemdanh.malop'=>$class,'idmonhoc'=>$sub))->group_by('sinhvien.mssv')->get()->result_array();
        return $data;
    }
    public function get_class()
    {
        return $this->db->from('lop')->get()->result_array();
        
    }
    public function get_sub($id)
    {
        return $this->db->select(array('tenmonhoc','idmonhoc'))->from('monhoc')->join('diemdanh','monhoc.id=diemdanh.idmonhoc')->where(array('malop'=>$id))->distinct()->get()->result_array();
    }
    public function edit_mark($id,$diem2,$diem3)
    {
        return $this->db->query("update diemdanh set diem2='{$diem2}' , diem3='{$diem3}' where mssv='{$id}'");
    }

}
?>