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
    public function get_value($malop,$mamon)
    { 
        // $count = array('sinhvien.mssv',
        // 'sinhvien.hoten',
        // 'gioitinh',
        // 'lop.tenlop as lop',
        // 'count(buoivang.mssv) as bv'
        // );
        $data=$this->db->query('SELECT DISTINCT sinhvien.mssv,sinhvien.hoten,sinhvien.gioitinh,lop.tenlop,monhoc.tenmonhoc, t1.bv as bv from sinhvien join lop on sinhvien.malop=lop.malop join diemdanh on sinhvien.mssv = diemdanh.mssv join monhoc on diemdanh.idmonhoc=monhoc.id left join (select mssv,count(mssv) as bv from buoivang where idmonhoc="'.$mamon.'" GROUP by buoivang.mssv) as t1 on sinhvien.mssv = t1.mssv where diemdanh.malop="'.$malop.'" and diemdanh.idmonhoc="'.$mamon.'"')->result_array();
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

    public function diemdanh($mssv,$mon)
    {
        
            $data = array("mssv"=>$mssv,"idmonhoc"=>$mon,"buoivang" => date("d/m/Y"));
            if($this->db->insert("buoivang",$data))
            {
            $this->db->set('diem1','diem1-1',false);
            $this->db->where('mssv',$mssv);
            $this->db->where('idmonhoc',$mon);
            $this->db->where('diem1>','0');
            $this->db->update('diemdanh');
            return true;
            }
            else{
                return false;
            }
          
            return false;
        
      
       
    }
    public function study($malop,$mamon)
    {
         $sv=$this->db->select('mssv,malop')->from('sinhvien')->where('malop',$malop)->get()->result_array();
       
         foreach ($sv as $key=>$value)
         {
             $sv[$key]['idmonhoc']=$mamon;
         }
         return $this->db->insert_batch('diemdanh',$sv)? true:false;

     }

  

}
?>