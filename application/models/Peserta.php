<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class peserta extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function is_login() {
        $data = $this->session->userdata('mem');
        if ($data > 0) {
            return true;
        }
        return false;
    }
    function get_memberdata() {
        $data = $this->session->userdata('mem');
        if (!$this->is_login()) { 
            return false;
        } else {
            $array = array('id' => $data);
        }
        $member = out_row('c_mahasiswa', $array);
        return $member;
    } 
    function submit_login() { 
        $array = array(
            'no_ujian' => $this->input->post('no_ujian'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'id_jurusan' => $this->input->post('jurusan'),
            'id_prodi1' => $this->input->post('prodi1'),
            'id_prodi2' => $this->input->post('prodi2'),
            'jkel' => $this->input->post('jkel'),
            'nama' => $this->input->post('nama'),
            ); 
        $row = out_row('c_mahasiswa', array('no_ujian' => $this->input->post('no_ujian')));
        //print_r($array);exit();
        $out = array('valid' => false);
        if (count($row) > 0) { 
            $this->session->set_userdata('mem', $row->id); 
            $out = array('valid' => true);
        }else{
            $this->db->insert('c_mahasiswa', $array); 
            $row = out_row('c_mahasiswa', $array);
            if (count($row) > 0) { 
                $this->session->set_userdata('mem', $row->id); 
                $out = array('valid' => true);
            }
        }
        //redirect(base_url().'home');
        echo json_encode($out);
    }
    function logout() {
        $this->session->unset_userdata('mem'); 
        redirect(base_url().'welcome', 'refresh');
    }

    function cek_ujian(){
       $member= $this->get_memberdata();

   }

}
