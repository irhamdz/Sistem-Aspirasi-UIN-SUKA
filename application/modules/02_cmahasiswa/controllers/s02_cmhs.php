<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class S02_cmhs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("lib_wilayah_fungsi", '', 'wilayah');
		$this->load->library("lib_reg_fungsi", '', 'lib_reg_fungsi');
		if($this->session->userdata('status')!==$this->security->xss_clean($this->uri->segment(1))){
			redirect(''.base_url().'');
		}
	}
			
	function index(){ 
					$jenis=$this->session->userdata('jenis_penerimaan');
				#	$gel=$this->session->userdata('jenis_penerimaan');
					$gel=$this->cek_gelombang();
					$id_user=$this->session->userdata('id_user');
					$time_now='SYSDATE'; //
					$api_datapost=array(
						'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
						'PMB_JENIS_PENDAFTAR' => $jenis,
						'PMB_GELOMBANG_PENDAFTAR' => $gel,
						'PMB_LOGIN_PERTAMA_PENDAFTARX0XTGL' => $time_now
					); 
					#print_r($api_datapost);die();
					$aksi	= $this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>168, 'api_subkode' => 3, 'api_search' => $api_datapost));
					
					if($aksi==TRUE){
						#$data['status']=$this->status_kelengkapan();
						#$this->output99->output_display('02_cmahasiswa/s02_vw_awal', $data);
						//DATA LIPUTAN
						$api_url 	= URL_API_ADMISI.'admisi_pengumuman/data_view';
						$parameter  = array('api_kode' => 88001, 'api_subkode' => 4, 'api_search' => array());
						$data['liputan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
						#print_r($data);
						$data['pendaftar'] = $id_user;
						$this->output99->output_display('02_cmahasiswa/s02_vw_beranda', $data);
					}else{
						
						//PMB_DARA_DIRI_PESERTA
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array($id_user));
						$data['pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
						#print_r($data['pendaftar']);
						if($data['pendaftar']==TRUE){
							if($data['pendaftar'][0]->PMB_JENIS_KELAMIN_PENDAFTAR==0){
								$sdr='Sdr. ';
							}else{
								$sdr='Sdri. ';
							}
							$data['pendaftar'] = $sdr.$data['pendaftar'][0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						}else{
							$data['pendaftar'] = $id_user;
						}
						#$data['status']=$this->status_kelengkapan();
						#$this->output99->output_display('02_cmahasiswa/s02_vw_awal', $data);
						//DATA LIPUTAN
						$api_url 	= URL_API_ADMISI.'admisi_pengumuman/data_view';
						$parameter  = array('api_kode' => 88001, 'api_subkode' => 4, 'api_search' => array());
						$data['liputan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
						 // print_r($data);
						
						if(empty($this->session->userdata('nama_pendaftar'))){
							$nama=$this->session->userdata('id_user');
						}else{
							$nama=$this->session->userdata('nama_pendaftar');
						}
						// $this->output99->output_display('02_cmahasiswa/s02_vw_beranda', $data);
						$this->breadcrumb->append_crumb('Beranda', base_url());
						$salam="Assalamu'alikum!, Selamat ".ucwords(sia_msg_salam()).", ".$nama."</strong>";
						$this->breadcrumb->append_crumb($salam, '/');
						$data['content']='02_cmahasiswa/s02_vw_beranda';
						$data['jenis_kolom']="3";
						$this->load->view('s00_vw_all', $data);
					}
			
				
			
		#$data['pendaftar']=$this->pendaftar();
		#$data['status']=$this->status_kelengkapan();
		#$this->output99->output_display('02_cmahasiswa/s02_vw_awal', $data);
		
		
	}
	
	function status_kelengkapan(){
		$jenis=$this->session->userdata('jenis_penerimaan');
		$url_base=base_url().$this->session->userdata('status');
		$id_user=$this->session->userdata('id_user');
			switch($jenis){
				case 1 : {
					 $api_url 					= URL_API_ADMISI.'admisi_pmb/data_search';
					 $parameter  				= array('api_kode' => 168, 'api_subkode' => 1, 'api_search' => array($id_user));
					 $data['status_simpan'] 	= $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					 $status_simpan_pendaftar 			= $data['status_simpan'][0];
					 $status_simpan_ortu	  			= $data['status_simpan'][1];
					 $status_simpan_piljur	  			= $data['status_simpan'][2];
					 $status_prestasi_ektra_kulikuler	= $data['status_simpan'][3];
					 $status_cetak_kartu_ujian			= $data['status_simpan'][4];
					 switch($status_simpan_pendaftar){
						case 0 : $status_simpan_pendaftar="default' title='Silahkan Inputkan Biodata Anda'"; break;
						case 1 : $status_simpan_pendaftar="warning' title='Anda bisa Ubah Biodata'"; break;
						case 2 : $status_simpan_pendaftar="success' title='Lihat Biodata'"; break;
					 }
					 switch($status_simpan_ortu){
						case 0 : $status_simpan_ortu="default"; break;
						case 1 : $status_simpan_ortu="warning"; break;
						case 2 : $status_simpan_ortu="success"; break;
					 }
					 switch($status_simpan_piljur){
						case 0 : $status_simpan_piljur="default"; break;
						case 1 : $status_simpan_piljur="warning"; break;
						case 2 : $status_simpan_piljur="success"; break;
					 }
					 switch($status_prestasi_ektra_kulikuler){
						case 0 : $status_prestasi_ektra_kulikuler="default"; break;
						case 1 : $status_prestasi_ektra_kulikuler="warning"; break;
						case 2 : $status_prestasi_ektra_kulikuler="success"; break;
					 }
					 switch($status_cetak_kartu_ujian){
						case 0 : $status_cetak_kartu_ujian="default' title='Silahkan Lengkapi Semua Data Terlebih Dahulu'"; break;
						case 1 : $status_cetak_kartu_ujian="success' title='Silahkan Cetak Kartu Ujian Anda'"; break;
						
					 }
					 $menu1="<a href='$url_base/data-pendaftar'><span class='label label-$status_simpan_pendaftar'>Biodata Pribadi</span></a>&nbsp";
					 $menu2="<a href='$url_base/data-orang_tua'><span class='label label-$status_simpan_ortu'>Data Orang Tua</span></a>&nbsp";
					 $menu3="<a href='$url_base/data-pilihan_jurusan'><span class='label label-$status_simpan_piljur'>Pilih Jalur & Jurusan</span></a>&nbsp";
			         $menu4="<a href='$url_base/data-prestasi_ektra_kulikuler'><span class='label label-$status_prestasi_ektra_kulikuler'>Data Prestasi Ekstra Kulikuler</span></a>&nbsp";
					 $menu5="<a href='$url_base/data-cetak_kartu_ujian'><span class='label label-$status_cetak_kartu_ujian'>Cetak Kartu Ujian</span></a>&nbsp";
					 #print_r($data['status_simpan']); die();
				}	 
				break;
				case 2 : 
					 $api_url 					= URL_API_ADMISI.'admisi_pmb/data_search';
					 $parameter  				= array('api_kode' => 168, 'api_subkode' => 2, 'api_search' => array($id_user));
					 $data['status_simpan'] 	= $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					 $status_simpan_pendaftar 			= $data['status_simpan'][0];
					 $status_simpan_piljur	  			= $data['status_simpan'][1];
					 #$status_cetak_kartu_ujian			= $data['status_simpan'][2];
					
					 switch($status_simpan_pendaftar){
						case 0 : $status_simpan_pendaftar="default' title='Silahkan Inputkan Biodata Anda'"; break;
						case 1 : $status_simpan_pendaftar="warning' title='Anda bisa Ubah Biodata'"; break;
						case 2 : $status_simpan_pendaftar="success' title='Sudah Terverifikasi'"; break;
						#case 3 : $status_simpan_pendaftar="success' title='Sudah Terverifikasi'"; break;
					 }
					 switch($status_simpan_piljur){
						case 0 : $status_simpan_piljur="default' title='Silahkan Pilih Jalur dan Jurusan yang Anda inginkan'"; break;
						case 1 : $status_simpan_piljur="warning' title='Anda bisa ubah Jalur dan jurusan yang dipilih'"; break;
						case 2 : $status_simpan_piljur="success' title='Sudah Terverifikasi'"; break;
						#case 3 : $status_simpan_piljur="success' title='Sudah Terverifikasi'"; break;
					 } 
					
					 #$menu1="<a href='$url_base/data-pendaftar'><span class='label label-$status_simpan_pendaftar'>STEP 1 -> Biodata Pribadi</span></a>&nbsp";
					 $menu1="<a href='#'><span class='label label-$status_simpan_pendaftar'>STEP 1 -> Biodata Pribadi</span></a>&nbsp";
					 #$menu2="<a href='$url_base/data-pilihan_jurusan'><span class='label label-$status_simpan_piljur'>STEP 2 -> Pilih Jalur & Jurusan</span></a>&nbsp";
					 $menu2="<a href='#'><span class='label label-$status_simpan_piljur'>STEP 2 -> Pilih Jalur & Jurusan</span></a>&nbsp";
					 $kalau_maucetak="";
					 $kalau_maucetak=$data['status_simpan'][0] + $data['status_simpan'][1];
					 #echo $kalau_maucetak;
					 if($kalau_maucetak==4){
						$status_cetak_kartu_ujian="success' title='Sudah Terverifikasi'";
						$menu3="<a href='#'><span class='label label-$status_cetak_kartu_ujian'>STEP 3 -> Data Sudah Terverifikasi</a></span>&nbsp";
					 }elseif($kalau_maucetak==2){
						$status_cetak_kartu_ujian="warning' title='Jika sudah Yakin, silahkan Verifikasi Data Anda'";
						$menu3="<a href='$url_base/data-verifikasi_data'><span class='label label-$status_cetak_kartu_ujian'>STEP 3 -> Verifikasi Data</a></span>&nbsp";
					 }else{
						$status_cetak_kartu_ujian="warning' title='Silahkan Lengkapi Semua Data Terlebih Dahulu'";
						$menu3="<a href='#'><span class='label label-$status_cetak_kartu_ujian'>STEP 3 -> Verifikasi Data</a></span>&nbsp";
					 }
					 #print_r($data['status_simpan']); die();
				break;
				case 5 : case 7 : case 8 : 
					$api_url= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 1, 'api_search' => array());
					$data['pmb'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	  
				break;
			}
			switch($jenis){
				case 1 : $navigasi = $menu1.$menu2.$menu3.$menu4.$menu5; break;
				case 2 : $navigasi =  "<br />".$menu1.'<br />'.$menu2.'<br />'.$menu3; break;
				#case 5 : case 7 : case 8 : $navigasi =$menu1.$menu6.$menu7.$menu8.$menu3.$menu5;  break;
				default : $navigasi = ''; break; 
			}
			return $navigasi;
			#echo $navigasi;
			#$menu1="<a href='$url_base/data-pendaftar'><span class='label label-$status_simpan_pendaftar'>Biodata Pribadi</span></a>&nbsp";
			#$menu2="<a href='$url_base/data-orang_tua'><span class='label label-$status_simpan_ortu'>Data Orang Tua</span></a>&nbsp";
			#$menu3="<a href='$url_base/data-pilihan_jurusan'><span class='label label-$status_simpan_piljur'>Pilih Jalur & Jurusan</span></a>&nbsp";
			#$menu4="<a href='$url_base/data-prestasi_ektra_kulikuler'><span class='label label-$status_prestasi_ektra_kulikuler'>Data Prestasi Ekstra Kulikuler</span></a>&nbsp";
			#$menu5="<a href='$url_base/data-cetak_kartu_ujian'><span class='label label-$status_cetak_kartu_ujian'>Cetak Kartu Ujian</span></a>&nbsp";
			#$menu6="<a href='$url_base/data-penelitian'><span class='label label-$status_penelitian'>Penelitian</a></span>&nbsp";
			#$menu7="<a href='$url_base/data-karya_tulis'><span class='label label-$status_karya_tulis'>Karya Tulis</span></a>&nbsp";
			#$menu8="<a href='$url_base/data-proposal_disertasi'><span class='label label-$status_proposal_disertasi'>Proposal Disertasi</span></a>&nbsp";	
			
			
				
	}
	
	private function _0422_error_msg($arr){
		#$arrh = array();
		switch($arr['kode']){
			case 1: $arrh = array(1, 'MAAF, BERI TANDA CENTANG TERLEBIH DAHULU PADA PILIHAN DATA SAYA SUDAH SESUAI, SAYA YAKIN UNTUK MENYIMPAN'); break;
			case 2: $arrh = array(2, 'MAAF, PASTIKAN ANDA MENYETUJUI VERIFIKASI DATA PRIBADI DENGAN MEMBERI TANDA CENTANG '); break;
			case 3: $arrh = array(3, 'MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA  '); break;
			default: $arrh = array(100, 'MAAF, TERJADI KESALAHAN. HARAP LOGOUT KEMUDIAN LOGIN KEMBALI'); break;
		} 
		return array('code' => $arrh[0], 'message' => 'ORA-00'.$arrh[0].': '.$arrh[1].' ORA-00'.$arrh[0],'offset' => 0, 'current_page' => $arr['current_page']); 
	}
	
	private function _0400_error($error){
		$data['error'] = $error;
		$this->output99->output_display('02_cmahasiswa/s02_vw_error', $data); 
	}
	
	function getAllpmb(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 1, 'api_search' => array());
		$data['pmb'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		print_r($data['pmb']);
	}
	
	function jenis_kesehatan(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 3, 'api_search' => array());
		$data['jenis_kesehatan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['jenis_kesehatan']);
	}
	
	function ajax_wilayah(){
		if($this->input->post('aksi') == 'prop'){
			$kd_prop = $this->input->post('kd_prop');
			
			$arrkab = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
			array('api_kode'=>12000, 'api_subkode' => 4 ,'api_search' => array($kd_prop)));
			
			if(!empty($arrkab)){
				$select_kab = '';
				foreach($arrkab as $idx => $ab){
					if(substr($ab['NM_KAB'],0,12) == 'KAB. LAINNYA'){
						$KD_KAB_LAIN=$ab['KD_KAB'];
						continue;
					}
					$select_kab	.= '<option value="'.$ab['KD_KAB'].'">'.$ab['NM_KAB'].'</option>';
				}
				$select_kab=$select_kab.'<option value="'.$KD_KAB_LAIN.'">KABUPATEN LAINNYA</option>';
			}else{ $select_kab	= '<option value="">-</option>'; }
			
			echo json_encode(array('kab' => $select_kab));
		}elseif($this->input->post('aksi') == 'kab'){
			$kd_kab = $this->input->post('kd_kab');
			
			$arrkec = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
			array('api_kode'=>13000, 'api_subkode' => 4 ,'api_search' => array($kd_kab)));
			
			$select_kec = '';
			foreach($arrkec as $idx => $ab){
				$select_kec	.= '<option value="'.$ab['KD_KEC'].'">'.strtoupper($ab['NM_KEC']).'</option>';
			}
			$select_kec.='<option value="999999">KEC. LAINNYA</option>';
			echo json_encode(array('kec' => $select_kec));
		}else{
			redirect('data-pendaftar');
		}
	}
	
	function pendaftar(){
		$url_base=base_url().$this->session->userdata('status');
		$data['status']=$this->status_kelengkapan();
		$id_user=$this->session->userdata('id_user');
		// echo $id_user;
		//PMB_DARA_DIRI_PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array($id_user));
		$data['pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		// echo "ok";
		// print_r($data['pendaftar']); die();
		//JENIS_KESEHATAN
		$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_  = array('api_kode' => 192, 'api_subkode' => 3, 'api_search' => array());
		$data['jenis_kesehatan'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);	
		//PENYAKIT PESERTA
		$api_url__ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter__  = array('api_kode' => 192, 'api_subkode' => 6, 'api_search' => array($id_user));
		$data['penyakit'] = $this->s00_lib_api->get_api_jsob($api_url__,'POST',$parameter__);
		//MASTER AGAMA 
		$api_url___ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter___  = array('api_kode' => 192, 'api_subkode' => 14, 'api_search' => array());
		$data['master_agama'] = $this->s00_lib_api->get_api_jsob($api_url___,'POST',$parameter___);	
		
		
		$data['negara'] = $this->wilayah->data_negara();	
		// print_r($data['negara']); die();
		
		$KD_PROP='';
		$data['KD_PROP']=$KD_PROP;
		$data_propinsi_list=$this->wilayah->data_propinsi_list();
		$data['PROP_LIST']=$data_propinsi_list;
		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Pendaftar', '/');
		
		// print_r($data['propinsi']); die();
		// print_r($data['pendaftar']); die();
		if($data['pendaftar']==TRUE){
		
				$cek_redirect=$data['pendaftar'][0]->PMB_STATUS_SIMPAN_PENDAFTAR;
				// echo $cek_redirect; die();
					// if($id_user=='ABCABC123123'){
						// $jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
										// $KD_PROP=$data['pendaftar'][0]->KD_PROP;
										// $KD_KAB=$data['pendaftar'][0]->KD_KAB;
										// $KD_KEC=$data['pendaftar'][0]->KD_KEC;
										// $data['NEGARA_ASAL']=$data['pendaftar'][0]->NEGARA_ASAL;
										// $data['KODE_POS']=$data['pendaftar'][0]->KODE_POS;
										// $data_kabupaten_list=$this->wilayah->data_kabupaten_list($KD_PROP);
										// $data['KAB_LIST']=$data_kabupaten_list;
										
										// $data_kecamatan_list=$this->wilayah->data_kecamatan_list($KD_KAB);
										// $data['KEC_LIST']=$data_kecamatan_list;
										
										// $KAB_LAHIR=$data['pendaftar'][0]->KD_KAB_LAHIR;
										// $kab	= $this->data_kabupaten($KAB_LAHIR);
										// foreach($kab as $value){
											// if($KAB_LAHIR==$value['KD_KAB']){
												// $data['NAMA_KAB_LAHIR']=$value['NM_KAB'];
											// }
										// }
										// $data['jenis']=$jenis_pendaftar;
										// $data['content']='02_cmahasiswa/s02_vw_data_pendaftar';
										// $this->load->view('s00_vw_all', $data);
									// }else{
				
				
				
				
				switch($cek_redirect){
					case 1: 
							$jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
							// echo $jenis_pendaftar; die();
							switch($jenis_pendaftar){
								case 1: case 2: case 4: case 5: case 8: case 9:
								
								
										$masih_belum=$this->cek_tutup();
										switch($masih_belum){
											case 1 :
												$KD_PROP=$data['pendaftar'][0]->KD_PROP;
												$KD_KAB=$data['pendaftar'][0]->KD_KAB;
												$KD_KEC=$data['pendaftar'][0]->KD_KEC;
												$data['NEGARA_ASAL']=$data['pendaftar'][0]->NEGARA_ASAL;
												$data['KODE_POS']=$data['pendaftar'][0]->KODE_POS;
												$data_kabupaten_list=$this->wilayah->data_kabupaten_list($KD_PROP);
												$data['KAB_LIST']=$data_kabupaten_list;
												
												$data_kecamatan_list=$this->wilayah->data_kecamatan_list($KD_KAB);
												$data['KEC_LIST']=$data_kecamatan_list;
												
												$KAB_LAHIR=$data['pendaftar'][0]->KD_KAB_LAHIR;
												$kab	= $this->data_kabupaten($KAB_LAHIR);
												foreach($kab as $value){
													if($KAB_LAHIR==$value['KD_KAB']){
														$data['NAMA_KAB_LAHIR']=$value['NM_KAB'];
													}
												}
												$data['jenis']=$jenis_pendaftar;
												$data['content']='02_cmahasiswa/s02_vw_data_pendaftar_s1d3';
												$this->load->view('s00_vw_all', $data);
												// $this->output99->output_display('02_cmahasiswa/s02_vw_data_pendaftar_s1d3', $data); 
											break;
											case 2 :
												#echo 'Pendaftaran Ditutup';
												$data['content']='02_cmahasiswa/s02_vw_tutup';
												$this->load->view('s00_vw_all', $data);
												// $this->output99->output_display('02_cmahasiswa/s02_vw_tutup', $data); 
											break;
										}
								break;
								/*
								case 2: 
									$masih_belum=$this->cek_tutup();
									switch($masih_belum){
										case 1 :
											$data['content']='02_cmahasiswa/s02_vw_data_pendaftar';
											$this->load->view('s00_vw_all', $data);
											// $this->output99->output_display('02_cmahasiswa/s02_vw_data_pendaftar', $data); 
										break;
										case 2 :
											#echo 'Pendaftaran Ditutup';
											$data['content']='02_cmahasiswa/s02_vw_tutup';
											$this->load->view('s00_vw_all', $data);
											// $this->output99->output_display('02_cmahasiswa/s02_vw_tutup', $data); 
										break;
									}
								break;
								case 4: 
								case 5:
								*/
								case 8:
									$data['content']='02_cmahasiswa/s02_vw_data_pendaftar_s3';
									$this->load->view('s00_vw_all', $data);
									// $this->output99->output_display('02_cmahasiswa/s02_vw_data_pendaftar_s3', $data); 
								break;
							}
							
					break;
					case 2: 	
						$masih_belum=$this->cek_tutup();
						switch($masih_belum){
							case 1 :
								redirect(''.$url_base.'/data-verifikasi_data'); 
							break;
							case 2 :
									$jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
									switch($jenis_pendaftar){
									case 1 : case 2 : case 4: case 5: case 8 : case 9:
										if($data['pendaftar'][0]->PMB_NO_UJIAN_PENDAFTAR>0){
											redirect(''.$url_base.'/data-verifikasi_data'); 
										}else{
											$data['content']='02_cmahasiswa/s02_vw_tutup';
											$this->load->view('s00_vw_all', $data);
										}
									break;
									}
							break;
						}
					break;
				}
			// }
		}else{
				#$this->formpendaftar($data);
				$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
				case 1 : case 2 : case 4: case 5: case 8 : case 9 :
				#edit baru
					// if($id_user=='ABCABC123123'){
						// $data['jenis']=$jenis;
						// $data['content']='02_cmahasiswa/s02_vw_form_pendaftar';
						// $this->load->view('s00_vw_all', $data);
						// #$this->output99->output_display('02_cmahasiswa/s02_vw_form_pendaftar_s1d3', $data); 				
					// }else{
							$masih_belum=$this->cek_tutup();
							#echo $masih_belum; die();
							switch($masih_belum){
									case 1 :
										$data['jenis']=$jenis;
										$data['content']='02_cmahasiswa/s02_vw_form_pendaftar';
										$this->load->view('s00_vw_all', $data);
										// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendaftar_s1d3', $data); 
									break;
									case 2 :
										#echo 'Pendaftaran Ditutup';
										$data['content']='02_cmahasiswa/s02_vw_tutup';
										$this->load->view('s00_vw_all', $data);
										// $this->output99->output_display('02_cmahasiswa/s02_vw_tutup', $data); 
									break;
							}
						
					// }
				break;
				/*
				case 2 :
						if($id_user=='ABCABC123123'){
							$data['content']='02_cmahasiswa/s02_vw_form_pendaftar';
							$this->load->view('s00_vw_all', $data);
							// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendaftar_s1d3', $data); 				
						}else{
				
							$masih_belum=$this->cek_tutup();
							switch($masih_belum){
								case 1 :
									$data['content']='02_cmahasiswa/s02_vw_form_pendaftar';
									$this->load->view('s00_vw_all', $data);
									// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendaftar', $data); 
								break;
								case 2 :
								#echo 'Pendaftaran Ditutup';
									$data['content']='02_cmahasiswa/s02_vw_tutup';
									$this->load->view('s00_vw_all', $data);
									// $this->output99->output_display('02_cmahasiswa/s02_vw_tutup', $data); 
								break;
							}
						}
							
				break;
				case 4 :
				case 5 :
				*/
				case 8 :
					$masih_belum=$this->cek_tutup();
					// echo $masih_belum; die();
					// echo "ok"; die();
					switch($masih_belum){
						case 1 :
								$data['content']='02_cmahasiswa/s02_vw_form_pendaftar_s3';
								$this->load->view('s00_vw_all', $data);
								// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendaftar_s3', $data); 
						break;
						case 2 :
						#echo 'Pendaftaran Ditutup';
							$data['content']='02_cmahasiswa/s02_vw_tutup';
							$this->load->view('s00_vw_all', $data);
							// $this->output99->output_display('02_cmahasiswa/s02_vw_tutup', $data); 
						break;
					}
				break;
				}
		}
	}
	
	
	function actionform(){
		switch($this->input->post('step')){
		case 1:		
			$jenis=$this->session->userdata('jenis_penerimaan');
			switch($jenis){
			    case 1 : case 2 : case 3 : case 4: case 5: case 8: case 9:
						// echo "kosek meneng o"; DIE();
						if($jenis==1){
							$NISN=preg_replace("/[^0-9]/", "", $this->input->post('pmb1_nisn'));
						}else{
							$NISN="-";
						}
						$GELAR_DEPAN_NA=$this->input->post('GELAR_DEPAN_NA');
						$GELAR_DEPAN=$this->input->post('GELAR_DEPAN');
						$nama=$this->input->post('pmb1_nama_lengkap');
						$nama=preg_replace("/[^A-Za-z',. ]/", "", $nama);
						$NAMA_PESERTA=str_replace("'", "&#39;", $nama);
						$GELAR_BELAKANG_NA=$this->input->post('GELAR_BELAKANG_NA');
						$GELAR_BELAKANG=$this->input->post('GELAR_BELAKANG');
						$TMP_LAHIR=$this->input->post('TMP_LAHIR');
						$KD_KAB_LAHIR=$this->input->post('KD_KAB_LAHIR');
						$TGL_LAHIR=$this->input->post('pmb1_tgl_lahir');
						$JK=$this->input->post('pmb1_jenis_kelamin');
						$GOL_DARAH=$this->input->post('GOL_DARAH');
						$WN=$this->input->post('pmb1_warga_negara');
						$ALAMAT_ASAL=str_replace("'", "&#39;", $this->input->post('pmb1_alamat'));
						$RT_ASAL=preg_replace("/[^0-9]/", "", $this->input->post('RT_ASAL'));
						$RW_ASAL=preg_replace("/[^0-9]/", "", $this->input->post('RW_ASAL'));
						$DESA=str_replace("'", "&#39;", $this->input->post('DESA'));
						$KD_PROP=$this->input->post('KD_PROP');
						$KD_KAB=$this->input->post('KD_KAB');
						$KD_KEC=$this->input->post('KD_KEC');
						$NEGARA_ASAL=$this->input->post('NEGARA_ASAL');
						$KODE_POS=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS'));
						$NOHP=preg_replace("/[^0-9]/", "", $this->input->post('pmb1_nohp'));
						$EMAIL=$this->input->post('pmb1_email');
						$AGAMA=$this->input->post('pmb1_agama');
						$JENIS=$this->session->userdata('jenis_penerimaan');
						$GELOMBANG=$this->cek_gelombang(); 
						$TAHUN_DAFTAR=$this->session->userdata('TAHUN_BAYAR'); 
						$STATUS_LOGIN=$this->session->userdata('status');
						$TELEPON_RUMAH=$this->input->post('TELEPON_RUMAH');
						if($AGAMA=='agama_lain'){
							$AGAMA=$this->input->post('agama_lain');
						}else{
								$AGAMA=$this->input->post('pmb1_agama');
						}
						
						if(empty($NISN)){
							$error="NISN TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($NAMA_PESERTA)){
							$error="NAMA TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($TMP_LAHIR)){
							$error="TEMPAT LAIHR TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($KD_KAB_LAHIR)){
							$error="KABUPATEN LAHIR LAHIR TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						// }elseif(empty($JK)){
							// $error="JENIS KELAMIN TIDAK BOLEH KOSONG";
							// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							// $hasil = "gagal";
							// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						// }elseif(empty($WN)){
							// $error="WARGENEGARA TIDAK BOLEH KOSONG";
							// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							// $hasil = "gagal";
							// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						// }elseif(empty($GOL_DARAH)){
							// $error="GOLONGAN DARAH TIDAK BOLEH KOSONG";
							// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							// $hasil = "gagal";
							// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($ALAMAT_ASAL)){
							$error="ALAMAT ASAL TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($RT_ASAL)){
							$error="RT ASAL ASAL TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($RW_ASAL)){
							$error="RW ASAL TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($DESA)){
							$error="DESA TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($KD_PROP)){
							$error="NAMA PROPINSI TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($KD_KAB)){
							$error="NAMA KABUPATEN TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($KD_KEC)){
							$error="NAMA KECAMATAN TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($NEGARA_ASAL)){
							$error="NAMA NEGARA ASAL TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($KODE_POS)){
							$error="KODE POS TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($NOHP)){
							$error="NOMOR HP TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($EMAIL)){
							$error="EMAIL TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($AGAMA)){
							$error="AGAMA TIDAK BOLEH KOSONG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							#$jenis=$this->session->userdata('jenis_penerimaan');
							#$config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status');
							$config['upload_path']   =   "img_pendaftar/".$STATUS_LOGIN."/".$TAHUN_DAFTAR."/".$GELOMBANG."/";
							$config['allowed_types'] =   "jpg"; 
							$config['max_size']      =   "1024";
							//$config['max_width']     =   "1907";
						//	$config['max_height']    =   "1280";
							$config['overwrite']     =   true;
							$config['file_name']     =   $this->session->userdata('id_user')."-foto-".$JENIS.".jpg";
							#$config['encrypt_name'] =  TRUE;
							#$config['file_name']    =   TRUE;
							$this->load->library('upload',$config);
							if(!$this->upload->do_upload()){
								$error=strtoupper($this->upload->display_errors());
								$pesan = "<div class='bs-callout bs-callout-error'>".$error.$config['upload_path'].$config['file_name']."</div>";
								$hasil = "gagal";
								echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$finfo=$this->upload->data();
								if($finfo==TRUE){ 
									$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'PMB_NISN_PENDAFTAR' => $NISN,
											'GELAR_DEPAN_NA' => $GELAR_DEPAN_NA,
											'GELAR_DEPAN' => $GELAR_DEPAN,
											'PMB_NAMA_LENGKAP_PENDAFTAR' => strtoupper($NAMA_PESERTA),
											'GELAR_BELAKANG_NA' => $GELAR_BELAKANG_NA,
											'GELAR_BELAKANG' => $GELAR_BELAKANG,
											'PMB_TEMPAT_LAHIR_PENDAFTAR' => $TMP_LAHIR,
											'KD_KAB_LAHIR' => $KD_KAB_LAHIR,
											'PMB_TGL_LAHIR_PENDAFTAR' => $TGL_LAHIR,
											'PMB_JENIS_KELAMIN_PENDAFTAR' => $JK,
											'GOL_DARAH' => $GOL_DARAH,
											'PMB_WARGA_NEGARA_PENDAFTAR' => $WN,
											'PMB_ALAMAT_LENGKAP_PENDAFTAR' => $ALAMAT_ASAL,
											'RT' => $RT_ASAL,
											'RW' => $RW_ASAL,
											'DESA' => $DESA,
											'KD_PROP' => $KD_PROP,
											'KD_KAB' => $KD_KAB,
											'KD_KEC' => $KD_KEC,
											'NEGARA_ASAL' => $NEGARA_ASAL,
											'KODE_POS' => $KODE_POS,
											'PMB_TELP_PENDAFTAR' => $NOHP,
											'PMB_EMAIL_PENDAFTAR' => $EMAIL,
											'PMB_AGAMA_PENDAFTAR' => $AGAMA,
											'PMB_FOTO_PENDAFTAR' => $finfo['file_name'],
											// 'PMB_STATUS_SIMPAN_PENDAFTAR' => 1,
											// 'PMB_NO_UJIAN_PENDAFTAR' => 0,
											// 'PMB_ID_RUANG_UJIAN_PENDAFTAR' => 0,
											'PMB_KD_JENIS_PENDAFTAR' => $JENIS,
											'PMB_GELOMBANG_PENDAFTAR' => $GELOMBANG,
											'PMB_TAHUN_PENDAFTARAN' => $TAHUN_DAFTAR,
											'TELEPON_RUMAH' => $TELEPON_RUMAH
										); 
									#echo "<pre>"; print_r($api_datapost); echo "</pre>"; die();
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 13, 'api_search' => $api_datapost));
									// PRINT_R($aksi); die();
									if($aksi==TRUE){
												$url_ridirek=base_url().$this->session->userdata('status').'/data-kesehatan';
												$error="DATA DIRI BERHASIL DI INPUT...";
												$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA RIWAYAT KESEHATAN</u></a></div>";
												$hasil = "sukses";
												echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}else{
												$error="GAGAL INPUT DATA DIRI";
												$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
												$hasil = "gagal";
												echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}
									
								}else{
									$error="FOTO GAGAL DIUPLOAD";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}
							
								
											// $api_datapost = array(
												// 'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
												// 'KESEHATAN' => $kesehatan
							}
						}			
				break;
				/* 
				case 2 : 
						// aksi step 1 - pasca
					if(empty($this->input->post('lisensi'))){
						
							$this->_0400_error($this->_0422_error_msg(array('kode'=>'2','current_page'=>$this->input->post('current_page'))));
					}else{
							
							$jenis=$this->session->userdata('jenis_penerimaan');
							$config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status');
							$config['allowed_types'] =   "jpg"; 
							$config['max_size']      =   "1024";
							$config['max_width']     =   "1907";
							$config['max_height']    =   "1280";
							$config['overwrite']    =   true;
							$config['file_name']     =   $this->session->userdata('id_user')."-foto-".$jenis.".jpg";
							#$config['encrypt_name']  =  TRUE;
							#$config['file_name']    =   TRUE;
							$this->load->library('upload',$config);
							if(!$this->upload->do_upload()){
								$error=$this->upload->display_errors();
								$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
								$hasil = "gagal";
								echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$finfo=$this->upload->data();
								if($finfo==TRUE){ 
									if($this->input->post('pmb1_agama')=='agama_lain'){
										$agama=$this->input->post('agama_lain');
									}else{
										$agama=$this->input->post('pmb1_agama');
									}
									
									$nama=$this->input->post('pmb1_nama_lengkap');
									$nama=preg_replace("/[^A-Za-z',. ]/", "", $nama);
									$nama_peserta=str_replace("'", "#39;", $nama);
									$nama_peserta=strtoupper($nama_peserta);
									$alamat=$this->input->post('pmb1_alamat');
									$alamat=str_replace("'", "&#39;", $alamat);
									$jenis=$this->session->userdata('jenis_penerimaan');
									$gelombang=$this->cek_gelombang(); 
									$api_datapost = array(
										'',
										$this->session->userdata('id_user'),
										$nama_peserta,
										$alamat,
										$this->input->post('pmb1_tempat_lahir'),
										$this->input->post('pmb1_tgl_lahir'),
										$this->input->post('pmb1_nohp'),
										$this->input->post('pmb1_email'),
										$agama,
										$this->input->post('pmb1_jenis_kelamin'),
										$this->input->post('pmb1_warga_negara'),
										$finfo['file_name'],
										1,
										0,
										0,
										$jenis,
										$gelombang
									); 
									#print_r($api_datapost); die();
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 1, 'api_search' => $api_datapost));
								
									#print_r($aksi); die();
									$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan'));
										if($aksi==TRUE){
											$api_datapost=array(
												'',
												$this->session->userdata('id_user'),
												$kesehatan,
												1
											); 
											#print_r($api_datapost);die();
											$aksi	= $this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 4, 'api_search' => $api_datapost));
											#print_r($aksi); die();
												if($aksi==TRUE){
													$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sebelumnya';
													$error="DATA DIRI BERHASIL DI INPUT...";
													$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>Pendidikan Sebelumnya</u></a></div>";
													$hasil = "sukses";
													echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
												}else{
													$error="GAGAL INPUT DATA DIRI";
													$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
													$hasil = "gagal";
													echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
												}
										}
								}else{
									$pesan = "<div class='bs-callout bs-callout-error'>DATA GAGAL DISIMPAN</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}
							}
					}
						
				break; 
				case 4 : 
				case 5 :
				*/
				case 8 : 
					#echo "s3"; die();
					if(empty($this->input->post('lisensi'))){
							$error="MAAF, PASTIKAN ANDA MENYETUJUI VERIFIKASI DATA PRIBADI DENGAN MEMBERI TANDA CENTANG";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}else{
						$pmb1_nama_lengkap=$this->input->post('pmb1_nama_lengkap');
						$pmb1_nama_lengkap=preg_replace("/[^A-Za-z',. ]/", "", $pmb1_nama_lengkap);
						$nama_peserta=str_replace("'", "#39;", $pmb1_nama_lengkap);
						$pmb1_tempat_lahir=$this->input->post('pmb1_tempat_lahir');
						$pmb1_tgl_lahir=$this->input->post('pmb1_tgl_lahir');
						#$pmb1_alamat=$this->input->post('pmb1_alamat');
						$alamat=$this->input->post('pmb1_alamat');
						$alamat=str_replace("'", "&#39;", $alamat);
						$jk=$this->input->post('pmb1_jenis_kelamin');
						$pmb1_nohp=$this->input->post('pmb1_nohp');
						$pmb1_email=$this->input->post('pmb1_email');
						if($this->input->post('pmb1_agama')=='agama_lain'){
							$agama=$this->input->post('agama_lain');
						}else{
							$agama=$this->input->post('pmb1_agama');
						}
						$pmb1_jenis_kelamin=$this->input->post('pmb1_jenis_kelamin');
						$pmb1_kesehatan=$this->input->post('pmb1_kesehatan');
						$pmb1_warga_negara=$this->input->post('pmb1_warga_negara');
						
						$jenis=$this->session->userdata('jenis_penerimaan');
						$config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status');
						$config['allowed_types'] =   "jpg"; 
						$config['max_size']      =   "1024";
						//$config['max_width']     =   "1907";
					//	$config['max_height']    =   "1280";
						$config['overwrite']     =    true;
						$config['file_name']     =   $this->session->userdata('id_user')."-foto-".$jenis.".jpg";
						#$config['encrypt_name']  =  TRUE;
						#$config['file_name']    =   TRUE;
						$this->load->library('upload',$config);
							if(!$this->upload->do_upload()){
								$error=$this->upload->display_errors();
								$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
								$hasil = "gagal";
								echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$finfo=$this->upload->data();
								if($finfo==TRUE){ 
								
									if(empty($nama_peserta)){
										$error="NAMA TIDAK BOLEH KOSONG<br />CONTOH PENGISIAN : SIGIT NUGROHO";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_tempat_lahir)){
										$error="TEMPAT LAHIR TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : YOGYAKARTA";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_tgl_lahir)){
										$error="TANGGAL LAHIR TIDAK BOLEH KOSONG<BR />FORMAT TANGGAL : 06-04-2014 DD-MM-YYYY";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($alamat)){
										$error="ALAMAT TIDAK BOLEH KOSONG";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_nohp)){
										$error="NOMOR TELPON TIDAK BOLEH KOSONG <BR />CONTOH PENGISIAN : 089629008652";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_email)){
										$error="EMAIL TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN ' - '";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($agama)){
										$error="AGAMA TIDAK BOLEH KOSONG";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif($pmb1_kesehatan==''){
										$error="KESEHATAN TIDAK BOLEH KOSONG";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}else{
										$nama=strtoupper($nama_peserta);
										$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan'));
										$jenis=$this->session->userdata('jenis_penerimaan');
										$TAHUN_BAYAR=$this->session->userdata('TAHUN_BAYAR');
										$gelombang=$this->cek_gelombang(); 
										$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'PMB_NAMA_LENGKAP_PENDAFTAR' => $nama_peserta,
											'PMB_ALAMAT_LENGKAP_PENDAFTAR' => $alamat,
											'PMB_TEMPAT_LAHIR_PENDAFTAR' => $pmb1_tempat_lahir,
											'PMB_TGL_LAHIR_PENDAFTAR' => $pmb1_tgl_lahir,
											'PMB_TELP_PENDAFTAR' => $pmb1_nohp,
											'PMB_EMAIL_PENDAFTAR' => $pmb1_email,
											'PMB_AGAMA_PENDAFTAR' => $agama,
											'PMB_JENIS_KELAMIN_PENDAFTAR' => $jk,
											'PMB_WARGA_NEGARA_PENDAFTAR' => $pmb1_warga_negara,
											'PMB_FOTO_PENDAFTAR' => $finfo['file_name'],
											'PMB_STATUS_SIMPAN_PENDAFTAR' => 1,
											'PMB_NO_UJIAN_PENDAFTAR' => 0,
											'PMB_ID_RUANG_UJIAN_PENDAFTAR' => 0,
											'PMB_KD_JENIS_PENDAFTAR' => $jenis,
											'PMB_GELOMBANG_PENDAFTAR' => $gelombang,
											'PMB_TAHUN_PENDAFTARAN' => $TAHUN_BAYAR,
											'KESEHATAN' => $kesehatan
										); 
										// print_r($api_datapost); die();
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 27, 'api_search' => $api_datapost));
										// print_r($aksi); die();
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sebelumnya';
											$error="DATA DIRI BERHASIL DI INPUT...";
											$pesan = "<div class='bs-callout bs-callout-success'>".$error."..Lanjutkan <a href='$url_ridirek'><u>PENDIDIKAN SEBELUMNYA</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}else{
											$error="GAGAL INPUT DATA DIRI";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}
									}
								}
							}
					}
				break;
					
			}
		break;
		case 11: //AKSI EDIT DATA PRIBADI
			$jenis=$this->session->userdata('jenis_penerimaan');
			switch($jenis){
			case 1: case 2: case 3: case 4: case 5: case 8: case 9:  //AKSI EDIT DATA PRIBADI 
					// echo "S1 D3"; die();
					// echo "<pre>"; print_r($_POST); echo "</pre>";
					if($jenis==1){
							$NISN=preg_replace("/[^0-9]/", "", $this->input->post('pmb1_nisn'));
						}else{
							$NISN="-";
						}
					$GELAR_DEPAN_NA=$this->input->post('GELAR_DEPAN_NA');
					$GELAR_DEPAN=$this->input->post('GELAR_DEPAN');
					$nama=$this->input->post('pmb1_nama_lengkap');
					$nama=preg_replace("/[^A-Za-z',. ]/", "", $nama);
					$NAMA_PESERTA=str_replace("'", "&#39;", $nama);
					$GELAR_BELAKANG_NA=$this->input->post('GELAR_BELAKANG_NA');
					$GELAR_BELAKANG=$this->input->post('GELAR_BELAKANG');
					$TMP_LAHIR=$this->input->post('TMP_LAHIR');
					$KD_KAB_LAHIR=$this->input->post('KD_KAB_LAHIR');
					$TGL_LAHIR=$this->input->post('pmb1_tgl_lahir');
					$JK=$this->input->post('pmb1_jenis_kelamin');
					$GOL_DARAH=$this->input->post('GOL_DARAH');
					$WN=$this->input->post('pmb1_warga_negara');
					$ALAMAT_ASAL=str_replace("'", "&#39;", $this->input->post('pmb1_alamat'));
					$RT_ASAL=preg_replace("/[^0-9]/", "", $this->input->post('RT_ASAL'));
					$RW_ASAL=preg_replace("/[^0-9]/", "", $this->input->post('RW_ASAL'));
					$DESA=str_replace("'", "&#39;", $this->input->post('DESA'));
					$KD_PROP=$this->input->post('KD_PROP');
					$KD_KAB=$this->input->post('KD_KAB');
					$KD_KEC=$this->input->post('KD_KEC');
					$NEGARA_ASAL=$this->input->post('NEGARA_ASAL');
					$KODE_POS=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS'));
					$NOHP=preg_replace("/[^0-9]/", "", $this->input->post('pmb1_nohp'));
					$EMAIL=$this->input->post('pmb1_email');
					$AGAMA=$this->input->post('pmb1_agama');
					$JENIS=$this->session->userdata('jenis_penerimaan');
					$GELOMBANG=$this->cek_gelombang(); 
					$TAHUN_DAFTAR=$this->session->userdata('TAHUN_BAYAR'); 
					$STATUS_LOGIN=$this->session->userdata('status');
					$TELEPON_RUMAH=$this->input->post('TELEPON_RUMAH');
					if($AGAMA=='agama_lain'){
						$AGAMA=$this->input->post('agama_lain');
					}else{
							$AGAMA=$this->input->post('pmb1_agama');
					}
					
					if(empty($NISN)){
						$error="NISN TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($NAMA_PESERTA)){
						$error="NAMA TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($TMP_LAHIR)){
						$error="TEMPAT LAIHR TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($KD_KAB_LAHIR)){
						$error="KABUPATEN LAHIR LAHIR TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					// }elseif(empty($JK)){
						// $error="JENIS KELAMIN TIDAK BOLEH KOSONG";
						// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						// $hasil = "gagal";
						// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					// }elseif(empty($WN)){
						// $error="WARGENEGARA TIDAK BOLEH KOSONG";
						// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						// $hasil = "gagal";
						// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					// }elseif(empty($GOL_DARAH)){
						// $error="GOLONGAN DARAH TIDAK BOLEH KOSONG";
						// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						// $hasil = "gagal";
						// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($ALAMAT_ASAL)){
						$error="ALAMAT ASAL TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($RT_ASAL)){
						$error="RT ASAL ASAL TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($RW_ASAL)){
						$error="RW ASAL TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($DESA)){
						$error="DESA TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($KD_PROP)){
						$error="NAMA PROPINSI TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($KD_KAB)){
						$error="NAMA KABUPATEN TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($KD_KEC)){
						$error="NAMA KECAMATAN TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($NEGARA_ASAL)){
						$error="NAMA NEGARA ASAL TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($KODE_POS)){
						$error="KODE POS TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($NOHP)){
						$error="NOMOR HP TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($EMAIL)){
						$error="EMAIL TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($AGAMA)){
						$error="AGAMA TIDAK BOLEH KOSONG";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}else{
						$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'PMB_NISN_PENDAFTAR' => $NISN,
											'GELAR_DEPAN_NA' => $GELAR_DEPAN_NA,
											'GELAR_DEPAN' => $GELAR_DEPAN,
											'PMB_NAMA_LENGKAP_PENDAFTAR' => strtoupper($NAMA_PESERTA),
											'GELAR_BELAKANG_NA' => $GELAR_BELAKANG_NA,
											'GELAR_BELAKANG' => $GELAR_BELAKANG,
											'PMB_TEMPAT_LAHIR_PENDAFTAR' => $TMP_LAHIR,
											'KD_KAB_LAHIR' => $KD_KAB_LAHIR,
											'PMB_TGL_LAHIR_PENDAFTAR' => $TGL_LAHIR,
											'PMB_JENIS_KELAMIN_PENDAFTAR' => $JK,
											'GOL_DARAH' => $GOL_DARAH,
											'PMB_WARGA_NEGARA_PENDAFTAR' => $WN,
											'PMB_ALAMAT_LENGKAP_PENDAFTAR' => $ALAMAT_ASAL,
											'RT' => $RT_ASAL,
											'RW' => $RW_ASAL,
											'DESA' => $DESA,
											'KD_PROP' => $KD_PROP,
											'KD_KAB' => $KD_KAB,
											'KD_KEC' => $KD_KEC,
											'NEGARA_ASAL' => $NEGARA_ASAL,
											'KODE_POS' => $KODE_POS,
											'PMB_TELP_PENDAFTAR' => $NOHP,
											'PMB_EMAIL_PENDAFTAR' => $EMAIL,
											'PMB_AGAMA_PENDAFTAR' => $AGAMA,
											'TELEPON_RUMAH' => $TELEPON_RUMAH
										); 
						// print_r($api_datapost); die();
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 14, 'api_search' => $api_datapost));
						if($aksi==TRUE){
							$url_ridirek=base_url().$this->session->userdata('status').'/data-kesehatan';
							$error="DATA DIRI BERHASIL DIUBAH...";
							$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA RIWAYAT KESEHATAN</u></a></div>";
							$hasil = "sukses";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							$error="GAGAL MEMPERBAHARUI DATA DIRI";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
						// echo "<pre>"; print_r($api_datapost); echo "</pre>"; die();
					
					}
						/*
						$nisn=$this->input->post('pmb1_nisn');
							$nisn=preg_replace("/[^0-9]/", "", $nisn);
							$nama=$this->input->post('pmb1_nama_lengkap');
							$nama=preg_replace("/[^A-Za-z',. ]/", "", $nama);
							$nama_peserta=str_replace("'", "#39;", $nama);
							$tempat_lahir=$this->input->post('pmb1_tempat_lahir');
							$tgl_lahir=$this->input->post('pmb1_tgl_lahir');
							$alamat=$this->input->post('pmb1_alamat');
							$alamat=str_replace("'", "&#39;", $alamat);
							$nohp=$this->input->post('pmb1_nohp');
							$email=$this->input->post('pmb1_email');
							$jk=$this->input->post('pmb1_jenis_kelamin');
							$kesehatan=$this->input->post('pmb1_kesehatan');
							$wn=$this->input->post('pmb1_warga_negara');
							
							if($this->input->post('pmb1_agama')=='agama_lain'){
								$agama=$this->input->post('agama_lain');
							}else{
								$agama=$this->input->post('pmb1_agama');
							}
							
						
							if(empty($nama_peserta)){
									$error="NAMA TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : SIGIT NUGROHO";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($nisn)){
									$error="NISN TIDAK BOLEH KOSONG, JUMLAH DIGIT 10 DAN HANYA BISA DISI DENGAN ANGKA, CONTOH : 1234567890<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($tempat_lahir)){
									$error="TEMPAT LAHIR TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : YOGYAKARTA";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($tgl_lahir)){
									$error="TANGGAL LAHIR TIDAK BOLEH KOSONG<BR />FORMAT TANGGAL : 06-04-2014 DD-MM-YYYY";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($alamat)){
									$error="ALAMAT TIDAK BOLEH KOSONG";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($nohp)){
									$error="NOMOR TELPON TIDAK BOLEH KOSONG <BR />CONTOH PENGISIAN : 089629008652";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($email)){
									$error="EMAIL TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN ' - '";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($agama)){
									$error="AGAMA TIDAK BOLEH KOSONG";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif($kesehatan==''){
									$error="KESEHATAN TIDAK BOLEH KOSONG";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								
									if(empty($this->input->post('pmb1_kesehatan_baru'))){
										$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan'));
									}else{
										$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan_baru'));
									}
									$nama=strtoupper($nama_peserta);
									$jenis=$this->session->userdata('jenis_penerimaan');
									$api_datapost = array(
									'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
									'PMB_NAMA_LENGKAP_PENDAFTAR' => $nama,
									'PMB_ALAMAT_LENGKAP_PENDAFTAR' => $alamat,
									'PMB_TEMPAT_LAHIR_PENDAFTAR' => $tempat_lahir,
									'PMB_TGL_LAHIR_PENDAFTAR' => $tgl_lahir,
									'PMB_TELP_PENDAFTAR' => $nohp,
									'PMB_EMAIL_PENDAFTAR' => $email,
									'PMB_AGAMA_PENDAFTAR' => $agama,
									'PMB_JENIS_KELAMIN_PENDAFTAR' => $jk,
									'PMB_WARGA_NEGARA_PENDAFTAR' => $wn,
									'PMB_FOTO_PENDAFTAR' => $this->input->post('pmb1_foto_lama'),
									'PMB_STATUS_SIMPAN_PENDAFTAR' => 1,
									'PMB_NO_UJIAN_PENDAFTAR' => 0,
									'PMB_ID_RUANG_UJIAN_PENDAFTAR' => 0,
									'PMB_KD_JENIS_PENDAFTAR' => $jenis,
									'PMB_NISN_PENDAFTAR' => $nisn
									); 
									#print_r($api_datapost); die();
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 14, 'api_search' => $api_datapost));
									#print_r($aksi); die();
									if($aksi==TRUE){
										$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'KESEHATAN' => $kesehatan
										); 
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 38, 'api_search' => $api_datapost));
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sebelumnya';
											$error="DATA DIRI BERHASIL DIRUBAH DI INPUT...";
											$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PENDIDIKAN SEBELUMNYA</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}else{
											$error="GAGAL MEMPERBAHARUI DATA KESEHATAN";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}
									}else{
											$error="GAGAL MEMPERBAHARUI DATA DIRI";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}
							}
						*/
			break;
			case 8: //EDIT DATA PRIBADI S2
							/*$foto=$_FILES["userfile"]["name"];
							//
							$jenis=$this->session->userdata('jenis_penerimaan');
							$config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status');
							$config['allowed_types'] =   "jpg"; 
							$config['max_size']      =   "1024";
							$config['max_width']     =   "1907";
							$config['max_height']    =   "1280";
							$config['overwrite']     =   true;
							$config['file_name']     =   $this->session->userdata('id_user')."-foto-".$jenis;
							$config['file_size']  = true;
							$this->load->library('upload',$config);
							if(empty($foto)){ */
							$nama=$this->input->post('pmb1_nama_lengkap');
							$nama=preg_replace("/[^A-Za-z',. ]/", "", $nama);
							$nama_peserta=str_replace("'", "#39;", $nama);
							
							$alamat=$this->input->post('pmb1_alamat');
							$alamat=str_replace("'", "&#39;", $alamat);
							
							
							$api_datapost = array(
									$this->session->userdata('id_user'),
									$nama_peserta,
									$alamat,
									$this->input->post('pmb1_tempat_lahir'),
									$this->input->post('pmb1_tgl_lahir'),
									$this->input->post('pmb1_nohp'),
									$this->input->post('pmb1_email'),
									$this->input->post('pmb1_agama'),
									$this->input->post('pmb1_jenis_kelamin'),
									$this->input->post('pmb1_warga_negara'),
									$this->input->post('pmb1_foto_lama')
							); 
								#print_r($api_datapost);
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 8, 'api_search' => $api_datapost));
								#print_r($aksi);
								if($aksi==TRUE){
									if(empty($this->input->post('pmb1_kesehatan_baru'))){
										$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan'));
									}else{
										$kesehatan=implode(" ", $this->input->post('pmb1_kesehatan_baru'));
									}
										$api_datapost=array(
											$this->session->userdata('id_user'),
											$kesehatan
										); 
										#print_r($api_datapost);
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 9, 'api_search' => $api_datapost));
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sebelumnya';
											$error="DATA DIRI BERHASIL DIRUBAH DI INPUT...";
											$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PENDIDIKAN SEBELUMNYA</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}else{
											$error="GAGAL MEMPERBAHARUI DATA DIRI";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}
									
								}else{
									$pesan = "<div class='bs-callout bs-callout-error'>DATA GAGAL DIRUBAH</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}
					break;
				}
			break;
			case 2:	 // AKSI PILJUR
				$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1: case 9: //AKSI PILJUR S1 D3
						#echo "S1/D3"; 
					if(empty($this->input->post('pmb2_jalur'))){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($this->input->post('pmb2_pilihan_1'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN I HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
					}elseif(empty($this->input->post('pmb2_pilihan_2'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN II HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));		
					}elseif(empty($this->input->post('pmb2_pilihan_3'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN III HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));		
					}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_2')){
						$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
					
					}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_3')){
						$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					
					
					}elseif($this->input->post('pmb2_pilihan_2')==$this->input->post('pmb2_pilihan_3')){
						$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					
					}else{
						$piljur1=$this->input->post('pmb2_pilihan_1');
						$piljur2=$this->input->post('pmb2_pilihan_2');
						$piljur3=$this->input->post('pmb2_pilihan_3');
						$api_datapost = array(
										'PMB_PIN_PENDAFTAR' =>	$this->session->userdata('id_user'),
										'PMB_JALUR_PENDAFTARAN' =>	$this->input->post('pmb2_jalur'),
										'PMB_KELAS_JURUSAN' =>	0,
										'PMB_PILJUR_1' => $this->input->post('pmb2_pilihan_1'),
										'PMB_PILJUR_2' => $this->input->post('pmb2_pilihan_2'),
										'PMB_PILJUR_3' => $this->input->post('pmb2_pilihan_3'),
										'PMB_JENIS_PENDAFTAR' => $this->session->userdata('jenis_penerimaan'),
										'PMB_TAHUN_DAFTAR' => date("Y"),
										'PMB_STATUS_SIMPAN_PILJUR' =>1
										); 
						#print_r($api_datapost);
						 $aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 18,'api_search' => $api_datapost));
						 if($aksi==TRUE){
							$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
							$pesan = "<div class='bs-callout bs-callout-success'>PILIHAN JALUR DAN JURUSAN BERHASIL DISIMPAN..LANJUTKAN <a href='$url_ridirek'><u>VERIFIKASI DATA</u></a></div>";
							$hasil = "sukses";
						    echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						 }
					}
					break;
					case 2: case 3: //AKSI PILJUR S2
								if(empty($this->input->post('pmb2_jalur'))){
									$pesan = "<div class='bs-callout bs-callout-error'>KELAS HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}elseif(empty($this->input->post('pmb2_kelas'))){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
								}elseif(empty($this->input->post('pmb2_pilihan_1'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN I HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
								}elseif(empty($this->input->post('pmb2_pilihan_2'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN II HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
								}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_2')){
									#$this->_0400_error($this->_0422_error_msg(array('kode'=>'3','current_page'=>$this->input->post('current_page'))));
									$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
								}else{
									
										$api_datapost = array(
											'',
											$this->session->userdata('id_user'),
											$this->input->post('pmb2_jalur'),
											$this->input->post('pmb2_kelas'),
											$this->input->post('pmb2_pilihan_1'),
											$this->input->post('pmb2_pilihan_2'),
											0,
											$this->session->userdata('jenis_penerimaan'),
											date("Y"),
											1
										); 
										#print_r($api_datapost);
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
										'POST', array('api_kode'=>10, 'api_subkode' => 5, 'api_search' => $api_datapost));
										#print_r($aksi);
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
											$pesan = "<div class='bs-callout bs-callout-success'>Pilihan Jalur dan Jurusan Berhasil disimpan..Lanjutkan <a href='$url_ridirek'><u>Verifikasi Data</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
											#$url_base=base_url().$this->session->userdata('status');
											#redirect(''.$url_base.'/data-verifikasi_data'); 
										}
								}
					break;
					case 4: 
					case 5: 
					case 8:  //AKSI PILJUR S3
						#echo "S3"; 
						$jalur=$this->input->post('pmb2_jalur');
						$pmb2_pilihan_1=$this->input->post('pmb2_pilihan_1');
						
						if(empty($jalur)){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($pmb2_pilihan_1)){
									$pesan = "<div class='bs-callout bs-callout-error'>JURUSAN HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							$api_datapost = array(
										'PMB_PIN_PENDAFTAR' =>	$this->session->userdata('id_user'),
										'PMB_JALUR_PENDAFTARAN' =>	$jalur,
										'PMB_KELAS_JURUSAN' =>	1,
										'PMB_PILJUR_1' => $pmb2_pilihan_1,
										'PMB_PILJUR_2' => 0,
										'PMB_PILJUR_3' => 0,
										'PMB_JENIS_PENDAFTAR' => $this->session->userdata('jenis_penerimaan'),
										'PMB_TAHUN_DAFTAR' => date("Y"),
										'PMB_STATUS_SIMPAN_PILJUR' =>1
										); 
							#print_r($api_datapost);
							$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
										'POST', array('api_kode'=>10, 'api_subkode' => 34, 'api_search' => $api_datapost));
										#print_r($aksi);
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
											$pesan = "<div class='bs-callout bs-callout-success'>PILIHAN JALUR DAN JURUSAN BERHASIL DISIMPAN..LANJUTKAN <a href='$url_ridirek'><u>VERIFIKASI DATA</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
											#$url_base=base_url().$this->session->userdata('status');
											#redirect(''.$url_base.'/data-verifikasi_data'); 
										}else{
											$error="DATA PILIHAN JURUSAN GAGAL DI INPUT";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}	
						}
					break;
				}
			break;
			case 21: //AKSI EDIT PILJUR
				$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1: case 9 :
						#echo "AKSI EDIT S1 D3"; 
						if(empty($this->input->post('pmb2_jalur'))){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($this->input->post('pmb2_pilihan_1'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN I HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
						}elseif(empty($this->input->post('pmb2_pilihan_2'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN II HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));		
						}elseif(empty($this->input->post('pmb2_pilihan_3'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN III HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));		
						}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_2')){
									$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
					
						}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_3')){
									$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						
					
						}elseif($this->input->post('pmb2_pilihan_2')==$this->input->post('pmb2_pilihan_3')){
									$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							$piljur1=$this->input->post('pmb2_pilihan_1');
							$piljur2=$this->input->post('pmb2_pilihan_2');
							$piljur3=$this->input->post('pmb2_pilihan_3');
							$api_datapost = array(
										'PMB_PIN_PENDAFTAR' =>	$this->session->userdata('id_user'),
										'PMB_JALUR_PENDAFTARAN' =>	$this->input->post('pmb2_jalur'),
										'PMB_PILJUR_1' => $this->input->post('pmb2_pilihan_1'),
										'PMB_PILJUR_2' => $this->input->post('pmb2_pilihan_2'),
										'PMB_PILJUR_3' => $this->input->post('pmb2_pilihan_3')
										); 
							#print_r($api_datapost);
							 $aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 19,'api_search' => $api_datapost));
							if($aksi==TRUE){
								$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
								$pesan = "<div class='bs-callout bs-callout-success'>PILIHAN JALUR DAN JURUSAN BERHASIL DISIMPAN..LANJUTKAN <a href='$url_ridirek'><u>VERIFIKASI DATA</u></a></div>";
								$hasil = "sukses";
								echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$pesan = "<div class='bs-callout bs-callout-error'>GAGAL MEMPERBAHARUI DATA PILIHAN JURUSAN</div>";
								$hasil = "gagal";
								echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}
							
						}
					break;
					case 2: case 3:
							if(empty($this->input->post('pmb2_jalur'))){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($this->input->post('pmb2_kelas'))){
									$pesan = "<div class='bs-callout bs-callout-error'>KELAS HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($this->input->post('pmb2_pilihan_1'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN I HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
							}elseif(empty($this->input->post('pmb2_pilihan_2'))){
									$pesan = "<div class='bs-callout bs-callout-error'>PILIHAN JURUSAN II HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
							}elseif($this->input->post('pmb2_pilihan_1')==$this->input->post('pmb2_pilihan_2')){
									#$this->_0400_error($this->_0422_error_msg(array('kode'=>'3','current_page'=>$this->input->post('current_page'))));
									$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PILIHAN JURUSAN TIDAK BOLEH SAMA!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));	
							}else{
									$api_datapost = array(
										$this->session->userdata('id_user'),
										$this->input->post('pmb2_jalur'),
										$this->input->post('pmb2_kelas'),
										$this->input->post('pmb2_pilihan_1'),
										$this->input->post('pmb2_pilihan_2'),
										0
									); 
									#print_r($api_datapost);
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
									'POST', array('api_kode'=>10, 'api_subkode' => 12, 'api_search' => $api_datapost));
									if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
									$pesan = "<div class='bs-callout bs-callout-success'>PILIHAN JALUR DAN JURUSAN BERHASIL DIRUBAH..LANJUTKAN <a href='$url_ridirek'><u>VERIFIKASI DATA</u></a></div>";
													$hasil = "sukses";
													echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}
							}
							#$url_base=base_url().$this->session->userdata('status');
							#redirect(''.$url_base.'/data-verifikasi_data'); 
					break;
					case 4:
					case 5:
					case 8: 
					#echo "AKSI EDIT S3"; 
					#echo "S3"; 
						$jalur=$this->input->post('pmb2_jalur');
						$pmb2_pilihan_1=$this->input->post('pmb2_pilihan_1');
						if(empty($jalur)){
									$pesan = "<div class='bs-callout bs-callout-error'>JALUR HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}elseif(empty($pmb2_pilihan_1)){
									$pesan = "<div class='bs-callout bs-callout-error'>JURUSAN HARUS DIISI TERLEBIH DAHULU!</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							$api_datapost = array(
										'PMB_PIN_PENDAFTAR' =>	$this->session->userdata('id_user'),
										'PMB_PILJUR_1' => $pmb2_pilihan_1
										); 
							#print_r($api_datapost); die();
							$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
										'POST', array('api_kode'=>10, 'api_subkode' => 35, 'api_search' => $api_datapost));
										#print_r($aksi);
										if($aksi==TRUE){
											$url_ridirek=base_url().$this->session->userdata('status').'/data-verifikasi_data';
											$pesan = "<div class='bs-callout bs-callout-success'>PILIHAN JALUR DAN JURUSAN BERHASIL DISIMPAN..LANJUTKAN <a href='$url_ridirek'><u>VERIFIKASI DATA</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
											#$url_base=base_url().$this->session->userdata('status');
											#redirect(''.$url_base.'/data-verifikasi_data'); 
										}else{
											$error="DATA PILIHAN JURUSAN GAGAL DI INPUT";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}	
						}
					break;
				}
				#echo "aksi edit puljur";
				
			break;
			case 22 : //AKSI DATA ORANG TUA
				$nama_ibu=$this->input->post('pmb2_nm_ibu');
				$nama_ibu=str_replace("'", "''", $nama_ibu);
				$alamat_ibu=$this->input->post('pmb2_alamat_ibu');
				$alamat_ibu=str_replace("'", "&#39;", $alamat_ibu);
				$RT_IBU=preg_replace("/[^0-9]/", "", $this->input->post('RT_IBU'));
				$RW_IBU=preg_replace("/[^0-9]/", "", $this->input->post('RW_IBU'));
				$DESA_IBU=str_replace("'", "&#39;", $this->input->post('DESA_IBU'));
				$KD_PROP_IBU=$this->input->post('KD_PROP_IBU');
				$KD_KAB_IBU=$this->input->post('KD_KAB_IBU');
				$KD_KEC_IBU=$this->input->post('KD_KEC_IBU');
				$KODE_POS_IBU=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS_IBU'));
				$telp1_ibu=$this->input->post('pmb2_telp_ibu');
				$telp2_ibu=$this->input->post('pmb2_hp_ibu');
				$gaji_ibu=preg_replace("/[^0-9]/", "", $this->input->post('pmb2_gaji_ibu'));
				
				$nama_ayah=$this->input->post('pmb2_nm_ayah');
				$nama_ayah=str_replace("'", "''", $nama_ayah);
				$alamat_ayah=$this->input->post('pmb2_alamat_ayah');
				$alamat_ayah=str_replace("'", "&#39;", $alamat_ayah);
				$RT_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('RT_AYAH'));
				$RW_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('RW_AYAH'));
				$DESA_AYAH=str_replace("'", "&#39;", $this->input->post('DESA_AYAH'));
				$KD_PROP_AYAH=$this->input->post('KD_PROP_AYAH');
				$KD_KAB_AYAH=$this->input->post('KD_KAB_AYAH');
				$KD_KEC_AYAH=$this->input->post('KD_KEC_AYAH');
				$KODE_POS_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS_AYAH'));
				$telp1_ayah=$this->input->post('pmb2_telp_ayah');
				$telp2_ayah=$this->input->post('pmb2_hp_ayah');
				$gaji_ayah=preg_replace("/[^0-9]/", "", $this->input->post('pmb2_gaji_ayah'));
						
				if(empty($nama_ibu)){
					$error="NAMA IBU TIDAK BOLEH KOSONG<br />";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($alamat_ibu)){
					$error="ALAMAT LENGKAP IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RT_IBU)){
					$error="RT IBU ASAL TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RW_IBU)){
					$error="RW IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($DESA_IBU)){
					$error="DESA IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_PROP_IBU)){
					$error="NAMA PROPINSI IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KAB_IBU)){
					$error="NAMA KABUPATEN IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KEC_IBU)){
					$error="NAMA KECAMATAN IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KODE_POS_IBU)){
					$error="KODE POS IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp1_ibu)){
					$error="TELPON RUMAH IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 0735324935";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp2_ibu)){
					$error="NO. TELP/HP IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 089629008652";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($nama_ayah)){
					$error="NAMA AYAH TIDAK BOLEH KOSONG<br />";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($alamat_ayah)){
					$error="ALAMAT LENGKAP IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RT_AYAH)){
					$error="RT AYAH ASAL TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RW_AYAH)){
					$error="RW AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($DESA_AYAH)){
					$error="DESA AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_PROP_AYAH)){
					$error="NAMA PROPINSI AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KAB_AYAH)){
					$error="NAMA KABUPATEN AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KEC_AYAH)){
					$error="NAMA KECAMATAN AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KODE_POS_AYAH)){
					$error="KODE POS AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp1_ayah)){
					$error="TELPON RUMAH AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 0735324935";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp2_ayah)){
					$error="NO. TELP/HP AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 089629008652";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($gaji_ibu)){
					$error="PENGHASILAN IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 10000000";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($gaji_ayah)){
					$error="PENGHASILAN AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 10000000";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}else{
					$api_datapost = array(
						'PMB_PIN_PENDAFTAR'=>$this->session->userdata('id_user'),
						'PMB_NAMA_LENGKAP_IBU'=> $nama_ibu,
						'PMB_NAMA_LENGKAP_AYAH'=> $nama_ayah,
						'PMB_ALAMAT_LENGKAP_IBU'=> $alamat_ibu,
						'PMB_ALAMAT_LENGKAP_AYAH'=> $alamat_ayah,
						'PMB_ID_KEC_IBU'=> 0,
						'PMB_ID_KEC_AYAH'=> 0,
						'PMB_NOHP_IBU'=> $telp2_ibu,
						'PMB_NOHP_AYAH'=> $telp1_ayah,
						'PMB_TELP_IBU'=> $telp1_ibu,
						'PMB_TELP_AYAH'=> $telp2_ayah,
						'PMB_STATUS_SIMPAN_ORTU'=> 1,
						'RT_IBU' => $RT_IBU,
						'RW_IBU' => $RW_IBU,
						'DESA_IBU' => $DESA_IBU,
						'KD_PROP_IBU' => $KD_PROP_IBU,
						'KD_KAB_IBU' => $KD_KAB_IBU,
						'KD_KEC_IBU' => $KD_KEC_IBU,
						'KODE_POS_IBU' => $KODE_POS_IBU,
						'RT_AYAH' => $RT_AYAH,
						'RW_AYAH' => $RW_AYAH,
						'DESA_AYAH' => $DESA_AYAH,
						'KD_PROP_AYAH' => $KD_PROP_AYAH,
						'KD_KAB_AYAH' => $KD_KAB_AYAH,
						'KD_KEC_AYAH' => $KD_KEC_AYAH,
						'KODE_POS_AYAH' => $KODE_POS_AYAH,
						'GAJI_IBU' => $gaji_ibu,
						'GAJI_AYAH' => $gaji_ayah
					);
					#print_r($api_datapost);
					$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 62, 'api_search' => $api_datapost));
									#print_r($aksi); die();
						if($aksi==TRUE){
										$url_ridirek=base_url().$this->session->userdata('status').'/data-prestasi';
										$error="DATA ORANG TUA BERHASIL DI INPUT...";
										$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PRESTASI</u></a></div>";
										$hasil = "sukses";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
										$error="GAGAL INPUT DATA ORANG TUA";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
					
				}
				
			break;
			case 23 : 
				#echo "edit orang tua";
				$nama_ibu=$this->input->post('pmb2_nm_ibu');
				$nama_ibu=str_replace("'", "''", $nama_ibu);
				$alamat_ibu=$this->input->post('pmb2_alamat_ibu');
				$alamat_ibu=str_replace("'", "&#39;", $alamat_ibu);
				$RT_IBU=preg_replace("/[^0-9]/", "", $this->input->post('RT_IBU'));
				$RW_IBU=preg_replace("/[^0-9]/", "", $this->input->post('RW_IBU'));
				$DESA_IBU=str_replace("'", "&#39;", $this->input->post('DESA_IBU'));
				$KD_PROP_IBU=$this->input->post('KD_PROP_IBU');
				$KD_KAB_IBU=$this->input->post('KD_KAB_IBU');
				$KD_KEC_IBU=$this->input->post('KD_KEC_IBU');
				$KODE_POS_IBU=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS_IBU'));
				$telp1_ibu=$this->input->post('pmb2_telp_ibu');
				$telp2_ibu=$this->input->post('pmb2_hp_ibu');
				$gaji_ibu=preg_replace("/[^0-9]/", "", $this->input->post('pmb2_gaji_ibu'));
				
				$nama_ayah=$this->input->post('pmb2_nm_ayah');
				$nama_ayah=str_replace("'", "''", $nama_ayah);
				$alamat_ayah=$this->input->post('pmb2_alamat_ayah');
				$alamat_ayah=str_replace("'", "&#39;", $alamat_ayah);
				$RT_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('RT_AYAH'));
				$RW_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('RW_AYAH'));
				$DESA_AYAH=str_replace("'", "&#39;", $this->input->post('DESA_AYAH'));
				$KD_PROP_AYAH=$this->input->post('KD_PROP_AYAH');
				$KD_KAB_AYAH=$this->input->post('KD_KAB_AYAH');
				$KD_KEC_AYAH=$this->input->post('KD_KEC_AYAH');
				$KODE_POS_AYAH=preg_replace("/[^0-9]/", "", $this->input->post('KODE_POS_AYAH'));
				$telp1_ayah=$this->input->post('pmb2_telp_ayah');
				$telp2_ayah=$this->input->post('pmb2_hp_ayah');
				$gaji_ayah=preg_replace("/[^0-9]/", "", $this->input->post('pmb2_gaji_ayah'));
				
				
				if(empty($nama_ibu)){
					$error="NAMA IBU TIDAK BOLEH KOSONG<br />";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($alamat_ibu)){
					$error="ALAMAT LENGKAP IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RT_IBU)){
					$error="RT IBU ASAL TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RW_IBU)){
					$error="RW IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($DESA_IBU)){
					$error="DESA IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_PROP_IBU)){
					$error="NAMA PROPINSI IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KAB_IBU)){
					$error="NAMA KABUPATEN IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KEC_IBU)){
					$error="NAMA KECAMATAN IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KODE_POS_IBU)){
					$error="KODE POS IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp1_ibu)){
					$error="TELPON RUMAH IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 0735324935";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp2_ibu)){
					$error="NO. TELP/HP IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 089629008652";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($nama_ayah)){
					$error="NAMA AYAH TIDAK BOLEH KOSONG<br />";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($alamat_ayah)){
					$error="ALAMAT LENGKAP IBU TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RT_AYAH)){
					$error="RT AYAH ASAL TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($RW_AYAH)){
					$error="RW AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($DESA_AYAH)){
					$error="DESA AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_PROP_AYAH)){
					$error="NAMA PROPINSI AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KAB_AYAH)){
					$error="NAMA KABUPATEN AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KD_KEC_AYAH)){
					$error="NAMA KECAMATAN AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($KODE_POS_AYAH)){
					$error="KODE POS AYAH TIDAK BOLEH KOSONG";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp1_ayah)){
					$error="TELPON RUMAH AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 0735324935";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($telp2_ayah)){
					$error="NO. TELP/HP AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 089629008652";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($gaji_ibu)){
					$error="PENGHASILAN IBU TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 10000000";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}elseif(empty($gaji_ayah)){
					$error="PENGHASILAN AYAH TIDAK BOLEH KOSONG<BR />CONTOH PENGISIAN : 10000000";
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}else{
					$api_datapost = array(
						'PMB_PIN_PENDAFTAR'=>$this->session->userdata('id_user'),
						'PMB_NAMA_LENGKAP_IBU'=> $nama_ibu,
						'PMB_NAMA_LENGKAP_AYAH'=> $nama_ayah,
						'PMB_ALAMAT_LENGKAP_IBU'=> $alamat_ibu,
						'PMB_ALAMAT_LENGKAP_AYAH'=> $alamat_ayah,
						'PMB_ID_KEC_IBU'=> 0,
						'PMB_ID_KEC_AYAH'=> 0,
						'PMB_NOHP_IBU'=> $telp2_ibu,
						'PMB_NOHP_AYAH'=> $telp1_ayah,
						'PMB_TELP_IBU'=> $telp1_ibu,
						'PMB_TELP_AYAH'=> $telp2_ayah,
						'PMB_STATUS_SIMPAN_ORTU'=> 1,
						'RT_IBU' => $RT_IBU,
						'RW_IBU' => $RW_IBU,
						'DESA_IBU' => $DESA_IBU,
						'KD_PROP_IBU' => $KD_PROP_IBU,
						'KD_KAB_IBU' => $KD_KAB_IBU,
						'KD_KEC_IBU' => $KD_KEC_IBU,
						'KODE_POS_IBU' => $KODE_POS_IBU,
						'RT_AYAH' => $RT_AYAH,
						'RW_AYAH' => $RW_AYAH,
						'DESA_AYAH' => $DESA_AYAH,
						'KD_PROP_AYAH' => $KD_PROP_AYAH,
						'KD_KAB_AYAH' => $KD_KAB_AYAH,
						'KD_KEC_AYAH' => $KD_KEC_AYAH,
						'KODE_POS_AYAH' => $KODE_POS_AYAH,
						'GAJI_IBU' => $gaji_ibu,
						'GAJI_AYAH' => $gaji_ayah
					);
					#print_r($api_datapost); DIE();
					$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 63, 'api_search' => $api_datapost));
					#print_r($aksi); die();
						if($aksi==TRUE){
							$url_ridirek=base_url().$this->session->userdata('status').'/data-prestasi';
							$error="DATA ORANG TUA BERHASIL DI INPUT...";
							$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PRESTASI</u></a></div>";
							$hasil = "sukses";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
							$error="GAGAL INPUT DATA ORANG TUA";
							$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
							$hasil = "gagal";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
				}
			break;
			case 100: //aksi verifikasi data
				if(empty($this->input->post('lisensi'))){
						$pesan = "<div class='bs-callout bs-callout-error'>MAAF, PASTIKAN ANDA MENYETUJUI VERIFIKASI DATA DENGAN MEMBERI TANDA CENTANG</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}else{
					$jenis=$this->session->userdata('jenis_penerimaan');
					switch($jenis){
						case 1: case 9 :
						#echo "verifikasi data - sudah tidak bisa edit lagi"; 
						$status=$this->input->post('status_verifikasi');
						$api_datapost = array(
										$this->session->userdata('id_user'),
										$status
									); 
						#print_r($api_datapost); die();
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
									'POST', array('api_kode'=>10, 'api_subkode' => 20, 'api_search' => $api_datapost));
						#print_r($aksi);
						if($aksi==TRUE){
							$url_base=base_url().$this->session->userdata('status');
							redirect(''.$url_base.'/data-verifikasi_data'); 
						}
						break;
						case 2 :
						#echo "verifikasi data - sudah tidak bisa edit lagi"; 
						$status=$this->input->post('status_verifikasi');
						$api_datapost = array(
										$this->session->userdata('id_user'),
										$status
									); 
						#print_r($api_datapost); die();
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
									'POST', array('api_kode'=>10, 'api_subkode' => 6, 'api_search' => $api_datapost));
						#print_r($aksi);
						if($aksi==TRUE){
							$url_base=base_url().$this->session->userdata('status');
							redirect(''.$url_base.'/data-verifikasi_data'); 
						}
						break;
						case 4: case 5: case 8:
							#echo "s3";
							$status=$this->input->post('status_verifikasi');
							$api_datapost = array(
										$this->session->userdata('id_user'),
										$status
									); 
							#print_r($api_datapost); die();
							$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
									'POST', array('api_kode'=>10, 'api_subkode' => 36, 'api_search' => $api_datapost));
							#print_r($aksi);
							if($aksi==TRUE){
								$url_base=base_url().$this->session->userdata('status');
								redirect(''.$url_base.'/data-verifikasi_data'); 
							}
							
						break;
					}		
						
						
				}
			break;
			default : $this->_0400_error($this->_0422_error_msg(array('kode'=>'1','current_page'=>$this->input->post('current_page')))); break;
		}	 
		
	}
	function kesehatan(){
		$id_user=$this->session->userdata('id_user');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 10, 'api_subkode' => 60, 'api_search' => $id_user);
		$data['kesehatan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($data);
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$salam="Data Kesehatan";
			$this->breadcrumb->append_crumb($salam, '/');
		if($data['kesehatan']==TRUE){
			// $this->output99->output_display('02_cmahasiswa/s02_vw_data_kesehatan', $data);
			$data['content']='02_cmahasiswa/s02_vw_data_kesehatan';
			$this->load->view('s00_vw_all', $data);
		}else{
			$data['content']='02_cmahasiswa/s02_vw_form_kesehatan';
			$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_form_kesehatan');
		}
		
	}
	function actionform_kesehatan(){
		// echo "<pre>"; print_r($_POST); echo "</pre>"; die();
		if($_POST['step']=='insert_kesehatan'){
			$RIWAYAT_PENYAKIT=$this->input->post('TOP_RIWAYAT_KESEHATAN');
			if(empty($RIWAYAT_PENYAKIT)){ $RIWAYAT_PENYAKIT="-"; }
				$KESEHATAN=$this->input->post('GLOBAL_MASTER_DIFABEL');
			// $KETERANGAN_DIFABEL=$this->input->post('KETERANGAN_DIFABEL');
			if($KESEHATAN=='NORMAL'){
				$NORMAL_TIDAK="1";
			}else{
				$NORMAL_TIDAK=implode(" ", $this->input->post('KD_DIFABEL'));
			}
			$api_datapost=array(
				'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
				'PMB_RIWAYAT_PENYAKIT' => $RIWAYAT_PENYAKIT,
				'PMB_ID_JENIS_KESEHATAN' =>	$NORMAL_TIDAK,
				'PMB_STATUS_KESEHATAN' => 1
			); 
			#print_r($api_datapost);die();
			$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 59, 'api_search' => $api_datapost));
			if($aksi==TRUE){
				$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sabelumnuya';
				$error="DATA KESEHATAN BERHASIL DI INPUT...";
				$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PENDIDIKAN SEBELUMNYA</u></a></div>";
				$hasil = "sukses";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}else{
				$error="DATA KESEHATAN GAGAL DI INPUT...";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				$hasil = "gagal";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}
		}elseif($_POST['step']=='update_kesehatan'){
			$RIWAYAT_PENYAKIT=$this->input->post('TOP_RIWAYAT_KESEHATAN');
			if(empty($RIWAYAT_PENYAKIT)){ $RIWAYAT_PENYAKIT="-"; }
			
			if(empty($_POST['lainnya'])){ $LAINNYA="-"; }ELSE{ $LAINNYA=$_POST['lainnya'];}
			$KESEHATAN=$this->input->post('GLOBAL_MASTER_DIFABEL');
			#$KETERANGAN_DIFABEL=$this->input->post('KETERANGAN_DIFABEL');
			if($KESEHATAN=='NORMAL'){
				$NORMAL_TIDAK="1";
			}else{
				if(empty($this->input->post('KD_DIFABEL'))){
					$NORMAL_TIDAK=implode(" ", $this->input->post('pmb1_kesehatan'));
				}else{
					$NORMAL_TIDAK=implode(" ", $this->input->post('KD_DIFABEL'));
				}	
			}
			
			$api_datapost=array(
				'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
				'PMB_RIWAYAT_PENYAKIT' => $RIWAYAT_PENYAKIT,
				'PMB_ID_JENIS_KESEHATAN' =>	$NORMAL_TIDAK,
				'LAINNYA' => $LAINNYA
			); 
			#echo json_encode($api_datapost);
			$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 61, 'api_search' => $api_datapost));
			if($aksi==TRUE){
				$url_ridirek=base_url().$this->session->userdata('status').'/data-pendidikan_sabelumnuya';
				$error="DATA KESEHATAN BERHASIL DI UBAH...";
				$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PENDIDIKAN SEBELUMNYA</u></a></div>";
				$hasil = "sukses";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}else{
				$error="DATA KESEHATAN GAGAL DI UBAH...";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				$hasil = "gagal";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}
			// $error="DATA KESEHATAN GAGAL DI INPUT";
			// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
			// $hasil = "gagal";
			// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
		}
		
	}
	
	function pendidikan_sebelumnya_old(){
		$url_base=base_url().$this->session->userdata('status');
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1: 
						if($this->input->post('op')=='prop'){
					
						$id=$this->input->post('val');
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 29, 'api_search' => array($id));
						$data['kabupaten'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
						$li_kab = '<option value="">-Pilih Kabupaten-</option>';
						foreach ($data['kabupaten'] as $value) {
							$li_kab .= '<option value='.$value->KODE_KABUPATEN.'>'.$value->NAMA_KABUPATEN.'</option>';
						}
						#$ul_kab = '<select class="wil" id="kab" style="margin-bottom: 0px">'.$li_kab.'</select>'; 
						echo json_encode($li_kab);
		
						}elseif($this->input->post('op')=='kab'){
					
						$id=$this->input->post('kab');
						#echo $id; die();
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 30, 'api_search' => array($id));
						$data['sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
						#print_r($data['sekolah']); die();
						$li_sek = '<option value="">-Pilih Sekolah-</option>';
						foreach ($data['sekolah'] as $value) {
							$li_sek .= '<option value='.$value->KODE_SEKOLAH.'>'.$value->NAMA_SEKOLAH.'</option>';
						}
						#$ul_sekolah = '<select class="wil" id="sek" style="margin-bottom: 0px">'.$li_sek.'</select>'; 
						echo $li_sek;
	
						}else{
					
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 28, 'api_search' => array());
						$data['propinsi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
						#$this->output99->output_display('02_cmahasiswa/s02_vw_form_change_dropdown', $data);
					
						
						#echo "pendidikan s1d3"; 
						//MASTER JENIS SEKOLAH
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter_js  = array('api_kode' => 192, 'api_subkode' => 33, 'api_search' => array());
						$data['jenis_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_js);	
						#print_r($data['jenis_sekolah']);
							
						//MASTER JURUSAN SEKOLAH
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
						$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
						#print_r($data['jurusan_sekolah']);
						
						//PENDIDIKAN TERAKHIR S1D3
						$id_user=$this->session->userdata('id_user');
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 32, 'api_search' => array($id_user));
						$data['pendidikan_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	#print_r($data['pendidikan_s1d3']);
						
						$this->breadcrumb->append_crumb('Beranda', base_url());
						$salam="Pendidikan Sebelumnya";
						$this->breadcrumb->append_crumb($salam, '/');
						
						if($data['pendidikan_s1d3']==TRUE){
							$kode_sekolah=$data['pendidikan_s1d3'][0]->PMB_KODE_SEKOLAH;
							//NAMA SEKOLAH PESERTA
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
							$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
							#print_r($data['nama_sekolah_peserta']);
							// $this->output99->output_display('02_cmahasiswa/s02_vw_pendidikan_s1d3', $data);
							
							
							$data['content']='02_cmahasiswa/s02_vw_pendidikan_s1d3';
							$this->load->view('s00_vw_all', $data);
						}else{
							// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendidikan_s1d3', $data);
							
							$data['content']='02_cmahasiswa/s02_vw_form_pendidikan_s1d3';
							$this->load->view('s00_vw_all', $data);
						}
						}
					break;
					case 2: case 4: case 5: case 8:
					//MASTER LULUSAN 
					$api_url____ 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter____  = array('api_kode' => 192, 'api_subkode' => 15, 'api_search' => array());
					$data['master_lulusan'] = $this->s00_lib_api->get_api_jsob($api_url____,'POST',$parameter____);	
					#echo "pendidikan pacsa"; 
					
					//PENDIDIKAN CPASCA SEBELUMNYA
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 4, 'api_search' => array($id_user));
					$data['pendidikan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data);
					if($data['pendidikan']==TRUE){
						$data['content']='02_cmahasiswa/s02_vw_pendidikan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_pendidikan_pendaftar', $data);
					}else{
						$data['content']='02_cmahasiswa/s02_vw_form_pendidikan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendidikan_pendaftar', $data);
					}
					break;
				}
	}
	
	
	function pendidikan_sebelumnya(){
		$url_base=base_url().$this->session->userdata('status');
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1: case 9:
											
						//MASTER JURUSAN SEKOLAH
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
						$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
						#print_r($data['jurusan_sekolah']);
						
						//PENDIDIKAN TERAKHIR S1D3
						$id_user=$this->session->userdata('id_user');
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 32, 'api_search' => array($id_user));
						$data['pendidikan_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
						// print_r($data['pendidikan_s1d3']);
						
						$this->breadcrumb->append_crumb('Beranda', base_url());
						$salam="Pendidikan Sebelumnya";
						$this->breadcrumb->append_crumb($salam, '/');
						$data_pendidikan=$this->data_pendidikan();
						$data['MASTER_DATA_PENDIDIKAN']=$data_pendidikan;
						
						if($data['pendidikan_s1d3']==TRUE){
							$data['NM_SEKOLAH']=$data['pendidikan_s1d3'][0]->PMB_SEKOLAH_LAIN;
							$data['KD_SEKOLAH_ASAL']=$data['pendidikan_s1d3'][0]->PMB_KODE_SEKOLAH;
							$data['JENJANG']=$data['pendidikan_s1d3'][0]->JENJANG;
							$data['KD_PEND']=$data['pendidikan_s1d3'][0]->KD_PEND;
							$data['NPSN']=$data['pendidikan_s1d3'][0]->PMB_KODE_SEKOLAH;
							$data['content']='02_cmahasiswa/data_pendidikan';
							$this->load->view('s00_vw_all', $data);
						}else{
							// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendidikan_s1d3', $data);
							// $data['content']='02_cmahasiswa/s02_vw_form_pendidikan_s1d3';
							$data['content']='02_cmahasiswa/data_pendidikan';
							$this->load->view('s00_vw_all', $data);
						}
						
					break;
					case 2: case 4: case 5: case 8:
					//MASTER LULUSAN 
					$api_url____ 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter____  = array('api_kode' => 192, 'api_subkode' => 15, 'api_search' => array());
					$data['master_lulusan'] = $this->s00_lib_api->get_api_jsob($api_url____,'POST',$parameter____);	
					#echo "pendidikan pacsa"; 
					
					//PENDIDIKAN CPASCA SEBELUMNYA
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 4, 'api_search' => array($id_user));
					$data['pendidikan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data);
					if($data['pendidikan']==TRUE){
						$data['content']='02_cmahasiswa/s02_vw_pendidikan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_pendidikan_pendaftar', $data);
					}else{
						$data['content']='02_cmahasiswa/s02_vw_form_pendidikan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pendidikan_pendaftar', $data);
					}
					break;
				}
	}
	
	
	
	function data_sekolah2($KD_PEND){
		
		$CI=&get_instance();
		$data1	= array($KD_PEND);	
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>14000, 'api_subkode' => 4, 'api_search' => $data1));	
		return $isi2;
	}
	
	function data_pendidikan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>10000, 'api_subkode' => 1));	
		return $isi2;
		// print_r($isi2);
	}
	
	function ajax_data_sekolah(){
		$KD_PEND=$this->input->post('KD_PEND');
		$hasil='';
		$hasil=$this->data_sekolah2($KD_PEND);
		$data['hasil']=$hasil;
		// $data['content']='02_cmahasiswa/v_ajax_pendidikan';
		$this->load->view('02_cmahasiswa/v_ajax_pendidikan', $data);
	}
	
	 function data_npsn_cari2($katakunci,$kd_pend){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>14001, 'api_subkode' => 101,'api_search'=>array($katakunci,$kd_pend)));	
		return $isi2;
	}
	
	function ajax_data_npsn2(){
		$katakunci=$this->input->post('katakunci');
        $kd_pend=$this->input->post('kd_pend');
		$lokasi_balik=$this->input->post('lokasi_balik');
		$lokasi=$this->input->post('lokasi');
		$lokasi_tampil=$this->input->post('lokasi_tampil');
		if($katakunci){
			$data	= $this->data_npsn_cari2($katakunci,$kd_pend);
			$data['isi']=$data;
			//$data['lokasi']=$lokasi;			
			if($lokasi_balik=='KD_KAB'){
				$propinsi="1";
			}else{
				$propinsi='0';
			}
			$data['propinsi']=$propinsi;
			$data['lokasi_balik']=$lokasi_balik;
			$data['lokasi']="$lokasi#$lokasi_balik#$lokasi_tampil";
			$this->load->view('02_cmahasiswa/v_ajax_npsn',$data);
		}else{
			echo "";
		}
	}
	
	function pendidikan(){
	
		$data_pendidikan=$this->data_pendidikan();
		$data['MASTER_DATA_PENDIDIKAN']=$data_pendidikan;
		$data['content']='02_cmahasiswa/data_pendidikan';
		$this->load->view('s00_vw_all', $data);
		
	}
	
	
	function actionform_pendidikan(){
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1: case 9: //s1 d3
					#echo "aksi pendidikan s1d3"; 
						if($_POST['step']=='insert_pendidikan'){
							// $pmb1_jenis_sekolah=$this->input->post('pmb1_jenis_sekolah');
							// if($pmb1_jenis_sekolah=='jenis_sekolah_lain'){
								// $pmb1_jenis_sekolah=$this->input->post('jenis_sekolah_lain');
							// }else{
								// $pmb1_jenis_sekolah=$this->input->post('pmb1_jenis_sekolah');
							// }
							
							// $pmb1_jurusan_sekolah=$this->input->post('pmb1_jurusan_sekolah');
							// if($pmb1_jurusan_sekolah=='jurusan_lain'){
								// $pmb1_jurusan_sekolah=$this->input->post('jurusan_lain');
							// }else{
								// $pmb1_jurusan_sekolah=$this->input->post('pmb1_jurusan_sekolah');
							// }
							
							// $sekolah=$this->input->post('sekolah');
							// $sekolah=substr($sekolah,4,4);
							// if($sekolah==9999){
								// $sekolah=$this->input->post('sekolah_lain');
								// $sekolah=str_replace("'", "#39;", $sekolah);
								// $kode=$this->input->post('sekolah');
							// }else{
								// $sekolah=$this->input->post('sekolah');
								// $kode=$this->input->post('sekolah');
							// }
							
							// $pmb1_alamat_sekolah=$this->input->post('pmb1_alamat_sekolah');
							// $pmb1_alamat_sekolah=str_replace("'", "&#39;", $pmb1_alamat_sekolah);
							// $pmb1_tahun_lulus=$this->input->post('pmb1_tahun_lulus');
							
							
							// if(empty($pmb1_jenis_sekolah)){
									// $error="JENIS SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_jurusan_sekolah)){
									// $error="JURUSAN SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($sekolah)){
									// $error="NAMA SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_alamat_sekolah)){
									// $error="ALAMAT SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_tahun_lulus)){
									// $error="TAHUN LULUS TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }else{
								// $api_datapost = array(
									// 'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
									// 'JENIS_SEKOLAH' => $pmb1_jenis_sekolah,
									// 'JURUSAN_SEKOLAH' => $pmb1_jurusan_sekolah,
									// 'KODE_SEKOLAH' => $kode,
									// 'SEKOLAH_LAIN' => $sekolah,
									// 'TAHUN_LULUS' => $pmb1_tahun_lulus,
									// 'STATUS_SIMPAN_PENDIDIKAN' => 1,
									// 'ALAMAT_SEKOLAH' => $pmb1_alamat_sekolah
								// );
								// #print_r($api_datapost); die();
								// $aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 25, 'api_search' => $api_datapost));
								// if($aksi==TRUE){
									// $url_ridirek=base_url().$this->session->userdata('status').'/data-orangtua';
									// $error="DATA PENDIDIKAN BERHASIL DISIMPAN";
									// $pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA ORANG TUA</u></a></div>";
									// $hasil = "sukses";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								// }else{
									// $error="GAGAL SIMPAN DATA<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								// }	
								
							// }
							
							$JENJANG=$_POST['JENJANG'];
							
							$NM_SEKOLAH=$_POST['NM_SEKOLAH'];
							
							$KD_PEND=$_POST['KD_PEND'];
							
							$NPSN=$_POST['NPSN'];
							
							$PMB1_ALAMAT_SEKOLAH=$this->input->post('PMB1_ALAMAT_SEKOLAH');
							
							$PMB1_TAHUN_LULUS=$this->input->post('PMB1_TAHUN_LULUS');
							
							
							$PMB1_JURUSAN_SEKOLAH=$this->input->post('PMB1_JURUSAN_SEKOLAH');
							if($PMB1_JURUSAN_SEKOLAH=='jurusan_lain'){
								$PMB1_JURUSAN_SEKOLAH=$this->input->post('jurusan_lain');
							}else{
								$PMB1_JURUSAN_SEKOLAH=$this->input->post('PMB1_JURUSAN_SEKOLAH');
							}
							
							if(empty($JENJANG)){
								$error="JENJANG TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
								
							}	
							
							if(empty($KD_PEND)){
								$error="JENJANG PENDIDIKAN TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}
							
							if(empty($NM_SEKOLAH)){
								$error="NAMA SEKOLAH TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}
							
							if(empty($NPSN)){
								$error="NPSN TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}
							
							if(empty($PMB1_JURUSAN_SEKOLAH)){
								$error="JURUSAN SEKOLAH TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}elseif(empty($PMB1_ALAMAT_SEKOLAH)){
								$error="ALAMAT SEKOLAH TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}elseif(empty($PMB1_TAHUN_LULUS)){
								$error="TAHUN LULUS TIDAK BOLEH KOSONG<br />";
								$INSERT="TIDAK";
							}else{
								$INSERT="OK";
							}
							
							
							if($INSERT=="OK"){
										//nek keno
									$api_datapost = array(
										'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
										// 'JENIS_SEKOLAH' => $pmb1_jenis_sekolah,
										'JURUSAN_SEKOLAH' => $PMB1_JURUSAN_SEKOLAH,
										'KODE_SEKOLAH' => $NPSN,
										'SEKOLAH_LAIN' => $NM_SEKOLAH,
										'TAHUN_LULUS' => $PMB1_TAHUN_LULUS,
										'ALAMAT_SEKOLAH' => $PMB1_ALAMAT_SEKOLAH,
										'JENJANG' => $JENJANG,
										'KD_PEND' => $KD_PEND
									);
									// print_r($api_datapost); die();
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 25, 'api_search' => $api_datapost));
									// print_r($aksi); die();
									// if($aksi==true){
										$url_ridirek=base_url().$this->session->userdata('status').'/data-pekerjaan';
										$error="DATA PENDIDIKAN BERHASIL DISIMPAN";
										$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='".$url_ridirek."'><u>DATA ORANG TUA</u></a></div>";
										$hasil = "sukses";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									// }else{
										// $error="GAGAL SIMPAN DATA<br />";
										// $pesan="<div class='bs-callout bs-callout-error'>".$error."</div>";
										// $hasil="gagal";
										// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									// }
							
							}else{
									$warning=$error;
									$pesan = "<div class='bs-callout bs-callout-error'>".$warning."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}
						}elseif($_POST['step']=='update_pendidikan'){
							
							$JENJANG=$_POST['JENJANG'];
							$JENJANG_LAMA=$_POST['JENJANG_LAMA'];
							
							$NM_SEKOLAH=$_POST['NM_SEKOLAH'];
							$NM_SEKOLAH_LAMA=$_POST['NM_SEKOLAH_LAMA'];
							
							$KD_PEND=$_POST['KD_PEND'];
							$KD_PEND_LAMA=$_POST['KD_PEND_LAMA'];
							
							$NPSN=$_POST['NPSN'];
							$NPSN_LAMA=$_POST['NPSN_LAMA'];
							
							$PMB1_ALAMAT_SEKOLAH=$this->input->post('PMB1_ALAMAT_SEKOLAH');
							
							$PMB1_TAHUN_LULUS=$this->input->post('PMB1_TAHUN_LULUS');
							
							
							$PMB1_JURUSAN_SEKOLAH=$this->input->post('PMB1_JURUSAN_SEKOLAH');
							if($PMB1_JURUSAN_SEKOLAH=='jurusan_lain'){
								$PMB1_JURUSAN_SEKOLAH=$this->input->post('jurusan_lain');
							}else{
								$PMB1_JURUSAN_SEKOLAH=$this->input->post('PMB1_JURUSAN_SEKOLAH');
							}
							
							if(empty($JENJANG)){
								$JENJANG=$JENJANG_LAMA;
								$KD_PEND=$KD_PEND_LAMA;
								$NPSN=$NPSN_LAMA;
								$NM_SEKOLAH=$NM_SEKOLAH_LAMA;
								
							}	
							
							if(empty($KD_PEND)){
								$JENJANG=$JENJANG_LAMA;
								$KD_PEND=$KD_PEND_LAMA;
								$NPSN=$NPSN_LAMA;
								$NM_SEKOLAH=$NM_SEKOLAH_LAMA;
								
							}
							
							if(empty($NM_SEKOLAH)){
								$JENJANG=$JENJANG_LAMA;
								$KD_PEND=$KD_PEND_LAMA;
								$NPSN=$NPSN_LAMA;
								$NM_SEKOLAH=$NM_SEKOLAH_LAMA;
								
							}
							
							if(empty($NPSN)){
								$JENJANG=$JENJANG_LAMA;
								$KD_PEND=$KD_PEND_LAMA;
								$NPSN=$NPSN_LAMA;
								$NM_SEKOLAH=$NM_SEKOLAH_LAMA;
								
							}
							
							if(empty($PMB1_JURUSAN_SEKOLAH)){
								$error="JURUSAN SEKOLAH TIDAK BOLEH KOSONG<br />";
								$UPDATE="TIDAK";
							}elseif(empty($PMB1_ALAMAT_SEKOLAH)){
								$error="ALAMAT SEKOLAH TIDAK BOLEH KOSONG<br />";
								$UPDATE="TIDAK";
							}elseif(empty($PMB1_TAHUN_LULUS)){
								$error="TAHUN LULUS TIDAK BOLEH KOSONG<br />";
								$UPDATE="TIDAK";
							}else{
								$UPDATE="OK";
							}
							
							
							if($UPDATE=="OK"){
										//nek keno
									$api_datapost = array(
										'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
										// 'JENIS_SEKOLAH' => $pmb1_jenis_sekolah,
										'JURUSAN_SEKOLAH' => $PMB1_JURUSAN_SEKOLAH,
										'KODE_SEKOLAH' => $NPSN,
										'SEKOLAH_LAIN' => $NM_SEKOLAH,
										'TAHUN_LULUS' => $PMB1_TAHUN_LULUS,
										'ALAMAT_SEKOLAH' => $PMB1_ALAMAT_SEKOLAH,
										'JENJANG' => $JENJANG,
										'KD_PEND' => $KD_PEND
									);
									// print_r($api_datapost); die();
									$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 26, 'api_search' => $api_datapost));
									// print_r($aksi); die();
									// if($aksi==true){
										$url_ridirek=base_url().$this->session->userdata('status').'/data-pekerjaan';
										$error="DATA PENDIDIKAN BERHASIL DISIMPAN";
										$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='".$url_ridirek."'><u>DATA ORANG TUA</u></a></div>";
										$hasil = "sukses";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									// }else{
										// $error="GAGAL SIMPAN DATA<br />";
										// $pesan="<div class='bs-callout bs-callout-error'>".$error."</div>";
										// $hasil="gagal";
										// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									// }
							
							}else{
									$warning=$error;
									$pesan = "<div class='bs-callout bs-callout-error'>".$warning."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}
							
							
							
							
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
							// PRINT_R($_post);
							// $pmb1_jenis_sekolah=$this->input->post('pmb1_jenis_sekolah');
							// if($pmb1_jenis_sekolah=='jenis_sekolah_lain'){
								// $pmb1_jenis_sekolah=$this->input->post('jenis_sekolah_lain');
							// }else{
								// $pmb1_jenis_sekolah=$this->input->post('pmb1_jenis_sekolah');
							// }
							
							// $pmb1_jurusan_sekolah=$this->input->post('pmb1_jurusan_sekolah');
							// if($pmb1_jurusan_sekolah=='jurusan_lain'){
								// $pmb1_jurusan_sekolah=$this->input->post('jurusan_lain');
							// }else{
								// $pmb1_jurusan_sekolah=$this->input->post('pmb1_jurusan_sekolah');
							// }
							// /*
							// $sekolah=$this->input->post('sekolah');
							// $sekolah=substr($sekolah,4,4);
							// if($sekolah==9999){
								// $sekolah=$this->input->post('sekolah_lain');
								// $sekolah=str_replace("'", "#39;", $sekolah);
								// $kode=$this->input->post('sekolah');
							// }else{
								// $sekolah=$this->input->post('sekolah');
								// $kode=$this->input->post('sekolah');
							// }
							// */
							
							// $propinsi=$this->input->post('propinsi');
							// $kabupaten=$this->input->post('kabupaten');
							// $sekolah=$this->input->post('sekolah');
							// if($this->input->post('u_s')=='ubah_s' AND (!empty($propinsi)) AND (!empty($kabupaten)) AND (!empty($sekolah))){
								// $sekolah=substr($sekolah,4,4);
								// if($sekolah==9999){
										// $sekolah=$this->input->post('sekolah_lain');
										// $sekolah=str_replace("'", "#39;", $sekolah);
										// $kode=$this->input->post('sekolah');
								// }else{
										// $sekolah=$this->input->post('sekolah');
										// $kode=$this->input->post('sekolah');	
								// }	
								
							// }else{
								// $sekolah=$this->input->post('sekolah_lama');
								// $sekolah=str_replace("'", "#39;", $sekolah);
								// $kode=$this->input->post('kode_sekolah_lama');	
							// }
							
							// $pmb1_alamat_sekolah=$this->input->post('pmb1_alamat_sekolah');
							// $pmb1_alamat_sekolah=str_replace("'", "&#39;", $pmb1_alamat_sekolah);
							// $pmb1_tahun_lulus=$this->input->post('pmb1_tahun_lulus');
							
							
							// if(empty($pmb1_jenis_sekolah)){
									// $error="JENIS SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_jurusan_sekolah)){
									// $error="JURUSAN SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($sekolah)){
									// $error="NAMA SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_alamat_sekolah)){
									// $error="ALAMAT SEKOLAH TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }elseif(empty($pmb1_tahun_lulus)){
									// $error="TAHUN LULUS TIDAK BOLEH KOSONG<br />";
									// $pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil = "gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							// }else{
									// $api_datapost = array(
									// 'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
									// 'JENIS_SEKOLAH' => $pmb1_jenis_sekolah,
									// 'JURUSAN_SEKOLAH' => $pmb1_jurusan_sekolah,
									// 'KODE_SEKOLAH' => $kode,
									// 'SEKOLAH_LAIN' => $sekolah,
									// 'TAHUN_LULUS' => $pmb1_tahun_lulus,
									// 'ALAMAT_SEKOLAH' => $pmb1_alamat_sekolah
								// );
								// #print_r($api_datapost); die();
								// $aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 26, 'api_search' => $api_datapost));
								// if($aksi==TRUE){
									// $url_ridirek=base_url().$this->session->userdata('status').'/data-pekerjaan';
									// $error="DATA PENDIDIKAN BERHASIL DISIMPAN";
									// $pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='".$url_ridirek."'><u>DATA ORANG TUA</u></a></div>";
									// $hasil = "sukses";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								// }else{
									// $error="GAGAL SIMPAN DATA<br />";
									// $pesan="<div class='bs-callout bs-callout-error'>".$error."</div>";
									// $hasil="gagal";
									// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								// }	
							// }
						}else{
							echo "pendidikan s1d3";
						}
					
					break;
					case 2: case 4: case 5: case 8: // Pasca
						if($_POST['step']=='insert_pendidikan'){
							#echo "Simpan Pendidikan";
							$pmb1_lulusan_dari=$this->input->post('pmb1_lulusan_dari');
							if($pmb1_lulusan_dari=='lulusan_lain'){
								$pmb1_lulusan_dari=$this->input->post('lulusan_lain');
							}else{
								$pmb1_lulusan_dari=$this->input->post('pmb1_lulusan_dari');
							}
							$pmb1_nama_pt=$this->input->post('pmb1_nama_pt');
							$pmb1_tahun_ijazah=$this->input->post('pmb1_tahun_ijazah');
							$pmb1_ipk=$this->input->post('pmb1_ipk');
							if(empty($pmb1_lulusan_dari)){
									$error="LULUSAN DARI TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_nama_pt)){
									$error="NAMA PERGURUAN TINGGI TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_tahun_ijazah)){
									$error="TAHUN IJAZAH TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_ipk)){
									$error="IPK TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$api_datapost = array(
									'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
									'LULUSAN' => $pmb1_lulusan_dari,
									'NAMA_PT' => $pmb1_nama_pt,
									'TAHUN_IJAZAH' => $pmb1_tahun_ijazah,
									'IPK' => $pmb1_ipk,
									'STATUS_SIMPAN_PENDIDIKAN' => 1
								);
								#print_r($api_datapost); die();
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 21, 'api_search' => $api_datapost));
								if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-pekerjaan';
									$error="DATA PENDIDIKAN BERHASIL DISIMPAN";
									$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>DATA PEKERJAAN</u></a></div>";
									$hasil = "sukses";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}else{
									$error="DATA GAGAL SIMPAN<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}	
							}
						}elseif($_POST['step']=='update_pendidikan'){
							#echo "update pendidikan s2";
							$pmb1_lulusan_dari=$this->input->post('pmb1_lulusan_dari');
							if($pmb1_lulusan_dari=='lulusan_lain'){
								$pmb1_lulusan_dari=$this->input->post('lulusan_lain');
							}else{
								$pmb1_lulusan_dari=$this->input->post('pmb1_lulusan_dari');
							}
							$pmb1_nama_pt=$this->input->post('pmb1_nama_pt');
							$pmb1_tahun_ijazah=$this->input->post('pmb1_tahun_ijazah');
							$pmb1_ipk=$this->input->post('pmb1_ipk');
							if(empty($pmb1_lulusan_dari)){
									$error="LULUSAN DARI TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_nama_pt)){
									$error="NAMA PERGURUAN TINGGI TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_tahun_ijazah)){
									$error="TAHUN IJAZAH TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}elseif(empty($pmb1_ipk)){
									$error="IPK TIDAK BOLEH KOSONG<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
							}else{
								$api_datapost = array(
									'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
									'LULUSAN' => $pmb1_lulusan_dari,
									'NAMA_PT' => $pmb1_nama_pt,
									'TAHUN_IJAZAH' => $pmb1_tahun_ijazah,
									'IPK' => $pmb1_ipk
								);
								#print_r($api_datapost); die();
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 22, 'api_search' => $api_datapost));
								if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-pekerjaan';
									$error="DATA PENDIDIKAN BERHASIL DISIMPAN";
									$pesan = "<div class='bs-callout bs-callout-success'>".$error."..Lanjutkan <a href='$url_ridirek'><u>Data Pekerjaan</u></a></div>";
									$hasil = "sukses";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}else{
									$error="GAGAL SIMPAN DATA<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
								}	
								
							}
						}else{
							echo "pendidikan Pasca";
						}
					break;
					
				}
	}
	
	function pekerjaan(){
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Pekerjaan";
		$this->breadcrumb->append_crumb($salam, '/');
				switch($jenis){
					case 1: case 9 : echo "pekerjaan s1d3"; break;
					case 2: case 4 : case 5: case 8:
					 	//MASTER PEKERJAAN 
						$api_url_____ 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter_____  = array('api_kode' => 192, 'api_subkode' => 16, 'api_search' => array());
						$data['master_pekerjaan'] = $this->s00_lib_api->get_api_jsob($api_url_____,'POST',$parameter_____);
						//MASTER RENCANA BIAYA 
						$api_url______ 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter______  = array('api_kode' => 192, 'api_subkode' => 17, 'api_search' => array());
						$data['master_biaya'] = $this->s00_lib_api->get_api_jsob($api_url______,'POST',$parameter______);
						//PEKERJAAN CPASCA SEBELUMNYA
						$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter_  = array('api_kode' => 192, 'api_subkode' => 5, 'api_search' => array($id_user));
						$data['pekerjaan'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);	
						#print_r($data);
						if($data['pekerjaan']==TRUE){
						$data['content']='02_cmahasiswa/s02_vw_pekerjaan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_pekerjaan_pendaftar', $data);
						}else{
						$data['content']='02_cmahasiswa/s02_vw_form_pekerjaan_pendaftar';
						$this->load->view('s00_vw_all', $data);
						// $this->output99->output_display('02_cmahasiswa/s02_vw_form_pekerjaan_pendaftar', $data);
						}
					break;
				}
	}
	
	function actionform_pekerjaan(){
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
		switch($jenis){
			case 1: case 9: echo "pekerjaan s1d3"; break;
			case 2: case 4: case 5: case 8:
							if($_POST['step']=='insert_pekerjaan'){
								#echo "aksi insert pekerjaan s2"; DIE();
									$pmb1_status_pekerjaan=$this->input->post('pmb1_status_pekerjaan');
									if($pmb1_status_pekerjaan=='pekerjaan_lain'){
										$pmb1_status_pekerjaan=$this->input->post('pekerjaan_lain');
									}else{
										$pmb1_status_pekerjaan=$this->input->post('pmb1_status_pekerjaan');
									}
									$pmb1_telp_fax=$this->input->post('pmb1_telp_fax');
									$pmb1_alamat_kantor=$this->input->post('pmb1_alamat_kantor');
									$pmb1_alamat_kantor=str_replace("'", "&#39;", $pmb1_alamat_kantor);
									$pmb1_rencana_biaya=$this->input->post('pmb1_rencana_biaya');
									if($pmb1_rencana_biaya=='biaya_lain'){
										$pmb1_rencana_biaya=$this->input->post('biaya_lain');
									}else{
										$pmb1_rencana_biaya=$this->input->post('pmb1_rencana_biaya');
									}
									if(empty($pmb1_status_pekerjaan)){
										$error="STATUS PEKERJAAN TIDAK BOLEH KOSONG<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_alamat_kantor)){
										$error="ALAMAT KANTOR TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN TANDA INI - <br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_telp_fax)){
										$error="TELPON KANTOR TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN INI -<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_rencana_biaya)){
										$error="RENCANA BIAYA TIDAK BOLEH KOSONG<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}else{
										$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'STATUS_PEKERJAAN' => $pmb1_status_pekerjaan,
											'ALAMAT_KANTOR' => $pmb1_alamat_kantor,
											'TELPON_KANTOR' => $pmb1_telp_fax,
											'RENCANA_BIAYA' => $pmb1_rencana_biaya,
											'STATUS_SIMPAN_PEKERJAAN' => 1
										);
										#print_r($api_datapost); die();
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 23, 'api_search' => $api_datapost));
										if($aksi==TRUE){
											$jenis=$this->session->userdata('jenis_penerimaan');
												switch($jenis){
												case 2:
												$url_ridirek=base_url().$this->session->userdata('status').'/data-pilihan_jurusan';
												$title="PEMILIHAN JURUSAN";
												break;
												case 4: case 5: case 8:
												$url_ridirek=base_url().$this->session->userdata('status').'/data-penelitian';
												$title="DATA PENELITIAN";
												break;
											}
												$error="DATA PEKERJAAN BERHASIL DISIMPAN";
												$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='".$url_ridirek."'><u>".$title."</u></a></div>";
												$hasil = "sukses";
												echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
											
										}else{
											$error="GAGAL SIMPAN DATA<br />";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}	
									
									}
							
							}elseif($_POST['step']=='update_pekerjaan'){
								#echo "aksi update pekerjaan s2"; die();
									$pmb1_status_pekerjaan=$this->input->post('pmb1_status_pekerjaan');
									if($pmb1_status_pekerjaan=='pekerjaan_lain'){
										$pmb1_status_pekerjaan=$this->input->post('pekerjaan_lain');
									}else{
										$pmb1_status_pekerjaan=$this->input->post('pmb1_status_pekerjaan');
									}
									$pmb1_telp_fax=$this->input->post('pmb1_telp_fax');
									$pmb1_alamat_kantor=$this->input->post('pmb1_alamat_kantor');
									$pmb1_alamat_kantor=str_replace("'", "&#39;", $pmb1_alamat_kantor);
									$pmb1_rencana_biaya=$this->input->post('pmb1_rencana_biaya');
									if($pmb1_rencana_biaya=='biaya_lain'){
										$pmb1_rencana_biaya=$this->input->post('biaya_lain');
									}else{
										$pmb1_rencana_biaya=$this->input->post('pmb1_rencana_biaya');
									}
									if(empty($pmb1_status_pekerjaan)){
										$error="STATUS PEKERJAAN TIDAK BOLEH KOSONG<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_alamat_kantor)){
										$error="ALAMAT KANTOR TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN TANDA INI - <br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_telp_fax)){
										$error="TELPON KANTOR TIDAK BOLEH KOSONG, JIKA TIDAK ADA ISI DENGAN INI -<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}elseif(empty($pmb1_rencana_biaya)){
										$error="RENCANA BIAYA TIDAK BOLEH KOSONG<br />";
										$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
										$hasil = "gagal";
										echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
									}else{
										$api_datapost = array(
											'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
											'STATUS_PEKERJAAN' => $pmb1_status_pekerjaan,
											'ALAMAT_KANTOR' => $pmb1_alamat_kantor,
											'TELPON_KANTOR' => $pmb1_telp_fax,
											'RENCANA_BIAYA' => $pmb1_rencana_biaya
										);
										#print_r($api_datapost); die();
										$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 24, 'api_search' => $api_datapost));
										if($aksi==TRUE){
											$jenis=$this->session->userdata('jenis_penerimaan');
											switch($jenis){
												case 2:
												$url_ridirek=base_url().$this->session->userdata('status').'/data-pilihan_jurusan';
												$title="PEMILIHAN JURUSAN";
												break;
												case 4: case 5: case 8:
												$url_ridirek=base_url().$this->session->userdata('status').'/data-penelitian';
												$title="DATA PENELITIAN";
												break;
											}
											$error="DATA PEKERJAAN BERHASIL DISIMPAN";
											$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>$title</u></a></div>";
											$hasil = "sukses";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}else{
											$error="GAGAL SIMPAN DATA<br />";
											$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
											$hasil = "gagal";
											echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
										}	
									
									}
							
							}else{
							
								echo "pekerjaan";
							
							}
						
			break;
			default : echo "pekerjaan pasca"; break;
			#case 3: echo "pekerjaan s3"; break;
		}
	}
	
	function penelitian(){
		$url_base=base_url().$this->session->userdata('status');
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Data Penelitian";
		$this->breadcrumb->append_crumb($salam, '/');
		switch($jenis){
			case 4: case 5: case 8: 
				// echo "penelitian s3"; die();
				//PMB_PENELITIAN_S3
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 46, 'api_search' => array($id_user));
				$data['penelitian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				// print_r($data); die();
				if($data['penelitian']==TRUE){
					$cek_redirect=$data['penelitian'][0]->PMB_STATUS_SIMPAN_PENELITIAN;
					switch($cek_redirect){
						case 1: 
							$data['content']='02_cmahasiswa/s02_vw_data_penelitian';
							$this->load->view('s00_vw_all', $data);
							// $this->output99->output_display('02_cmahasiswa/s02_vw_data_penelitian', $data); 
							
							break;
						case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
					}
				}else{
					$data['content']='02_cmahasiswa/s02_vw_form_penelitian';
					$this->load->view('s00_vw_all', $data);
					// $this->output99->output_display('02_cmahasiswa/s02_vw_form_penelitian', $data);
				}
			break;
			
			
		}
	}
	
	function actionform_penelitian(){
		$jenis=$this->session->userdata('jenis_penerimaan');
		switch($jenis){
			case 4: case 5: case 8: 
				if($_POST['step']=='insert_penelitian'){
					$judul_penelitian=$this->input->post('judul_penelitian');
					$judul_penelitian=str_replace("'", "&#39;", $judul_penelitian);
					$kedudukan=$this->input->post('kedudukan');
					$tahun_penelitian=$this->input->post('tahun_penelitian');
					$sponsor=$this->input->post('sponsor');
					if(empty($judul_penelitian)){
						$error="JUDUL PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($kedudukan)){
						$error="KEDUDUKAN / STATUS PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($tahun_penelitian)){
						$error="TAHUN PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($sponsor)){
						$error="SPONSOR TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}else{
						$api_datapost = array(
							'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
							'JUDUL_PENELITIAN' => $judul_penelitian,
							'KEDUDUKAN' => $kedudukan,
							'TAHUN_PENELITIAN' => $tahun_penelitian,
							'SPONSOR' => $sponsor,
							'STATUS_SIMPAN_PENELITIAN' => 1
						);
						#print_r($api_datapost);
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 28, 'api_search' => $api_datapost));
						if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-karya_tulis';
									$error="DATA PENELITIAN BERHASIL DISIMPAN";
									$pesan = "<div class='bs-callout bs-callout-success'>".$error."..Lanjutkan <a href='$url_ridirek'><u>KARYA TULIS</u></a></div>";
									$hasil = "sukses";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
									$error="DATA GAGAL SIMPAN<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}	
					}
				}elseif($_POST['step']=='update_penelitian'){
					$judul_penelitian=$this->input->post('judul_penelitian');
					$judul_penelitian=str_replace("'", "&#39;", $judul_penelitian);
					$kedudukan=$this->input->post('kedudukan');
					$tahun_penelitian=$this->input->post('tahun_penelitian');
					$sponsor=$this->input->post('sponsor');
					if(empty($judul_penelitian)){
						$error="JUDUL PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($kedudukan)){
						$error="KEDUDUKAN / STATUS PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($tahun_penelitian)){
						$error="TAHUN PENELITIAN TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($sponsor)){
						$error="SPONSOR TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}else{
						$api_datapost = array(
							'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
							'JUDUL_PENELITIAN' => $judul_penelitian,
							'KEDUDUKAN' => $kedudukan,
							'TAHUN_PENELITIAN' => $tahun_penelitian,
							'SPONSOR' => $sponsor
						);
						#print_r($api_datapost); DIE();
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 29, 'api_search' => $api_datapost));
						if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-karya_tulis';
									$error="DATA PENELITIAN BERHASIL DISIMPAN";
									$pesan = "<div class='bs-callout bs-callout-success'>".$error."..LANJUTKAN <a href='$url_ridirek'><u>KARYA TULIS</u></a></div>";
									$hasil = "sukses";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
									$error="DATA GAGAL SIMPAN<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
					}
				}else{
					echo "Penelitian";
				}
			break;
		}
	}
	
	
	function karya_tulis(){
	$url_base=base_url().$this->session->userdata('status');
	$id_user=$this->session->userdata('id_user');
	$jenis=$this->session->userdata('jenis_penerimaan');
	$this->breadcrumb->append_crumb('Beranda', base_url());
	$salam="Karya Tulis";
	$this->breadcrumb->append_crumb($salam, '/');
		switch($jenis){
			case 4: case 5: case 8: 
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 47, 'api_search' => array($id_user));
				$data['karya_tulis'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data);
				if($data['karya_tulis']==TRUE){
					$cek_redirect=$data['karya_tulis'][0]->PMB_STATUS_SIMPAN_KARYA_TULIS;
					switch($cek_redirect){
						case 1: 
							$data['content']='02_cmahasiswa/s02_vw_data_karya_tulis';
							$this->load->view('s00_vw_all', $data);
							// $this->output99->output_display('02_cmahasiswa/s02_vw_data_karya_tulis', $data); 
						break;
						case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
					}
				}else{
					$data['content']='02_cmahasiswa/s02_vw_data_karya_tulis';
					$this->load->view('s00_vw_all', $data);
					// $this->output99->output_display('02_cmahasiswa/s02_vw_data_karya_tulis', $data);
				}
			break;
		}
	}
	
	function actionform_karya_tulis(){
		$jenis=$this->session->userdata('jenis_penerimaan');
		$h=explode("-", $this->security->xss_clean($this->uri->segment(3)));
		switch($jenis){
			case 4: case 5: case 8: 
				if($_POST['step']=='insert_karya'){
					$judul_karya_tulis=$this->input->post('judul_karya_tulis');
					$judul_karya_tulis=str_replace("'", "&#39;", $judul_karya_tulis);
					$penerbit=$this->input->post('penerbit');
					$tahun_karya_tulis=$this->input->post('tahun_karya_tulis');
					if(empty($judul_karya_tulis)){
						$error="JUDUL KARYA TULIS TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($penerbit)){
						$error="PENERBIT KARYA TULIS TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}elseif(empty($tahun_karya_tulis)){
						$error="TAHUN KARYA TULIS TIDAK BOLEH KOSONG<br />";
						$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
						$hasil = "gagal";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}else{
						$api_datapost = array(
							'PMB_PIN_PENDAFTAR' => $this->session->userdata('id_user'),
							'PMB_JUDUL_KARYA_TULIS' => $judul_karya_tulis,
							'PMB_PENERBIT_KARYA_TULIS' => $penerbit,
							'PMB_TAHUN_KARYA_TULIS' => $tahun_karya_tulis,
							'PMB_STATUS_SIMPAN_KARYA_TULIS' => 1
						);	
						$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 30, 'api_search' => $api_datapost));
						if($aksi==TRUE){
									$url_ridirek=base_url().$this->session->userdata('status').'/data-karya_tulis';
									$error="DATA KARYA TULIS BERHASIL DISIMPAN";
									$pesan = "<div class='bs-callout bs-callout-success'>".$error."..<a href='$url_ridirek'><u>ANDA MASIH BISA MENAMBAH DAN MENGHAPUS DATA KARYA TULIS</u></a></div>";
									$hasil = "sukses";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}else{
									$error="DATA GAGAL SIMPAN<br />";
									$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
									$hasil = "gagal";
									echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
					
					}
				}elseif($_POST['step']=='update_karya_tulis'){
					
				}elseif($h[0]=='hapus'){
						$api_datapost = array(
							'PMB_ID_KARYA' => $h[2]
						);
					#print_r($api_datapost); die();
					$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 31, 'api_search' => $api_datapost));
					if($aksi==TRUE){
						redirect(''.base_url().'s3/data-karya_tulis');
					}else{
						redirect(''.base_url().'s3/data-karya_tulis');
					}
				}
			break;
		}
	}
	
	function proposal_disertasi(){
		$url_base=base_url().$this->session->userdata('status');
		$id_user=$this->session->userdata('id_user');
		$jenis=$this->session->userdata('jenis_penerimaan');
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Proposal Disertasi";
		$this->breadcrumb->append_crumb($salam, '/');
		switch($jenis){
			case 4: case 5: case 8: 
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 48, 'api_search' => array($id_user));
				$data['disertasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				#print_r($data);
				if($data['disertasi']==TRUE){
					$cek_redirect=$data['disertasi'][0]->PMB_STATUS_SIMPAN_DISERTASI;
					switch($cek_redirect){
						case 1: 
						
							// $this->output99->output_display('02_cmahasiswa/s02_vw_from_disertasi', $data); 
							$data['content']='02_cmahasiswa/s02_vw_from_disertasi';
							$this->load->view('s00_vw_all', $data);
							break;
						case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
					}
				}else{
					$data['content']='02_cmahasiswa/s02_vw_from_disertasi';
					$this->load->view('s00_vw_all', $data);
					// $this->output99->output_display('02_cmahasiswa/s02_vw_from_disertasi', $data);
				}
			break;
		}
	}
	
	function actionform_proposal_disertasi(){
	$h=explode("-", $this->security->xss_clean($this->uri->segment(3)));
	$jenis=$this->session->userdata('jenis_penerimaan');
	switch($jenis){
		case 4: case 5: case 8: 
		if($_POST['step']=='insert_disertasi'){
		$file = $_FILES["userfile"]["name"];
		$judul_disertasi = $this->input->post('judul_disertasi');
		$judul_disertasi=str_replace("'", "&#39;", $judul_disertasi);
		if(empty($judul_disertasi)){
			$pesan = "<div class='bs-callout bs-callout-error'>JUDUL DISERTASI TODAK BOLEH KOSONG</div>";
			$hasil = "gagal";
			echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
		}else{
			
			$config['upload_path']   =   "disertasi/$jenis";
			$config['allowed_types'] =   "pdf"; 
			$config['max_size']      =   "15000";
			$config['overwrite']    =   true;
			$config['file_name']     =   $this->session->userdata('id_user')."-disertasi-".$jenis;
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload()){
				$error=$this->upload->display_errors();
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				$hasil = "gagal";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}else{	
					$id_user=$this->session->userdata('id_user');
					$jenis=$this->session->userdata('jenis_penerimaan');
					$disertasi=$this->session->userdata('id_user')."-disertasi-".$jenis.".pdf";
					
					$api_datapost = array(
								'PMB_PIN_PENDAFTAR'=> $id_user,
								'PMB_JUDUL_DISERTASI'=> $judul_disertasi,
								'PMB_FILE_DISERTASI'=> $disertasi,
								'PMB_STATUS_SIMPAN_DISERTASI'=> 1
					);
				#print_r($api_datapost); die();
				$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 32,'api_search' => $api_datapost));
				if($aksi==TRUE){
				$finfo=$this->upload->data();
					if($finfo==TRUE){ 
						$msg="BERHASIL PROPOSAL DISERTASI";
						$pesan = "<div class='bs-callout bs-callout-success'>".$msg."</div>";
						$hasil = "sukses";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}
				}else{
					$pesan = "<div class='bs-callout bs-callout-error'>GAGAL INPUT DATA PROPOSAL DISERTASI</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));

				}
			}
		
		}
		}elseif($h[0]=='hapus'){
				$id_user=$this->session->userdata('id_user');
						$api_datapost = array(
							'PMB_PIN_PENDAFTAR' => $id_user
						);
					#print_r($api_datapost); die();
					$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 33, 'api_search' => $api_datapost));
					if($aksi==TRUE){
						redirect(''.base_url().'s3/data-proposal_disertasi');
					}else{
						redirect(''.base_url().'s3/data-proposal_disertasi');
					}
		}
	break;
  }
}
	
	
	function pilihan_jurusan(){ 
	$jenis=$this->session->userdata('jenis_penerimaan');
	$id_user=$this->session->userdata('id_user');
	$this->breadcrumb->append_crumb('Beranda', base_url());
	$salam="Pilihan Jalur dan Jurusan";
	$this->breadcrumb->append_crumb($salam, '/');
	$data['GELOMBANG']=$this->cek_gelombang();
	switch($jenis){
		case 2 :case 3:
		$url_base=base_url().$this->session->userdata('status');
		$data['status']=$this->status_kelengkapan();
		
		#$data['pendaftar']=$this->pendaftar();
		
		//MASTER PRODI S2
		$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_  = array('api_kode' => 192, 'api_subkode' => 18, 'api_search' => array($jenis));
		$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
		
		//JALUR DIA
		$jenis=$this->session->userdata('jenis_penerimaan');
		$api_url__ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter__  = array('api_kode' => 192, 'api_subkode' => 19, 'api_search' => array($jenis));
		$data['master_jalur'] = $this->s00_lib_api->get_api_jsob($api_url__,'POST',$parameter__);
		
		//PMB_PILJUR_PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 7, 'api_search' => array($id_user));
		$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data); die();
		if($data['piljur']==TRUE){
			$cek_redirect=$data['piljur'][0]->PMB_STATUS_SIMPAN_PILJUR;
		switch($cek_redirect){
			case 1: 
				$data['content']='02_cmahasiswa/s02_vw_data_piljur_pendaftar';
				$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_data_piljur_pendaftar', $data); 
			break;
			case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
		}
		}else{
				$data['content']='02_cmahasiswa/s02_vw_form_piljur_pendaftar';
				$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_form_piljur_pendaftar', $data);
		}
		break;
		case 4: case 5: case 8: 
		#echo "Pilihan S3";
		
		//MASTER PRODI S3
		if($jenis==4){
			$apisub_prodi="49";
		}elseif($jenis==5){
			$apisub_prodi="85";
		}elseif($jenis==8){
			$apisub_prodi="49";
		}
		$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_  = array('api_kode' => 192, 'api_subkode' => $apisub_prodi, 'api_search' => array());
		$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
		
		//PMB_PILJUR_PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 7, 'api_search' => array($id_user));
		$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data);
		if($data['piljur']==TRUE){
			$cek_redirect=$data['piljur'][0]->PMB_STATUS_SIMPAN_PILJUR;
		switch($cek_redirect){
			case 1: 
			$data['content']='02_cmahasiswa/s02_vw_data_piljur_pendaftar_s3';
			$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_data_piljur_pendaftar_s3', $data); 
			break;
			case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
		}
		}else{
		$data['content']='02_cmahasiswa/s02_vw_form_piljur_pendaftar_s3';
		$this->load->view('s00_vw_all', $data);
		// $this->output99->output_display('02_cmahasiswa/s02_vw_form_piljur_pendaftar_s3', $data);
		}	
		break;
	}
		
}
	
	
	function pilihan_jurusan_s1d3(){
		$url_base=base_url().$this->session->userdata('status');
		$data['status']=$this->status_kelengkapan();
		$id_user=$this->session->userdata('id_user');
		#$data['pendaftar']=$this->pendaftar();
		
		//MASTER PRODI 
		$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter_  = array('api_kode' => 192, 'api_subkode' => 38, 'api_search' => array());
		$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
		
		//JALUR DIA
		$jenis=$this->session->userdata('jenis_penerimaan');
		$api_url__ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter__  = array('api_kode' => 192, 'api_subkode' => 19, 'api_search' => array($jenis));
		$data['master_jalur'] = $this->s00_lib_api->get_api_jsob($api_url__,'POST',$parameter__);
		// echo "<pre>"; print_r($data['master_jalur']); echo "</pre>";die();
		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Pilihan Jalur dan Jurusan";
		$this->breadcrumb->append_crumb($salam, '/');
		
		//PMB_PILJUR_PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 7, 'api_search' => array($id_user));
		$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['piljur']);
		if($data['piljur']==TRUE){
			$cek_redirect=$data['piljur'][0]->PMB_STATUS_SIMPAN_PILJUR;
		switch($cek_redirect){
			case 1: 
			$data['content']='02_cmahasiswa/s02_vw_data_piljur_pendaftar_s1d3';
			$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_data_piljur_pendaftar_s1d3', $data); 
			break;
			case 2: redirect(''.$url_base.'/data-verifikasi_data'); break;
		}
		}else{
				$data['content']='02_cmahasiswa/s02_vw_form_piljur_pendaftar_s1d3';
				$this->load->view('s00_vw_all', $data);
				// $this->output99->output_display('02_cmahasiswa/s02_vw_form_piljur_pendaftar_s1d3', $data);
		}
		
	}
	
	
	//STEP 2 S1D3
	function orangtua(){
		$KD_PROP='';
		$data['KD_PROP']=$KD_PROP;
		$data_propinsi_list=$this->wilayah->data_propinsi_list();
		$data['PROP_LIST']=$data_propinsi_list;
		$id_user=$this->session->userdata('id_user');
			//PMB_DATA_ORTU_PESERTA
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 36, 'api_search' => array($id_user));
		$data['ortu'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#print_r($data); die();
		/* master kecamatan
		$api_url 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search';
		$parameter_kec  = array('api_kode' =>13000, 'api_subkode' => 6, 'api_search' => array());
		$data['kecamatan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_kec);
		*/
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Data Orang Tua";
		$this->breadcrumb->append_crumb($salam, '/');
		if($data['ortu']==TRUE){
			$data_propinsi=$this->wilayah->data_propinsi_list();
			$data['PROP_LIST']=$data_propinsi;
			$KD_PROP_IBU=$data['ortu'][0]->KD_PROP_IBU;
			$KD_KAB_IBU=$data['ortu'][0]->KD_KAB_IBU;
			$KD_KEC_IBU=$data['ortu'][0]->KD_KEC_IBU;
			$data_kabupaten_list_ibu=$this->wilayah->data_kabupaten_list($KD_PROP_IBU);
			$data['KAB_LIST_IBU']=$data_kabupaten_list_ibu;
			$data_kecamatan_list_ibu=$this->wilayah->data_kecamatan_list($KD_KAB_IBU);
			$data['KEC_LIST_IBU']=$data_kecamatan_list_ibu;
			
			$KD_PROP_AYAH=$data['ortu'][0]->KD_PROP_AYAH;
			$KD_KAB_AYAH=$data['ortu'][0]->KD_KAB_AYAH;
			$KD_KEC_AYAH=$data['ortu'][0]->KD_KEC_AYAH;
			$data_kabupaten_list_ayah=$this->wilayah->data_kabupaten_list($KD_PROP_AYAH);
			$data['KAB_LIST_AYAH']=$data_kabupaten_list_ayah;
			$data_kecamatan_list_ayah=$this->wilayah->data_kecamatan_list($KD_KAB_AYAH);
			$data['KEC_LIST_AYAH']=$data_kecamatan_list_ayah;
			
			$data['content']='02_cmahasiswa/s02_vw_data_orangtua';
			$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_data_orangtua', $data);
		}else{
			$data['content']='02_cmahasiswa/s02_vw_form_data_orangtua';
			$this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_form_data_orangtua', $data);
		}
	}
	
	function prestasi(){
		$id_user=$this->session->userdata('id_user');
		
		//PMB_DATA_PRESTASI_PESERTA
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$salam="Prestasi";
		$this->breadcrumb->append_crumb($salam, '/');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 37, 'api_search' => array($id_user));
		$data['prestasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		// if($data['prestasi']==TRUE){
			// $data['content']='02_cmahasiswa/s02_vw_form_data_prestasi';
			// $this->load->view('s00_vw_all', $data);
			// $this->output99->output_display('02_cmahasiswa/s02_vw_form_data_prestasi');
		// }else{
			// $this->output99->output_display('02_cmahasiswa/s02_vw_form_data_prestasi');
		// }
		$data['TAHUN_DAFTAR']=$this->session->userdata('TAHUN_BAYAR');
		$data['GELOMBANG']=$this->cek_gelombang();
		// print_r($data); die();
		$data['content']='02_cmahasiswa/s02_vw_form_data_prestasi';
		$this->load->view('s00_vw_all', $data);
	}
	
	function verifikasi_data(){
		$data['status']=$this->status_kelengkapan();
		$id_user=$this->session->userdata('id_user');
		//PENYAKIT PESERTA
		$api_url__ 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter__  = array('api_kode' => 192, 'api_subkode' => 6, 'api_search' => array($id_user));
		$data['penyakit'] = $this->s00_lib_api->get_api_jsob($api_url__,'POST',$parameter__);
		$jenis=$this->session->userdata('jenis_penerimaan');
		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Verfikasi Data', '/');
		
		$data['TAHUN_DAFTAR']=$this->session->userdata('TAHUN_BAYAR');
		$data['GELOMBANG']=$this->cek_gelombang();
		$data['JENIS']=$jenis;
		
		switch($jenis){
			case 1 : case 9: #echo "SI/D3"; 
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
				
				//PENDIDIKAN TERAKHIR S1D3
				$id_user=$this->session->userdata('id_user');
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 32, 'api_search' => array($id_user));
				$data['pendidikan_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	#print_r($data['pendidikan_s1d3']);
				$kode_sekolah=$data['pendidikan_s1d3'][0]->PMB_KODE_SEKOLAH;	
				// print_r($data['pendidikan_s1d3']); die();
				
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
				$data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
				
				//PMB_DATA_PRESTASI_PESERTA
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 37, 'api_search' => array($id_user));
				$data['prestasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
				
				//PMB_VERIVIKASI_DATA_PESERTA
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 39, 'api_search' => array($id_user));
				$data['verifikasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				
				
				if($data['prestasi']==FALSE){
					$data['status_prestasi']="Tidak Ada";
				}else{
					$data['status_prestasi']="Ada";
				}
				
				if($data['verifikasi']==TRUE){
					$data['content']='02_cmahasiswa/s02_vw_data_verifikasi_data';
					$this->load->view('s00_vw_all', $data);
					// $this->output99->output_display('02_cmahasiswa/s02_vw_data_verifikasi_data', $data);
				}else{
					$url_base=base_url().$this->session->userdata('status');
					redirect(''.$url_base.'/data-pendaftar'); 
				}
				
			break;
			case 2 :  case 4: case 5: case 8:
				//PMB_VERIVIKASI_DATA_PESERTA
				
					$api_kode=192;
					$api_subkode=18;
				
				$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter_  = array('api_kode' => $api_kode, 'api_subkode' => $api_subkode, 'api_search' => array($jenis));
				$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
				
				$datapost = array(
					'TAHUN' => $this->session->userdata('TAHUN_BAYAR'),
					'JENIS' => $jenis
				
				);
			
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 84, 'api_search' => $datapost);
				$data['jalur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				
				$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
				$parameter  = array('api_kode' => 192, 'api_subkode' => 8, 'api_search' => array($id_user));
				$data['verifikasi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
				
				#print_r($data);
				if($data['verifikasi']==TRUE){
					$data['content']='02_cmahasiswa/s02_vw_data_verifikasi_data';
					$this->load->view('s00_vw_all', $data);
					
					// $this->output99->output_display('02_cmahasiswa/s02_vw_data_verifikasi_data', $data);
				}else{
					$url_base=base_url().$this->session->userdata('status');
					redirect(''.$url_base.'/data-pendaftar'); 
				}
			break;
		}
		
	
	}
	
	
	function create_kartu_ujian_tes(){
		$jenis=$this->session->userdata('jenis_penerimaan');
		echo $jenis;
		// $status=$this->session->userdata('status');
		// echo "<script type='text/javascript'>
								// alert('Ada permasalahan dengan ruang ujian, silahkan coba beberapa saat lagi!!');
								// document.location='http://admisi.uin-suka.ac.id/$status/data-pendaftar';
								// </script>";
		
	}
	
	function create_kartu_ujian(){
		//CEK GELOMBANG
		$jenis=$this->session->userdata('jenis_penerimaan');
				switch($jenis){
					case 1:  case 9: 
					// echo "GELOMBANG YANG ADA DI S1 D3";  die();
					//CEK JALUR dan CEK NOMOR UJIAN -> sudah ada belum?
					$id_user=$this->session->userdata('id_user');
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 12, 'api_search' => array($id_user));
					$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					// print_r($data); die();
					
					$jalur=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
					$no_ujian=$data['piljur'][0]->PMB_NO_UJIAN_PENDAFTAR;
					$ruang_ujian=$data['piljur'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
					$tahun=$data['piljur'][0]->PMB_TAHUN_DAFTAR;
					$datapost = array(
						'PMB_JALUR_PENDAFTARAN' => $jalur,
						'PMB_TAHUN_PENDAFTARAN' => $tahun
					);
					
					
					if($no_ujian==0 AND $ruang_ujian==0){
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 10, 'api_search' => $datapost);
						$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
						 // print_r($data['no_terkahir']); die();
						
						if($data['no_terkahir']==TRUE){
							//Minta id_ruang ujian
							$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
							#echo $nomer_terakhir; die();
							#$nomer_terakhir = substr($nomer_terakhir,4,5); //untuk 9 digit
							$nomer_terakhir = substr($nomer_terakhir,5,5);
							#echo $nomer_terakhir; die();
							$nomer_terakhir = ($nomer_terakhir*1)+1;
							#echo $nomer_terakhir; die();
							$datapost=array(
								'nomer_terakhir' => $nomer_terakhir,
								'kd_jalur' => $jalur
							);
							// print_r($datapost); die();
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter  = array('api_kode' => 192, 'api_subkode' => 40, 'api_search' => $datapost);
							$data['ruang'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
							// print_r($data['ruang']); die();
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
								$jenis=$this->session->userdata('jenis_penerimaan');;
								$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
								switch($gel){
									case 10: $gel=10; break; // gel 1 s1 d3
									#case 11: $gel=2; break; // gel 2 s1 d3
									#case 30: $gel=2; break; // gel 1 s3
								}
								$nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
								// echo $nonya; die();
								$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
									$api_datapost = array(
									$this->session->userdata('id_user'),
									$nonya,
									$id_ruang
									); 
								#print_r($api_datapost); die();
								$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
								'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost));
									if($aksi==TRUE){
								$url_base=base_url().$this->session->userdata('status');
								redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
									}
							}else{	
								$url_base=base_url().$this->session->userdata('status');
								redirect(''.$url_base.'/data-verifikasi_data'); 
							}
						}elseif($data['no_terkahir']==NULL){
							$status=$this->session->userdata('status');
							echo "<script type='text/javascript'>
								alert('Ada permasalahan dengan ruang ujian, silahkan coba beberapa saat lagi!!');
								document.location='http://admisi.uin-suka.ac.id/$status/data-pendaftar';
								</script>";
						}else{
							$url_base=base_url().$this->session->userdata('status');
							redirect(''.$url_base.'/data-verifikasi_data'); 
						}
										
					}else{
						$url_base=base_url().$this->session->userdata('status');
						redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
					}
					
					break;
					
					case 2: 
						// $url_base=base_url().$this->session->userdata('status');
						// redirect(''.$url_base.'/data-verifikasi_data');  die();
						
						//CEK JALUR dan CEK NOMOR UJIAN -> sudah ada belum?
						$id_user=$this->session->userdata('id_user');
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 12, 'api_search' => array($id_user));
						$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
						// print_r($data);die();
						$jalur=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
						$no_ujian=$data['piljur'][0]->PMB_NO_UJIAN_PENDAFTAR;
						$ruang_ujian=$data['piljur'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
						$tahun=$data['piljur'][0]->PMB_TAHUN_DAFTAR;
						switch($jalur){
							case 20: case 21: case 22:
									if($no_ujian==0 AND $ruang_ujian==0){
										//Cek No Terakhir
										// if($jalur==20){
											// $jalur=0;
										// }
										
										$datapost = array(
											'PMB_JALUR_PENDAFTARAN' => $jalur,
											'PMB_TAHUN_PENDAFTARAN' => $tahun
										);
										// print_r($datapost); die();
										$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
										$parameter  = array('api_kode' => 192, 'api_subkode' => 58, 'api_search' => $datapost);
										$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
										// print_r($data['no_terkahir']); die();
										if($data['no_terkahir']==TRUE){
											#print_r($data); die();
											//Minta id_ruang ujian
											$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
											$nomer_terakhir = substr($nomer_terakhir,5,5);
											$nomer_terakhir = ($nomer_terakhir*1)+1;
											// echo $nomer_terakhir; die();
											$datapost = array(
												'NOMOR_TERAKHIR' => $nomer_terakhir,
												'TAHUN' => $tahun,
												'GELOMBANG' => $jalur
											);
											$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
											$parameter  = array('api_kode' => 192, 'api_subkode' => 11, 'api_search' => $datapost);
											$data['ruang'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
											#print_r($data['ruang']); die();
										
											if($data['ruang']==TRUE){
												//update no_ujian //14 2 1 00001
												// if (($nomer_terakhir>=0)&&($nomer_terakhir<10)) $nolny = "0000"; //00001 - 00009
												// elseif (($nomer_terakhir>=10)&&($nomer_terakhir<100)) $nolny = "000"; // 00010 - 00099
												// elseif (($nomer_terakhir>=100)&&($nomer_terakhir<1000)) $nolny = "00"; // 00100 - 99999
												// elseif ($nomer_terakhir>=1000) $nomer_terakhir = "";
												
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
												$jenis=$this->session->userdata('jenis_penerimaan');
												$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
												// echo $gel; die();
												switch($gel){
													#case 10: $gel=1; break; // gel 1 s1 d3
													#case 11: $gel=2; break; // gel 2 s1 d3
													case 20: $gel=20; break; // gel 1 s2
													case 21: $gel=21; break; // gel 1 s2
													case 22: $gel=22; break; // gel 2 s2
													#case 30: $gel=2; break; // gel 1 s3
												}
												$nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
												// $nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
												// echo $nonya; die();
												$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
													$api_datapost = array(
														$this->session->userdata('id_user'),
														$nonya,
														$id_ruang
													); 
												// print_r($api_datapost); die();
												$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
												'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost));
												
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
												
											}else{
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-verifikasi_data'); 
											}
										}else{
											$url_base=base_url().$this->session->userdata('status');
											redirect(''.$url_base.'/data-verifikasi_data'); 
										}
										
									}else{
										$url_base=base_url().$this->session->userdata('status');
										redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
									}
							break;
						
						}
						
					break;
					case 4: 
					case 5:
					case 8: 
						#echo "GELOMBANG YANG ADA DI S3"; 
						//CEK JALUR dan CEK NOMOR UJIAN -> sudah ada belum?
						$id_user=$this->session->userdata('id_user');
						$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
						$parameter  = array('api_kode' => 192, 'api_subkode' => 12, 'api_search' => array($id_user));
						$data['piljur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
						// print_r($data);die();
						$jalur=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
						$no_ujian=$data['piljur'][0]->PMB_NO_UJIAN_PENDAFTAR;
						$ruang_ujian=$data['piljur'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
						switch($jalur){
							case 40: 
								if($no_ujian==0 AND $ruang_ujian==0){
									$datapost=array('JENIS_PENDAFTAR'=>$jenis, 'GELOMBANG' => $jalur, 'TAHUN' => date("Y"));
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 69, 'api_search' => $datapost);
									$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
									#print_r($data); die();
									if($data['no_terkahir']==TRUE){
											#print_r($data); die();
											//Minta id_ruang ujian
											$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
											$nomer_terakhir = substr($nomer_terakhir,5,5);
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
												$jenis=$this->session->userdata('jenis_penerimaan');
												$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
												switch($gel){
													case 40: $gel=40; break; // gel 1 s3 by course
												}
												$nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
												#echo $nonya; die();
												$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
													$api_datapost = array(
														$this->session->userdata('id_user'),
														$nonya,
														$id_ruang
													); 
												#print_r($api_datapost); die();
												$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
												'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost));
												
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
												
											}else{
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-verifikasi_data'); 
											}
									}else{
											$url_base=base_url().$this->session->userdata('status');
											redirect(''.$url_base.'/data-verifikasi_data'); 
										}
								}else{
										$url_base=base_url().$this->session->userdata('status');
										redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
									}
							break;
							case 50: 
								if($no_ujian==0 AND $ruang_ujian==0){
									$datapost=array('JENIS_PENDAFTAR'=>$jenis, 'GELOMBANG' => $jalur, 'TAHUN' => date("Y"));
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 69, 'api_search' => $datapost);
									$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
									#print_r($data); die();
									if($data['no_terkahir']==TRUE){
											#print_r($data); die();
											//Minta id_ruang ujian
											$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
											$nomer_terakhir = substr($nomer_terakhir,5,5);
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
												$jenis=$this->session->userdata('jenis_penerimaan');
												$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
												switch($gel){
													case 50: $gel=50; break; // gel 1 s3 by course Ekonomi Islam
												}
												$nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
												#echo $nonya; die();
												$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
													$api_datapost = array(
														$this->session->userdata('id_user'),
														$nonya,
														$id_ruang
													); 
												#print_r($api_datapost); die();
												$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
												'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost));
												
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
												
											}else{
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-verifikasi_data'); 
											}
									}else{
											$url_base=base_url().$this->session->userdata('status');
											redirect(''.$url_base.'/data-verifikasi_data'); 
										}
								}else{
										$url_base=base_url().$this->session->userdata('status');
										redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
									}
							break;
							case 80: 
								if($no_ujian==0 AND $ruang_ujian==0){
									$datapost=array('JENIS_PENDAFTAR'=>$jenis, 'GELOMBANG' => $jalur, 'TAHUN' => date("Y"));
									$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
									$parameter  = array('api_kode' => 192, 'api_subkode' => 69, 'api_search' => $datapost);
									$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
									// print_r($data); die();
									if($data['no_terkahir']==TRUE){
											#print_r($data); die();
											//Minta id_ruang ujian
											$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
											$nomer_terakhir = substr($nomer_terakhir,5,5);
											$nomer_terakhir = ($nomer_terakhir*1)+1;
											// echo $nomer_terakhir; die();
											
											$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
											$parameter  = array('api_kode' => 192, 'api_subkode' => 51, 'api_search' => array($nomer_terakhir));
											$data['ruang'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
											#print_r($data['ruang']); die();
											if($data['ruang']==TRUE){
												//update no_ujian //14 8 1 00001
												if (($nomer_terakhir>=0)&&($nomer_terakhir<10)) $nolny = "0000"; //00001 - 9
												elseif (($nomer_terakhir>=10)&&($nomer_terakhir<100)) $nolny = "000"; // 00010 - 99
												elseif (($nomer_terakhir>=100)&&($nomer_terakhir<1000)) $nolny = "00"; // 00100 - 999
												elseif (($nomer_terakhir>=1000)&&($nomer_terakhir<10000)) $nolny = "0"; // 001000 - 9999
												elseif ($nomer_terakhir>=10000) $nomer_terakhir = "";
												//14 8 1 00001 S3 Reashc Gelombang 1
												//14 8 2 00001 S3 Reashc Gelombang 2
												
												$ta=$data['piljur'][0]->PMB_TAHUN_DAFTAR;
												#$ta= explode('/', $ta);
												#$ta= $ta[0];
												$ta = substr($ta, 2); 
												$jenis=$this->session->userdata('jenis_penerimaan');
												$gel=$data['piljur'][0]->PMB_JALUR_PENDAFTARAN;
												switch($gel){
													case 80: $gel=80; break; // gel 1 s3 by r
												}
												$nonya = $ta."".$jenis."".$gel."".$nolny."".$nomer_terakhir;
												// echo $nonya; die();
												$id_ruang=$data['ruang'][0]->PMB_ID_RUANG;
													$api_datapost = array(
														$this->session->userdata('id_user'),
														$nonya,
														$id_ruang
													); 
												#print_r($api_datapost); die();
												$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 
												'POST', array('api_kode'=>10, 'api_subkode' => 7, 'api_search' => $api_datapost));
												
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
												
											}else{
												$url_base=base_url().$this->session->userdata('status');
												redirect(''.$url_base.'/data-verifikasi_data'); 
											}
									}else{
											$url_base=base_url().$this->session->userdata('status');
											redirect(''.$url_base.'/data-verifikasi_data'); 
										}
								}else{
										$url_base=base_url().$this->session->userdata('status');
										redirect(''.$url_base.'/data-cetak_kartu_ujian'); 
									}
							break;
						}
						
					break;
				}
		
	}
	
	function cetak_biodata(){
	$id_user=$this->session->userdata('id_user');
	$jenis=$this->session->userdata('jenis_penerimaan');
		#$id_user="R98X546X5P6M5ADZ";
		#$jenis=1;
		
			switch($jenis){
				case 1: case 9:
					//S1 d3 cetak biodata
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 42, 'api_search' => array($id_user));
					$data['cetak_biodata'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data);
					
					if($data['cetak_biodata']==TRUE){
						$no_ujian=$data['cetak_biodata'][0]->PMB_NO_UJIAN_PENDAFTAR;
						$ruang_ujian=$data['cetak_biodata'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
						if($no_ujian==0 AND $ruang_ujian==0){
							$url_base=base_url().$this->session->userdata('status');
							redirect(''.$url_base.'/data-create_kartu_ujian'); 
						}else{
							// MASTER JURUSAN SEKOLAH
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter_jus  = array('api_kode' => 192, 'api_subkode' => 34, 'api_search' => array());
							$data['jurusan_sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_jus);	
							#print_r($data['jurusan_sekolah']);
					
							// $kode_sekolah=$data['cetak_biodata'][0]->PMB_KODE_SEKOLAH;	
							
							// NAMA SEKOLAH PESERTA
							// $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							// $parameter_nsp  = array('api_kode' => 192, 'api_subkode' => 35, 'api_search' => array($kode_sekolah));
							// $data['nama_sekolah_peserta'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter_nsp);
							// #print_r($data['nama_sekolah_peserta']);
							
							
							$id_user=$this->session->userdata('id_user');
							$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
							$parameter  = array('api_kode' => 192, 'api_subkode' => 32, 'api_search' => array($id_user));
							$data['pendidikan_s1d3'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
								
							// print_r($data['pendidikan_s1d3']); die();
								$this->load->view('02_cmahasiswa/s02_vw_cetak_biodata_s1d3', $data);
						}
					}
				break;
				case 2: 
				case 4: 
				case 5: 
				case 8:
					#$data['pendaftar']=$this->pendaftar();
					//PMB_VERIVIKASI_DATA_PESERTA
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 9, 'api_search' => array($id_user));
					$data['cetak_biodata'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
					#print_r($data); die();
					if($data['cetak_biodata']==TRUE){
							$no_ujian=$data['cetak_biodata'][0]->PMB_NO_UJIAN_PENDAFTAR;
							$ruang_ujian=$data['cetak_biodata'][0]->PMB_ID_RUANG_UJIAN_PENDAFTAR;
						if($no_ujian==0 AND $ruang_ujian==0){
							$url_base=base_url().$this->session->userdata('status');
							redirect(''.$url_base.'/data-create_kartu_ujian'); 
						}else{
							$this->load->view('02_cmahasiswa/s02_vw_cetak_biodata', $data);
						}
					}
				break;
			}
	}
	
	function cetak_kartu_ujian(){
		$jenis=$this->session->userdata('jenis_penerimaan');
		switch($jenis){
		case 1: case 9:
			$id_user=$this->session->userdata('id_user');
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
			$id_user=$this->session->userdata('id_user');
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
			// print_r($data['cetak_kartu_ujian']); DIE();
			
			$datapost = array(
				'TAHUN' => $this->session->userdata('TAHUN_BAYAR'),
				'JENIS' => $jenis
			
			);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 84, 'api_search' => $datapost);
			$data['jalur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			// print_r($data['jalur']); DIE();
			if($data['cetak_kartu_ujian']==TRUE){
				$this->load->view('02_cmahasiswa/s02_vw_cetak_kartu_ujian_s1d3', $data);
			} 
		break;
		case 2: case 3:
			$id_user=$this->session->userdata('id_user');
			#$data['pendaftar']=$this->pendaftar();
			//PMB_VERIVIKASI_DATA_PESERTA
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 13, 'api_search' => array($id_user));
			$data['cetak_kartu_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			//print_r($data['cetak_kartu_ujian']);
			//MASTER PRODI S2
			$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter_  = array('api_kode' => 192, 'api_subkode' => 18, 'api_search' => array());
			$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
			
			// echo "<pre>"; print_r($data['master_prodi']); echo "</pre>"; die();
			
			$datapost = array(
				'TAHUN' => $this->session->userdata('TAHUN_BAYAR'),
				'JENIS' => $jenis
			
			);
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 84, 'api_search' => $datapost);
			$data['jalur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			
			if($data['cetak_kartu_ujian']==TRUE){
				$this->load->view('02_cmahasiswa/s02_vw_cetak_kartu_ujian', $data);
			}
		break;
		case 4: case 5: case 8:
			$id_user=$this->session->userdata('id_user');
			
			//MASTER PRODI S3
			$api_url_ 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter_  = array('api_kode' => 192, 'api_subkode' => 49, 'api_search' => array());
			$data['master_prodi'] = $this->s00_lib_api->get_api_jsob($api_url_,'POST',$parameter_);
			
			$datapost = array(
				'TAHUN' => $this->session->userdata('TAHUN_BAYAR'),
				'JENIS' => $jenis
			
			);
			
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 84, 'api_search' => $datapost);
			$data['jalur'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			
			$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
			$parameter  = array('api_kode' => 192, 'api_subkode' => 52, 'api_search' => array($id_user));
			$data['cetak_kartu_ujian'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
			// echo "<pre>"; print_r($data); echo "</pre>";die();
			if($data['cetak_kartu_ujian']==TRUE){
				$this->load->view('02_cmahasiswa/s02_vw_cetak_kartu_ujian_s3', $data);
			}
		break;
		}
	}
	
	function ubah_foto(){
		//CEK STATUS simpan
		$id_user=$this->session->userdata('id_user');
		// $api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		// $parameter  = array('api_kode' => 192, 'api_subkode' => 20, 'api_search' => array($id_user));
		// $data['cek_status_simpan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array($id_user));
		$data['pendaftar'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);			
		#print_r($data);
		#echo $data['cek_status_simpan'][0]->PMB_STATUS_SIMPAN_PENDAFTAR;
						$this->breadcrumb->append_crumb('Beranda', base_url());
						$salam="Ubah Foto";
						$this->breadcrumb->append_crumb($salam, '/');
				if($data['pendaftar'][0]->PMB_STATUS_SIMPAN_PENDAFTAR==1){
					#edit 
								$jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
								// switch($jenis_pendaftar){
								// case 1 : 
								// $this->output99->output_display('02_cmahasiswa/s02_vw_ubah_foto', $data); 
								$data['jenis']=$jenis_pendaftar;
								$data['content']='02_cmahasiswa/s02_vw_ubah_foto';
								$this->load->view('s00_vw_all', $data);
								
								// break;
								
								// default : 
								// $data['content']='02_cmahasiswa/s02_vw_ubah_foto';
								// $this->load->view('s00_vw_all', $data);
								// $this->output99->output_display('02_cmahasiswa/s02_vw_ubah_foto'); 
								// break;
				
				}else{
					$url_base=base_url().$this->session->userdata('status');
					redirect(''.$url_base.'/data-verifikasi_data'); 
				}
	}
 
function init_upload(){
	if($this->input->post('step')=='prestasi'){
		$TAHUN_DAFTAR= $_POST['TAHUN_DAFTAR'];
		$GELOMBANG= $_POST['GELOMBANG'];
		if(isset($_POST['status_prestasi'])=='1'){
			$pesan = "<div class='bs-callout bs-callout-success'>Tidak Ada Perubahan</div>";
			$hasil = "tidak_berubah";
			echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
		}else{
			$file = $_FILES["userfile"]["name"];
			
			// $status_iya = $this->input->post('status_prestasi');
			if(empty($file)){
				$pesan = "<div class='bs-callout bs-callout-success'>Tidak Ada Prestasi</div>";
				$hasil = "tidak_berubah";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			// }elseif(empty($status_iya)){
				// $pesan = "<div class='bs-callout bs-callout-success'>Tidak Ada Prestasi</div>";
				// $hasil = "tidak_berubah";
				// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			// }elseif($status_iya==2){
				// $pesan = "<div class='bs-callout bs-callout-success'>Tidak Ada Prestasi</div>";
				// $hasil = "tidak_berubah";
				// echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}else{
				$jenis=$this->session->userdata('jenis_penerimaan');
				$config['upload_path']   =   "sertifikat_files/".$this->session->userdata('status')."/".$TAHUN_DAFTAR."/".$GELOMBANG;
				$config['allowed_types'] =   "jpg"; 
				$config['max_size']      =   "1024";
				//$config['max_width']     =   "1907";
				//$config['max_height']    =   "1280";
				$config['overwrite']    =   true;
				$config['file_name']     =   $this->session->userdata('id_user')."-sertifikat-".$jenis.".jpg";
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload()){
					$error=$this->upload->display_errors();
					$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
					$hasil = "gagal";
					echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
				}else{	
						$id_user=$this->session->userdata('id_user');
						$jenis=$this->session->userdata('jenis_penerimaan');
						$sertifikat=$this->session->userdata('id_user')."-sertifikat-".$jenis.".jpg";
						
						$api_datapost = array(
									'PMB_PIN_PENDAFTAR'=> $id_user,
									'PMB_TAHFIDZ_30JUZ'=> 1,
									'PMB_SCAN_SERTIFIKAT'=> $sertifikat,
									'PMB_STATUS_SIMPAN_PRESTASI'=> 1
						);
				// print_r($api_datapost); die();
				$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 17,'api_search' => $api_datapost));
					if($aksi==TRUE){
					$finfo=$this->upload->data();
						if($finfo==TRUE){ 
							$msg="Berhasil Input Sertifikat";
							$pesan = "<div class='bs-callout bs-callout-success'>".$msg."</div>";
							$hasil = "sukses";
							echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
						}
					}else{
						$pesan = "<div class='bs-callout bs-callout-success'>Tidak Ada Prestasi</div>";
						$hasil = "tidak_berubah";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));

					}
				}
			
			}
		}
		
	}else{
		$file = $_FILES["userfile"]["name"];
		// $ext = end(explode('.', $file));
		$TAHUN_DAFTAR= $_POST['TAHUN_DAFTAR'];
		$GELOMBANG= $_POST['GELOMBANG'];
		if(empty($file)){
			$pesan = "<div class='bs-callout bs-callout-error'>Tidak Ada Perubahan</div>";
			$hasil = "tidak_berubah";
			echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
		}else{
			$jenis=$this->session->userdata('jenis_penerimaan');
			// if($jenis==8){
				// $config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status');
			// }else{
				$config['upload_path']   =   "img_pendaftar/".$this->session->userdata('status')."/".$TAHUN_DAFTAR."/".$GELOMBANG;
			// }
			$config['allowed_types'] =   "jpg"; 
			$config['max_size']      =   "1024";
			//$config['max_width']     =   "1907";
			//$config['max_height']    =   "1280";
			$config['overwrite']    =   true;
			$config['file_name']     =   $this->session->userdata('id_user')."-foto-".$jenis.".jpg";
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload()){
				$error=$this->upload->display_errors();
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				$hasil = "gagal";
				echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
			}else{
				$finfo=$this->upload->data();
				// print_r($finfo); 
					if($finfo==TRUE){ 
						$msg="Berhasil Merubah Foto";
						$pesan = "<div class='bs-callout bs-callout-success'>".$msg."</div>";
						$hasil = "sukses";
						echo json_encode(array('pesan' => $pesan, 'hasil' => $hasil));
					}
			}
		}
	}
}
	
	function beranda(){
		//DATA LIPUTAN
		$api_url 	= URL_API_ADMISI.'admisi_pengumuman/data_view';
		$parameter  = array('api_kode' => 88001, 'api_subkode' => 4, 'api_search' => array());
		$data['liputan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data);
		#echo $data['liputan'][0]->PG_JUDUL;
		#echo $data['liputan'][0]->['PG_JUDUL'];
		$this->output99->output_display('02_cmahasiswa/s02_vw_beranda', $data);
	
	}
	
	function dropdown_nama_sekolah(){
	if($this->input->post('op')=='prop'){
	
		$id=$this->input->post('val');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 29, 'api_search' => array($id));
		$data['kabupaten'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
        $li_kab = '<option value="">-Pilih Kabupaten-</option>';
		foreach ($data['kabupaten'] as $value) {
			$li_kab .= '<option value='.$value->KODE_KABUPATEN.'>'.$value->NAMA_KABUPATEN.'</option>';
		}
        #$ul_kab = '<select class="wil" id="kab" style="margin-bottom: 0px">'.$li_kab.'</select>'; 
        echo $li_kab;
		
    }elseif($this->input->post('op')=='kab'){
		$id=$this->input->post('kab');
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 30, 'api_search' => array($id));
		$data['sekolah'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
        $li_sek = '<option value="">-Pilih Sekolah-</option>';
		foreach ($data['sekolah'] as $value) {
			$li_sek .= '<option value='.$value->KODE_SEKOLAH.'>'.$value->NAMA_SEKOLAH.'</option>';
		}
		#$ul_sekolah = '<select class="wil" id="sek" style="margin-bottom: 0px">'.$li_sek.'</select>'; 
		echo $li_sek;
	
	}elseif($this->input->post('simpan')=='SIMPAN'){
		$propinsi=$this->input->post('propinsi');
		$kabupaten=$this->input->post('kabupaten');
		$sekolah=$this->input->post('sekolah');
		$sekolah_lain=$this->input->post('sekolah_lain');
		$skl = substr($sekolah, -4);
		if($skl==9999){
			echo $propinsi."-".$kabupaten."-".$sekolah."-".$sekolah_lain;
		}else{
			echo $propinsi."-".$kabupaten."-".$sekolah;
		}
	}else{
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 28, 'api_search' => array());
		$data['propinsi'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		#$this->output99->output_display('02_cmahasiswa/s02_vw_form_change_dropdown', $data);
	
	}
	}
	
	
	function get_negara(){
		$api_url 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_view';
		$parameter  = array('api_kode' =>11001, 'api_subkode' => 2, 'api_search' => array());
		$data = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		return $data;
	}
	
	
	function data_propinsi_list(){
		$api_url 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_view';
		$parameter  = array('api_kode' =>11000, 'api_subkode' => 1, 'api_search' => array());
		$data = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		return $data;
	}
	
	// 
	function kabupaten_cari(){
		$katakunci=$this->input->post('katakunci');
		$lokasi_balik=$this->input->post('lokasi_balik');
		$lokasi=$this->input->post('lokasi');
		$lokasi_tampil=$this->input->post('lokasi_tampil');
		if($katakunci){
			$data	= $this->data_kabupaten($katakunci);
			$data['isi']=$data;
			//$data['lokasi']=$lokasi;			
			if($lokasi_balik=='KD_KAB'){
				$propinsi="1";
			}else{
				$propinsi='0';
			}
			$data['propinsi']=$propinsi;
			$data['lokasi_balik']=$lokasi_balik;
			$data['lokasi']="$lokasi#$lokasi_balik#$lokasi_tampil";
			$this->load->view('02_cmahasiswa/v_ajax_kab',$data);
		}else{
			echo "";
		}
	}
	
	//DATA KABUPATEN
	function data_kabupaten($katakunci){
		$CI=&get_instance();
		$data1	= array($katakunci);	
		$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
					array('api_kode'=>12000, 'api_subkode' => 3, 'api_search' => $data1));
		return $isi2;
	}
	

	

	// function cek_gelombang(){
		// #echo $this->session->userdata('tgl_bayar');
		// #echo "<br /><br />";
		// $jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
			// switch($jenis_pendaftar){
				// case 1:
					// $tanggal_tutup="08-07-2014";
					// $jam_tutup = "23:59";
					// $exp_t=strtotime($tanggal_tutup);
					// $exp_h=strtotime($jam_tutup);
					// $expired_date= $exp_t + $exp_h;
					// #echo $expired_date;
					// #echo "<br /><br /><br />";
				// break;
				// case 2:
					// $tanggal_tutup="20-06-2014";
					// $jam_tutup = "23:59";
					// $exp_t=strtotime($tanggal_tutup);
					// $exp_h=strtotime($jam_tutup);
					// $expired_date= $exp_t + $exp_h;
					// #echo $expired_date;
					// #echo "<br /><br /><br />";
				// break;
				// case 4:
					// $tanggal_tutup="30-08-2014";
					// $jam_tutup = "23:59";
					// $exp_t=strtotime($tanggal_tutup);
					// $exp_h=strtotime($jam_tutup);
					// $expired_date= $exp_t + $exp_h;
					// #echo $expired_date;
					// #echo "<br /><br /><br />";
				// break;	
				// case 5:
					// $tanggal_tutup="12-08-2014";
					// $jam_tutup = "23:59";
					// $exp_t=strtotime($tanggal_tutup);
					// $exp_h=strtotime($jam_tutup);
					// $expired_date= $exp_t + $exp_h;
					// #echo $expired_date;
					// #echo "<br /><br /><br />";
				// break;	
				// case 8:
					// $tanggal_tutup="4-11-2014";
					// $jam_tutup = "23:59";
					// $exp_t=strtotime($tanggal_tutup);
					// $exp_h=strtotime($jam_tutup);
					// $expired_date= $exp_t + $exp_h;
					// #echo $expired_date;
					// #echo "<br /><br /><br />";
				// break;
				
			// }
				
		// $tgl_jam= explode(" ",$this->session->userdata('tgl_bayar'));
		// $tgl_bayar=explode("/",$tgl_jam[0]);
		// $tanggal_bayar=$tgl_bayar[0]."-".$tgl_bayar[1]."-".$tgl_bayar[2];
		// $jam=$tgl_jam[1];
		// $t = strtotime($tanggal_bayar);
		// $h = strtotime($jam);
		// $t_b = $t+$h;
		// #echo $t_b;
		
		// if($t_b <= $expired_date){
			// $jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
			// switch($jenis_pendaftar){
				// case 1:
					// #echo "S1 D3 GELOMBANG 1";
					// $gel=10;
				// break;
				// case 2:
					// #echo "S2 GELOMBANG 1";
					// $gel=20;
				// break;
				// case 4: 
					// $gel=40;
				// break;
				// case 5: 
					// $gel=50;
				// break;
				// case 8: 
					// $gel=80;
				// break;
			// }
		// }else{
			// $jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
			// switch($jenis_pendaftar){
				// case 1: 
					// $gel=11;
				// break;
				// case 2:
					// #echo "S2 GELOMBANG 2";
					// $gel=21;
				// break;
				// case 4: 
					// $gel=41;
				// break;
				// case 5: 
					// $gel=51;
				// break;
				// case 8: 
					// $gel=81;
				// break;
			// }
		// }
		// return $gel;
	// }
	
	
	function cek_gelombang(){
		$jenis_pendaftar=$this->session->userdata('jenis_penerimaan');
		$TAHUN_BAYAR=$this->session->userdata('TAHUN_BAYAR');
		// echo $jenis_pendaftar; die();
		$api_datapost = array(
			'PMB_KODE_JENIS_PENERIMAAN' => $jenis_pendaftar,
			'TAHUN' => $TAHUN_BAYAR
		);
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 16, 'api_search' => $api_datapost);
		$GELOMBANG = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		// print_r($GELOMBANG); DIE();
		if($GELOMBANG==TRUE){
			// $jam_tutup=date("H:i:s", strtotime($GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR));
			// $tanggal_tutup=date("d/m/Y", strtotime($GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR));
			$tanggal_tutup=$GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR;
			$jam_tutup="23:59";
			$exp_t=strtotime($tanggal_tutup);
			$exp_h=strtotime($jam_tutup);
			$expired_date= $exp_t + $exp_h;
			
			//jam tanggal bayar e
			$tgl_jam= explode(" ",$this->session->userdata('tgl_bayar'));
			$tgl_bayar=explode("/",$tgl_jam[0]);
			$tanggal_bayar=$tgl_bayar[0]."-".$tgl_bayar[1]."-".$tgl_bayar[2];
			$jam=$tgl_jam[1];
			$t = strtotime($tanggal_bayar);
			$h = strtotime($jam);
			$t_b = $t+$h;
			
				if($t_b <= $expired_date){
					$gel=$GELOMBANG[0]->PMB_KODE_JALUR_MASUK;
				}else{
					$gel=$GELOMBANG[0]->PMB_KODE_JALUR_MASUK + 1;
				}
			
		}else{
			$gel=0;
		}
		
		return $gel;
		// echo $gel;
	}
	
	function session_print(){
		print_r($_SESSION);
		// $tgl_jam= explode(" ",$this->session->userdata('tgl_bayar'));
		// $tgl_bayar=explode("/",$tgl_jam[0]);
		// $tanggal_bayar=$tgl_bayar[0]."-".$tgl_bayar[1]."-".$tgl_bayar[2];
		// $tanggal_bayar=strtotime($tanggal_bayar);
		// echo $tanggal_bayar;
		
		$a1=strtotime("29-04-2015");
		$a=strtotime("11:29:26");
		$aa=$a1+$a;
		
		$b1=strtotime("29-05-2015");
		$b=strtotime("23:59:59");
		$bb=$b1+$b;
		
		if($aa<=$bb){
			
		echo $aa."-".$bb;
			
		}
		
	}
	function cek_tutup(){
		//SEKARANG
		error_reporting(0);
		$today = date("d-m-Y");
		$today_hour = date("H:m");
		$today=strtotime($today);
		$today_hour=strtotime($today_hour);
		$today_h=$today+$today_hour;
		
		//TANGGAL BAYAR
		$tgl_jam= explode(" ",$this->session->userdata('tgl_bayar'));
		$tgl_bayar=explode("/",$tgl_jam[0]);
		$tanggal_bayar=$tgl_bayar[0]."-".$tgl_bayar[1]."-".$tgl_bayar[2];
		$jam=$tgl_jam[1];
		// echo $tanggal_bayar;
		$t = strtotime($tanggal_bayar);
		// echo $t; die();
		$h = strtotime($jam);
		// $h = 0;
		$t_b = $t+$h;
		$JENIS_PENDAFTAR=$this->session->userdata('jenis_penerimaan');
		$TAHUN=$tgl_bayar[2];
		$api_datapost = array(
						'PMB_KODE_JENIS_PENERIMAAN'=> $JENIS_PENDAFTAR,
						'TAHUN'=> $TAHUN
			);
		// print_r($jenis_pendaftar); die();
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 16, 'api_search' => $api_datapost);
		$GELOMBANG = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		// print_r($GELOMBANG); die();
		// $tanggal_tutup=date("d/m/Y", strtotime($GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR));
		// $tanggal_tutup=strtotime($GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR);
		if(!empty($GELOMBANG)){
			$tanggal_tutup=$GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR;
			// echo $GELOMBANG[0]->PMB_TANGGAL_AKHIR_DAFTAR;
			$jam_tutup="23:59:59";
			$exp_t=strtotime($tanggal_tutup);
			$exp_h=strtotime($jam_tutup);
			$expired_date= $exp_t + $exp_h;
		}
		//PENENTUAN GELOMBANG
		if($t_b <= $expired_date){
			$gelombang=1;
		}else{
			$gelombang=2;
		}
		
		// echo $gelombang; die();
		// echo $gelombang; die();
				if($gelombang==1){
					if($today_h <= $expired_date){
						$izin=1;				
					}else{
						$izin=2;
					}
				}elseif($gelombang==2){
					$izin=2;
				}
		return $izin;
		// echo $izin;
	}
	
	function cek_exp(){
		$gel=$this->cek_gelombang();
		$tutup=$this->cek_tutup();
		if($tutup==1){
			$status="Diizikan";
		}else{
			$status="Tidak Diizikan, Sudah Tutup";
		}
		echo "<pre>PIN => ".$this->session->userdata('id_user')."<br />";
		echo "TANGGAL-PEMBAYARAN => ".$this->session->userdata('tgl_bayar')."<br />";
		echo "JENIS-PENDAFTAR => ".strtoupper ($this->session->userdata('status'))."<BR />";
		#echo "JENIS-PENDAFTAR => KODE-JALUR => ".$gel."<br />";
		echo "STATUS AKSES => ".$status."</pre>";
	}
	
}