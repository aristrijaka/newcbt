
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array(
        'blog_title' => 'My Blog Title',
        'blog_heading' => 'My Blog Heading',
        'menus'=> $this->menu()
        );
		$this->parser->parse('home', $data); 
		//;
	}
	public function biodata()
	{
		$data = array(
        'page_title' => 'Biodata',
        'blog_heading' => 'My Blog Heading',
        'menus'=> $this->menu('biodata'),
        'base_url' => base_url()
        );
		$this->parser->parse('biodata', $data); 
		//;
	}
	public function tpa()
	{
		$data = array(
        'page_title' => 'TPA',
        'blog_heading' => 'My Blog Heading',
        'menus'=> $this->menu('tpa'),
        'soal' => $this->soal(),
        'base_url' => base_url(),
        'monitor' => $this->monitor(),
        'petunjuk' => $this-> petunjuk()
        );
		$this->parser->parse('tpa', $data); 
		//;
	}
	public function soal($value='')
	{
		$ssl='';
		$qry = out_where('soal',array('is_active' => 'Y'));
		$no=1;
		foreach($qry as $rw){
			if ($no > 1){
            	$btb ='<button  class="back" value='.$no.' style=" float: left;"  > < Kembali  </button>';
            	$disp = 'none';
            }else{
            	$disp = '';
            	$btb ='';
            }
			$ssl .= '<div id="soal'.$no.'" style "display: '.$disp.'" class="alert alert-warning">
						<h3><strong>Soal no '.$no.'</strong></h4>
                        <img src="'.base_url().'assets/soalipa/'.$rw->gambar.'" class="img-rounded"  >  
                        <hr>
                        <div class="alert alert-default"> <h4>Pilih Jawaban</h4> 
                          <input class="btn jawaban '.$no.'-A tdk_pilih" value="A" style=" width: 40px; " />
                          <input class="btn jawaban '.$no.'-B tdk_pilih" value="B" style=" width: 40px; " />
                          <input class="btn jawaban '.$no.'-C tdk_pilih" value="C" style=" width: 40px; " />
                          <input class="btn jawaban '.$no.'-D tdk_pilih" value="D" style=" width: 40px; " />
                          <input class="btn jawaban '.$no.'-E tdk_pilih" value="E" style=" width: 40px; " /> 
                        <hr> '.$btb.'<button  class="next" value='.$no.' style=" float: right;"  >Lanjut > </button> 
                    </div>
                    </div>';
                    $no++; 
		}  
        return $ssl;
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
                            <li><a '.$class_dashboard.' href='.base_url().'>Dashboard</a></li>
                            <li><a '.$class_biodata.' href="'.base_url().'welcome/biodata">Biodata</a></li>
                            <li><a '.$class_skala.' href="'.base_url().'welcome/skala">Test Skala</a></li>
                            <li><a '.$class_tpa.' href="'.base_url().'welcome/tpa">Test TPA</a></li>
                            <li><a '.$class_hasil.' href="login.html">Hasil</a></li>
                            <li><a href="blank.html">Logout</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>';
		return $out;
	}
	public function monitor($value='')
	{
		$out='';
		for ($x = 1; $x <= 50; $x++) {
        $out .='  <input class="btn monitor M-'.$x.' btn-default"  value="'.$x.'" style=" width: 40px; " /> ';
        } 
        return $out;
	}
	public function petunjuk($value='')
	{
		$out=' <p><strong></strong></p>
               <p style="text-align: center; margin-bottom: 10pt; line-height: 114%; font-family: Calibri; font-size: 11pt;" align="center"><strong><span style="font-family: \'Times New Roman\'; font-weight: bold; font-size: 12.0000pt;">PETUNJUK </span></strong></p> 
               <ol>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Sebelum mengerjakan ujian, telitilah terlebih dahulu jumlah soal dan nomor halaman yang terdapat pada naskah ujian. Naskah ujian 50 butir soal (A,B,C,D,E).</span></li>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Tulislah nomor dan nama Saudara pada lembar jawaban di tempat yang disediakan sesuai dengan petunjuk yang diberikan oleh pengawas.</span></li>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Bacalah soal dengan cermat dan kerjakan keseluruhan soal.</span></li>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Saudara diberi waktu 90 menit untuk mengerjakan keseluruhan soal</span></li>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Kerjakan soal dalam lembar jawaban yang telah disediakan</li>
                <li class="NewStyle17"><span style="font-family: \'Times New Roman\'; font-size: 12.0000pt;">Apabila Saudara telah selesai mengerjakan soal, kumpulkan hasil kepada pengawas.</span></li>
            </ol>
            <p>&nbsp;</p>';
        return $out;
	}
}
