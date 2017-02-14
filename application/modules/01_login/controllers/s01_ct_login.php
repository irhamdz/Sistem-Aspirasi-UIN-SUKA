<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author		: Wihikan Mawi Wijna
	Created		: 13:13 31/05/2013 

	s01			: sia "kamar" 01, (s00, s01, s02, ..., s99)
	ct			: ct = controller, vw = view, mdl = model, lib = library
	login		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S01_ct_login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->api 		= $this->s00_lib_api;
		$this->output9	= $this->s00_lib_output;
		
		$this->load->library('s01_lib_auth','','auth');
		$this->load->library('s01_lib_warning','','warning');
		$this->load->library('s00_lib_general');
		$this->load->library('s00_lib_siaenc');
		
		$this->menu7	= $this->s00_lib_sh_menu;
		
		$this->menu7->set_var('url_link','login');
		$this->menu7->set_var('url_prefix','.html');
		
		$this->session->set_userdata('app','login');
		#	= $this->s00_lib_api;h
	}
	
	function index(){
		// echo 'tes'; die();

		if($this->auth->is_login()){ 
			$this->auth->redirect_menu(); 
		}else{ 
			$this->_awal_login(); 
		}
	}
	
	private function _get_portal_api(){
		return array(
			'api_agenda'	=> $this->api->get_api_json('http://www.uin-suka.ac.id/service/agenda/5','GET'),
			'api_berita'	=> $this->api->get_api_json('http://www.uin-suka.ac.id/service/berita/5','GET'),
			'api_peng'		=> $this->api->get_api_json('http://www.uin-suka.ac.id/service/pengumuman/5','GET'),
		);
	}
	
	private function _000_text_captcha(){
		$arr1 = array(	'2m7xp',
						'l20fc',
						'4v0ak',
						'bnspt',
						'2x93n',
						
						'l3wh2',
						'2cps8',
						'14c9b',
						'0z2pk',
						'29dj4',

						'ajwmg',
						'wpngk',
						'synpq',
						'hapdm',
						'bqp4e');
		
		$i = fmod(date('s'),15);
		$j = fmod(date('i'),2);
		$k = $arr1[$i];
		#$l = fmod(date('s')+$i,10);
		$l = mt_rand(1,9);
		if($j) { $k = strrev($k); }
		
		$string = mt_rand(10,99).strtoupper($k).$l;
		$string1 = '';
		for($t = 0; $t < strlen($string); $t++){
		$string1 .= $string[$t].' ';
		}
		$string1 = str_replace('0','0',$string1);
		$string1 = str_replace('O','0',$string1);
		$string1 = str_replace('I','1',$string1);
		$string1 = str_replace('S',mt_rand(3,8),$string1);
		
		return $string1;
	}
	
	function err_404($error = array()){
		error_reporting(0);
		$data			= $this->_get_portal_api();
		$data['error'] 	= $error;
		$data['content']='s00_vw_error';
		$this->load->view('s00_vw_all', $data);
		// $this->output9->output_display('s00_vw_error', array('data' => $data)); }
	}
	function _awal_login(){
		$data 	= array();
		#echo 'halt'; }
		#$data	= $this->_get_portal_api();
		
		if(isset($_POST['kategori_hash'])){
			#$kode1 = $this->s00_lib_siaenc->decrypt($_POST['kategori_hash']);
			$kode2 = explode('//', $this->s00_lib_siaenc->decrypt($_POST['kategori_hash']));
			if((count($kode2) == 2) && (intval($kode2[1]) > 99)){ 
				switch($kode2[0]){ 
					case '100':
						$api1 = $this->api->get_api_json('http://www.uin-suka.ac.id/service/pengumuman/5','GET');
						for($j = 0; $j < (count($api1)); $j++){
							$jd = $d[$j]['judul'];
							echo '<li class="home"><div class="title">'; 
							echo anchor($api1[$j]['url'], character_limiter($jd,40),'title="'.$jd.'"').'</div>';
							echo '<div class="pojok '.strtolower($api1[$j]['jenis']).'"></div>
							<div class="underline-menu"></div></li>';
						}
					break;
					case '105':
						$api1 = $this->api->get_api_json('http://www.uin-suka.ac.id/service/berita/5','GET');
						for($j = 0; $j < (count($api1)); $j++){
							$jd = $api1[$j]['judul'];
							echo '<li class="home"><div class="title">'; 
							echo anchor($api1[$j]['url'], character_limiter($jd,40),'title="'.$jd.'"').'</div>';
							echo '<div class="pojok '.strtolower($api1[$j]['jenis']).'"></div>
							<div class="underline-menu"></div></li>';
						}
					break;
					case '110':
						$api1 = $this->api->get_api_json('http://www.uin-suka.ac.id/service/agenda/5','GET');
						
						for($j = 0; $j < (count($api1)); $j++){
							$tgl0 = date('d/m/Y h:i:s',strtotime($api1[$j]['tanggal']));
							$tgl1 = date_trans_foracle($tgl0, 1, '0 200 000', ' ');
							$tgl2 = date_trans_foracle($tgl0, 1, '0 030 000', ' ');
							
							echo '<div class="dateblock">';
							echo '<div class="day">'.$tgl1.'</div>';
							echo '<div class="month">'.substr($tgl2,0,3).'</div>';
							echo '</div>';
							echo '<div class="datetext">';
							echo '<p class="col-title" style="text-align:left;">'.anchor($api1[$j]['url'],character_limiter($api1[$j]['nama_agenda'],40),'title="'.$api1[$j]['nama_agenda'].'"').'</p>';
							echo '<div class="divline-solid nopadtop"></div>';
							echo '</div>';
							echo '<div class="underline-menu"></div>';
						}
					break;
				}
			}
		} else {
			$data['menu_logon'] = true;
			
			
			$data['pengumuman2']= $this->api->get_api_json(URL_API_ADMISI.'admisi_pengumuman/data_view', 'POST', 
			array('api_kode'=>88002, 'api_subkode' => 4, 'api_search' => array('ADM')));
			
			
		#	$data['pengumuman2']['p2'] = array(1,2,3,4,5);
			// echo "<pre>"; print_r($data); echo "</pre>"; die();
			$data['url_d0'] = $this->menu7->build_url_var('v0b0','%LINK%', 'informasi');
			$data['url_d1'] = $this->menu7->build_url_var('v0b1','%LINK%', 'informasi');
			$data['url_d2'] = $this->menu7->build_url_var('v0b2','%LINK%', 'informasi');
			$data['url_d3'] = $this->menu7->build_url_var('v0b3','%LINK%', 'informasi');
			$data['url_d10'] = $this->menu7->build_url_var('v0b10','%LINK%', 'informasi');
			
			$data['url_d4'] = $this->menu7->build_url_var('v0b4','%LINK%', 'informasi');
			$data['url_d5'] = $this->menu7->build_url_var('v0b5','%LINK%', 'informasi');
			$data['url_d6'] = $this->menu7->build_url_var('v0b6','%LINK%', 'informasi');
			$data['url_d7'] = $this->menu7->build_url_var('v0b7','%LINK%', 'informasi');
			$data['url_d8'] = $this->menu7->build_url_var('v0b8','%LINK%', 'informasi');
			$data['url_d9'] = $this->menu7->build_url_var('v0b9','%LINK%', 'informasi');
			// print_r($data['url_d1']); die();
			$data['pengumuman1'] = $this->api->get_api_json(URL_API_ADMISI.'admisi_pengumuman/data_view', 'POST', 
			array('api_kode'=>88001, 'api_subkode' => 4));
			// print_r($data); die();
			#$this->session->set_userdata('cap000', $this->_000_text_captcha());
			if(!isset($_COOKIE['cap001'])){
			setcookie('cap001', t1_encode($this->_000_text_captcha()), time()+60);
			$_COOKIE['cap001'] = t1_encode($this->_000_text_captcha());
			}
			#sia_comment($data);			
			$data['cok1'] = $_COOKIE['cap001'];
			
			$data['content']='01_login/def/s01_vw_login_02warning';
			// print_r($data); die();
			
			$this->load->view('s00_vw_all', $data);
			
		}
	}
	
	function init_login_calon() #sigit
	{
		error_reporting(0);
		// print_r($_POST); die();
		$u1 	= $this->input->post('logu1');
		$p1 	= $this->input->post('logp1');
		$ln="";
		if(preg_match("/@/", $u1)){$ln=1;} //email bukan

		/* 
			1. cek api sibayar 
			2. cek reversal (logout)/ xxx (masuk)
			3. dpt data 1 - 8 ---->>> 1->(if S1/D3 -> /pmb, 2-8 -> if S2/S3 -> /pasca, else ke init_login masuk ke AD)
			
			#(12312312 ABCABC123123 | XXX) (masuk)
			#(12398760 G9N87F12X2N35ZGZ | reversal) (logout)
		
		if($u1!=='12312311' AND $u1!=='12312312' AND $u1!=='12312314' AND $u1!=='12312315' AND $u1!=='199111280000001101'){
			$this->warning->set_error('proses'); 
			redirect('login','refresh');					
		}else{  
		*/
		// $ad=$this->init_login($u1,$p1);
		// print_r($ad); die();
		$hsl = $this->auth->get_sibayar_check($u1,$p1);
		// print_r($hsl); die();
		if(!isset($hsl['status'])){
				$jenis = $hsl['JENIS_PMB'];
				$tgl_bayar = $hsl['TGL_BAYAR'];
				$TAHUN_BAYAR = explode(" ", $hsl['TGL_BAYAR']);
				$TAHUN_BAYAR = explode("/",$TAHUN_BAYAR[0]);
				$TAHUN_BAYAR = $TAHUN_BAYAR[2];
				#echo $jenis; die();
				// echo $tgl_bayar; die();
				#echo $TAHUN_BAYAR; die();
				#echo $hsl['LOG_PMB']; die();
				if(strtoupper($hsl['LOG_PMB']) == 'XXX'){
					#pemisahan jenis jalur pendaftaran -> 1 2 3 4 5 6 7 8 DSB
					switch($jenis){
						case 1 : case 9 : $stat = 'pmb'; break;
						case 2 : 
						#2014-06-16 16:00
						#$expired_login = 
						$stat = 's2'; break;
						case 3 : case 6: case 7: 
						#echo "Belum dibuka"; die();
						$err = "bb";
						$this->warning->set_error($err); 
						redirect('login','refresh'); 
						#redirect('logout','refresh'); 
						// echo "<script type='text/javascript'>
								// alert('Jalur Yang Anda Pilih Belum dibuka');
								// document.location='http://admisi.uin-suka.ac.id/logout';
								// </script>";
						break;
						case 4 : case 5 : case 8 : $stat = 's3'; break;
						default : $stat = ''; break;
					}
					#echo $stat; 
					// echo $hsl['LOG_PMB'].$hsl['JENIS_PMB']; die();
					$this->auth->set_session_cmhs($u1, $p1, $stat, $jenis, $tgl_bayar, $TAHUN_BAYAR);
				}elseif(strtoupper($hsl['LOG_PMB']) == 'REVERSAL'){
						$err = 'REVERSAL';
						$this->warning->set_error($err); 
						redirect('login','refresh'); 
					// echo "<script type='text/javascript'>
								// alert('Maaf, Anda telah melakukan pembatalan Pendaftaran sebelumnya');
								// document.location='http://admisi.uin-suka.ac.id/logout';
								// </script>";
				}
		}elseif($ln==1){
		$stat="matrikulasi";
		if(filter_var($u1, FILTER_VALIDATE_EMAIL)){
			$lanjut="ok";
		}else{
			$lanjut="invalid_emial";
		}
		
		
				if($lanjut=="ok"){
					if($u1!='' and $p1!=''){ //CEK EMAIL DENGAN PASSWORD
						$DATAPOST=array('PMB_EMAIL_PENDAFTAR'=>$u1,'PASSWORD' => $p1);
						$cek=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>168, 'api_subkode' => 17, 'api_search' => $DATAPOST));
						if(!empty($cek)){
							$pin=$cek[0]->PMB_PIN_PENDAFTAR;
							$TAHUN_BAYAR=$cek[0]->PMB_TAHUN_PENDAFTARAN;
							$nama_pendaftar=$cek[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
							// print_r($pin); die();
							// echo "login";
							//AMBIL STATUS
							//JIKA 1 -> LOGIN OK
							//JIKA 2 -> LOGIN OK
							$this->auth->set_session_cmhs_ln($pin, $u1, $p1, $stat, $TAHUN_BAYAR, $nama_pendaftar);
						}else{
							$err = 'USERORPASS';
							$this->warning->set_error($err); 
							redirect('login','refresh'); 
						}
					}elseif($p1==''){ //CEK EMAIL TANPA PASSWORD
						$EMAIL=array('PMB_EMAIL_PENDAFTAR'=>$u1);
						$cekemail=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>168, 'api_subkode' => 18, 'api_search' => $EMAIL));
						// echo "<pre>"; print_r($cekemail); echo "</pre>"; die();
						if(!empty($cekemail)){ 
							$status=$cekemail[0]->PMB_STATUS_SIMPAN_PENDAFTAR;
							$no_reg=$cekemail[0]->PMB_NO_UJIAN_PENDAFTAR;
							if($status==1){
								// echo "logout 1";
								$login="tidak";						
							}elseif($status==2 AND $no_reg==''){
								// echo "logout 2";
								$login="tidak";
							}elseif($status==2 AND $no_reg!=''){
								// echo "kirim email";
								$login="iya";
							}elseif($status==3){
								// echo "kirim email";
								$login="iya";
							}
						}else{
							$login="iya";
						}
						if($login=='iya'){
							// echo "kirim email"; die();
							$registertime=strtotime(date("d-m-Y h:m:s"));
							$r=rand(0,9);
							$random=$registertime.$r;
							$aksi=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 78, 'api_search' => $random));
							// print_r($aksi); die();
							$reg=$aksi[0]->XKODE;
							// $PASSWORD_SEND=rand(000001,999999);
							$PASSWORD=rand(000001,999999);
							$TAHUN_DAFTAR=date("Y");
							$DATAPOST=array(
								'PMB_PIN_PENDAFTAR' => $reg,
								'PMB_WARGA_NEGARA_PENDAFTAR' => 1,
								'PMB_EMAIL_PENDAFTAR' => $u1,
								'PMB_FOTO_PENDAFTAR' => $reg.".jpg",
								'PMB_KD_JENIS_PENDAFTAR' => 100,
								'PMB_TAHUN_PENDAFTARAN' => $TAHUN_DAFTAR,
								'PMB_GELOMBANG_PENDAFTAR' => 100,
								'PMB_STATUS_SIMPAN_PENDAFTAR' => 1,
								'ID_HEALTH' => 1,
								'PASSWORD' => md5($PASSWORD)
							);
							// echo "<pre>"; print_r($DATAPOST); echo "</pre>"; die();
							$foto_default="asset/img/default.jpg";
							$foto_user="img_pendaftar/matrikulasi_ln/".$TAHUN_DAFTAR."/".$reg.".jpg";
							copy($foto_default,$foto_user);
							$aksi=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>10, 'api_subkode' => 79, 'api_search' => $DATAPOST));
							if($aksi==TRUE){
									$config['protocol']='smtp';  
									$config['smtp_host']='ssl://smtp.googlemail.com';  
									$config['smtp_port']='465';  
									$config['smtp_user']='admission@uin-suka.ac.id';  
									$config['smtp_pass']='111222';  		
									// $config['smtp_pass']='eventuinsuka';  		
									$config['mailtype']='html';  
									$email=$u1;
								// $password=rand(100001,999999);
								// $password_1=md5($password);
									
									$this->load->library('email', $config);
									$this->email->set_newline("\r\n");
									$this->email->from('admission@uin-suka.ac.id');
									$this->email->to($email);		
									$this->email->subject('Account Confirmation for Admission to UIN Sunan Kalijaga');
									$pesan="Thank you for registering to UIN Sunan Kalijaga admission's website.<br/><br />
											Your admission's account is :<br />
											Username : ".$u1."<br/>
											Password : ".$PASSWORD."<br />
											<p slign='center'>
												Please immediately login to http://admisi.uin-suka.ac.id using the provided account and fill all the required admission forms.<br />
												For further enquiries please send email to admission@uin-suka.ac.id.
											</p>
											Best Regards,<br />
											Admission Office<br />
											UIN Sunan Kalijaga Yogyakarta<br />
											admisi.uin-suka.ac.id<br />
											admission@uin-suka.ac.id
									";		
									$this->email->message($pesan);
									if($this->email->send()){							
										$err = 'OK';
										$this->warning->set_error($err); 
										redirect('login','refresh'); 
									}else{
										// show_error($this->email->print_debugger());
										$err = 'NOT';
										$this->warning->set_error($err); 
										redirect('login','refresh'); 
									}
									
							}else{
									$err = 'NOT';
									$this->warning->set_error($err); 
									redirect('login','refresh'); 
							}
						}else{
							// echo "logout"; die();
							$err = 'EMAIL_SAMA';
							$this->warning->set_error($err); 
							redirect('login','refresh'); 
						}
					}
				
				}else{
						$err = 'EMAIL_INVALID';
						$this->warning->set_error($err); 
						redirect('login','refresh'); 
					
				}
			
		}else{
			$this->init_login($u1,$p1); //JIKA BUKAN CALON DILEMPAR KE AD
		}
	  #}
	}

	
