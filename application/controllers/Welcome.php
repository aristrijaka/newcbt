<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('konten');
		$this->load->model('peserta');
	}
	public function index()
	{
		$data = array(
			'blog_title' => 'My Blog Title',
			'blog_heading' => 'My Blog Heading',
			'kelompok' => $this->konten->get_kelompok(),
			'base_url' => base_url(),
			'menus'=> $this->konten->menu()
			);
		$this->parser->parse('auth/login', $data); 
		//;
	}
	public function home()
	{
		if(!$this->peserta->is_login()){
			redirect('welcome', 'refresh');
		}else{
			$peserta = $this->peserta->get_memberdata();
			$data = array(
				'blog_title' => 'My Blog Title',
				'blog_heading' => 'Hallo : '.$peserta->nama,
				'menus'=> $this->konten->menu(),
				'base_url' => base_url()
				);
			$this->parser->parse('home', $data); 
		}
	}
	public function hasil()
	{
		if(!$this->peserta->is_login()){
			redirect('welcome', 'refresh');
		}else{
			$peserta = $this->peserta->get_memberdata();
			$data = array(
				'blog_title' => 'My Blog Title',
				'page_title' => 'Hasil Assessment',
				'tpa' => out_field('hasil_test', array('id_mhs' =>$peserta->id,'id_ujian'=>1),'score'),
				'skala' => out_field('hasil_test', array('id_mhs' =>$peserta->id,'id_ujian'=>2),'score') * (100/80),
				'menus'=> $this->konten->menu('hasil'),
				'base_url' => base_url()
				);
			$this->parser->parse('hasil', $data); 
		}
	}
	public function biodata()
	{
		if(!$this->peserta->is_login()){
			redirect('welcome', 'refresh');
		}else{
			$peserta = $this->peserta->get_memberdata(); 
			$data = array(
				'page_title' => 'Biodata',
				'nama' => $peserta->nama,
				'no_ujian'=> $peserta->no_ujian,
				'tgl_lahir' => todmy($peserta->tgl_lahir),
				'prodi1' => out_field('jurusan', array('id' => $peserta->id_prodi1),'jurusan'),
				'prodi2' =>out_field('jurusan', array('id' => $peserta->id_prodi2),'jurusan'),
				'jkel' =>$peserta->jkel,
				'menus'=> $this->konten->menu('biodata'),
				'base_url' => base_url()
				);
			$this->parser->parse('biodata', $data); 
		}
	}
	public function tpa()
	{
		if(!$this->peserta->is_login()){
			redirect('welcome', 'refresh');
		}else{
		$peserta = $this->peserta->get_memberdata(); 
		$data = array(
			'page_title' => 'TPA', 
			'menus'=> $this->konten->menu('tpa'),
			'soal' => $this->konten->soal($peserta->id),
			'timer'=> $this->konten->get_time($peserta->id),
			'base_url' => base_url(),
		//	'monitor' => $this->konten->monitor($peserta->id),
			'petunjuk' => $this->konten-> petunjuk()
			);
		$this->parser->parse('tpa', $data); 
		}
	}
	public function skala()
	{
		if(!$this->peserta->is_login()){
			redirect('welcome', 'refresh');
		}else{
		$peserta = $this->peserta->get_memberdata(); 
		$data = array(
			'page_title' => 'TPA', 
			'menus'=> $this->konten->menu('skala'),
			'soal' => $this->konten->soal_scala($peserta->id),
			'timer'=> $this->konten->get_time_skala($peserta->id),
			'petunjuk'=>'',
			'base_url' => base_url()
			);
		$this->parser->parse('skala', $data); 
		}
	}
	function eko_login() { 
		$data = $this->peserta->submit_login();
	} 
	function eko_logout() { 
		$data = $this->peserta->logout();
	}
	function post() {
		return $this->page->eko(urinext('post'));
	}
	
	function get_pilihan1(){
		$kel=$this->input->post('kelompok');
		if($kel==4){
			$kelompok ='';
		}else{
			$kelompok =' and id_kelompok='.$kel;
		}
		$out=array();
		$valid=false;
		$sql = "select*from jurusan where is_active ='y' ".$kelompok." order by id"; 
		$jur = get_option(out_where($sql), array('val' => 'id', 'text' => 'jurusan'),0,true,'Pilih Jurusan I');
		$out = array(
			'valid'=> true,
			'jurusan'=>$jur);
		echo json_encode($out);
	}
	function get_pilihan2(){
		$kel=$this->input->post('kelompok');
		$id=$this->input->post('pil1');
		if($kel==4){
			$id_k=out_field('jurusan',array('id'=>$id),'id_kelompok');
			$kelompok =' and id_kelompok <> '.$id_k;
		}else{
            //$id_k=out_field('id_kelompok',array('id'=>$id),'id_kelompok');
			$kelompok =' and id_kelompok='.$kel;
		}
		$out=array();
		$valid=false;
		$sql = "select*from jurusan where is_active ='y' ".$kelompok." and id <> ".$id."  order by id";
		$jur = get_option(out_where($sql), array('val' => 'id', 'text' => 'jurusan'),0,true,'Pilih Jurusan II');
		$out = array(
			'valid'=> true,
			'jurusan'=>$jur);

		echo json_encode($out);
	}
	public function save_jwb()
	{
		$out = array('valid' => false);
		if(!$this->peserta->is_login()){
			$out->valid = false;
		}else{
			$peserta = $this->peserta->get_memberdata(); 
			$row = out_row('hasil_test', array('id_mhs' => $peserta->id,'id_ujian'=>1));
			if (count($row) > 0) { 
				$this->db->set('jawaban', $this->input->post('jawaban'));
				$this->db->where('id_mhs', $peserta->id);
				$this->db->where('id_ujian', 1);
				$this->db->update('hasil_test'); 
				$out['valid'] = true;
			} 
			$this->konten->koreksi($peserta->id);
			echo json_encode($out);
		}
	}
	public function save_jwb_last()
	{
		$out = array('valid' => false);
		if(!$this->peserta->is_login()){
			$out->valid = false;
		}else{
			$initDate = new DateTime(); 
      		$xx=$initDate->format('Y-m-d H:i:s');
			$peserta = $this->peserta->get_memberdata(); 
			$row = out_row('hasil_test', array('id_mhs' => $peserta->id,'id_ujian'=>1));
			if (count($row) > 0) { 
				$this->db->set('jawaban', $this->input->post('jawaban'));
				$this->db->set('akhir', $xx);
				$this->db->where('id_mhs', $peserta->id);
				$this->db->where('id_ujian', 1);
				$this->db->update('hasil_test'); 
				$out['valid'] = true;
			} 
			$this->konten->koreksi($peserta->id);
			echo json_encode($out);
		}
	}
	public function cetak_hasil_tpa()
	{
		$this->konten->cetak_lap_ujian();
	}
	public function save_jwb_skala()
	{
		$out = array('valid' => false);
		if(!$this->peserta->is_login()){
			$out->valid = false;
		}else{
			$peserta = $this->peserta->get_memberdata(); 
			$row = out_row('hasil_test', array('id_mhs' => $peserta->id,'id_ujian'=>2));
			if (count($row) > 0) { 
				$this->db->set('jawaban', $this->input->post('jawaban'));
				$this->db->where('id_mhs', $peserta->id);
				$this->db->where('id_ujian', 2);
				$this->db->update('hasil_test'); 
				$out['valid'] = true;
			} 
			$this->konten->koreksi_skala($peserta->id);
			echo json_encode($out);
		}
	}
	public function save_jwb_last_skala()
	{
		$out = array('valid' => false);
		if(!$this->peserta->is_login()){
			$out->valid = false;
		}else{
			$initDate = new DateTime(); 
      		$xx=$initDate->format('Y-m-d H:i:s');
			$peserta = $this->peserta->get_memberdata(); 
			$row = out_row('hasil_test', array('id_mhs' => $peserta->id,'id_ujian'=>2));
			if (count($row) > 0) { 
				$this->db->set('jawaban', $this->input->post('jawaban'));
				$this->db->set('akhir', $xx);
				$this->db->where('id_mhs', $peserta->id);
				$this->db->where('id_ujian', 2);
				$this->db->update('hasil_test'); 
				$out['valid'] = true;
			} 
			$this->konten->koreksi_skala($peserta->id);
			echo json_encode($out);
		}
	}
	public function cetak_hasil_skala()
	{
		$this->konten->cetak_lap_ujian_skala();
	}
}