<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Model
{
  
    public function admin_login($id,$pass)
    {
       $data= $this->db->where(array('id'=>$id,'pass'=>$pass))->get('admin')->result_array();
        if(count($data)==1)
        {
            //$this->session->set_userdata('admin','123');
            $newdata =array('admin'=>$id);
           $this->session->set_userdata($newdata);
           return 1;
        }
        else
            return 0;
    }
} 
?>