<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class S05_laporan_adminpmb extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("pagination");
		$this->load->library("lib_adminpmb", '', 'adminpmb');
		
		#$this->session->set_userdata('app', 'adminpmb');
		if($this->adminpmb->cek_allowed("AAZF01#AAZF09#AAZ001#AAZ003#AAZ004#AAZ002#BKDADM#POU002")){
			
		}else{
			redirect();
		}
		
	
	}
			
	function index(){ 
			echo "ok";
	}
	/*
	function cek_allowed($allow='')
        {
                $jbt = $this->session->userdata('jabatan');
                $who = array_intersect(explode("#",$jbt),explode("#",$allow));
                $stat = count($who) > 0 ? TRUE : FALSE;
                return $stat;
        }
		*/
/*	
	function daftar_calon_mahasiswa(){ 
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 1, 'api_search' => array());
		$data['data_pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['data_pendaftar']);
		$this->output99->output_display('05_adminpmb/s05_vw_data_pendaftar', $data);
	} */
	
	
	
	function daftar_calon_mahasiswa(){ 
		//COUNT DATA DULU
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 23, 'api_search' => array());
		$data['jum_row'] = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);	
		#print_r($data); die();
		//pagging
		$config = array();
        $config["base_url"] = base_url()."adminpmb/laporan-daftar_calon_mahasiswa";
        $config["total_rows"]=$data['jum_row'][0]['TOTAL_PENDAFTAR'];
		
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
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 21, 'api_search' => array($limit, $this->uri->segment(3)));
		$data['data_cmhs'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['data_cmhs']);
		$this->output99->output_display('05_adminpmb/s05_vw_data_calon_mahasiswa', $data);
	}
	
	function daftar_calon_mahasiswas1d3(){ 
		//COUNT DATA DULU
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 43, 'api_search' => array());
		$data['jum_row'] = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);	
		
		#print_r($data); die();
		//pagging
		$config = array();
        $config["base_url"] = base_url()."adminpmb/laporan-daftar_calon_mahasiswas1d3";
        $config["total_rows"]=$data['jum_row'][0]['TOTAL_PENDAFTAR'];
		
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
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 44, 'api_search' => array($limit, $this->uri->segment(3)));
		$data['data_cmhs'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['data_cmhs']);
		$this->output99->output_display('05_adminpmb/s05_vw_data_calon_mahasiswa_s1d3', $data);
	}
	
	function detail_calon_mahasiswa(){ 
		$pin=$this->security->xss_clean($this->uri->segment(3));
		#echo $pin; die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 22, 'api_search' => array($pin));
		$data['detail_calon_mahasiswa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['detail_calon_mahasiswa']);
		$this->output99->output_display('05_adminpmb/s05_vw_detail_pendaftar', $data);
		
	}
	
	function detail_calon_mahasiswa_s1d3(){ 
	
		$pin=$this->security->xss_clean($this->uri->segment(3));
		#echo $pin; die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 45, 'api_search' => array($pin));
		$data['detail_calon_mahasiswa'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['detail_calon_mahasiswa']);
		//master jenis sekolah
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_js  = array('api_kode' => 192, 'api_subkode' => 33, 'api_search' => array());
		$data['jenis_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_js);	
		#print_r($data['jenis_sekolah']);
							
		//MASTER JURUSAN SEKOLAH
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
		$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
		#$data['pendaftar']=$this->pendaftar();
		$this->output99->output_display('05_adminpmb/s05_vw_detail_pendaftar_s1d3', $data);
		
	}
	
	function statistik_peminat_per_prodi(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 24, 'api_search' => array());
		$data['statistik_perprodi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['statistik_perprodi']);
		$this->output99->output_display('05_adminpmb/s05_vw_statistik_pendaftar_perprodi', $data);
	
	}
	
	function statistik_peminat_per_prodi_s1d3(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Statistik Pendaftar Per Prodi S1/D3', '/');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 54, 'api_search' => array());
		$data['statistik_perprodi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['statistik_perprodi']);
		#$this->output99->output_display('05_adminpmb/s05_vw_statistik_pendaftar_perprodi_s1d3', $data);
		$data['content']='05_adminpmb/s05_vw_statistik_pendaftar_perprodi_s1d3';
		$this->load->view('s00_vw_all', $data);
	
	}
	
	function informasi_ruang_ujian(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 26, 'api_search' => array());
		$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['informasi_ruang_ujian']); die();
		$this->output99->output_display('05_adminpmb/s05_vw_informasi_ruang_ujian', $data);
	
	}	
	
	function informasi_ruang_ujian_s1d3(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Informasi Ruang Ujian', '/');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 53, 'api_search' => array());
		$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['informasi_ruang_ujian']);
		#$this->output99->output_display('05_adminpmb/s05_vw_informasi_ruang_ujian_s1d3', $data);
		$data['content']='05_adminpmb/s05_vw_informasi_ruang_ujian_s1d3';
		$this->load->view('s00_vw_all', $data);

	}
	
	function daftar_calon_istri(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 25, 'api_search' => array());
		$data['daftar_calon_istri'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['daftar_calon_istri']);
		$this->output99->output_display('05_adminpmb/s05_vw_daftar_calon_istri', $data);
	
	}
	
	function daftar_peserta_belum_selesai(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Pendaftar Belum Selesai', '/');
		if(isset($_POST['form'])=='now'){
			if(empty($_POST['jenis_pmb'])){
				$error="PILIH JENIS PMB TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}elseif(empty($_POST['status'])){
				$error="PILIH JENIS DATA YANG AKAN DITAMPILKAN";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
			#print_r($_POST);
			$key=explode('|', $_POST['status']);
			$datapost=array(
				'STATUS_SIMPAN' => $key[1],
				'GELOMBANG' => $_POST['jenis_pmb'],
				'KEYSQL' => $key[2],
				'KEYSEARCH' => $key[0]
			);
			#PRINT_R($datapost); die();
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 168, 'api_subkode' => 14, 'api_search' => array($datapost));
			$data['daftar_peserta_belum_selesai'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			#print_r($data); die();
			$this->load->view('05_adminpmb/s05_vw_belum_selesai',$data);
			#$error="Pilih Jenis PMB terlebih dahulu";
			#$pesan = "<div class='bs-callout bs-callout-error'>".$data."</div>";
			}
		}else{
			//MASTER JALUR MASUK
			$cek_jabatan = $this->session->userdata('jabatan');
			$status = explode('#', $cek_jabatan);
			if(in_array('AAZ001',$status) || in_array('POU002',$status)): //ROOT
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
				$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			endif;
			if(in_array('AAZF09',$status)): //PASCA
				$jenis=2;
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 56, 'api_search' => array($jenis));
				$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			endif;
			if(in_array('AAZF01',$status) || in_array('AAZ002',$status) || in_array('BKDADM',$status) || in_array('AAZF02',$status) || in_array('AAZF03',$status) //D3S1 //admisi
				|| in_array('AAZF04',$status) || in_array('AAZF05',$status) || in_array('AAZF06',$status)
				|| in_array('AAZF07',$status) || in_array('AAZF08',$status) || in_array('AAZ003',$status) ):
				$jenis=1;
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 56, 'api_search' => array($jenis));
				$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			endif;
			#$this->output99->output_display('05_adminpmb/s05_vw_daftar_belum_selesai', $data);
			$data['content']='05_adminpmb/s05_vw_daftar_belum_selesai';
			$this->load->view('s00_vw_all', $data);
		}
	
	}
	
	
	
	function daftar_prodi_s1d3(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 31, 'api_search' => array());
		$data['daftar_prodi_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['daftar_prodi_s1d3']);
		$this->output99->output_display('05_adminpmb/s05_vw_daftar_calon_istri', $data);
	
	}
	
	function statistik_pendaftar(){
		$url=$this->security->xss_clean($this->uri->segment(3));
		if($url=='lihat'){
			if(empty($_POST['jenis_pmb'])){
				$error="Pilih Jenis PMB terlebih dahulu";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo json_encode(array('pesan' => $pesan));
			}else{
				$jp=$_POST['jenis_pmb'];
				$jp=explode('#',$jp);
				$JENIS_PMB=$jp[0];
				#ECHO $JENIS_PMB; die();
				$GELOMBANG=$jp[0];
				switch($JENIS_PMB){
						case 10 : $JENIS_PMB='1'; break;
						case 20 : $JENIS_PMB='2'; break;
						case 21 : $JENIS_PMB='2'; break;
						case 40 : $JENIS_PMB='4'; break;
						case 50 : $JENIS_PMB='5'; break;
						case 80 : $JENIS_PMB='8'; break;
				}
				//Jumlah Bayar
					$username = 'admis1';
					$password = 'admi511';
					$TGL_MULAI=$jp[1];
					$TGL_MULAI=date('dmY', strtotime($TGL_MULAI));
					$TGL_AKHIR=$jp[2];
					$TGL_AKHIR=date('dmY', strtotime($TGL_AKHIR));
					
					$url_total_bayar = "http://service.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/JENIS_PMB/$JENIS_PMB/TGL_MULAI/$TGL_MULAI/TGL_AKHIR/$TGL_AKHIR/format/json";
					#echo $url; die();
					$context = stream_context_create(
						array(
							'http' => array(
									'method' => 'GET',
									'header' => "Authorization: Basic " . base64_encode("$username:$password")
								)
						));
					$gropo3 = @file_get_contents($url_total_bayar,false,$context);
					$data = json_decode($gropo3,true);
					
				$api_datapost = array(
					'JENIS' => $JENIS_PMB,
					'GELOMBANG' => $GELOMBANG
				);
				
				//Jumlah Login
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 168, 'api_subkode' => 8, 'api_search' => array($api_datapost));
				$data['jumlah_login'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['jumlah_login']); die();
				
				// JUMLAH BELUM SELESAI
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 168, 'api_subkode' => 11, 'api_search' => array($api_datapost));
				$data['jumlah_belum_selesai'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data['jumlah_belum_selesai']); 
				
				// JUMLAH VERIFIKASI
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 168, 'api_subkode' => 10, 'api_search' => array($api_datapost));
				$data['jumlah_verifikasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data);
				
				//Jumlah Cetak
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 168, 'api_subkode' => 9, 'api_search' => array($api_datapost));
				$data['jumlah_cetak'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data);
				
				//RUANGAN YANG TERSEDIA
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 168, 'api_subkode' => 12, 'api_search' => array($api_datapost));
				$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['informasi_ruang_ujian']); die();
				$kapasitas_semua=0;
				$kapasitas_terisi=0;
				foreach($data['informasi_ruang_ujian'] as $value){
					$kapasitas_semua = $kapasitas_semua + $value->PMB_KAPASITAS_RUANG;
					$kapasitas_terisi = $kapasitas_terisi + $value->TERISI;
				}				
					$sisa=$kapasitas_semua-$kapasitas_terisi;
				#echo $kapasitas_semua."--".$kapasitas_terisi; die();
				$total_bayar=$data['JUMLAH'];
				$total_login=$data['jumlah_login'][0]->TOTAL_LOGIN;
				$total_cetak=$data['jumlah_cetak'][0]->TOTAL_CETAK;
				$total_verifikasi_belum_cetak=$data['jumlah_verifikasi'][0]->TOTAL_VERIFIKASI;
				$total_belum_selesai=$data['jumlah_belum_selesai'][0]->TOTAL_BELUM;
				
				$error="
						Total Bayar : $total_bayar Orang<br />
						Total Login : $total_login Orang<br />
						Total Belum Selesai : $total_belum_selesai Orang <br />
						Total Verifikasi dan Belum Cetak : $total_verifikasi_belum_cetak Orang <br />
						Total Cetak : $total_cetak Orang <br />
						Kursi Yang Tersedia : $kapasitas_semua <br />
						Kursi Terisi : $kapasitas_terisi <br /> 
						Sisa Kursi : $sisa";
				$pesan = "<div class='bs-callout bs-callout-success'>".$error."</div>";
				echo json_encode(array('pesan' => $pesan));
			}
		}else{
		//MASTER JALUR MASUK
		$cek_jabatan = $this->session->userdata('jabatan');
		$status = explode('#', $cek_jabatan);
		if(in_array('AAZ001',$status)): //ROOT
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
			$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		endif;
		if(in_array('AAZF09',$status)): //PASCA
			$jenis=2;
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 56, 'api_search' => array($jenis));
			$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		endif;
		if(in_array('AAZF01',$status) || in_array('AAZ002',$status) || in_array('BKDADM',$status) || in_array('AAZF02',$status) || in_array('AAZF03',$status) //D3S1 //admisi
			|| in_array('AAZF04',$status) || in_array('AAZF05',$status) || in_array('AAZF06',$status)
			|| in_array('AAZF07',$status) || in_array('AAZF08',$status) || in_array('AAZ003',$status) ):
			$jenis=1;
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 56, 'api_search' => array($jenis));
			$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		endif;
		#print_r($data);
		$this->output99->output_display('05_adminpmb/s05_vw_form_statistik_pendaftar', $data);
		}
		
	}
	
	function jajal(){
		$username = 'admis1';
		$password = 'admi511';
		$JENIS_PMB='2';
		$TGL_MULAI='01052014';
		$TGL_AKHIR='12062014';
		#$url = "http://service.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/format/json";
		$url = "http://service.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/JENIS_PMB/$JENIS_PMB/TGL_MULAI/$TGL_MULAI/TGL_AKHIR/$TGL_AKHIR/format/json";
		
		$context = stream_context_create(
					array(
					'http' => array(
								'method' => 'GET',
								'header' => "Authorization: Basic " . base64_encode("$username:$password")
							)
					));
		$gropo3 = @file_get_contents($url,false,$context);
		$get_bayar = json_decode($gropo3,true);
		print_r($get_bayar);
	}
	
	
	function data_pendaftar_ln(){
		$datapost= array(
			'JENIS_PENDAFTAR' => 1,
			'GELOMBANG' => 10,
			'TAHUN' => 2014
		);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 50, 'api_search' => $datapost);
		$data['data_ln'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data);
		$this->output99->output_display('05_adminpmb/s05_vw_daftar_peserta_ln', $data);
	}	
	
	function data_pendaftar_nilai_akhir(){
		$datapost= array(
			'GELOMBANG' => 10,
			'TAHUN' => 2014
		);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 46, 'api_search' => $datapost);
		$data['nilai_akhir_s2'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		print_r($data);
	}	
	
	function data_pendaftar_nilai_akhir_pil(){
		$datapost= array(
			'GELOMBANG' => 20,
			'TAHUN' => 2014,
			'KD_PIL' => 16,
			'URUTAN' => 1
		);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 56, 'api_search' => $datapost);
		$data['nilai_akhir_s2'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		print_r($data);
	}	
}