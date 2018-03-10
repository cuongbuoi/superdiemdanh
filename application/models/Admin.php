<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Model
{
    public function __construct() {
        $this->load->database();
        $this->load->library('session');
	}
    public function admin_login($id,$pass)
    {
       $data= $this->db->where(array('id'=>$id,'pass'=>$pass))->get('admin')->result_array();
        if(count($data)==1)
        {
            //$this->session->set_userdata('admin','123');
            $newdata =array('admin'=>$id);
           $this->session->userdata($newdata);
           return 1;
        }
        else
            return 0;
    }
}
?>