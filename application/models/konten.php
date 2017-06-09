<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class konten extends CI_Model {
  
  function soal($idp='')
  {
    $qryx = out_row('hasil_test',array('id_mhs' => $idp,'id_ujian' => 1)); 
    if (count($qryx) < 1) { 
      $ssl='<div class="row"><div class="col-md-9"> '; $daftar='{';$lsoal=array();$monit='';
      $mhs = $this->peserta->get_memberdata(); 
      if ($mhs->id_jurusan=='1'){
        $jur =  'IPA';
        $max = 50;
      }else if ($mhs->id_jurusan=='2'){
        $jur =  'IPS';
        $max = 60;
      }else{
        $jur = 'IPC';
        $max = 50;
      }
        //$qry = out_where('select * from soal where is_active = "Y" and kategori ='.$mhs->id_jurusan.' order by rand() limit 50');
      $qry = out_where('select * from soal where is_active = "Y" and kategori ='.$mhs->id_jurusan.' order by id limit '.$max );
      $no=1;
      foreach($qry as $rw)
      { 
        array_push($lsoal,$rw->id);
        $daftar .='S'.$rw->id.':\'X\',';
        if ($no > 1)
        {
          $btb ='<button  class="back" value='.$rw->id.' style=" float: left;"  > < Kembali  </button>';
          $disp = 'none';
        }else
        {
          $disp = '';
          $btb ='';
        }
        $ssl .= '<div id="soal'.$rw->id.'" style ="display: '.$disp.';" class="alert alert-warning">
        <h3><strong>Soal '. $jur.' no '.$no.'</strong></h4>
          <input type="hidden" id="soal_'.$rw->id.'" value ="'.$rw->id.'">
          <img src="'.base_url().'assets/soal/'.$jur.'/'.$rw->gambar.'" class="img-rounded"  >  
          <hr>
          <div class="alert alert-default"> <h4>Pilih Jawaban</h4> 
            <input class="btn jawaban '.$rw->id.'-A tdk_pilih" value="A" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-B tdk_pilih" value="B" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-C tdk_pilih" value="C" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-D tdk_pilih" value="D" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-E tdk_pilih" value="E" style=" width: 40px; " /> 
            <hr> '.$btb.'<button  class="next" value='.$rw->id.' style=" float: right;"  >Lanjut > </button> 
          </div>
        </div>';
        $monit .='  <input class="btn monitor M-'.$rw->id.' btn-default"  value="'.$no.'" style=" width: 40px; " /> ';
        $no++; 
      }  
      $ssl .= '<input type="hidden" id="rekap" value ="'.$daftar.'X:\'X\'}">';
      $ssl .='            </div> 
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LEMBAR MONITOR JAWABAN
                    </div>         
                    <h3 style="text-align:center;" ><input class="btn simpan btn-warning" value="Selesai" onclick="send_jwb_last();" /></h3>
                    <div class="panel-body"> ';
      $ssl .= $monit;
      $ssl .='</div></div></div></div>';
      $initDate = new DateTime(); 
      $xx=$initDate->format('Y-m-d H:i:s');
      $initDate->add(new DateInterval('PT5400S')); 
      $yy=$initDate->format('Y-m-d H:i:s');
      $array=array(
        'id_ujian'=>1,
        'id_mhs'=>$idp, 
        'mulai'=>$xx ,
        'akhir'=>$yy,
        'lsoal'=>implode(",",$lsoal)
        ); 
      $this->db->insert('hasil_test', $array); 
      return $ssl;
    }
    else{  
      $ssl='<div class="row"><div class="col-md-9"> '; $daftar='{';$monit='';
      $qry = out_where('select * from soal where id in('.$qryx->lsoal.')');
      $mhs = $this->peserta->get_memberdata(); 
      if ($mhs->id_jurusan=='1'){
        $jur =  'IPA';
      }else if ($mhs->id_jurusan=='2'){
        $jur =  'IPS';
      }else{
        $jur = 'IPC';
      }
      $no=1;
      foreach($qry as $rw)
      {     
        $jawaban = json_decode($qryx->jawaban); 
        $key = 'S'.$rw->id;
        $a = $jawaban->$key; 
        $class_a = 'tdk_pilih'; $class_b = 'tdk_pilih'; $class_c = 'tdk_pilih'; $class_d = 'tdk_pilih'; $class_e = 'tdk_pilih';
        switch ($a) {
              case "A":
              $class_a='pilih'; 
              break;
              case "B": 
              $class_b='pilih"'; 
              break;
              case "C":
              $class_c='pilih';
              break;
              case "D":
              $class_d='pilih';
              break;
              case "E":
              $class_e='pilih';
              break;
              default:
              echo "";
            }
        $daftar .='S'.$rw->id.':\'X\',';
        if ($no > 1)
        {
          $btb ='<button  class="back" value='.$rw->id.' style=" float: left;"  > < Kembali  </button>';
          $disp = 'none';
        }else
        {
          $disp = '';
          $btb ='';
        }
        $ssl .= '<div id="soal'.$rw->id.'" style ="display: '.$disp.';" class="alert alert-warning">
        <h3><strong>Soal no '.$no.'</strong></h4>
          <input type="hidden" id="soal_'.$rw->id.'" value ="'.$rw->id.'">
          <img src="'.base_url().'assets/soal/'.$jur.'/'.$rw->gambar.'" class="img-rounded"  >  
          <hr>
          <div class="alert alert-default"> <h4>Pilih Jawaban</h4> 
            <input class="btn jawaban '.$rw->id.'-A '.$class_a.'" value="A" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-B '.$class_b.'" value="B" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-C '.$class_c.'" value="C" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-D '.$class_d.'" value="D" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-E '.$class_e.'" value="E" style=" width: 40px; " /> 
            <hr> '.$btb.'<button  class="next" value='.$rw->id.' style=" float: right;"  >Lanjut > </button> 
          </div>
        </div>';
        $monit .='  <input class="btn monitor M-'.$rw->id.' btn-default"  value="'.$no.'" style=" width: 40px; " /> ';
        $no++; 
      }   
     // $ssl .= '<input type="hidden" id="rekap" value ="'.$daftar.'X:\'X\'}">';
      $ssl .='            </div> 
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LEMBAR MONITOR JAWABAN
                    </div>         
                    <h3 style="text-align:center;" ><input class="btn simpan btn-warning" value="Selesai" onclick="send_jwb_last();" /></h3>
                    <div class="panel-body"> ';
      $ssl .= $monit;
      $ssl .='</div></div></div></div>';
      $ssl .= "<input type='hidden' id='rekap' value ='".$qryx->jawaban."'>"; 

      return $ssl;
    }
  }
  function soal_scala($idp='')
  {
    $qryx = out_row('hasil_test',array('id_mhs' => $idp,'id_ujian' => 2)); 
    if (count($qryx) < 1) { 
      $ssl='<div class="row"><div class="col-md-9"> '; $daftar='{';$lsoal=array();$monit='';
      $mhs = $this->peserta->get_memberdata();  
      $max = 20; 
        //$qry = out_where('select * from soal where is_active = "Y" and kategori ='.$mhs->id_jurusan.' order by rand() limit 50');
      $qry = out_where('select * from soal_skala where is_active = "Y" order by id limit '.$max );
      $no=1;
      $atas=count($qry);
      foreach($qry as $rw)
      { 
        array_push($lsoal,$rw->id);
        $daftar .='S'.$rw->id.':\'X\',';
        if ($no > 1)
        {
          $btb ='<button  class="back" value='.$rw->id.' style=" float: left;"  > < Kembali  </button>';
          $disp = 'none';
        }else
        {
          $disp = '';
          $btb ='';
        }
        $ssl .= '<div id="soal'.$rw->id.'" style ="display: '.$disp.';" class="alert alert-warning">
        <h3><strong>Soal skala kepribadian no '.$no.' dari '.$atas.'</strong></h4>
          <input type="hidden" id="soal_'.$rw->id.'" value ="'.$rw->id.'">
          <img src="'.base_url().'assets/soal/SCALA/'.$rw->gambar.'" class="img-rounded"  >  
          <hr>
          <div class="alert alert-default"> <h4>Pilih Jawaban</h4> 
            <input class="btn jawaban '.$rw->id.'-A tdk_pilih" value="A" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-B tdk_pilih" value="B" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-C tdk_pilih" value="C" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-D tdk_pilih" value="D" style=" width: 40px; " /> 
            <hr> '.$btb.'<button  class="next" value='.$rw->id.' style=" float: right;"  >Lanjut > </button> 
          </div>
        </div>';
        $monit .='  <input class="btn monitor M-'.$rw->id.' btn-default"  value="'.$no.'" style=" width: 40px; " /> ';
        $no++; 
      }  
      $ssl .= '<input type="hidden" id="rekap" value ="'.$daftar.'X:\'X\'}">';
      $ssl .='            </div> 
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LEMBAR MONITOR JAWABAN
                    </div>         
                    <h3 style="text-align:center;" ><input class="btn simpan btn-warning" value="Selesai" onclick="send_jwb_last();" /></h3>
                    <div class="panel-body"> ';
      $ssl .= $monit;
      $ssl .='</div></div></div></div>';
      $initDate = new DateTime(); 
      $xx=$initDate->format('Y-m-d H:i:s');
      $initDate->add(new DateInterval('PT1800S')); 
      $yy=$initDate->format('Y-m-d H:i:s');
      $array=array(
        'id_ujian'=>2,
        'id_mhs'=>$idp, 
        'mulai'=>$xx ,
        'akhir'=>$yy,
        'lsoal'=>implode(",",$lsoal)
        ); 
      $this->db->insert('hasil_test', $array); 
      return $ssl;
    }
    else{  
      $ssl='<div class="row"><div class="col-md-9"> '; $daftar='{';$monit='';
      $qry = out_where('select * from soal_skala where id in('.$qryx->lsoal.')');
      $mhs = $this->peserta->get_memberdata();  
      $no=1;
      $atas=count($qry);
      foreach($qry as $rw)
      {     
        $jawaban = json_decode($qryx->jawaban); 
        $key = 'S'.$rw->id;
        $a = $jawaban->$key; 
        $class_a = 'tdk_pilih'; $class_b = 'tdk_pilih'; $class_c = 'tdk_pilih'; $class_d = 'tdk_pilih'; $class_e = 'tdk_pilih';
        switch ($a) {
              case "A":
              $class_a='pilih'; 
              break;
              case "B": 
              $class_b='pilih"'; 
              break;
              case "C":
              $class_c='pilih';
              break;
              case "D":
              $class_d='pilih';
              break; 
              default:
              echo "";
            }
        $daftar .='S'.$rw->id.':\'X\',';
        if ($no > 1)
        {
          $btb ='<button  class="back" value='.$rw->id.' style=" float: left;"  > < Kembali  </button>';
          $disp = 'none';
        }else
        {
          $disp = '';
          $btb ='';
        }
        $ssl .= '<div id="soal'.$rw->id.'" style ="display: '.$disp.';" class="alert alert-warning">
        <h3><strong>Soal no '.$no.' dari '.$atas.'</strong></h4>
          <input type="hidden" id="soal_'.$rw->id.'" value ="'.$rw->id.'">
          <img src="'.base_url().'assets/soal/SCALA/'.$rw->gambar.'" class="img-rounded"  >  
          <hr>
          <div class="alert alert-default"> <h4>Pilih Jawaban</h4> 
            <input class="btn jawaban '.$rw->id.'-A '.$class_a.'" value="A" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-B '.$class_b.'" value="B" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-C '.$class_c.'" value="C" style=" width: 40px; " />
            <input class="btn jawaban '.$rw->id.'-D '.$class_d.'" value="D" style=" width: 40px; " /> 
            <hr> '.$btb.'<button  class="next" value='.$rw->id.' style=" float: right;"  >Lanjut > </button> 
          </div>
        </div>';
        $monit .='  <input class="btn monitor M-'.$rw->id.' btn-default"  value="'.$no.'" style=" width: 40px; " /> ';
        $no++; 
      }   
     // $ssl .= '<input type="hidden" id="rekap" value ="'.$daftar.'X:\'X\'}">';
      $ssl .='            </div> 
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LEMBAR MONITOR JAWABAN
                    </div>         
                    <h3 style="text-align:center;" ><input class="btn simpan btn-warning" value="Selesai" onclick="send_jwb_last();" /></h3>
                    <div class="panel-body"> ';
      $ssl .= $monit;
      $ssl .='</div></div></div></div>';
      $ssl .= "<input type='hidden' id='rekap' value ='".$qryx->jawaban."'>"; 

      return $ssl;
    }
  }
  public function menu($target='Dashboard')
  {
    $class_dashboard='';
    $class_biodata='';
    $class_tpa='';
    $class_skala='';
    $class_hasil='';
    switch ($target) {
      case "Dashboard":
      $class_dashboard='class="menu-top-active"'; 
      break;
      case "biodata": 
      $class_biodata='class="menu-top-active"'; 
      break;
      case "tpa":
      $class_tpa='class="menu-top-active"';
      break;
      case "skala":
      $class_skala='class="menu-top-active"';
      break;
      case "hasil":
      $class_hasil='class="menu-top-active"';
      break;
      default:
      echo "";
    }
    $out ='<section class="menu-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="navbar-collapse collapse ">
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a '.$class_dashboard.' href="'.base_url().'welcome/home">Dashboard</a></li>
              <li><a '.$class_biodata.' href="'.base_url().'welcome/biodata">Biodata</a></li>
              <li><a '.$class_skala.' href="'.base_url().'welcome/skala">Test Skala</a></li>
              <li><a '.$class_tpa.' href="'.base_url().'welcome/tpa">Test TPA</a></li>
              <li><a '.$class_hasil.' href="'.base_url().'welcome/hasil">Hasil</a></li>
              <li><a href="'.base_url().'welcome/eko_logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </section>';
    return $out;
  } 
  public function petunjuk($value='')
  {
    $out=' <div id="petunjuk"><p><strong></strong></p>
    <p style="text-align: center; margin-bottom: 10pt; line-height: 114%; font-family: Calibri; font-size: 11pt;" align="center"><strong><span style="font-family: \'Times New Roman\'; font-weight: bold; font-size: 12.0000pt;">PETUNJUK </span></strong></p> 
    <ol>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Sebelum mengerjakan ujian, telitilah terlebih dahulu jumlah soal dan nomor halaman yang terdapat pada naskah ujian. Naskah ujian 50 butir soal (A,B,C,D,E).</span></li>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Tulislah nomor dan nama Saudara pada lembar jawaban di tempat yang disediakan sesuai dengan petunjuk yang diberikan oleh pengawas.</span></li>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Bacalah soal dengan cermat dan kerjakan keseluruhan soal.</span></li>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Saudara diberi waktu 90 menit untuk mengerjakan keseluruhan soal</span></li>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Kerjakan soal dalam lembar jawaban yang telah disediakan</li>
      <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Apabila Saudara telah selesai mengerjakan soal, kumpulkan hasil kepada pengawas.</span></li>
    </ol>
    <p>&nbsp;</p></div>';
    return $out;
  }
  function get_kelompok(){
    $kel='';
    $sql = "select*from kelompok where is_active ='y' order by id";
    $kel = get_option(out_where($sql), array('val' => 'id', 'text' => 'kelompok'),0,true,'Pilih Kelompok');
    return $kel;
  }
  public function koreksi($idp='')
  {
    $qryx = out_row('hasil_test',array('id_mhs' => $idp,'id_ujian' => 1)); 
    $jawaban = json_decode($qryx->jawaban); 
    $lsoal = explode(",",$qryx->lsoal); 
    $this->db->query('update hasil_test set benar = 0 , salah = 0 ,terjawab = 0 where id_ujian=1 and  id_mhs='.$idp); 
    $sekor = 100 / count($lsoal);
    foreach ($lsoal as $value) { 
      $kunci = out_field('soal', array('id' => $value ),'kunci');
      $key = 'S'.$value;
      $jwb = $jawaban->$key; 
      if ($jwb != 'X'){ 
        $this->db->query('update hasil_test set terjawab = (terjawab + 1) where id_ujian = 1 and id_mhs='.$idp);
      } 
      if($kunci==$jwb){
       $this->db->query('update hasil_test set benar = (benar + 1) where id_ujian= 1 and id_mhs='.$idp);
      }else{
       $this->db->query('update hasil_test set salah = (salah + 1) where id_ujian= 1 and id_mhs='.$idp);
      }
    }
    $mhs = $this->peserta->get_memberdata();
    if ($mhs->id_prodi1 == 19){
      $this->db->query('update hasil_test set score = (benar * '.$sekor.') where id_ujian=1 and id_mhs='.$idp);
    }else{
      $this->db->query('update hasil_test set score = (benar * '.$sekor.') where id_ujian=1 and id_mhs='.$idp);
      $this->db->query('update hasil_test set score = ((benar * '.$sekor.')+30) where terjawab>15 and id_ujian=1 and id_mhs='.$idp);
      $this->db->query('update hasil_test set score = 100 where score > 100 and id_ujian=1 and id_mhs='.$idp);
    }
    
  }
  public function koreksi_skala($idp='')
  {
    $qryx = out_row('hasil_test',array('id_mhs' => $idp,'id_ujian' => 2)); 
    $jawaban = json_decode($qryx->jawaban); 
    $lsoal = explode(",",$qryx->lsoal); 
    $this->db->query('update hasil_test set score = 0 ,benar = 0 , salah = 0 ,terjawab = 0 where id_ujian=2 and  id_mhs='.$idp); 
    $sekor = 100 / count($lsoal);
    foreach ($lsoal as $value) { 
      //$kunci = out_field('soal', array('id' => $value ),'kunci'); 
      $key = 'S'.$value;
      $jwb = $jawaban->$key; 
      if ($jwb != 'X'){ 
        $kunci =  out_row('soal_skala',array('id' => $value));
        $keyn = 'jawaban_'.$jwb;
        $nilai_kunci = $kunci->$keyn; 
        $this->db->query('update hasil_test set terjawab = (terjawab + 1),score = (score + '.$nilai_kunci.') where id_ujian = 2 and id_mhs='.$idp);
      }  
    } 
    
  }
  public function get_time_skala($idp='')
  {
    $initDate = new DateTime();
    $cek=array('id_ujian'=>2,'id_mhs'=>$idp); 
    $row = out_row('hasil_test', $cek);
    $mula= new DateTime($row->mulai);
    $akhir= new DateTime($row->akhir);
    $now = new DateTime(); 
    if ($now > $akhir){
        redirect(base_url().'welcome/home', 'refresh');
        return; 
    } 
    $diver = $akhir->getTimestamp() - $now->getTimestamp();
    return $diver;
  }
  public function get_time($idp='')
  {
    $initDate = new DateTime();
    $cek=array('id_ujian'=>1,'id_mhs'=>$idp); 
    $row = out_row('hasil_test', $cek);
    $mula= new DateTime($row->mulai);
    $akhir= new DateTime($row->akhir);
    $now = new DateTime(); 
    if ($now > $akhir){
        redirect(base_url().'welcome/home', 'refresh');
        return; 
    } 
    $diver = $akhir->getTimestamp() - $now->getTimestamp();
    return $diver;
  }
  function cetak_lap_ujian(){  
        $array = array();  
        $id = 1;
        $member = $this->peserta->get_memberdata(); 
        $row = out_row("select*from hasil_test where id_mhs = '".$member->id."' and id_ujian = 1 and is_active='Y' ");

        if(!isset($member->id)){
            redirect(base_url());
            return false;
        }
        if(count($row) < 1 or $id < 1){
            redirect(base_url());
            return false;
        }
        $lulus='LULUS';
        if($row->score<50){
            $lulus='';
        }
        $score=$row->score;
        if ($score>=50){
          $stts='Diterima';
        }else{
          $stts='Pending';
        }
        $ket_lulus='Diterima';
        if (($member->id_prodi1 == 23 ) or ($member->id_prodi2 == 23 )){
            $ket_lulus ="Status ".$stts." dan menunggu hasil tes Kesehatan dan Ketrampilan ";
        }else{
            $ket_lulus = "Status ".$stts." Selanjutnya menunggu hasil tes Wawancara";
        }
        $kelompok = out_field('kelompok', array('id' => $member->id_jurusan),'kelompok');
        $pilihan = '1.'.out_field('jurusan',array('id' =>$member->id_prodi1 ),'jurusan').' / 2. '.out_field('jurusan',array('id' =>$member->id_prodi2 ),'jurusan');
        $array = array(
            array('posx' => 90, 'posy' => 60, 'size' => 13, 'val' => 'HASIL UJIAN:', 'style' => 'B'),
            array('posx' => 65, 'posy' => 70, 'size' => 14, 'val' => 'COMPUTER ASSESSMENT TES', 'style' => 'B'),
            array('posx' => 40, 'posy' => 85, 'size' => 12, 'val' => 'No Ujian'),
            array('posx' => 60, 'posy' => 85, 'size' => 12, 'val' => ': '.$member->no_ujian),
            array('posx' => 40, 'posy' => 95, 'size' => 12, 'val' => 'Nama'),
            array('posx' => 60, 'posy' => 95, 'size' => 12, 'val' => ': '.$member->nama),
            array('posx' => 40, 'posy' => 105, 'size' => 12, 'val' => 'J.Kelamin'),
            array('posx' => 60, 'posy' => 105, 'size' => 12, 'val' => ': '.$member->jkel),
            array('posx' => 40, 'posy' => 115, 'size' => 12, 'val' => 'Jurusan'),
            array('posx' => 60, 'posy' => 115, 'size' => 12, 'val' => ': '.$pilihan),
            array('posx' => 38, 'posy' => 152, 'size' => 12, 'val' => toDmy($row->mulai)),
            array('posx' => 82, 'posy' => 152, 'size' => 12, 'val' => toDmy($row->akhir)),
            array('posx' => 132, 'posy' => 152, 'size' => 13, 'val' => $score, 'style' => 'B'),
            array('posx' => 164, 'posy' => 152, 'size' => 13, 'val' => '*)', 'style' => 'B'),
            array('posx' => 132, 'posy' => 200, 'size' => 12, 'val' => 'Semarang,          2017'),
            array('posx' => 132, 'posy' => 208, 'size' => 12, 'val' => 'Pengawas Ujian'),
            array('posx' => 132, 'posy' => 235, 'size' => 12, 'val' => '(............................................)'),
            array('posx' => 132, 'posy' => 245, 'size' => 12, 'val' => 'NPP: ..................................'), 

            array('posx' => 40, 'posy' => 170, 'size' => 12, 'val' => '*)'.$ket_lulus), 
            
        );

        $this->load->library('fpdi');
        $file = 'assets/pdf_tpl/surat_pgri.pdf';
        if(!file_exists($file)){
            return;
        }
        $pagecount = $this->fpdi->setSourceFile($file);
        $tplidx = $this->fpdi->importPage(1, '/MediaBox');
        $size = $this->fpdi->getTemplateSize($tplidx);
        $this->fpdi->addPage();
        $this->fpdi->useTemplate($tplidx, null, null, $size['w'], $size['h'], true);
        
        
        foreach($array as $key=>$item){
            if(!isset($arr[$key])){$arr[$key] = '';}
            $st = '';
            if(isset($item['style'])){$st = $item['style'];}
            $this->fpdi->SetFont('Arial', $st, $item['size']);
            $this->fpdi->SetXY(0, 0);
            $this->fpdi->Text($item['posx'], $item['posy'], $item['val'].$arr[$key]);
        }
        //exit('kene');
        $this->fpdi->Output('Hasil Ujian Cat '.$member->no_ujian.'.pdf', 'D');
    }
  function cetak_lap_ujian_skala(){ 
        $array = array();  
        $member = $this->peserta->get_memberdata(); 
        $row = out_row("select*from hasil_test where id_mhs = '".$member->id."' and id_ujian = 2 and is_active='Y' ");

        if(!isset($member->id)){
            redirect(base_url());
            return false;
        }   
        $pilihan = '1.'.out_field('jurusan',array('id' =>$member->id_prodi1 ),'jurusan').' / 2. '.out_field('jurusan',array('id' =>$member->id_prodi2 ),'jurusan');
        $score=$row->score;  
        
        $array = array(
            array('posx' => 90, 'posy' => 60, 'size' => 13, 'val' => 'HASIL UJIAN:', 'style' => 'B'),
            array('posx' => 80, 'posy' => 70, 'size' => 14, 'val' => 'SKALA KEPRIBADIAN', 'style' => 'B'),
            array('posx' => 40, 'posy' => 85, 'size' => 12, 'val' => 'No Ujian'),
            array('posx' => 60, 'posy' => 85, 'size' => 12, 'val' => ': '.$member->no_ujian),
            array('posx' => 40, 'posy' => 95, 'size' => 12, 'val' => 'Nama'),
            array('posx' => 60, 'posy' => 95, 'size' => 12, 'val' => ': '.$member->nama),
            array('posx' => 40, 'posy' => 105, 'size' => 12, 'val' => 'J.Kelamin'),
            array('posx' => 60, 'posy' => 105, 'size' => 12, 'val' => ': '.$member->jkel),
            array('posx' => 40, 'posy' => 115, 'size' => 12, 'val' => 'Jurusan'),
            array('posx' => 60, 'posy' => 115, 'size' => 12, 'val' => ': '.$pilihan ),
            array('posx' => 38, 'posy' => 152, 'size' => 12, 'val' => toDmy($row->mulai)),
            array('posx' => 82, 'posy' => 152, 'size' => 12, 'val' => toDmy($row->akhir)),
            array('posx' => 132, 'posy' => 152, 'size' => 13, 'val' => $score, 'style' => 'B'),
            //array('posx' => 164, 'posy' => 152, 'size' => 13, 'val' => $lulus, 'style' => 'B'),
            array('posx' => 132, 'posy' => 200, 'size' => 12, 'val' => 'Semarang, 2017'),
            array('posx' => 132, 'posy' => 208, 'size' => 12, 'val' => 'Pengawas Ujian'),
            array('posx' => 132, 'posy' => 235, 'size' => 12, 'val' => '(............................................)'),
            array('posx' => 132, 'posy' => 245, 'size' => 12, 'val' => 'NPP: ..................................'), 
            
        );
        $this->load->library('fpdi');
        $file = 'assets/pdf_tpl/surat_pgri.pdf';
        if(!file_exists($file)){
            return;
        }
        $pagecount = $this->fpdi->setSourceFile($file);
        $tplidx = $this->fpdi->importPage(1, '/MediaBox');
        $size = $this->fpdi->getTemplateSize($tplidx);
        $this->fpdi->addPage();
        $this->fpdi->useTemplate($tplidx, null, null, $size['w'], $size['h'], true);
        
        
        foreach($array as $key=>$item){
            if(!isset($arr[$key])){$arr[$key] = '';}
            $st = '';
            if(isset($item['style'])){$st = $item['style'];}
            $this->fpdi->SetFont('Arial', $st, $item['size']);
            $this->fpdi->SetXY(0, 0);
            $this->fpdi->Text($item['posx'], $item['posy'], $item['val'].$arr[$key]);
        }
        //exit('kene');
        $this->fpdi->Output('Hasil Ujian Scala '.$member->no_ujian.'.pdf', 'D');
    }
}