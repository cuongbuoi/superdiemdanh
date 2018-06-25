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
     public function gettablemonhoc()
     {
        return $this->db->get('monhoc')->result_array();
     }
     public function editmonhoc($id,$tenmon,$sotc,$sotiet)
     {
        $data= array('tenmonhoc'=>$tenmon,'sotinhchi'=>$sotc,'sotiet'=>$sotiet);
        $this->db->where('id',$id);
        $this->db->update('monhoc',$data);
        
     }

      public function tylevang($idclass,$idmon){
      $vang = $this->db->select('count(mssv) as vang')->where("diem1 != 10 and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();

      $kovang = $this->db->select('count(mssv) as kvang')->where("diem1 = 10 and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();
      
      
        return json_encode(array("ti_le_vang"=>floatval(intval($vang[0]['vang'])/((intval($vang[0]['vang']) + intval($kovang[0]['kvang'])))) * 100,"ko_vang"=>floatval(intval($kovang[0]['kvang'])/((intval($vang[0]['vang']) + intval($kovang[0]['kvang'])))) * 100));

     }
     public function getvalueeditbuoivang($mssv,$id)
     {
         return $this->db->select('buoivang.mssv,hoten,buoivang')->from('buoivang')->join('sinhvien','buoivang.mssv=sinhvien.mssv')->where(array('buoivang.mssv'=>$mssv,'idmonhoc'=>$id))->get()->result_array();
     }
     public function deletebuoivang($id)
     {
        $data = explode("|", $id);
        $this->db->delete('buoivang', array('mssv' => $data[0],'buoivang'=>$data[1]));
     }



     public function tylediem($idclass,$idmon)
     {
        $diem_kem = $this->db->select('count(mssv) as diemkem')->where("(diem1+diem2+(diem3))/3 <= 3.5 and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();

         $diem_tb = $this->db->select("count(mssv) as diemtb")->where("(diem1+diem2+(diem3))/3 >= 4 and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();

           $diem_kha = $this->db->select("count(mssv) as diemkha")->where("(diem1+diem2+(diem3))/3 >= 6.5 and (diem1+diem2+(diem3))/3 <=8  and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();
         $diem_gioi = $this->db->select("count(mssv) as diemgioi")->where("(diem1+diem2+(diem3))/3 > 8 and (diem1+diem2+(diem3))/3 <= 10  and malop = '".$idclass."' and idmonhoc='".$idmon."'")->from('diemdanh')->get()->result_array();


          //return $diem_tb[0]['diemtb'];

          return json_encode(array("diem_kem" => floatval(intval($diem_kem[0]['diemkem'])/((intval($diem_kem[0]['diemkem']) + intval($diem_tb[0]['diemtb']) + intval($diem_kha[0]['diemkha'])+intval($diem_gioi[0]['diemgioi'])))) * 100,"diem_tb" => floatval(intval($diem_tb[0]['diemtb'])/((intval($diem_kem[0]['diemkem']) + intval($diem_tb[0]['diemtb']) + intval($diem_kha[0]['diemkha'])+intval($diem_gioi[0]['diemgioi'])))) * 100,"diem_kha" => floatval(intval($diem_kha[0]['diemkha'])/((intval($diem_kem[0]['diemkem']) + intval($diem_tb[0]['diemtb']) + intval($diem_kha[0]['diemkha'])+intval($diem_gioi[0]['diemgioi'])))) * 100,"diem_gioi" => floatval(intval($diem_gioi[0]['diemgioi'])/((intval($diem_kem[0]['diemkem']) + intval($diem_tb[0]['diemtb']) + intval($diem_kha[0]['diemkha'])+intval($diem_gioi[0]['diemgioi'])))) * 100));


     }
     public function Them_mon_hoc($tenmon,$sotinhchi,$sotiet)
     {
         if($this->db->insert('monhoc',['tenmonhoc'=>$tenmon,'sotinhchi'=>$sotinhchi,'sotiet'=>$sotiet]))
         {
             return 1;
         }
         else
         {
             return 0;
         }
         
     }
     public function them_lop($malop,$tenlop)
     {
        if($this->db->insert('lop',['malop'=>$malop,'tenlop'=>$tenlop,'khoa'=>'Kỹ Thuật-Công Nghệ-Môi Trường']))
        {
            return 1;
        }
        else
        {
            return 0;
        }
     }



  

}
?>