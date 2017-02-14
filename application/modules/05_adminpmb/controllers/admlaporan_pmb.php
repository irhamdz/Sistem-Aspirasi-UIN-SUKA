<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admlaporan_pmb extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("lib_adminpmb", '', 'adminpmb');
		$this->load->library("pagination");
		$this->load->library("lib_pagging", '', 'lib_pajax');
		if($this->adminpmb->cek_allowed("AAZ001#AAZF09#POU001")){
			
		}else{
			redirect();
		}
		
	
	}
	
	
/* //DATA PENDAFTAR
	function data_pendaftar_old(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['WARGANEGARA'])){
				$error="PILIH STATUS KEWARGANEGARAAN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				#print_r($_POST); die();
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG'], 'WARGANEGARA' => $_POST['WARGANEGARA']);
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 1, 'api_search' => $datapost);
				$data['count_pendaftar']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data); die();
				#echo $data['count_pendaftar'][0]->TOTAL_PENDAFTAR; die();
				//////
				$config = array();
				$config["base_url"] = base_url()."adminpmb/admlaporan-data_pendaftar";
				$config["total_rows"]=$data['count_pendaftar'][0]->TOTAL_PENDAFTAR;
				$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
				$config['full_tag_close'] = '</ul></div>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = 'Selanjutnya';
				$config['prev_link'] = 'Sebelumnya';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li><a href="#" style="font-weight:bold;background-color:#f5f5f5">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_links'] = 2;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['first_link'] = 'Pertama';
				$config['last_link'] = 'Terakhir';

				$config["per_page"] = 20;
				$config["uri_segment"] = 3;
				$this->pagination->initialize($config);
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$data['links'] = $this->pagination->create_links(); 
				$batas_akhir='';
				if($page>1){
					$limit=$page+20;
				}else{
					$limit=20;
				}
				/////////
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG'], 'WARGANEGARA' => $_POST['WARGANEGARA'], 'LIMIT' => $limit, 'START' => $this->uri->segment(3));
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 2, 'api_search' => $datapost);
				$data['pendaftar']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data); die();
				$this->load->view('05_adminpmb/admlaporan/data_pendaftar/list_data_pendaftar', $data);
			}
		}else{
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_awal']=2014;
			$data['tahun_sekarang']=date("Y");
			$data['tampil_tahun']=$data['tahun_sekarang']-$data['tahun_awal'];		
			$this->output99->output_display('05_adminpmb/admlaporan/data_pendaftar/form_data_pendaftar', $data);
		}
	}
	 */
	function pendaftar_difabel(){
		$datapost=array('TAHUN'=>2015, 'GELOMBANG' => 10);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 113, 'api_search' => $datapost);
		$data['pendaftar_difabel']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		echo "<pre>"; PRINT_R($data); echo "</pre>"; die();
		
	}
	
	function data_pendaftar(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['WARGANEGARA'])){
				$error="PILIH STATUS KEWARGANEGARAAN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				#print_r($_POST); die();
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG'], 'WARGANEGARA' => $_POST['WARGANEGARA']);
				#print_r($datapost); die();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 2, 'api_search' => $datapost);
				$count_pendaftar=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data); die();
				// echo $count_pendaftar[0]->TOTAL_PENDAFTAR; die();
				#$data['count_pendaftar']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				//////
				
				$data = '';
				#$config["total_rows"] = $data['count_pendaftar'][0]->TOTAL_PENDAFTAR;
				#echo $count_rekap; die();
				$conf['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
				$conf['full_tag_close'] = '</ul></div>';
				$conf['next_tag_open'] = '<li>';
				$conf['next_tag_close'] = '</li>';
				$conf['prev_tag_open'] = '<li>';
				$conf['prev_tag_close'] = '</li>';
				$conf['next_link'] = 'Selanjutnya';
				$conf['prev_link'] = 'Sebelumnya';
				$conf['num_tag_open'] = '<li>';
				$conf['num_tag_close'] = '</li>';
				$conf['cur_tag_open'] = '<li><a href="#" style="font-weight:bold;background-color:#f5f5f5">';
				$conf['cur_tag_close'] = '</a></li>';
				$conf['num_links'] = 2;
				$conf['first_tag_open'] = '<li>';
				$conf['first_tag_close'] = '</li>';
				$conf['last_tag_open'] = '<li>';
				$conf['last_tag_close'] = '</li>';
				$conf['first_link'] = 'Pertama';
				$conf['last_link'] = 'Terakhir';
				$conf['total_rows'] = $count_pendaftar[0]->TOTAL_PENDAFTAR;
				$conf['per_page'] = 20;
				
				$start = ($this->input->post('page') == TRUE)? $this->input->post('page') : 0;
				$start = str_replace("page-", "", $start);
				$data['nourut'] = str_replace("page-", "", $start);
				#echo $start; die();
				#$start = 50;
				$conf['cur_page'] = $start;
				$this->lib_pajax->initialize($conf);
				$data['link'] = $this->lib_pajax->create_links();
				/////////
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG'], 'WARGANEGARA' => $_POST['WARGANEGARA'], 'LIMIT' => $conf['per_page']+$start, 'START' => $start);
				#print_r($datapost);
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 3, 'api_search' => $datapost);
				$data['pendaftar']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				$data['warganegara']=$_POST['WARGANEGARA'];
				#print_r($data); #die();
				$this->load->view('05_adminpmb/admlaporan/data_pendaftar/list_data_pendaftar', $data);
			}
		}else{
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('Data Pendaftar', '/');
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/data_pendaftar/form_data_pendaftar', $data);
			$data['content']='05_adminpmb/admlaporan/data_pendaftar/form_data_pendaftar';
			$this->load->view('s00_vw_all', $data);
		}
		
	}
	
	function informasi_ruang_ujian(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG']);
				#print_r($datapost); DIE();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 4, 'api_search' => $datapost);
				$data['informasi_ruang_ujian']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				// PRINT_R($data); die();
				$this->load->view('05_adminpmb/admlaporan/data_ruang/list_inforuang', $data);
			}
		}else{
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('Informasi Ruang Ujian', '/');
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/data_ruang/form_data_inforuang', $data);
			$data['content']='05_adminpmb/admlaporan/data_ruang/form_data_inforuang';
			$this->load->view('s00_vw_all', $data);
		}
	}
	
	function statistik_peminat_perprodi(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG']);
				#print_r($datapost); DIE();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 5, 'api_search' => $datapost);
				$data['statistik_peminat_perprodi']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			//	echo "<pre>"; PRINT_R($data); echo "</pre>"; die();
				$this->load->view('05_adminpmb/admlaporan/statistik_prodi/list_statistik_perprodi', $data); 
			}
		}else{
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('Statistik Peminat Per Prodi', '/');
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/statistik_prodi/form_statistik_prodi', $data);
			$data['content']='05_adminpmb/admlaporan/statistik_prodi/form_statistik_prodi';
			$this->load->view('s00_vw_all', $data);
		}
	}
	
	//
	
	
	function jumlah_bayar($TGL_MULAI,$TGL_AKHIR,$GEL){
	// function jumlah_bayar(){
		$USERNAME = 'admis1';
		$PASSWORD = 'admi511';
				////JUMLAH BAYAR
				$URL_TOTAL_BAYAR = "http://service2.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/JENIS_PMB/$GEL/TGL_MULAI/$TGL_MULAI/TGL_AKHIR/$TGL_AKHIR/format/json";
				#echo $URL_TOTAL_BAYAR; die();
				 $CONTEXT = stream_context_create(
					array(
						'http' => array(
								'method' => 'GET',
								'header' => "Authorization: Basic " . base64_encode("$USERNAME:$PASSWORD")
							)
					));
				$gropo3 = @file_get_contents($URL_TOTAL_BAYAR,false,$CONTEXT);
				$data['jumlah_bayar'] = json_decode($gropo3,true);
				// print_r($data);
		return $data['jumlah_bayar']['JUMLAH'];
	}
	
	
	function total_login($GEL,$TAHUN){
			$datapost=array('TAHUN'=>$TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 102, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->TOTAL_LOGIN;
	}
	
	function total_login_belum_isi_data($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 103, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->TOTAL_LOGIN_BELUM_ISI;
	}
	
	function isi_data_belum_pil_jurusan_blm_selesai($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 104, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->ISI_DATA_BLM_PILJUR;
	}
	
	
	function sudah_pil_jurusan_blm_selesai($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 105, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->SUDAH_PIL_JURUSAN_BLM_SELESAI;
	}
	
	function selesai_belum_cetak($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 106, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->SELESAI_BELUM_CETAK;
	}
	
	function selesai_sudah_cetak($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 107, 'api_search' => $datapost);
			$data['jumlah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['jumlah'][0]->SELESAI_SUDAH_CETAK;
	}
	
	function siapa_isi_data_belum_pil_jurusan_blm_selesai($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 108, 'api_search' => $datapost);
			$data['siapa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['siapa'];
	}
	
	function siapa_sudah_pil_jurusan_blm_selesai($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 109, 'api_search' => $datapost);
			$data['siapa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['siapa'];
	}
	function siapa_selesai_belum_cetak($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 110, 'api_search' => $datapost);
			$data['siapa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['siapa'];
	}
	
	function siapa_selesai_sudah_cetak($GEL,$TAHUN){
			$datapost=array('TAHUN'=> $TAHUN, 'GELOMBANG' => $GEL);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 255, 'api_subkode' => 111, 'api_search' => $datapost);
			$data['siapa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			return $data['siapa'];
	}
	
	function statistik_pendaftar_detail(){
	error_reporting(0);
		// $kondisi=$this->security->xss_clean($this->uri->segment(3));
		// $GELOMBANG=$this->security->xss_clean($this->uri->segment(5));
		// $TAHUN=$this->security->xss_clean($this->uri->segment(4));
		
			$KONDISI=$_POST['SIAPA'];
			$GELOMBANG=$_POST['GELOMBANG'];
			$TAHUN=$_POST['TAHUN'];
			switch($KONDISI){
				case 4 : 
						$data['SIAPA']=$this->siapa_isi_data_belum_pil_jurusan_blm_selesai($GELOMBANG,$TAHUN);
				break;
				case 5 : 
						$data['SIAPA']=$this->siapa_sudah_pil_jurusan_blm_selesai($GELOMBANG,$TAHUN);
				break;
				case 6 : 
						$data['SIAPA']=$this->siapa_selesai_belum_cetak($GELOMBANG,$TAHUN);
				break;
				case 7 : 
						$data['SIAPA']=$this->siapa_selesai_sudah_cetak($GELOMBANG,$TAHUN);
				break;
			}
			
			// print_r	($data);
			// $this->output99->output_display('05_adminpmb/admlaporan/statistik_pendaftar/list_statistik_pendaftar_detail', $data);
			$this->load->view('05_adminpmb/admlaporan/statistik_pendaftar/list_statistik_pendaftar_detail', $data);
			#ECHO "MADANG SEK";
		
	}
	
	
	function statistik_pendaftar(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Statistik Pendaftar', '/');
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			// }elseif(empty($_POST['STATUS'])){
				// $error="PILIH KATEGORI DATA YANG AKAN DITAMPILKAN";
				// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				// echo $pesan;
			}else{
				// print_r($_POST); die();
				// $TAHUN=2014;
				// $TGL_MULAI=date('dmY', strtotime("28-MAY-14"));
				// $TGL_AKHIR=date('dmY', strtotime("08-JUL-14"));
				// $GELOMBANG=10;
				#echo $_POST['STATUS']; die();
				$TAHUN=$_POST['TAHUN'];
				$D_GELOMBANG = $_POST['GELOMBANG'];
				$D_GELOMBANG = explode('#', $D_GELOMBANG);
				$USERNAME = 'admis1';
				$PASSWORD = 'admi511';
				
				
				
				$GELOMBANG = $D_GELOMBANG[0];
				switch($GELOMBANG){
							  case 10: case 11: $GEL=1; break;
							  case 20: case 21: $GEL=2; break;
							  case 40: case 41: $GEL=4; break;
							  case 50: case 51: $GEL=5; break;
							  case 80: case 81: $GEL=8; break;
							  case 12: $GEL=9; break;
							  
				}
					$datapost = array(
					'TAHUN' => $_POST['TAHUN'],
					'JENIS' => $GEL
				
				);
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 84, 'api_search' => $datapost);
				$data['tanggal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				
				$TGL_MULAI = $data['tanggal'][0]->PMB_TANGGAL_MULAI_DAFTAR;
				$TGL_MULAI = date('dmY', strtotime($TGL_MULAI));
				$TGL_AKHIR = $data['tanggal'][0]->PMB_TANGGAL_AKHIR_DAFTAR;
				$TGL_AKHIR = date('dmY', strtotime($TGL_AKHIR));
				$data['TAHUN']=$TAHUN;
				$data['GELOMBANG']=$GELOMBANG;
				$data['SUDAH_BAYAR']=$this->jumlah_bayar($TGL_MULAI,$TGL_AKHIR,$GEL);
				$data['SUDAH_BAYAR_SUDAH_LOGIN']=$this->total_login($GELOMBANG,$TAHUN);
				$data['SUDAH_BAYAR_SUDAH_LOGIN_BELUM_ISI_DATA']=$this->total_login_belum_isi_data($GELOMBANG,$TAHUN);
				$data['SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_BELUM_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK']=$this->isi_data_belum_pil_jurusan_blm_selesai($GELOMBANG,$TAHUN);
				$data['SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK']=$this->sudah_pil_jurusan_blm_selesai($GELOMBANG,$TAHUN);
				$data['SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_BELUM_CETAK']=$this->selesai_belum_cetak($GELOMBANG,$TAHUN);
				$data['SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_SUDAH_CETAK']=$this->selesai_sudah_cetak($GELOMBANG,$TAHUN);
				// echo "<pre>"; PRINT_R($data); echo "</pre>";
				$this->load->view('05_adminpmb/admlaporan/statistik_pendaftar/list_statistik_pendaftar', $data);
			}
		}else{
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/statistik_pendaftar/form_statistik_pendaftar', $data);
			$data['content']='05_adminpmb/admlaporan/statistik_pendaftar/form_statistik_pendaftar';
			$this->load->view('s00_vw_all', $data);
		}
	}
	
	
	//28052014 08072014
	
	function statistik_pendaftar_old(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['STATUS'])){
				$error="PILIH KATEGORI DATA YANG AKAN DITAMPILKAN";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				#echo $_POST['STATUS']; die();
				$D_GELOMBANG = $_POST['GELOMBANG'];
				$D_GELOMBANG = explode('#', $D_GELOMBANG);
				$USERNAME = 'admis1';
				$PASSWORD = 'admi511';
				$TGL_MULAI = $D_GELOMBANG[1];
				$TGL_MULAI = date('dmY', strtotime($TGL_MULAI));
				$TGL_AKHIR = $D_GELOMBANG[2];
				// echo $TGL_AKHIR; die();
				$TGL_AKHIR = date('dmY', strtotime($TGL_AKHIR));
				$JENIS_PMB = $D_GELOMBANG[0];
				// echo $TGL_MULAI."=====".$TGL_AKHIR."====".$JENIS_PMB; DIE();
				switch($JENIS_PMB){
				  case 10: case 11: $JENIS_PMB=1; break;
				  case 20: case 21: $JENIS_PMB=2; break;
				  case 40: case 41: $JENIS_PMB=4; break;
				  case 50: case 51: $JENIS_PMB=5; break;
				  case 80: case 81: $JENIS_PMB=8; break;
				}
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $D_GELOMBANG[0]);
				#switch($_POST['STATUS']){
				#	case "JUMLAH_BAYAR_LOGIN_BELUM_SELESAI" : 
				$data['tanggal']=array('AWAL' => $D_GELOMBANG[1], 'AKHIR' => $D_GELOMBANG[2]);
				if($_POST['STATUS']=='JUMLAH_BAYAR'){
					////JUMLAH BAYAR
					$URL_TOTAL_BAYAR = "http://service.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/JENIS_PMB/$JENIS_PMB/TGL_MULAI/$TGL_MULAI/TGL_AKHIR/$TGL_AKHIR/format/json";
					#echo $URL_TOTAL_BAYAR; die();
					 $CONTEXT = stream_context_create(
						array(
							'http' => array(
									'method' => 'GET',
									'header' => "Authorization: Basic " . base64_encode("$USERNAME:$PASSWORD")
								)
						));
					$gropo3 = @file_get_contents($URL_TOTAL_BAYAR,false,$CONTEXT);
					$data['jumlah_bayar'] = json_decode($gropo3,true);
					$data['status_tampil']='JUMLAH_BAYAR';
				}elseif($_POST['STATUS']=='JUMLAH_LOGIN'){
					//JUMLAH LOGIN
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 255, 'api_subkode' => 6, 'api_search' => $datapost);
					$data['jumlah_login'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					$data['status_tampil']='JUMLAH_LOGIN';
				}elseif($_POST['STATUS']=='JUMLAH_LOGIN_BELUM_ISI_DATA'){
					//JUMLAH LOGIN BELUM ISI DATA
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 255, 'api_subkode' => 7, 'api_search' => $datapost);
					$data['jumlah_login_belum_isi_data'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					#echo "<pre>"; PRINT_R($data); echo "</pre>"; die();
					$data['status_tampil']='JUMLAH_LOGIN_BELUM_ISI_DATA';
				}else{
					//STATISTIK PENDAFTAR
					$key=explode('|', $_POST['STATUS']);
					$datapost=array(
					'STATUS_SIMPAN' => $key[1],
					'GELOMBANG' => $D_GELOMBANG[0],
					'KEYSQL' => $key[2],
					'KEYSEARCH' => $key[0]
					);
					#print_r($datapost); die();
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 255, 'api_subkode' => 8, 'api_search' => $datapost);
					$data['statistik_pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					$data['status_tampil']='STATISTIK_PENDAFTAR';
					
				}
				#echo "<pre>"; PRINT_R($data); echo "</pre>"; die();
				$this->load->view('05_adminpmb/admlaporan/statistik_pendaftar/list_statistik_pendaftar', $data);
			}
		}else{
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			$this->output99->output_display('05_adminpmb/admlaporan/statistik_pendaftar/form_statistik_pendaftar', $data);
		}
	}
	
	function hasil_tes(){
		$datapost=array('TAHUN'=> 2014, 'KD_SOAL' => '001');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
		$peserta_tes = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
		
		//PRINT_R($peserta_tes); die();
		foreach($peserta_tes as $key => $value){
			$NILAI_TES[$value['PMB_NO_PMB']] = $value['NILAI_TES'];
			$KODE_SOAL[$value['PMB_NO_PMB']] = $value['PMB_KODE_SOAL'];
			
		}
		
		// $get_mhs = $this->adminpmb->get_univ('fak');
		// $get_mhs = $this->adminpmb->get_univ('prod','01');
		// print_r($get_mhs); die();
		
		$get_mhs = $this->adminpmb->get_univ('mhs','22607','2011');
		#print_r($mhs); die();
		$c_mhs = count($get_mhs);
		for($i=0; $i<$c_mhs;$i++) {
			$nim = $get_mhs[$i]['NIM'];
			$get_mhs[$i]['NILAI_TES'] = (empty($NILAI_TES[$nim]))?'BELUM TES':$NILAI_TES[$nim];
			$get_mhs[$i]['KODE_SOAL'] = (empty($KODE_SOAL[$nim]))?'BELUM TES':$KODE_SOAL[$nim];
		}
		$data['get_mhs']=$get_mhs;
		print_r($data);
		// $this->load->view('05_adminpmb/admlaporan/placement_test/list_hasil_test', $data);
		
		#$get_mhs = $this->adminpmb->get_univ('mhs','22607','2014');
	}
	
	function placement_test_old($kd_prodi=null){
	if(isset($kd_prodi))
		{
			//ambil syarat tanggal untuk mengetahui kd_tahunakademik
			//$dt_syarat_tgl = $this->lib_basic->get_tgl_daftar($this->kd_ta_sia,$this->kd_smt,'22607');
			$dt_mhs = $this->adminpmb->get_univ('mhs',$kd_prodi,'2014');
			$datapost=array('TAHUN'=> 2014, 'KD_SOAL' => '001');
				// $datapost=array('NO_TES'=>'14430050');
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
				$peserta_tes = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
				#PRINT_R($peserta_tes); die();
				foreach($peserta_tes as $key => $value){
					$NILAI_TES[$value['PMB_NO_PMB']] = $value['NILAI_TES'];
					$KODE_SOAL[$value['PMB_NO_PMB']] = $value['PMB_KODE_SOAL'];
				}
				
				#$dt_mhs = $this->adminpmb->get_univ('mhs',$max_prod['KD_PRODI'],'2014');
				// $dt_mhs = $this->adminpmb->get_univ('mhs','22607','2014');
				
				if ($dt_mhs){
					// foreach($dt_mhs as $key => $value):
						// $xx['PROSES'] = '-';
						// if(!$this->adminpmb->get_peserta_p_t($value['NIM'])){
							// $xx['PROSES'] = '<input name="nim['.$value['NIM'].']" type="checkbox" value="ok" checked>';
						// }
						// $data[] = array_merge($value,$xx);
						// $data_mhs = $data;
					// endforeach;
					$c_mhs = count($dt_mhs);
					for($i=0; $i<$c_mhs;$i++) {
						$nim = $dt_mhs[$i]['NIM'];
						$dt_mhs[$i]['NILAI_TES'] = (empty($NILAI_TES[$nim]))?'BELUM TES':$NILAI_TES[$nim];
						$dt_mhs[$i]['KODE_SOAL'] = (empty($KODE_SOAL[$nim]))?'BELUM TES':$KODE_SOAL[$nim];
					}
				}else{
					$dt_mhs = null;
				}
			$m = array('get_mhs' => $dt_mhs);
			$this->load->view('05_adminpmb/admlaporan/placement_test/table_hasil_test',$m);
		}
		else{
		
			if($this->input->post('op') == 'fak'):
				$dt_prod = $this->adminpmb->get_univ('prod',$this->input->post('val'));
				if($dt_prod)
				{
					$xprod = '';
					foreach ($dt_prod as $key => $value) {
						$xprod .= '<option value="'.$value['KD_PRODI'].'">'.$value['NM_PRODI'].'</option>' ;
					}
				}
				echo $xprod;
			else :
				$xfak = '<option value="xx">Pilih Fakultas</option>';
				$xprod = '<option value="xx">Pilih Prodi</option>';
				$get_mhs = '';
				$dt_fak = $this->adminpmb->get_univ('fak');
				if($dt_fak)
				{
					$xfak = '';
					$max_fak = $dt_fak[0];
					foreach ($dt_fak as $key => $value) {
						$xfak .= '<option value="'.$value['KD_FAK'].'">'.$value['NM_FAK'].'</option>' ;
					}
					$get_prodi = $this->adminpmb->get_univ('prod',$max_fak['KD_FAK']);
				}
				if(isset($get_prodi) && $get_prodi == true)
				{
					$xprod = '';
					$max_prod = $get_prodi[0];
					foreach ($get_prodi as $key => $value) {
						$xprod .= '<option value="'.$value['KD_PRODI'].'">'.$value['NM_PRODI'].'</option>' ;
					}
				}
				
				$datapost=array('TAHUN'=> 2014, 'KD_SOAL' => '001');
				// $datapost=array('NO_TES'=>'14430050');
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
				$peserta_tes = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
				#PRINT_R($peserta_tes); die();
				foreach($peserta_tes as $key => $value){
					$NILAI_TES[$value['PMB_NO_PMB']] = $value['NILAI_TES'];
					$KODE_SOAL[$value['PMB_NO_PMB']] = $value['PMB_KODE_SOAL'];
				}
				
				$dt_mhs = $this->adminpmb->get_univ('mhs',$max_prod['KD_PRODI'],'2014');
				// $dt_mhs = $this->adminpmb->get_univ('mhs','22607','2014');
				
				if ($dt_mhs){
					// foreach($dt_mhs as $key => $value):
						// $xx['PROSES'] = '-';
						// if(!$this->adminpmb->get_peserta_p_t($value['NIM'])){
							// $xx['PROSES'] = '<input name="nim['.$value['NIM'].']" type="checkbox" value="ok" checked>';
						// }
						// $data[] = array_merge($value,$xx);
						// $data_mhs = $data;
					// endforeach;
					$c_mhs = count($dt_mhs);
					for($i=0; $i<$c_mhs;$i++) {
						$nim = $dt_mhs[$i]['NIM'];
						$dt_mhs[$i]['NILAI_TES'] = (empty($NILAI_TES[$nim]))?'BELUM TES':$NILAI_TES[$nim];
						$dt_mhs[$i]['KODE_SOAL'] = (empty($KODE_SOAL[$nim]))?'BELUM TES':$KODE_SOAL[$nim];
					}
				}else{
					$dt_mhs = null;
				}
				
				
				
				//print_r($data_mhs);
				$m = array('dd_fak' => $xfak,'dd_prod' => $xprod,'get_mhs' => $dt_mhs);
				$this->output99->output_display('05_adminpmb/admlaporan/placement_test/form_hasil_test',$m);
			endif;
		}
	}
	
	
	function placement_test(){
	$this->breadcrumb->append_crumb('Beranda', base_url());
	$this->breadcrumb->append_crumb('Placement Test', '/');
	if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['soal'])){
				$error="PILIH SOAL TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['thn'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['fak'])){
				$error="PILIH FAKULTAS YANG AKAN DITAMPILKAN";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				$datapost=array('TAHUN'=> $_POST['thn'], 'KD_SOAL' => $_POST['soal']);
				//$datapost=array('NO_TES'=>'14430050');
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
				$peserta_tes = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
				// PRINT_R($peserta_tes); die();
				// echo "<pre>"; print_r($datapost); echo "</pre>"; die();
				
				
				foreach($peserta_tes as $key => $value){
					$NILAI_TES[$value['PMB_NO_PMB']] = $value['NILAI_TES'];
					$KODE_SOAL[$value['PMB_NO_PMB']] = $value['PMB_KODE_SOAL'];
				}
				
				$get_prodi = $this->adminpmb->get_univ('prod',$_POST['fak']);
				#echo "<pre>"; print_r($get_prodi); echo "</pre>"; 
				$idx=count($get_prodi);
				#echo $idx;
				$dt_mhs = array();
				for($i=0; $i<$idx;$i++) {
					$prodi=$get_prodi[$i]['KD_PRODI'];
					$dt_mhs = array_merge($dt_mhs,$this->adminpmb->get_univ('mhs',$prodi,$_POST['thn']));
					
				}
				#echo "<pre>"; print_r($dt_mhs); echo "</pre>"; 
				if ($dt_mhs){
					$c_mhs = count($dt_mhs);
					for($i=0; $i<$c_mhs;$i++) {
						$nim = $dt_mhs[$i]['NIM'];
						$dt_mhs[$i]['NILAI_TES'] = (empty($NILAI_TES[$nim]))?'BELUM TES':$NILAI_TES[$nim];
						$dt_mhs[$i]['KODE_SOAL'] = (empty($KODE_SOAL[$nim]))?'BELUM TES':$KODE_SOAL[$nim];
					}
				}else{
					$dt_mhs = null;
				}
				
				if($dt_mhs){
				foreach ($dt_mhs as $key => $row) {
					$nilai_sort[$key]  = $row['NILAI_TES'];
					$prodi_sort[$key]  = $row['KD_JURUSAN'];
				}
				#array_multisort($prodi_sort, SORT_ASC, $nilai_sort, SORT_DESC, $dt_mhs);
				array_multisort($nilai_sort, SORT_DESC, $dt_mhs);
				}
				#echo "<pre>"; print_r($dt_mhs); echo "</pre>"; 
				$m = array('get_mhs' => $dt_mhs, 'opt' => array('fak'=>$_POST['fak'], 'soal' => $_POST['soal'], 'thn' => $_POST['thn']));
				if(isset($_POST['download'])=='sekarang'){
					$this->load->view('05_adminpmb/admlaporan/placement_test/download_hasil_test',$m);
				}else{
					$this->load->view('05_adminpmb/admlaporan/placement_test/table_hasil_test',$m);
				}
				
			}
	}else{
				
				$get_mhs = '';
				$dt_fak = $this->adminpmb->get_univ('fak');
				
				if($dt_fak){
					$xfak = '';
					$max_fak = $dt_fak[0];
					foreach ($dt_fak as $key => $value) {
						$xfak .= '<option value="'.$value['KD_FAK'].'">'.$value['NM_FAK'].'</option>' ;
					}
						$xfak .= '<option value="-">LAINNYA</option>' ;
				}
		
				$data['dd_fak'] = $xfak;
				#$this->output99->output_display('05_adminpmb/admlaporan/placement_test/form_hasil_test',$m);
				$data['content']='05_adminpmb/admlaporan/placement_test/form_hasil_test';
				$this->load->view('s00_vw_all', $data);
		}
	}

	
	
	
	
	
	
	
	
	
	function uhuk(){
		$nim=$this->security->xss_clean($this->uri->segment(3));	
		$api_url_ 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_mahasiswa/data_search';
		$parameter_	= array('api_kode' => 26000, 'api_subkode' => 26, 'api_search' => array($nim));
		$get_mhs 		= $this->s00_lib_api->get_api_json($api_url_,'POST',$parameter_);
		#$dt_mhs = $this->adminpmb->get_univ('mhs','10','10');
		echo "<pre>"; print_r($get_mhs); echo "</pre>";
	
	}
	function tes(){
		$datapost=array('TAHUN'=> 2014, 'KD_SOAL' => '001');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
		$data = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
		foreach($data as $key => $value){
			$NIM[] = $value['PMB_NO_PMB'];
			$NILAI_TES[$value['PMB_NO_PMB']] = $value['NILAI_TES'];
			$KODE_SOAL[$value['PMB_NO_PMB']] = $value['PMB_KODE_SOAL'];
			
		}
		$api_url_ 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_mahasiswa/data_search';
		$parameter_	= array('api_kode' => 26000, 'api_subkode' => 10, 'api_search' => array($NIM));
		$get_mhs 		= $this->s00_lib_api->get_api_json($api_url_,'POST',$parameter_);
		#echo "<pre>"; print_r($get_mhs); echo "</pre>";
		$c_mhs = count($get_mhs);
		for($i=0; $i<$c_mhs;$i++) {
			$nim = $get_mhs[$i]['NIM'];
			$get_mhs[$i]['NILAI_TES'] = $NILAI_TES[$nim];
			$get_mhs[$i]['KODE_SOAL'] = $KODE_SOAL[$nim];
		}
		$data['get_mhs']=$get_mhs;
		#PRINT_R($data['get_mhs']); die();
		$this->load->view('05_adminpmb/admlaporan/placement_test/download_hasil_test',$data);
		#$this->load->view('05_adminpmb/admlaporan/placement_test/list_hasil_test', $data);
	}	
	
	function tes_1(){
				$datapost=array('TAHUN'=> 2014, 'KD_SOAL' => '001');
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
				$get_peserta = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
				#print_r($get_peserta); die();
				if ($get_peserta){
					foreach($get_peserta as $key => $value):
						 $xx['ID_PESERTA'] = $value['PMB_NO_PMB'];
						 $xx['NILAI_TES'] = $value['NILAI_TES'];
						 $api_mhs = ($this->tes($value['PMB_NO_PMB']));
							foreach ($api_mhs as $key => $value){
								$dt = $value;
								#$data[] = array_merge($dt,$xx);
							}
						#$data_mhs = $data;
					endforeach;
				} else{ $data_mhs = null;}
				print_r($dt); die();
				#$this->load->view('uedu/vw_tabel/tbl_jadwal_detail',$m);
	}

	
	function download_xls(){
		$TAHUN=$this->security->xss_clean($this->uri->segment(3));
		$GELOMBANG=$this->security->xss_clean($this->uri->segment(4));
		$WARGANEGARA=$this->security->xss_clean($this->uri->segment(5));
		$datapost=array('TAHUN'=>$TAHUN, 'GELOMBANG' => $GELOMBANG, 'WARGANEGARA' => $WARGANEGARA);
		#print_r($datapost); die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 9, 'api_search' => $datapost);
		$data['download']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($data); die();
		$this->load->view('05_adminpmb/admlaporan/data_pendaftar/list_pendaftar_xls', $data);
	
		
	}
	
	function download(){
		$TAHUN=2014;
		$GELOMBANG=80;
		$datapost=array('TAHUN'=>$TAHUN, 'GELOMBANG' => $GELOMBANG);
		#print_r($datapost); die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		// $parameter  = array('api_kode' => 255, 'api_subkode' => 9, 'api_search' => $datapost);
		$parameter  = array('api_kode' => 255, 'api_subkode' => 112, 'api_search' => $datapost);
		$data['download']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($data); die();
		$this->load->view('05_adminpmb/admlaporan/data_pendaftar/list_download', $data);
	
		
	}
	
	function hasil_kepribadian(){
		#echo "CETAL ALBUM UJIAN";
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Hasil Tes Kepribadian', '/');
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['GELOMBANG'])){
				$error="PILIH JALUR MASUK TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				$datapost=array('TAHUN'=>$_POST['TAHUN'], 'GELOMBANG' => $_POST['GELOMBANG']);
				#print_r($datapost); DIE();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 100, 'api_search' => $datapost);
				$data['kepribadian']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				$data['GELOMBANG']=$_POST['GELOMBANG'];
				$data['TAHUN']=$_POST['TAHUN'];
				$this->load->view('05_adminpmb/admlaporan/kepribadian/list_kepribadian', $data);
			}
		}elseif($this->security->xss_clean($this->uri->segment(3))=='download'){
				$datapost=array('TAHUN'=>$this->security->xss_clean($this->uri->segment(4)), 'GELOMBANG' => $this->security->xss_clean($this->uri->segment(5)));
				#print_r($datapost); DIE();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 100, 'api_search' => $datapost);
				$data['kepribadian']=$this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				$this->load->view('05_adminpmb/admlaporan/kepribadian/list_kepribadian_xls', $data);
		
		}else{
			$data['jalur_masuk']=$this->jalur_masuk();
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/kepribadian/form_kepribadian', $data);
			$data['content']='05_adminpmb/admlaporan/kepribadian/form_kepribadian';
			$this->load->view('s00_vw_all', $data);
		}
	}
	
	function jajal(){
				// service2.uin-suka.ac.id/servsimpeg/simpeg_mix/data_search
				// 2000/1
				// array(kode_pegawai)
				// http://service2.uin-suka.ac.id/servsimpeg/simpeg_public/
				// $api_url 	= 'http://service2.uin-suka.ac.id/servsimpeg/simpeg_mix/data_search';
				// $parameter  = array('api_kode' => 2001, 'api_subkode' => 5, 'api_search' => array('199111280000001101'));
				// $data['kode']=$this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
				
				// $parameter1 	= array('api_kode' => 2001, 'api_subkode' => 5, 'api_search' => array($this->session->userdata('id_user')));
				// $parameter1 	= array('api_kode' => 2001, 'api_subkode' => 1, 'api_search' => array($this->session->userdata('id_user')));
				// $api_spgn 		= $this->s00_lib_api->get_api_json('http://service2.uin-suka.ac.id/servsimpeg/simpeg_public/simpeg_mix/data_search', 'POST', $parameter1);
				// print_r($api_spgn);
				
				// $parameter1 	= array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array('ABCABC123123'));
				// $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				// $cmhs 		= $this->s00_lib_api->get_api_json($api_url, 'POST', $parameter1);
				// PRINT_R($cmhs); 
				
				$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter_  = array('api_kode' => 192, 'api_subkode' => 49, 'api_search' => array());
				$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
				// print_r($data); die();
				//PMB_PILJUR_PESERTA
				// $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				// $parameter  = array('api_kode' => 192, 'api_subkode' => 7, 'api_search' => array($id_user));
				// $data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				foreach($data['master_prodi'] as $value){
					if($value->PMB_ID_PRODI==61 || $value->PMB_ID_PRODI==83 || $value->PMB_ID_PRODI==84){
						echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
					}
				}
	}

	
	
//PRIVATE FUNCTION	
	private function jalur_masuk(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
		return $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}	
	private function jalur_masuk_id($unit){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 12, 'api_search' => array());
		return $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}	
	private function tahun_priode(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 1, 'api_search' => array());
		return $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}	
	private function unit(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 11, 'api_search' => array());
		return $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}	
	
	
}