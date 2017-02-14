<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class S05_tools_adminpmb extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("lib_adminpmb", '', 'adminpmb','Upload');
		if($this->adminpmb->cek_allowed("AAZ001#AAZ002#AAZ003#AAZ004")){
			
		}else{
			redirect();
		}
	}
			
	function index(){ 
			echo "ok";
	}
	

	
	function daftar_calon_mahasiswa(){ 
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 1, 'api_search' => array());
		$data['data_pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['data_pendaftar']);
		$this->output99->output_display('05_adminpmb/s05_vw_data_pendaftar', $data);
	}
	
	function prodi(){ 
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 43, 'api_search' => array());
		$data['data_pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		print_r($data['data_pendaftar']);
		
	}
	
	function cetak_album_ujian_ori(){ 
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
			if($kondisi[0]=='ruang'){
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 27, 'api_search' => array($kondisi[1]));
				$data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['cetak_album_ujian']);
				$this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_pasca', $data);
			}else{
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 26, 'api_search' => array());
				$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['informasi_ruang_ujian']);
				$this->output99->output_display('05_adminpmb/s05_vw_daftar_cetak_album', $data);
			}
	}
	
	function cetak_kartu_ujian(){
	error_reporting(0);
		$url = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		switch($url[0]){
		case 'lihat' : 
		$jenis_key=$_POST['jenis_lihat'];
		if(empty($_POST['kunci'])){
			$error="Isi Kata Kunci Pencarian Terlebih dahulu";
			$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
			echo $pesan;
		}elseif(empty($jenis_key)){
			$error="Pilih Jenis Pencarian Terlebih dahulu";
			$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
			echo $pesan;
		}else{
			$datapost= array(
				'KODE' => $jenis_key,
				'KEY' => strtoupper ($_POST['kunci'])
			);
			$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter_  = array('api_kode' => 192, 'api_subkode' => 57, 'api_search' => array($datapost));
			$data['peserta'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
			if($data['peserta']==TRUE){
				$this->load->view('05_adminpmb/s05_vw_daftar_cetak_kartu_ujian',$data);
			}else{
				$error="Data Tidak Ditemukan";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}
			
			
		  }
		break;
		case 'cetak' : 
			$JENIS_PMB=$this->security->xss_clean($this->uri->segment(4));
			$id_user=$this->security->xss_clean($this->uri->segment(5));
			#echo $JENIS_PMB; die();
							switch($JENIS_PMB){
								case 1:
									#$data['pendaftar']=$this->pendaftar();
									//MASTER PRODI 
									$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter_  = array('api_kode' => 192, 'api_subkode' => 38, 'api_search' => array());
									$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
			
									//MASTER JURUSAN SEKOLAH
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
									$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
									#print_r($data['jurusan_sekolah']);
						
									//PENDIDIKAN TERAKHIR S1D3
									#$id_user=$data['peserta'][0]->PMB_PIN_PENDAFTAR;
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 32, 'api_search' => array($id_user));
									$data['pendidikan_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	#print_r($data['pendidikan_s1d3']);
									$kode_sekolah=$data['pendidikan_s1d3'][0]->PMB_KODE_SEKOLAH;	
							
									//NAMA SEKOLAH PESERTA
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
									$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
									#print_r($data['nama_sekolah_peserta']);
			
									//PMB_VERIVIKASI_DATA_PESERTA
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 41, 'api_search' => array($id_user));
									$data['cetak_kartu_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
									#print_r($data);
									$data['jenis']="pmb";
									if($data['cetak_kartu_ujian']==TRUE){
										$this->load->view('05_adminpmb/s05_vw_cetak_kartu_ujian_s1d3', $data);
									} 
								break;
								case 2:
									#$id_user=$data['peserta'][0]->PMB_PIN_PENDAFTAR;
									#$data['pendaftar']=$this->pendaftar();
									//PMB_VERIVIKASI_DATA_PESERTA
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 13, 'api_search' => array($id_user));
									$data['cetak_kartu_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
									$data['jenis']="s2";
									#print_r($data); die();
									if($data['cetak_kartu_ujian']==TRUE){
										$this->load->view('05_adminpmb/s05_vw_cetak_kartu_ujian', $data);
									}
								break;
								case 4: case 5:
									#$id_user=$data['peserta'][0]->PMB_PIN_PENDAFTAR;
									#$data['pendaftar']=$this->pendaftar();
									//PMB_VERIVIKASI_DATA_PESERTA
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 52, 'api_search' => array($id_user));
									$data['cetak_kartu_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
									#print_r($data); die();
									$data['jenis']="s3";
									if($data['cetak_kartu_ujian']==TRUE){
										$this->load->view('05_adminpmb/s05_vw_cetak_kartu_ujian_s3', $data);
									}
								break;
							}
		break;
		case 'cetakbiodata' :
			#echo "biodata";
			$JENIS_PMB=$this->security->xss_clean($this->uri->segment(4));
			$id_user=$this->security->xss_clean($this->uri->segment(5));
			switch($JENIS_PMB){
				case 1: 
					//S1 D3 CETAK BIODATA
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 42, 'api_search' => array($id_user));
					$data['cetak_biodata'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data);
					if($data['cetak_biodata']==TRUE){
							//MASTER JURUSAN SEKOLAH
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
							$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
							#print_r($data['jurusan_sekolah']);
					
							$kode_sekolah=$data['cetak_biodata'][0]->PMB_KODE_SEKOLAH;	
							
							//NAMA SEKOLAH PESERTA
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
							$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
							#print_r($data['nama_sekolah_peserta']);
							
							$this->load->view('05_adminpmb/s05_vw_cetak_biodata_s1d3', $data);
					}
				break;
				case 2: 
				case 4: 
				case 5: 
				case 8:
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 9, 'api_search' => array($id_user));
					$data['cetak_biodata'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data); die();
					$this->load->view('05_adminpmb/s05_vw_cetak_biodata_pasca', $data);
				break;
			}
		break;
		default :
		//MASTER JALUR MASUK
		$cek_jabatan = $this->session->userdata('jabatan');
		$status = explode('#', $cek_jabatan);
		if(in_array('AAZ001',$status)): //ROOT
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
			$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		endif;
		$this->output99->output_display('05_adminpmb/s05_vw_form_cetak_kartu_pendaftar', $data);
		break;
		}
	}
	
	
	function create_kartu_ujian(){
		#echo "GELOMBANG YANG ADA DI S1 D3"; 
		//CEK JALUR dan CEK NOMOR UJIAN -> sudah ada belum?
		$JENIS_PMB=$this->security->xss_clean($this->uri->segment(3));
		$id_user=$this->security->xss_clean($this->uri->segment(4));
		#echo $id_user; die();	
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 12, 'api_search' => array($id_user));
		$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data);die();
		$jalur=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
		$no_ujian=$data['piljur'][0]->PMB_NO_UJIAN_PENDAFTAR;
		$ruang_ujian=$data['piljur'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
			if($no_ujian==0 AND $ruang_ujian==0){
					$datapost=array('JENIS_PENDAFTAR'=>$JENIS_PMB, 'GELOMBANG' => $jalur, 'TAHUN' => date("Y"));
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 69, 'api_search' => $datapost);
					$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					#print_r($data['no_terkahir']); die();
					if($data['no_terkahir']==TRUE){
						//Minta id_ruang ujian
							$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
							#echo $nomer_terakhir; die();
							#$nomer_terakhir = substr($nomer_terakhir,4,5); //untuk 9 digit
							$nomer_terakhir = substr($nomer_terakhir,5,5);
							#echo $nomer_terakhir; die();
							$nomer_terakhir = ($nomer_terakhir*1)+1;
							#echo $nomer_terakhir; die();
							$datapost=array('GELOMBANG' => $jalur,'NO_TERAKHIR' => $nomer_terakhir);
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter  = array('api_kode' => 192, 'api_subkode' => 50, 'api_search' => $datapost);
							$data['ruang'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
							#print_r($data['ruang']); die();
							if($data['ruang']==TRUE){
								//update no_ujian //14 2 1 00001
								if (($nomer_terakhir>=0)&&($nomer_terakhir<10)) $nolny = "0000"; //00001 - 9
								elseif (($nomer_terakhir>=10)&&($nomer_terakhir<100)) $nolny = "000"; // 00010 - 99
								elseif (($nomer_terakhir>=100)&&($nomer_terakhir<1000)) $nolny = "00"; // 00100 - 999
								elseif (($nomer_terakhir>=1000)&&($nomer_terakhir<10000)) $nolny = "0"; // 001000 - 9999
								elseif ($nomer_terakhir>=10000) $nomer_terakhir = "";
								//14 2 1 00001 S2 Gelombang 1
								//14 2 2 00001 S2 Gelombang 2
								$ta=$data['piljur'][0]->PMB_TAHUN_DAFTAR;
								#$ta= explode('/', $ta);
								#$ta= $ta[0];
								$ta = substr($ta, 2); 
								#$jenis=1;
								$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
								switch($gel){
									case 10: $gel=10; break; // gel 1 s1 d3
									case 11: $gel=2; break; // gel 2 s1 d3
									case 20: $gel=1; break; // gel 2 s1 d3
									case 21: $gel=2; break; // gel 2 s1 d3
									case 40: $gel=1; break; // gel 1 s3
									case 41: $gel=2; break; // gel 1 s3
									case 50: $gel=1; break; // gel 1 s3
									case 51: $gel=2; break; // gel 1 s3
								}
								$nonya = $ta."".$JENIS_PMB."".$gel."".$nolny."".$nomer_terakhir;
								#echo $gel; die();
								#echo $nonya; die();
								$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
									$api_datapost = array(
									$id_user,
									$nonya,
									$id_ruang
									); 
								#print_r($api_datapost); die();
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
								'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost)); 
									if($aksi==TRUE){
										echo "<script type='text/javascript'>
													<!--
													alert('Berhasil');
													window.location='".base_url()."adminpmb/laporan-daftar_peserta_belum_selesai';
													//-->
												</script>";
									}
							
							}
					}
			}
					
	
	}
	
	
	function cekdata(){ 		
		if(isset($_POST['cek'])){
			if($_POST['jc']=='diri'){
				#echo $_POST['pin'];
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array($_POST['pin']));
				$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				$this->output99->output_display('05_adminpmb/cek', $data);
			}elseif($_POST['jc']=='kes'){
				#echo $_POST['pin'];
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 6, 'api_search' => array($_POST['pin']));
				$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				$this->output99->output_display('05_adminpmb/cek', $data);
			}elseif($_POST['jc']=='status'){
				#echo $_POST['pin'];
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 6, 'api_search' => array($_POST['pin']));
				$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['cek']);
			}
		}else{
			$data['cek']="Belum Dapat Menampilkan Data";
			$this->output99->output_display('05_adminpmb/cek', $data);
		}
	}
	
	function reset_data_peserta(){ 
	$kondisi = $this->security->xss_clean($this->uri->segment(3));
	if($kondisi=='pin'){
		$pin=$this->security->xss_clean($this->uri->segment(4));
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 4, 'api_search' => array($pin));
		$data['result'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($data['result']); die();
		if($data['result']==null){
			#echo "HAPUS";
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 168, 'api_subkode' => 7, 'api_search' => array($pin));
			$data['result'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			redirect('adminpmb/tools-reset_data_peserta');
		}else{
		 echo "AMAN";
		}
	}else{
	
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 5, 'api_search' => array());
		$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cek']);
		$this->output99->output_display('05_adminpmb/reset_data', $data);
		
	}
	}
	
	
	function cetak_cover_ujian(){$this->load->view('05_adminpmb/s05_vw_cetak_cover_ujian');}
	
	
	 function cetak_album_ujian() {
	
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		if($kondisi[0]=='ruang'){
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 27, 'api_search' => array($kondisi[1]));
		$data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cetak_album_ujian']);
		$html=$this->load->view('05_adminpmb/jajal',$data,TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		#finish pdf
		$pdf->lastPage();
		$pdf->Output('album-'.ceil(microtime(true)).'.pdf', 'I');
		
	
		}else{
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 26, 'api_search' => array());
				$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['informasi_ruang_ujian']);
				$this->output99->output_display('05_adminpmb/s05_vw_daftar_cetak_album', $data);
			}
	} 
	

		function cetak_album_ujian_pascas2() {
	
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		if($kondisi[0]=='ruang'){
	/*
		 $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		 $parameter  = array('api_kode' => 192, 'api_subkode' => 64, 'api_search' => array($kondisi[1]));
		 $data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		 #print_r($data['cetak_album_ujian']);
		 $this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_s1d3',$data); 
	*/
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 64, 'api_search' => array($kondisi[1]));
		$data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cetak_album_ujian']);
		
		/* //NAMA SEKOLAH PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
		$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
		#print_r($data['nama_sekolah_peserta']); */
		$html=$this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_s1d3',$data,TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		#$img_file = "http://admisi.uin-suka.ac.id/asset/logo.png";
		#$pdf->Image($img_file, 77, 177, 27.5,20, '','','',true,300,'');
		#finish pdf
		$pdf->lastPage();
		$pdf->Output('album-'.ceil(microtime(true)).'.pdf', 'I');
		
				
		}else{
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 53, 'api_search' => array());
				$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['informasi_ruang_ujian']);
				$this->output99->output_display('05_adminpmb/s05_vw_daftar_cetak_album_s1d3', $data);
			}
	}	
	
	function cetak_album_ujian_s1d3() {
	
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		if($kondisi[0]=='ruang'){
	/*
		 $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		 $parameter  = array('api_kode' => 192, 'api_subkode' => 64, 'api_search' => array($kondisi[1]));
		 $data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		 #print_r($data['cetak_album_ujian']);
		 $this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_s1d3',$data); 
	*/
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 64, 'api_search' => array($kondisi[1]));
		$data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cetak_album_ujian']);
		
		/* //NAMA SEKOLAH PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
		$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
		#print_r($data['nama_sekolah_peserta']); */
		$html=$this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_s1d3',$data,TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		#$img_file = "http://admisi.uin-suka.ac.id/asset/logo.png";
		#$pdf->Image($img_file, 77, 177, 27.5,20, '','','',true,300,'');
		#finish pdf
		$pdf->lastPage();
		$pdf->Output('album-'.ceil(microtime(true)).'.pdf', 'I');
		
				
		}else{
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 53, 'api_search' => array());
				$data['informasi_ruang_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['informasi_ruang_ujian']);
				$this->output99->output_display('05_adminpmb/s05_vw_daftar_cetak_album_s1d3', $data);
			}
	}
	
	
	
	function cetak_album_ujian_s1d3_difabel() {
	
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 65, 'api_search' => array());
		$data['cetak_album_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cetak_album_ujian']);
		
		/* //NAMA SEKOLAH PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
		$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
		#print_r($data['nama_sekolah_peserta']); */
		$html=$this->load->view('05_adminpmb/s05_vw_cetak_album_ujian_s1d3_difabel',$data,TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		#finish pdf
		$pdf->lastPage();
		$pdf->Output('album-'.ceil(microtime(true)).'.pdf', 'I');
	
	}
	
	
	function cetak_form_verifikasi_ujian(){
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		if($kondisi[0]=='ruang'){
				
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 27, 'api_search' => array($kondisi[1]));
				$data['cetak_verifikasi_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['cetak_verifikasi_ujian']);
				$this->load->view('05_adminpmb/s05_vw_cetak_form_verifikasi', $data);
		}
	}
	
	function cetak_form_verifikasi_ujian_s1d3(){
		$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
		if($kondisi[0]=='ruang'){
				
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 64, 'api_search' => array($kondisi[1]));
				$data['cetak_verifikasi_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#print_r($data['cetak_verifikasi_ujian']);
				$this->load->view('05_adminpmb/s05_vw_cetak_form_verifikasi_s1d3', $data);
		}
	}
	
	
	private function _0322_prep_loadxls($filename = ''){
		include_once('includes/xls_report/PHPExcel.php');
		$objReader = new PHPExcel_Reader_Excel5();
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load("ljk_files/s2/".$filename);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,false);
		$totalrow = count($sheetData); 
		for($i = 0; $i < $totalrow; $i++){
				$uu_mhs['mhs'][] = array(
									'no_pmb' 	=> preg_replace("/[^0-9]/", "", $sheetData[$i][4]), 
									'kode_soal' => preg_replace("/[^0-9]/", "", $sheetData[$i][5]), 
									'tgl_lahir' => preg_replace("/[^0-9]/", "", $sheetData[$i][6]), 
									'nama' 		=> strtoupper($sheetData[$i][7]), 
									'jawaban' 	=> strtoupper($sheetData[$i][8])
								);
		} 
		return $uu_mhs; 
	}
	
	function soal(){
		$kondisi = explode("/",$this->security->xss_clean($this->uri->segment(3)));
		#print_r($kondisi); die();
		if($kondisi[0]=='upload_ljk'){
			#print_r($_POST); die();
			if(isset($_FILES['userfile'])){
			#	$kode = explode("/",$this->security->xss_clean($this->uri->segment(4)));
			#	echo $kode[0]; die();
				
				// $kd_soal=$_POST['kode_soal'];
				// $gelombang=$_POST[''];
				// $jenis=$_POST[''];
				
				//upload xls
				$config['upload_path'] 		= 'ljk_files/$jenis/';
				$config['allowed_types'] 	= 'xls';
				$config['overwrite']     	= FALSE;
				$config['file_name']     	= 'ljk-$jenis-2014-'.$_FILES['userfile']['name'];
				$this->load->library('upload',$config);
				
				if ($this->upload->do_upload()){
					$error='';
					$data['uu_file']	= $this->upload->data(); 
					$loadxls		 	= $this->_0322_prep_loadxls($data['uu_file']['file_name']);
					
				    // $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					// $parameter  = array('api_kode' => 192, 'api_subkode' => 62, 'api_search' => array("$kd_soal"));
					// $data['kunci_jawaban'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					#$kunci_jawaban = 'CBBABDADBDABCADCCCCBBBCDDBCCABADCADBCAABCACBBBDACDCBCABDCADCABABDDABAADABCC'; #BAR
					#$kunci_jawaban = 'BDACDADDCADBBADDCBDBCDBACBACCDCBCACBBDDADCBCCDBBCBBADCBBABAD'; #BIR
					#$kunci_jawaban = 'CCCACBABCEDDBDACEDCCAECBDCEBCBDBECACABDBECDBDADECDBCEDABCABCDBCCDDEBABCDEBBDACACEACADCDDDACCDBACDCED'; #TPA
					
					/* $gel='20';
					$jenis='2';
					$kd_soal='001'; */
					$key = str_split($kunci_jawaban);
					foreach($loadxls['mhs'] as $id=>$val){
						if($val['kode_soal'] == $kd_soal){
							#echo count(str_split($val['jawaban'])).' '.$val['jawaban'].'<br />';
						#	echo ($id+1).'. ';
							$tgl_lahir = substr($val['tgl_lahir'],0,2).'-'.substr($val['tgl_lahir'],2,2).'-'.substr($val['tgl_lahir'],4,4);
							$jwb = str_split($val['jawaban']);
							$status_jawaban='';
							foreach($key as $idx=>$kunci){
								$no_soal = $idx+1;
								if(isset($jwb[$idx])){
									if($kunci == $jwb[$idx]){
										$status_jawaban.="1";
									}else{
										$status_jawaban.="2";
									}
								}else{ $status_jawaban.="3"; }
								
								
							}
							//INSERT
								$api_datapost= array(
										'PMB_KODE_JALUR_MASUK' => $gel,
										'PMB_KODE_JENIS_PENERIMAAN' => $jenis,
										'PMB_NO_PMB' => $val['no_pmb'],
										'PMB_NAMA_PESERTA' => $val['nama'],
										'PMB_TANGGAL_LAHIR' => $tgl_lahir,
										'PMB_KODE_SOAL' => $val['kode_soal'],
										'PMB_NO_SOAL' => '',
										'PMB_JAWABAN' => '',
										'PMB_STATUS_JAWABAN' => $status_jawaban
								);
								#print_r($api_datapost); DIE();
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 59, 'api_search' => $api_datapost));
								#if($id%100==0) $aksi=false; else $aksi=true;
								#print_r($aksi);
								if($aksi==TRUE){
									#echo "<div class='bs-callout bs-callout-success'>Berhasil</div>";
								}else{
									$error.=$val['no_pmb']."<br />";
								}
							
						}
						
					}
					if($error){
						echo "<div class='bs-callout bs-callout-error'>".$error."</div>";
					}else{
						echo "<div class='bs-callout bs-callout-success'>Berhasil</div>";
					}
					#print_r($loadxls);
					#$this->load->view('kkn/admin/2014/_input_nilai_kkn_prev',$data);
				}else{
					echo $this->upload->display_errors();
				}
			}else{
				echo "<h1>Gagal upload nilai LJK!!!</h1>";
			}
		}elseif($kondisi[0]=='prosentase'){
			if($_POST[0]){
				// echo $_POST[0];
				// echo $_POST[1]; 
				// die();
				$k_soal=$_POST[0];
				$jalur=$_POST[1];
				$api_datapost=array(
					$k_soal,
					$jalur
				);
				#print_r($api_datapost); die();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 60, 'api_search' => array($api_datapost));
				$data['daftar_cek_prosentase'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				#echo '<pre>';  print_r($data['daftar_cek_prosentase']); echo '</pre>'; die();
				
				$api_datapost=array(
					'KODE_SOAL' =>$k_soal,
					'GELOMBANG' =>$jalur,
					'TAHUN' => date("Y")
				);
				#echo $k_soal; die();
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 61, 'api_search' => $api_datapost);
				$data['tools_soal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				
				#echo '<pre>'; print_r($data['tools_soal']); echo '</pre>'; die();
				foreach($data['daftar_cek_prosentase'] as $val){
					if($val->PMB_NO_PMB>0){
						#echo $val->PMB_NO_PMB."-".$val->PMB_STATUS_JAWABAN."<BR />"; die();
						$kode_soal=$val->PMB_KODE_SOAL;
						foreach($data['tools_soal'] as $value){
							$benar=0;$jml_benar=0;$max_benar=0;
							$salah=0;$jml_salah=0;$max_salah=0;
							$kosong=0;$jml_kosong=0;$max_kosong=0;
							$total=0;
							$key = str_split($val->PMB_STATUS_JAWABAN);
							#print_r($key); die();
							$total_soal = count($key);
							for($a=0; $a<count($key); $a++){
								if(($a+1)>=$value->PMB_NOMOR_MULAI AND $value->PMB_NOMOR_AKHIR>=($a+1)){
									$bobot_benar=$value->PMB_NILAI_BENAR;
									$bobot_salah=$value->PMB_NILAI_SALAH;
									$bobot_kosong=$value->PMB_NILAI_KOSONG;
									$jumlah_subsoal=($value->PMB_NOMOR_AKHIR-$value->PMB_NOMOR_MULAI)+1;
									$jenis=$value->PMB_KODE_JENIS_PENERIMAAN;
									$jalur_masuk=$value->PMB_KODE_JALUR_MASUK;
								}else{
									continue;
								}
								$max_benar+=$bobot_benar;
								$max_salah+=$bobot_salah;
								$max_kosong+=$bobot_kosong;
								if($key[$a]==1){ #jika nilai 1=benar
										$benar++;
										$jml_benar+=$bobot_benar;
								}elseif($key[$a]==2){ #jika salah =2
										$salah++;
										$jml_salah+=$bobot_salah;
								}elseif($key[$a]==3){ #jika kosong =3
										$kosong++;
										$jml_kosong+=$bobot_kosong;
								}
							}
						#print_r($val->PMB_NO_PMB); die();
						#print_r($jml_salah); die() ;
						#$total=($jml_benar+$jml_salah+$jml_kosong)/($bobot_benar*$jumlah_subsoal);
						$asli=($jml_benar+$jml_salah+$jml_kosong);
						$range = abs($max_benar)+abs($max_salah)+abs($max_kosong);
						$max_nilai=0;
						if($max_benar>0){ $max_nilai+=$max_benar; }
						if($max_salah>0){ $max_nilai+=$max_salah; }
						if($max_kosong>0){ $max_nilai+=$max_kosong; }
						$total=($asli+($range-$max_nilai))*(100/$range);
						#$total = ($asli-$total_soal*)
						#$total_akhir=ceil($total);
						/* if($total_akhir>1){
							$total=1;
						}else{
							$total=$total_akhir;
						} */
						//INSERT
						$api_datapost= array(
										'PMB_ID_NILAI_AKHIR' => '',
										'PMB_NO_PMB' => $val->PMB_NO_PMB,
										'PMB_KODE_SOAL_UJI' => '',
										'PMB_KODE_SOAL' => $kode_soal,
										'PMB_JUMLAH_JAWABAN_BENAR' => '',
										'PMB_JUMLAH_JAWABAN_SALAH' => '',
										'PMB_JUMLAH_JAWABAN_KOSONG' => '',
										'PMB_NILAI_AKHIR' => $total,
										'PMB_JALUR_MASUK' => $jalur_masuk,
										'PMB_KODE_JENIS_PENERIMAAN' => $jenis,
										'PMB_STATUS_PROSES' => 1
								);
						#echo '<pre>'; print_r($api_datapost); echo '</pre>';
						
							$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', 
							array('api_kode'=>10, 'api_subkode' => 39, 'api_search' => $api_datapost)); 
								if($aksi==TRUE){
									#print_r($api_datapost);
								   echo "NO PMB = ".$api_datapost['PMB_NO_PMB']."
										<br />KODE SOAL = ".$api_datapost['PMB_KODE_SOAL']."
										<br />JUMLAH BENAR  =".$api_datapost['PMB_JUMLAH_JAWABAN_BENAR']."
										<br />JUMLAH SALAH  =".$api_datapost['PMB_JUMLAH_JAWABAN_SALAH']."
										<br />JUMLAH KOSONG =".$api_datapost['PMB_JUMLAH_JAWABAN_KOSONG']."
										<br />NILAI AKHIR   =".$api_datapost['PMB_NILAI_AKHIR']."<br />";
									echo "<div class='bs-callout bs-callout-success'>Data Berhasil dihitung</div>";
								}else{
									echo "<div class='bs-callout bs-callout-error'>Data Gagal dihitung</div>";
								}  
								
						}
					}
				}
					
			}
					
		}else{
			echo "mau apa";
		}
		
	}
	
	function form_soal(){
		$kondisi = explode("/",$this->security->xss_clean($this->uri->segment(3)));
		#print_r($kondisi); die();
		//MASTER SOAL
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 63, 'api_search' => array());
		$data['master_soal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		//JALUR MASUK
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
		$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		if($kondisi[0]=='upload'){
			$this->output99->output_display('05_adminpmb/s05_vw_form_up_soal', $data);
		}elseif($kondisi[0]=='prosentase'){
			$this->output99->output_display('05_adminpmb/s05_vw_form_prosentase_soal', $data);
		}
	}
	
	
	private function loadxls($filename = ''){
		include_once('includes/xls_report/PHPExcel.php');
		$objReader = new PHPExcel_Reader_Excel5();
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load("ljk_files/s2/".$filename);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,false);
		$totalrow = count($sheetData); 
		for($i = 0; $i < $totalrow; $i++){
				$uu_mhs['xls'][] = array(
									'no_pmb' 	=> preg_replace("/[^0-9]/", "", $sheetData[$i][0]), 
									'nilai_akhir' => preg_replace("/[^0-9]/", "", $sheetData[$i][1])
								);
		} 
		return $uu_mhs; 
	}
	
	function terjemahan(){
		$kondisi = explode("/",$this->security->xss_clean($this->uri->segment(3)));
		#print_r($kondisi); die();
		if($kondisi[0]=='upload_terjemahan'){
				#print_r($_POST); die();
				$jal=explode('|',$_POST['jalur']);
				$jalur_masuk=$jal[0];
				$jenis=$jal[1];
				switch($jenis){
					case 2: $jen_pen='s2'; break;
				}
				$kode=$_POST['soal'];
				#echo $jenis; die();
			if(isset($_FILES['userfile'])){
				//upload xls
				$config['upload_path'] 		= 'ljk_files/'.$jen_pen.'/';
				$config['allowed_types'] 	= 'xls';
				$config['overwrite']     	= TRUE;
				$config['file_name']     	= 'terjemahan-'.$kode.'-'.$jen_pen.'-2014-'.$_FILES['userfile']['name'];
				$this->load->library('upload',$config);	
				if($this->upload->do_upload()){
					$error='';
					$data['uu_file']	= $this->upload->data(); 
					$loadxls		 	= $this->loadxls($data['uu_file']['file_name']);
					#print_r($loadxls);
					#INSERT
					foreach($loadxls['xls'] as $id=>$val){
						#echo $val['no_pmb']."---";
						#echo $val['nilai_akhir']."<br />";
						$api_datapost= array(
										'PMB_ID_NILAI_AKHIR' => '',
										'PMB_NO_PMB' => $val['no_pmb'],
										'PMB_KODE_SOAL_UJI' => '',
										'PMB_KODE_SOAL' => $kode,
										'PMB_JUMLAH_JAWABAN_BENAR' => '',
										'PMB_JUMLAH_JAWABAN_SALAH' => '',
										'PMB_JUMLAH_JAWABAN_KOSONG' => '',
										'PMB_NILAI_AKHIR' => $val['nilai_akhir'],
										'PMB_JALUR_MASUK' => $jalur_masuk,
										'PMB_KODE_JENIS_PENERIMAAN' => $jenis,
										'PMB_STATUS_PROSES' => 0
								);
						#print_r($api_datapost); die();
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', 
						array('api_kode'=>10, 'api_subkode' => 39, 'api_search' => $api_datapost)); 								
						 if($api_datapost==TRUE){
									#print_r($api_datapost);
								   echo "NO PMB = ".$api_datapost['PMB_NO_PMB']."
										<br />KODE SOAL = ".$api_datapost['PMB_KODE_SOAL']."
										<br />NILAI AKHIR   =".$api_datapost['PMB_NILAI_AKHIR']."<br />";
									echo "<div class='bs-callout bs-callout-success'>Data Berhasil Diinput</div>";
								}else{
									echo "<div class='bs-callout bs-callout-error'>Data Gagal diinput</div>";
								} 
					}
					
				}else{
					echo $this->upload->display_errors();
				}
			}else{
				echo "gagal";
			
			}
			
		}
	}
	
	function form_terjemahan(){
		//MASTER SOAL
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 63, 'api_search' => array());
		$data['master_soal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		//JALUR MASUK
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
		$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		$this->output99->output_display('05_adminpmb/s05_vw_form_up_terjemah', $data);
	}
	
	function kepribadian($tompo){
		$data_kp = array();
		// $datapost=array(
			// 'GELOMBANG' => $tompo['GELOMBANG'],
			// 'TAHUN' => $tompo['TAHUN']
		// );
		$datapost=array(
			'GELOMBANG' => 10,
			'TAHUN' => $tompo['TAHUN']
		);
		$apidatapost=array(
			'GELOMBANG' => $tompo['GELOMBANG'],
			'TAHUN' => $tompo['TAHUN']
		);
		#PRINT_R($datapost); die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 67, 'api_search' => $datapost);
		$kategori_kepribadian = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 66, 'api_search' => $datapost);
		$bobot_kepribadian = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		$arr_kunci = array();
		foreach($kategori_kepribadian as $id=>$kat){
			foreach($bobot_kepribadian as $idx=>$bobot){
				if($bobot->PMB_KODE_SUB_SOAL == $kat->PMB_KODE_SUB_SOAL){
					$arr_kunci[$bobot->PMB_KODE_SUB_SOAL][] = $bobot;
				}
			}
		}
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 54, 'api_search' => $apidatapost);
		$jenis_kelamin = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		# echo '<pre>'; print_r($arr_kunci); echo '</pre>'; die();
		$arr_jk = array();
		foreach($jenis_kelamin as $id=>$jk){
			$arr_jk[$jk->PMB_NO_UJIAN_PENDAFTAR] = $jk->PMB_JENIS_KELAMIN_PENDAFTAR;
		}
		
		/* $data['jawaban_peserta_1']=array('NO_PMB'=>1, 'JAWABAN'=>'CBBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_2']=array('NO_PMB'=>2, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'P');
		$data['jawaban_peserta_3']=array('NO_PMB'=>3, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_4']=array('NO_PMB'=>4, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L'); 
		$data['jawaban_peserta_5']=array('NO_PMB'=>5, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_6']=array('NO_PMB'=>6, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'P');
		$data['jawaban_peserta_7']=array('NO_PMB'=>7, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_8']=array('NO_PMB'=>8, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_9']=array('NO_PMB'=>9, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'P');
		$data['jawaban_peserta_10']=array('NO_PMB'=>10, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_11']=array('NO_PMB'=>11, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'P');
		$data['jawaban_peserta_12']=array('NO_PMB'=>12, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_13']=array('NO_PMB'=>13, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_14']=array('NO_PMB'=>14, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'P');
		$data['jawaban_peserta_15']=array('NO_PMB'=>15, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_16']=array('NO_PMB'=>16, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_17']=array('NO_PMB'=>17, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_18']=array('NO_PMB'=>18, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_19']=array('NO_PMB'=>19, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		$data['jawaban_peserta_20']=array('NO_PMB'=>20, 'JAWABAN'=>'ABBABCACBAABCAACCCCBBBCBBCCABACCAABCAABCACBBBDACBCBCABCCAACABABBBABAACABCCABBBBBBABCABCABCBACBACBBABBCBBA', 'JK' => 'L');
		 */
		
		foreach($tompo['JAWABAN'] as $index=>$jawaban){
			// if($jawaban['KODE_SUB_SOAL'] != '421' || $jawaban['KODE_SUB_SOAL'] != '422' || $jawaban['KODE_SUB_SOAL'] != '423' || $jawaban['KODE_SUB_SOAL'] != '424' || $jawaban['KODE_SUB_SOAL'] != '425') continue;
			// echo $jawaban['KODE_SUB_SOAL']."<br />"; continue;
			
			if($jawaban['KODE_SUB_SOAL'] <= 420 || $jawaban['KODE_SUB_SOAL'] >= 426){
				#echo $jawaban['KODE_SUB_SOAL']."<br />"; 
				continue;
			}
		// if(!array_key_exists($jawaban['KODE_SUB_SOAL'],$arr_kunci)){ continue; }
			$kunci = $arr_kunci[$jawaban['KODE_SUB_SOAL']];
			$R_MD = 0; $R_A = 0; $R_B = 0; $R_C =0; $R_E = 0; $R_F = 0; $R_G = 0; $R_H = 0; $R_I = 0; $R_L = 0; $R_M = 0; $R_N = 0; $R_O = 0; $R_Q1 = 0; $R_Q2 = 0; $R_Q3 = 0; $R_Q4 = 0;
			$MD = 0; $A = 0; $B = 0; $C =0; $E = 0; $F = 0; $G = 0; $H = 0; $I = 0; $L = 0; $M = 0; $N = 0; $O = 0; $Q1 = 0; $Q2 = 0; $Q3 = 0; $Q4 = 0;
			$jawab=str_split($jawaban['JAWABAN']);
				foreach($jawab as $idx=>$val){
					$no=$idx+1;
					$kat = $kunci[$idx];
						switch($val){
							case 'A': $bobot=$kat->PMB_BOBOT_JWB_A; break;
							case 'B': $bobot=$kat->PMB_BOBOT_JWB_B; break;
							case 'C': $bobot=$kat->PMB_BOBOT_JWB_C; break;
							default: $bobot=0; break;
						}
						switch($kat->PMB_GROUP_JWB){
							case 'MD' : $R_MD += $bobot; break;			
							case 'A' : $R_A += $bobot; break;			
							case 'B' : $R_B += $bobot; break;			
							case 'C' : $R_C += $bobot; break;			
							case 'E' : $R_E += $bobot; break;			
							case 'F' : $R_F += $bobot; break;			
							case 'G' : $R_G += $bobot; break;			
							case 'H' : $R_H += $bobot; break;			
							case 'I' : $R_I += $bobot; break;			
							case 'L' : $R_L += $bobot; break;			
							case 'M' : $R_M += $bobot; break;			
							case 'N' : $R_N += $bobot; break;			
							case 'O' : $R_O += $bobot; break;			
							case 'Q1' : $R_Q1 += $bobot; break;			
							case 'Q2' : $R_Q2 += $bobot; break;			
							case 'Q3' : $R_Q3 += $bobot; break;			
							case 'Q4' : $R_Q4 += $bobot; break;			
						}
						
					if($no==count($kunci)){ break; }
				}
				#		 1   2  3   4   5   6   7    8       9    10
				#------------------------------------------------------
 				#Female	0-2	3-4	5	6	7	8	9	 10-11	12	13-14
				#Male	0-3	  4	5	6	7	8	9-10	11	12	13-14
					if(isset($arr_jk[$jawaban['NO_PMB']])){
						if($arr_jk[$jawaban['NO_PMB']]==0){ //lanang
							switch($R_MD){
								case '0':case '1':case '2': case '3': $MD=1; break;
								case '4': $MD=2; break;
								case '5': $MD=3; break;
								case '6': $MD=4; break;
								case '7': $MD=5; break;
								case '8': $MD=6; break;
								case '9': case '10': $MD=7; break;
								case '11': $MD=8; break;
								case '12': $MD=9; break;
								case '13': case '14': $MD=10; break;	
							}
						}else{ //WEDOK
							switch($R_MD){
								case '0':case '1':case '2': $MD=1; break;
								case '3':case '4': $MD=2; break;
								case '5': $MD=3; break;
								case '6': $MD=4; break;
								case '7': $MD=5; break;
								case '8': $MD=6; break;
								case '9': $MD=7; break;
								case '10': case '11': $MD=8; break;
								case '12': $MD=9; break;
								case '13': case '14': $MD=10; break;	
							}
						}
					}else{ 
						#$R_MD = '>_<'; 
						$R_MD = '0'; 
					}
						
/* 				
				A	0-3	4	5	6	7-8	9	10	11	12	-
				B	0	1	2	3	4	5	-	6	7	8
				C	0-1	2	3-4	5	6	7	8-9	10	11	12

				E	0	1	2	3	4-5	6	7	8	9-10	11-12
				F	0-2	3	4	5	6	7-8	9	10	11	12
				G	0-1	2-3	4	5-6	7	8	9	10	11	12

				H	0-1	2	3-4	5	6	7-8	9	10	11	12
				I	0	1	2	3-4	5	6-7	8	9	10	11-12
				L	0-1	2	3	4	5	6	7	8	9	10-12

				M	0	1	2	3	4	5	6-7	8	9	10-12
				N	0	1	2	3	4	5	6	7-8	9	10-12
				O	0-1	2	3	4-5	6	7	8-9	10	11	12

				Q1	0-1	2	3	4	5-6	7	8	9	10	11-12
				Q2	-	0	1	2-3	4	5	6	7	8-9	10-12
				
				Q3	0-2	3	4	5-6	7	8	9	10	11	12
				Q4	0-1	2	3	4	5-6	7	8	9	10-11	12

 */		
			
			#A	0-3	4	5	6	7-8	9	10	11	12	-
			switch($R_A){
				case '0': case '1': case '2': case '3': $A=1; break;
				case '4': $A=2; break;
				case '5': $A=3; break;
				case '6': $A=4; break;
				case '7': case '8': $A=5; break;
				case '9': $A=6; break;
				case '10': $A=7; break;
				case '11': $A=8; break;
				case '12': $A=9; break;
			}
			#B	0	1	2	3	4	5	-	6	7	8
			switch($R_B){
				case '0': $B=1; break;
				case '1': $B=2; break;
				case '2': $B=3; break;
				case '3': $B=4; break;
				case '4': $B=5; break;
				case '5': $B=6; break;
				case '6': $B=8; break;
				case '7': $B=9; break;
				case '8': $B=10; break;
			}
			
			#C	0-1	2	3-4	5	6	7	8-9	10	11	12
			switch($R_C){
				case '0': case '1': $C=1; break;
				case '2': $C=2; break;
				case '3': case '4': $C=3; break;
				case '5': $C=4; break;
				case '6': $C=5; break;
				case '7': $C=6; break;
				case '8': case '9': $C=7; break;
				case '10': $C=8; break;
				case '11': $C=9; break;
				case '12': $C=10; break;
			}
			
			#E	0	1	2	3	4-5	6	7	8	9-10	11-12
			switch($R_E){
				case '0': $E=1; break;
				case '1': $E=2; break;
				case '2': $E=3; break;
				case '3': $E=4; break;
				case '4': case '5': $E=5; break;
				case '6': $E=6; break;
				case '7': $E=7; break;
				case '8': $E=8; break;
				case '9': case '10': $E=9; break;
				case '11': case '12': $E=10; break;
			}
			
			#F	0-2	3	4	5	6	7-8	9	10	11	12
			switch($R_F){
				case '0': case '1': case '2': case '3': $F=1; break;
				case '4': $F=2; break;
				case '5': $F=3; break;
				case '6': $F=4; break;
				case '7': case '8': $F=5; break;
				case '9': $F=6; break;
				case '10': $F=7; break;
				case '11': $F=8; break;
				case '12': $F=9; break;
			}
			
			#G	0-1	2-3	4	5-6	7	8	9	10	11	12
			switch($R_G){
				case '0': case '1': $G=1; break;
				case '2': case '3': $G=2; break;
				case '4': $G=3; break;
				case '5': case '6': $G=4; break;
				case '7': $G=5; break;
				case '8': $G=6; break;
				case '9': $G=7; break;
				case '10': $G=8; break;
				case '11': $G=9; break;
				case '12': $G=10; break;
			}
			
			#H	0-1	2	3-4	5	6	7-8	9	10	11	12
			switch($R_H){
				case '0': case '1': $H=1; break;
				case '2': $H=2; break;
				case '3': case '4': $H=3; break;
				case '5': $H=4; break;
				case '6': $H=5; break;
				case '7': case '8': $H=6; break;
				case '9': $H=7; break;
				case '10': $H=8; break;
				case '11': $H=9; break;
				case '12': $H=10; break;
			}
			
			#I	0	1	2	3-4	5	6-7	8	9	10	11-12
			switch($R_I){
				case '0': $I=1; break;
				case '1': $I=2; break;
				case '2': $I=3; break;
				case '3': case '4': $I=4; break;
				case '5': $I=5; break;
				case '6': case '7': $I=6; break;
				case '8': $I=7; break;
				case '9': $I=8; break;
				case '10': $I=9; break;
				case '11': case '12' :$I=10; break;
			}
			
			#L	0-1	2	3	4	5	6	7	8	9	10-12
			switch($R_L){
				case '0': case '1': $L=1; break;
				case '2': $L=2; break;
				case '3': $L=3; break;
				case '4': $L=4; break;
				case '5': $L=5; break;
				case '6': $L=6; break;
				case '7': $L=7; break;
				case '8': $L=8; break;
				case '9': $L=9; break;
				case '10': case '11': case '12': $L=10; break;
			}
			
			#M	0	1	2	3	4	5	6-7	8	9	10-12
			switch($R_M){
				case '0': $M=1; break;
				case '1': $M=2; break;
				case '2': $M=3; break;
				case '3': $M=4; break;
				case '4': case '8': $M=5; break;
				case '5': $M=6; break;
				case '6': case '7': $M=7; break;
				case '8': $M=8; break;
				case '9': $M=9; break;
				case '10': case '11': case '12': $M=10; break;
			}
			
			#N	0	1	2	3	4	5	6	7-8	9	10-12
			switch($R_N){
				case '0': case '1': case '2': case '3': $N=1; break;
				case '1': $N=2; break;
				case '2': $N=3; break;
				case '3': $N=4; break;
				case '4': case '8': $N=5; break;
				case '5': $N=6; break;
				case '6': $N=7; break;
				case '7': case '8': $N=8; break;
				case '9': $N=9; break;
				case '10': case '11': case '12': $N=10; break;
			}
			
			#O	0-1	2	3	4-5	6	7	8-9	10	11	12
			switch($R_O){
				case '0': case '1':$O=1; break;
				case '2': $O=2; break;
				case '3': $O=3; break;
				case '4': case '5': $O=4; break;
				case '6': $O=5; break;
				case '7': $O=6; break;
				case '8': case '9': $O=7; break;
				case '10': $O=8; break;
				case '11': $O=9; break;
				case '12': $O=10; break;
			}
			
			#Q1	0-1	2	3	4	5-6	7	8	9	10	11-12
			switch($R_Q1){
				case '0': case '1': $Q1=1; break;
				case '2': $Q1=2; break;
				case '3': $Q1=3; break;
				case '4': $Q1=4; break;
				case '5': case '6': $Q1=5; break;
				case '7': $Q1=6; break;
				case '8': $Q1=7; break;
				case '9': $Q1=8; break;
				case '10': $Q1=9; break;
				case '11': case '12': $Q1=10; break;
			}
			
			#Q2	-	0	1	2-3	4	5	6	7	8-9	10-12
			switch($R_Q2){
				case '0': $Q2=2; break;
				case '1': $Q2=3; break;
				case '2': case '3': $Q2=4; break;
				case '4': $Q2=5; break;
				case '5': $Q2=6; break;
				case '6': $Q2=7; break;
				case '7': $Q2=8; break;
				case '8': case '9': $Q2=9; break;
				case '10': case '11': case '12': $Q2=10; break;
			}
			

			#Q3	0-2	3	4	5-6	7	8	9	10	11	12
			switch($R_Q3){
				case '0': case '1': $Q3=1; break;
				case '2': $Q3=2; break;
				case '3': $Q3=3; break;
				case '4': $Q3=4; break;
				case '5': case '6': $Q3=5; break;
				case '7': $Q3=6; break;
				case '8': $Q3=7; break;
				case '9': $Q3=8; break;
				case '10': case '11': $Q3=9; break;
				case '12': $Q3=10; break;
			}

			#Q4	0-1	2	3	4	5-6	7	8	9	10-11	12			
			switch($R_Q4){
				case '0': case '1': $Q4=1; break;
				case '2': $Q4=2; break;
				case '3': $Q4=3; break;
				case '4': $Q4=4; break;
				case '5': case '6': $Q4=5; break;
				case '7': $Q4=6; break;
				case '8': $Q4=7; break;
				case '9': $Q4=8; break;
				case '10': case '11': $Q4=9; break;
				case '12': $Q4=10; break;
			}
			
			if($MD<6){
				//tidak valid. input seadanya	
			}elseif($MD>=7){
				//diolahn lagi ya :-)
				switch($MD){
					case 10 : 
						$O+=2;$Q4+=2;
						$C-=2;$Q3-=2;
						$L+=1;$N+=1;$Q2+=1;
						$A-=1;$G-=1;$H-=1;
					break;
					case 9: case 8:  
						#L N O Q2 Q4 +1
						$L+=1;$N+=1;$O+=1;$Q2+=1;$Q4+=1;
						#A, C, G, H, dan Q3 -1
						$A-=1;$C-=1;$G-=1;$H-=1;$Q3-=1;
					break;
					case 7: 
						#O dan Q4 +1
						$O+=1;$Q4+=1;
						#C dan Q3 -1
						$C-=1;$Q3-=1;
					break;
				}
			}else{
				//ideal
			}
			/*
			 $data_kp[] =array(
				'NOPMB' => $jawaban['NO_PMB'],
				'KODESOAL' => $kat->PMB_KODE_SOAL,
				'TEST_FORM' => $kat->PMB_KODE_SUB_SOAL,
				'MD' => $MD,
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'E' => $E,
				'F' => $F,
				'G' => $G,
				'H' => $H,
				'I' => $I,
				'L' => $L,
				'M' => $M,
				'N' => $N,
				'O' => $O,
				'Q1' => $Q1,	
				'Q2' => $Q2,
				'Q3' => $Q3,
				'Q4' => $Q4
			); 
			*/
		 $data_kp =array(
				'NOPMB' => $jawaban['NO_PMB'],
				'KODESOAL' => $kat->PMB_KODE_SOAL,
				'TEST_FORM' => $kat->PMB_KODE_SUB_SOAL,
				'R_MD' => $R_MD,
				'R_A' => $R_A,
				'R_B' => $R_B,
				'R_C' => $R_C,
				'R_E' => $R_E,
				'R_F' => $R_F,
				'R_G' => $R_G,
				'R_H' => $R_H,
				'R_I' => $R_I,
				'R_L' => $R_L,
				'R_M' => $R_M,
				'R_N' => $R_N,
				'R_O' => $R_O,
				'R_Q1' => $R_Q1,	
				'R_Q2' => $R_Q2,
				'R_Q3' => $R_Q3,
				'R_Q4' => $R_Q4,
				'MD' => $MD,
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'E' => $E,
				'F' => $F,
				'G' => $G,
				'H' => $H,
				'I' => $I,
				'L' => $L,
				'M' => $M,
				'N' => $N,
				'O' => $O,
				'Q1' => $Q1,	
				'Q2' => $Q2,
				'Q3' => $Q3,
				'Q4' => $Q4,
				'PMB_JENIS_PENDAFTAR' => $tompo['JALUR'],
				'PMB_GELOMBANG_PENDAFTAR' => $tompo['GELOMBANG'],
				'PMB_TAHUN_DAFTAR' => $tompo['TAHUN']
			); 
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 10, 'api_subkode' => 53, 'api_search' => $data_kp);
			$aksi = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			if($aksi){
				echo "<div class='bs-callout bs-callout-success'>Berhasil</div>";
			}else{
				echo "<div class='bs-callout bs-callout-error'>".$jawaban['NO_PMB']." Gagal</div>";
			}
			
			// echo '<pre>'; PRINT_R($data_kp); echo '</pre>'; #die();
		}
		// echo '<pre>'; PRINT_R($data_kp); echo '</pre>'; #die();
		#$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		#$parameter  = array('api_kode' => 10, 'api_subkode' => 53, 'api_search' => $data_kp);
		#$data['kepribadian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter); 
		
			
	}	
	
	function cek_soal($tompo){
		#$kunci_jawaban = 'CBBABDADBDABCADCCCCBBBCDDBCCABADCADBCAABCACBBBDACDCBCABDCADCABABDDABAADABCC'; #BAR
		#$kunci_jawaban = 'BDACDADDCADBBADDCBDBCDBACBACCDCBCACBBDDADCBCCDBBCBBADCBBABAD'; #BIR
		#$kunci_jawaban = 'CCCACBABCEDDBDACEDCCAECBDCEBCBDBECACABDBECDBDADECDBCEDABCABCDBCCDDEBABCDEBBDACACEACADCDDDACCDBACDCED'; #TPA
		#$key = str_split($kunci_jawaban);
		#print_r($tompo); die();
		$datapost=array(
			'GELOMBANG' => $tompo['GELOMBANG'],
			'TAHUN' => $tompo['TAHUN'],
			'KODE_SOAL' => ''.$tompo['KODE_SOAL'].''
		);
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 68, 'api_search' => $datapost);
		$kunci_s1d3 = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($kunci_s1d3); die();
		$arr_kunci = array();
		
		foreach($kunci_s1d3 as $id=>$value){
			$kunci=$value->PMB_KUNCI_JAWABAN;
			$kcb=str_split($kunci);
			$arr_kunci[$value->PMB_KODE_SUB_SOAL]=$kcb;
		}
		
		#print_r($kunci_s1d3); die();
		foreach($tompo['JAWABAN'] as $id=>$val){
				#echo count(str_split($val['jawaban'])).' '.$val['jawaban'].'<br />';
			#	echo ($id+1).'. ';
				if(!isset($arr_kunci[$val['KODE_SUB_SOAL']])){ echo "<div class='bs-callout bs-callout-error'>Lewat</div>"; continue; }
				$key=$arr_kunci[$val['KODE_SUB_SOAL']];
				$tgl_lahir = substr($val['TGL_LAHIR'],0,2).'-'.substr($val['TGL_LAHIR'],2,2).'-'.substr($val['TGL_LAHIR'],4,4);
				$jwb = str_split($val['JAWABAN']);
				$jawaban='';
				$status_jawaban='';
				foreach($key as $idx=>$kunci){
					$no_soal = $idx+1;
					#if($jwb[$idx]!=' '){
					if(preg_match('/^[a-zA-Z\.]+$/',$jwb[$idx])){
						if($kunci == $jwb[$idx]){
							$status_jawaban.="1";
						}else{
							$status_jawaban.="2";
						}
					$jawaban.=$jwb[$idx];
					}else{ if($jwb[$idx]=='*'){ $jawaban.='*'; }else{ $jawaban.='#'; } $status_jawaban.="3"; }
					
					if($no_soal==count($key)){ break; }
				}
				//INSERT
					$api_datapost= array(
							'PMB_KODE_JALUR_MASUK' => $tompo['GELOMBANG'],
							'PMB_KODE_JENIS_PENERIMAAN' => $tompo['JALUR'],
							'PMB_NO_PMB' => $val['NO_PMB'],
							'PMB_NAMA_PESERTA' => $val['NAMA'],
							'PMB_TANGGAL_LAHIR' => $tgl_lahir,
							'PMB_KODE_SOAL' => $tompo['KODE_SOAL'],
							'PMB_NO_SOAL' => '',
							'PMB_JAWABAN' => $jawaban,
							'PMB_STATUS_JAWABAN' => $status_jawaban
					);
					#print_r($api_datapost); 
					$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 59, 'api_search' => $api_datapost));
					#if($id%100==0) $aksi=false; else $aksi=true;
					#print_r($aksi);
					if($api_datapost){
						echo "<div class='bs-callout bs-callout-success'>Berhasil</div>";
					}else{
						echo "<div class='bs-callout bs-callout-error'>".$val['NO_PMB']." Gagal</div>";
					} 
		}
	}
	
	function moco_dat(){
		$kondisi = explode("/",$this->security->xss_clean($this->uri->segment(3)));
		
		if($kondisi[0]=='upload'){
			if(isset($_FILES['userfile'])){
				#print_r($_POST); die();
				#print_r($_FILES); die();
				$post_1=explode('|',$_POST['jalur']);
				$gelombang=$post_1[0];
				$jalur=$post_1[1];
				#echo $jalur; die();
				$soal=$_POST['soal'];
				$tahun=date("Y");
				#echo $jalur."/".$gelombang; die();
				$path="dat_files/".$jalur."/".$tahun."/".$gelombang."/";
				#$path="dat_files/1/2014/10/";
				#echo  $path; die();
				$config['upload_path'] 		= 'dat_files/'.$jalur.'/'.$tahun.'/'.$gelombang.'/';
				$config['allowed_types'] 	= 'dat';
				$config['overwrite']     	= FALSE;
				$config['file_name']     	= ''.$soal.'-'.$tahun.'-'.$gelombang.'-'.$_FILES['userfile']['name'];
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload()){
					$file=$this->upload->file_name;
						$jawaban_peserta = array();
						$filek = fopen($path.$file, "r") or exit("Unable to open file $file !");
						if($jalur==90){
								while (!feof($filek)){
									$readk = fgets($filek);
									#$jawaban_peserta[] = explode("\t",$readk);
										$jawaban_peserta[] = array(	'NO_PMB' => substr($readk,40,8),
																	'KODE_SUB_SOAL' => substr($readk,48,3),
																	'TGL_LAHIR' => substr($readk,50,8),
																	'NAMA' => substr($readk,60,20),
																	'JAWABAN' => substr($readk,81,120)
															);
									
								}
								
							
						
						}else{
								while (!feof($filek)){
									$readk = fgets($filek);
									#$jawaban_peserta[] = explode("\t",$readk);
									
										$jawaban_peserta[] = array(	'NO_PMB' => substr($readk,40,10),
																'KODE_SUB_SOAL' => substr($readk,50,3),
																'TGL_LAHIR' => substr($readk,53,8),
																'NAMA' => substr($readk,61,20),
																'JAWABAN' => substr($readk,81,120)
															);
									
									
									
								}
						}
						#echo '<pre>'; print_r($jawaban_peserta); echo '</pre>'; die();
						$kirim = array(
							'GELOMBANG' => $gelombang,
							'TAHUN' => $tahun,
							'JALUR' => $jalur,
							'KODE_SOAL' => $soal,
							'JAWABAN' => $jawaban_peserta
						);
						
						if($jalur==1 || $jalur==14 || $jalur==90 || $jalur==100){
							if($soal=='004'){
								 // echo "<pre>"; print_r($kirim); echo "</pre>";
								$this->kepribadian($kirim);
							}elseif($soal=='001'||$soal=='002'||$soal=='003'){
								$this->cek_soal($kirim);
								#echo "runf rampung bos";
							} 
						}elseif($jalur==2){
							#echo "Pasca";
							#print_r($kirim); die();
							 if($soal=='001'||$soal=='002'||$soal=='003'){
								$this->cek_soal($kirim);
								#echo "runf rampung bos";
							}  
						}
						
				}else{
					echo $this->upload->display_errors();
				}
			}
		}else{
			//MASTER SOAL
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 63, 'api_search' => array());
			$data['master_soal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			
			//JALUR MASUK
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 55, 'api_search' => array());
			$data['jalur_masuk'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
			$this->output99->output_display('05_adminpmb/s05_vw_form_kepribadian', $data);
		}
		
	}
	
	function nilai_akhir(){
		
		$datapost=array(
			'GELOMBANG' => 10,
			'TAHUN' => 2014
		);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 67, 'api_search' => $datapost);
		$kategori_kepribadian = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 66, 'api_search' => $datapost);
		$bobot_kepribadian = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		
		$arr_kunci = array();
		foreach($kategori_kepribadian as $id=>$kat){
			foreach($bobot_kepribadian as $idx=>$bobot){
				if($bobot->PMB_KODE_SUB_SOAL == $kat->PMB_KODE_SUB_SOAL){
					$arr_kunci[$bobot->PMB_KODE_SUB_SOAL][$idx] = $bobot;
				}
			}
		}
		print_r($arr_kunci);
	}	
	
	function testing(){
		$api_datapost=array(
					#'KODE_SOAL' =>'001',
					'GELOMBANG' =>10,
					'TAHUN' =>2014
				);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 57, 'api_search' => $api_datapost);
		$data['tools_soal'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		print_r($data['tools_soal']);
		/* die();
		
		$datapost=array(
			'GELOMBANG' => 10,
			'TAHUN' => 2014,
			'KODE_SOAL' => '001'
		);
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 68, 'api_search' => $datapost);
		$kunci_s1d3 = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($kunci_s1d3);
		$arr_kunci = array();
		
		foreach($kunci_s1d3 as $id=>$value){
			$kunci=$value->PMB_KUNCI_JAWABAN;
			$kcb=str_split($kunci);
			$arr_kunci[$value->PMB_KODE_SUB_SOAL]=$kcb;
		}
		print_r($arr_kunci); */
	}
	
}