function init_login($u1 ='', $p1 = ''){
		// function init_login(){
		/* $u1 	= $this->uri->segment(2);
		$p1 	= $this->uri->segment(3); */
		#echo $u1.'-'.$p1;
		#COOKIE EXPERIMENT
		#$c1 	= strrev(strtoupper($this->input->post('logc1')));
		#$s0		= @t1_decode($_COOKIE["cap001"]);
		#$s1		= str_replace(' ','',$s0); 
		#setcookie('cap002', $c1.' '.$s1, time()+60);
				
		if (($u1 != '') && ($p1 != '')){
			
			#LIGHTVERSION
			#if(strlen($u1) == 8): 
			#if((substr($u1,2,1) == '5') || (substr($u1,2,1) == '7')):
			
			$c1 = $this->auth->get_ad_check($u1, $p1);
			$c2 = $this->auth->get_spp_check($u1);
			$c3 = $this->auth->get_ad_exist($u1);
			#print_r($c3); die();
			#echo $c1." ".$c2; die();
			$pass = false;
			
			if($c3[0]){
				if(strtoupper($c3[1][0]['Status']) == 'ENABLED'){
					if($c1){
						$agg = $c3[1][0]['AnggotaDari'][0][0];
						if (($agg == 'MhsGroup')){
							$c2 = $this->auth->get_spp_check($u1);
							if($c2){ $pass = true; }
							else { $err = 'b1'; } //spp mhs
						} else { $pass = true; } //case mhs
					} else { $err = 'd4'; } //user+password
				} else { $err = 'd2'; } //enabled
			} else {
				$err = 'd3';
				switch($c3[1]){
					case 1: case 2: case 3: $err = 'd0'; break; 
					case 4: case 5: $err = 'd1'; break; 
				}
			} //exist
			//adi wirawan 26/05/2014
			//praregistrasi aplikasi

			if($pass){
				$this->auth->set_session($u1, $p1);
			}else{ 
				error_reporting(0);
                $u1=str_replace("-","",trim($u1));
                $p1=str_replace("-","",trim($p1));
				$praregistrasi_data=$this->auth->praregistrasi_app_login($u1,$p1);
                $kode_jalur=$praregistrasi_data['KODE_JALUR'];
                $kd_ta = $praregistrasi_data['KD_TA'];
                /*if($u1 == '10310175' && $p1 == '10310175'){
                	$this->session->set_userdata('logged_in',TRUE);
					$this->session->set_userdata('nomor_pendaftaran',$u1);
					$this->session->set_userdata('nisn',$p1);
					$this->session->set_userdata('praregistrasi_nama',"!SISKA RESTU");
                    $this->session->set_userdata('praregistrasi_jalur',"11");
					redirect('praregistrasi', 'refresh');
            	}*/
				//if($praregistrasi_data){
                if($kode_jalur){
                    $nama=$praregistrasi_data['NAMA'];
					$this->session->set_userdata('logged_in',TRUE);
					$this->session->set_userdata('nomor_pendaftaran',$u1);
					$this->session->set_userdata('nisn',$p1);
					$this->session->set_userdata('praregistrasi_kd_ta',"$kd_ta");
					$this->session->set_userdata('praregistrasi_nama',"$nama");
                    $this->session->set_userdata('praregistrasi_jalur',"$kode_jalur");
					redirect('praregistrasi', 'refresh');
				}else{
					$this->warning->set_error($err); 
					redirect('login','refresh'); 
				}
			}
					
		} else { redirect('login','refresh'); }
		
	}
	
	public function init_logout(){
		if($this->session->userdata('logged_in')){ $this->session->sess_destroy(); }
		setcookie('cap001','',time()-3600); 
		unset($_COOKIE['cap001']);
		redirect('','refresh');
	}

	public function p900_testerlogin(){
		$this->load->helper('form');
		
		if(isset($_POST['bt_simpan'])){
			$u1 = $_POST['t_un'];
			$p1 = $_POST['t_ps'];
			
			if($this->auth->get_ad_check($u1, $p1)){
				echo 'masuk AD';
				$this->auth->set_session_tester900($u1, $p1);
			} else {
				echo 'GAGAL_AD';
			}
		} else {
			echo '<h1>tester masuk</h1>';
			echo form_open(current_url(),array('name' => 'form_bio'));
			echo '<strong>Username:</strong>';
			echo form_input('t_un','','style="width:300px;"');
			echo '<br><br>';
			echo '<strong>Password:</strong>';
			echo form_password('t_ps','','style="width:300px;"');
			echo '<br><br>';
			echo form_submit('bt_simpan','klik aja');
			echo form_close();
		}
	}
}
