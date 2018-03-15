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
}
?>