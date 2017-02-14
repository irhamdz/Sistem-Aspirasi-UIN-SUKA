<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: Wihikan Mawi Wijna
	Created		: 13:13 31/05/2013 

	s01			: sia "kamar" 01, (s00, s01, s02, ..., s99)
	lib			: ct = controller, vw = view, mdl = model, lib = library
	auth		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S01_lib_auth {
	
	function tes00(){ return '0000x';  }
	
	function is_login(){
		$CI =& get_instance();
		$hasil = trim($CI->session->userdata('logged_in'));
		if ($hasil != '') { return true; } else { return false; }
		#if(isset($CI->session->userdata('logged_in'))){ return true; } else { return false; }
	}
	
	function is_dosen($nip = 0){
		$CI =& get_instance();
		if ($nip == 0) { $nip = $CI->session->userdata('id_user'); }
		$dosen = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_dosen/data_search', 'POST', array('api_kode'=>20000, 'api_subkode'=>3, 'api_search' => array($nip)));
		#return $dosen;
		if(!empty($dosen)){ return true; } else { return false; }
	}
	
	function is_dosen_wali($nip = 0){
		$CI =& get_instance();
		if ($nip == 0) { $nip = $CI->session->userdata('id_user'); }
		$dosen = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', array('api_kode'=>28000, 'api_subkode'=>3, 'api_search' => array($nip)));
		if(!empty($dosen)){ return true; } else { return false; }
	}
	
	function get_spp_check($user1){
		#shotozuro
/*		$hasil1 = false;
		
		$user = 'sia';
		$pass = 'ais';
		$postorget 	= 'GET';
		$v_ta = 2013;
		$v_smt = 2;
				
		//12640035
		$api_url ='http://service.uin-suka.ac.id/servsibayar/index.php/data/d_bayar_spp/bayar_spp_aktif_custom/nim/'.$user1.'/kd_ta/'.$v_ta.'/kd_smt/'.$v_smt.'/format/json';
		$context = stream_context_create(array(
			'http' => array(
				'header'  => "Authorization: Basic " . base64_encode($user.":".$pass)
			)
		));
		$hasil = file_get_contents($api_url,false,$context);
		$hasil = json_decode($hasil,true);
		
		if(!empty($hasil)){ $hasil1 = true; } */
		$hasil1 = TRUE;
		return $hasil1;
	}
	
	function get_ad_exist($user){
		$CI =& get_instance();
		$hasil_ 	= false;
		$postorget 	= 'GET';
		$auth_ad_id = '2f304362ebfbe3932f2e810ba8fb6243c4';
		$api_url 	= URL_API_AD.'adgetuser.php?aud='.$auth_ad_id.'&src='.$user;
		
		$hasil = $CI->curl->simple_get($api_url);
				
		$hasil = json_decode($hasil, true);
		if(is_array($hasil)){
			$auth_type = array("AlumniGroup","WisudaGroup","MhsGroup","StaffGroup","KartuGroup","OrtuGroup");
			foreach($auth_type as $auth_type_){
				for($j1 = 0; $j1 < count($hasil[0]['AnggotaDari'][0]); $j1++){
					if($hasil[0]['AnggotaDari'][0][$j1] == $auth_type_){ $hasil_ = true; break; }
				}
			}
		}
		// print_r(array($hasil_, $hasil)); die();
		return array($hasil_, $hasil);
	}
	
	function get_ad_check($user, $pass){
		$CI =& get_instance();
		#8f304662ebfee3932f2e810aa8fb628714
		$hasil_ 	= false;
		$postorget 	= 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628715';
		$api_url 	= URL_API_AD.'adlogauthgr.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		
		$hasil = $CI->curl->simple_get($api_url);
		
		/*
			//VERIFIKASI AD VERSI LAWAS
			if(substr($hasil,0,6) == '[{"427'){
			$hasil = json_decode($hasil, true);
			$auth_type = array("MhsGroup","StaffGroup","KartuGroup","WaliGroup");
			
			foreach($auth_type as $auth_type_){
					if(strpos($hasil[0]['art'],$auth_type_)) { $hasil_ = true; break; }
			}
		}*/
		
		$hasil = json_decode($hasil, true);
		if(is_array($hasil)){
			$auth_type = array("MhsGroup","StaffGroup","KartuGroup","OrtuGroup");
			foreach($auth_type as $auth_type_){
				for($j1 = 0; $j1 < count($hasil[0]['AnggotaDari'][0]); $j1++){
					if($hasil[0]['AnggotaDari'][0][$j1] == $auth_type_){
						$hasil_ = true; break;
					}
				}
			}
		}
		//print_r($hasil_); die();
		 return $hasil_;
	}
	function set_session_cmhs($kode, $pin, $status, $jenis, $tgl_bayar, $TAHUN_BAYAR){ #sigit
		$CI =& get_instance();
		// $parameter1 	= array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array('ABCABC123123'));
		$parameter1 	= array('api_kode' => 192, 'api_subkode' => 2, 'api_search' => array($pin));
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$cmhs 		= $CI->s00_lib_api->get_api_json($api_url, 'POST', $parameter1);
		if(!empty($cmhs)){
				$gelombang = $cmhs[0]['PMB_GELOMBANG_PENDAFTAR'];
				$nama_pendaftar = $cmhs[0]['PMB_NAMA_LENGKAP_PENDAFTAR'];
		}else{
				$gelombang = "DEFAULT";
				$nama_pendaftar = '';
		}
		
		if($status=='pmb'){
			$whoisyou="S1/D3";
		}else{
			$whoisyou=strtoupper($status);
		}
		$arr_session = array(		'id_user'			=> $pin,
									'status'			=> $status,
									'jenis_penerimaan'	=> $jenis,
									'gelombang'			=> $gelombang,
									'nama_pendaftar'	=> $nama_pendaftar,
									'siapa_aku'			=> $whoisyou,
									'tgl_bayar'			=> $tgl_bayar,
									'TAHUN_BAYAR'		=> $TAHUN_BAYAR,
									'app'				=> 'calon-'.$status.'',
									'time_login'		=> time(),
									'logged_in' 		=> TRUE,
									);
		
		$CI->session->set_userdata($arr_session);
		$this->redirect_menu();
		#print_r($arr_session);
	}
	
	function set_session_cmhs_ln($pin, $u, $p, $stat, $TAHUN_BAYAR, $nama_pendaftar){ #sigit mhs ln
		$CI =& get_instance();
		// if($status=='pmb'){
			// $whoisyou="S1/D3";
		// }else{
			// $whoisyou=strtoupper($status);
		// }
		$arr_session = array(		'id_user'			=> $u,
									'pin'				=> $pin,
									'nama_pendaftar'	=> $nama_pendaftar,
									'status'			=> $stat,
									'jenis_penerimaan'	=> 100,
									// 'siapa_aku'			=> 'PENDAFTAR LUAR NEGERI',
									'siapa_aku'			=> 'FOREIGN APPLICANT',
									// 'tgl_bayar'		=> $tgl_bayar,
									'TAHUN_BAYAR'		=> $TAHUN_BAYAR,
									// 'app'			=> 'calon-'.$status.'',
									'time_login'		=> time(),
									'logged_in' 		=> TRUE,
									);
		$CI->session->set_userdata($arr_session);
		$this->redirect_menu();
		#print_r($arr_session);
	}
	/* adi wirawan */
    function add_api_admisi($url,$method,$post){
		////////////////
		$username='admisi11';
		$password='42m151';
			//////////////
		if(strtoupper($method)=='POST'){			
			$postdata = http_build_query($post);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded' . "\r\n"
					.'Content-Length: ' . strlen($postdata) . "\r\n",
					'content' => $postdata
				)
			);
			if($username && $password)
			{
				$opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
			}
			
			$context = stream_context_create($opts);
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}else{
			$isi='';
			if($post){
				foreach($post as $key=>$value){
					$isi=$isi."/".$key."/$value/";
				}	
			}		
			$url=$url.$isi;
			$context = stream_context_create(array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password")
				)
			));	
				
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}
	}
	function praregistrasi_app_login($no_pmb,$tgl){
		$CI =& get_instance();//
		/*$url="http://yudisium.uin-suka.ac.id/snmptn/index.php/service/siswa/get_siswa";
		$url2="http://yudisium.uin-suka.ac.id/spanptain/index.php/service/siswa/get_siswa";
		$param=array(
				'nomor_pendaftaran'=>$no_pmb,
				'nisn'=>$nisn,
				'key'=>'0871ce4b01b3b522404d0f844513387c',
			);
		$data=$CI->s00_lib_api->get_api_json("$url",'POST',$param);
		$data2=$CI->s00_lib_api->get_api_json("$url2",'POST',$param);
		$NAMA_SISWA=$data[0]['NAMA_SISWA'];
		$NAMA_SISWA2=$data2[0]['NAMA_SISWA'];
		if($NAMA_SISWA){
			return $NAMA_SISWA;
		}elseif($NAMA_SISWA2){
			return $NAMA_SISWA2;
		}*/
        $url2="http://service.uin-suka.ac.id/servadmisi/index.php/snmptn/yudisium/get_siswa_prareg";
        $param2=array(
				'NOMOR_PENDAFTARAN'=>$no_pmb,
				'TGL_LAHIR'=>$tgl
        );
        $data2=json_decode($this->add_api_admisi("$url2",'POST',$param2),true);
        #print_r($data2);
        $NOMOR_PENDAFTARAN = $data2[0]['NOMOR_PENDAFTARAN'];
        $NAMA_SISWA = strtoupper($data2[0]['NAMA_SISWA']);
        #echo "-- $NAMA_SISWA --- ";
        $KODE_JALUR = $data2[0]['KODE_JALUR'];
        $KD_TA = $data2[0]['KD_TA'];
		########adiwirawan 1804/2016
		if($no_pmb == '15319201800'){
			$tgl = '11031997';
			$NAMA_SISWA = 'BENI MARSAL SUPRIADI';
			$KODE_JALUR ='17';
			$KD_TA = '2015';
		}
		######################
        if($KODE_JALUR){
        	$isi['NAMA']=$NAMA_SISWA;
        	$isi['KODE_JALUR'] = $KODE_JALUR;
        	$isi['KD_TA'] = $KD_TA;
        	#print_r($isi);
        	#exit();
        	return $isi;
        }
	}
	function set_session($user, $pass){
		/* if((strlen($user) == 8) && ((substr($user,2,1) == '5') || (substr($user,2,1) == '7'))) ||
		((strlen($user) == 18)): */
		#if(	((strlen($user) == 8) && (substr($user,2,1) == '6')) ||
			#((strlen($user) == 8) && (substr($user,2,1) == '7')) ||
		#	((strlen($user) == 18)) ):
		
		$CI =& get_instance();//
		$hasil_ 	= null;
		$postorget 	= 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628715';
		$api_url 	= URL_API_AD.'adlogauthgr.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		$hasil 		= $CI->curl->simple_get($api_url);
		
			// service2.uin-suka.ac.id/servsimpeg/simpeg_mix/data_search
			// 2000/1
			// array(kode_pegawai)
		$parameter1 	= array('api_kode' => 2001, 'api_subkode' => 5, 'api_search' => array($user));
		// $parameter1 	= array('api_kode' => 2001, 'api_subkode' => 1, 'api_search' => array($user));
		$api_spgn 		= $CI->s00_lib_api->get_api_json('http://service2.uin-suka.ac.id/servsimpeg/simpeg_public/simpeg_mix/data_search', 'POST', $parameter1);
		if(!empty($api_spgn)){
				$username = $api_spgn[0]['NM_PGW_F'];
		}else{
				$username = '';
		}
		$ta = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_krs/data_procedure', 'POST', array('api_kode'=>50000, 'api_subkode'=>2));
		
		$hasil = json_decode($hasil, true);
		// print_r($api_spgn); die();
		if(is_array($hasil)){
			if($this->parse_ad_status($hasil[0]['AnggotaDari']) == 'wali'){ $user = substr($user,0,strlen($user)-1); }
			$arr_session = array(	'id_user'		=> $user,
									'status'		=> $this->parse_ad_status($hasil[0]['AnggotaDari']),
									'jabatan'		=> $this->parse_ad_jabatan($hasil),
									'akses_prodi'	=> $this->parse_ad_akses_prodi($hasil),
									'username'	=> $username,
									#'status'		=> 'mhs',
									#'jabatan'		=> 'MHS',
									#'akses_prodi'	=> '',
									
									#'user_agent'	=> $_SERVER['HTTP_USER_AGENT'],
									#'ip_address'	=> $_SERVER['REMOTE_ADDR'],
									#'time_login'	=> fulltoday(),
									'time_login'	=> time(),
									'kd_ta' 		=> $ta['data'][':hasil1'],
									'ta' 			=> $ta['data'][':hasil2'],
									'kd_smt' 		=> $ta['data'][':hasil3'],
									'nm_smt' 		=> $ta['data'][':hasil4'],
									'logged_in' 	=> TRUE,
									);
//echo $arr_session['jabatan']; die();
			#print_r($arr_session); die();
			$CI->session->set_userdata($arr_session);	
			
			//save log user login
			if($this->parse_ad_status($hasil[0]['AnggotaDari']) == 'wali'){ $user1 = $user.'w'; } else { $user1 = $user; }
			$ipd = $CI->input->ip_address().'#'.$CI->input->user_agent();
			$logd = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_sistem/data_procedure', 'POST', array('api_kode'=>101001, 'api_subkode'=>1,'api_datapost'=>array($user1, $ipd)));
			
			$this->redirect_menu();
		}
		else
		{
			redirect('login', 'refresh');
		}
		
		#else: 
		#	echo 'Maaf, saat ini jadwal pengisian KRS untuk Fakultas Sains dan Teknologi';
		#endif;  
		/* else: 
			echo 'Maaf, saat ini jadwal pengisian KRS untuk Fakultas Ushuluddin dan Pemikiran Islam serta Fakultas Ilmu Sosial dan Humaniora';
		endif; */
		
		/*
		//VERIFIKASI AD VERSI LAWAS
		if(substr($hasil,0,6) == '[{"427'){
			$hasil = json_decode($hasil, true);
			
			$arr_session = array(	'id_user'		=> $user,
									'status'		=> $this->parse_ad_status($hasil[0]['art']),
									'jabatan'		=> $this->parse_ad_jabatan($hasil),
									'akses_prodi'	=> $this->parse_ad_akses_prodi($hasil),
									
									'user_agent'	=> $_SERVER['HTTP_USER_AGENT'],
									'ip_address'	=> $_SERVER['REMOTE_ADDR'],
									'time_login'	=> fulltoday(),
									'kd_ta' 		=> $ta['data'][':hasil1'],
									'ta' 			=> $ta['data'][':hasil2'],
									'kd_smt' 		=> $ta['data'][':hasil3'],
									'nm_smt' 		=> $ta['data'][':hasil4'],
									'logged_in' 	=> TRUE,
									);
			$CI->session->set_userdata($arr_session);	
			$this->redirect_menu();
		} else { redirect('login', refresh); }*/
		
	}
	
	function set_session_tester900($user, $pass){
		$CI =& get_instance();
		$hasil_ 	= null;
		$postorget 	= 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628715';
		$api_url 	= URL_API_AD.'adlogauthgr.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		$hasil 		= $CI->curl->simple_get($api_url);
		
		$ta = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_krs/data_procedure', 'POST', array('api_kode'=>50000, 'api_subkode'=>2));
		
		$hasil = json_decode($hasil, true);
		if(is_array($hasil)){
			if($this->parse_ad_status($hasil[0]['AnggotaDari']) == 'wali'){ $user = substr($user,0,strlen($user)-1); }
			$arr_session = array(	'id_user'		=> $user,
									'status'		=> $this->parse_ad_status($hasil[0]['AnggotaDari']),
									'jabatan'		=> $this->parse_ad_jabatan($hasil),
									'akses_prodi'	=> $this->parse_ad_akses_prodi($hasil),
									
									'user_agent'	=> $_SERVER['HTTP_USER_AGENT'],
									'ip_address'	=> $_SERVER['REMOTE_ADDR'],
									'time_login'	=> fulltoday(),
									'kd_ta' 		=> $ta['data'][':hasil1'],
									'ta' 			=> $ta['data'][':hasil2'],
									'kd_smt' 		=> $ta['data'][':hasil3'],
									'nm_smt' 		=> $ta['data'][':hasil4'],
									'logged_in' 	=> TRUE,
									);
			$CI->session->set_userdata($arr_session);	
			echo '<pre>';
			echo '$hasil:';
			print_r($hasil);
			
			echo '$tester_jabatan:';
			print_r($this->parse_ad_jabatan_tester900($hasil));
			
			echo '$session:';
			print_r($CI->session->all_userdata());
			echo '</pre>';
			
			//save log user login
			#$ipd = $CI->input->ip_address().'#'.$CI->input->user_agent();
			#$logd = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_sistem/data_procedure', 'POST', array('api_kode'=>101001, 'api_subkode'=>1,'api_datapost'=>array($user, $ipd)));
					
			#$this->redirect_menu();
		} else { redirect('login', refresh); }
		
		/*
		//VERIFIKASI AD VERSI LAWAS
		if(substr($hasil,0,6) == '[{"427'){
			$hasil = json_decode($hasil, true);
			
			$arr_session = array(	'id_user'		=> $user,
									'status'		=> $this->parse_ad_status($hasil[0]['art']),
									'jabatan'		=> $this->parse_ad_jabatan($hasil),
									'akses_prodi'	=> $this->parse_ad_akses_prodi($hasil),
									
									'user_agent'	=> $_SERVER['HTTP_USER_AGENT'],
									'ip_address'	=> $_SERVER['REMOTE_ADDR'],
									'time_login'	=> fulltoday(),
									'kd_ta' 		=> $ta['data'][':hasil1'],
									'ta' 			=> $ta['data'][':hasil2'],
									'kd_smt' 		=> $ta['data'][':hasil3'],
									'nm_smt' 		=> $ta['data'][':hasil4'],
									'logged_in' 	=> TRUE,
									);
			$CI->session->set_userdata($arr_session);	
			$this->redirect_menu();
		} else { redirect('login', refresh); }*/
		
	}
	
	function redirect_menu(){
		$CI =& get_instance();
		$status = $CI->session->userdata('status');
		switch($status){ #sigit
			case 'pmb':
				redirect('pmb','refresh');
			break;
			case 'matrikulasi':
				redirect('matrikulasi','refresh');
			break;
			case 's2':
				redirect('s2','refresh');
			break;
			case 's3':
				redirect('s3','refresh');
			break;
			case 'mhs':
				redirect('mahasiswa','refresh');
			break;
			case 'wali':
				redirect('wali','refresh');
			break;
			case 'staff': case 'kartu':
				#echo "tes"; die();
				if($this->is_dosen()) { 
				redirect('dosen','refresh'); } else { redirect('staff','refresh'); }
			break;
		
			default: redirect('logout','refresh'); break;
		}
	}
	
	function parse_ad_status($id){
		/* 
		//VERIFIKASI AD VERSI LAWAS
		switch($id){
			case 'CN=StaffGroup,CN=Users,DC=ad,DC=uin-suka,DC=ac,DC=id': 	$hasil = 'staff'; break;
			case 'CN=MhsGroup,CN=Users,DC=ad,DC=uin-suka,DC=ac,DC=id': 		$hasil = 'mhs'; break;
			case 'CN=KartuGroup,CN=Users,DC=ad,DC=uin-suka,DC=ac,DC=id': 	$hasil = 'kartu'; break;
			case 'CN=WaliGroup,CN=Users,DC=ad,DC=uin-suka,DC=ac,DC=id': 	$hasil = 'wali'; break;
			default:														$hasil = ''; break;
		} return $hasil; */
		
		foreach($id[0] as $idx){
			switch ($idx){
				case 'StaffGroup': 		$hasil = 'staff'; break;
				case 'MhsGroup': 		$hasil = 'mhs'; break;
				case 'KartuGroup': 		$hasil = 'kartu'; break;
				case 'OrtuGroup': 		$hasil = 'wali'; break;
				default:				$hasil = ''; break;
			}
		} return $hasil;		
	}
	
	function parse_ad_jabatan($data){
		$CI =& get_instance();
		$status = $this->parse_ad_status($data[0]['AnggotaDari']);
				
		switch($status){
			case 'mhs': case 'wali':	return ''; break;
			case 'staff':
			case 'kartu':
				$jabatan = $this->get_ad_jabatan($data);
				return implode('#',$jabatan[3]);
			break;
		}
	}
	
	function parse_ad_jabatan_tester900($data){
		$CI =& get_instance();
		$status = $this->parse_ad_status($data[0]['AnggotaDari']);
			
		switch($status){
			case 'mhs': case 'wali':	return ''; break;
			case 'staff':
			case 'kartu':
				$jabatan = $this->get_ad_jabatan_tester900($data);
				return $jabatan;
				#return implode('#',$jabatan[3]);
			break;
		}
	}
	
	function parse_ad_akses_prodi($data){
		$CI =& get_instance();
		$status = $this->parse_ad_status($data[0]['AnggotaDari']);
				
		switch($status){
			case 'mhs':	case 'wali':	return ''; break;
			case 'staff':
			case 'kartu':
				$jabatan = $this->get_ad_jabatan($data);
				return implode('#',$jabatan[0]);
			break;
		}
	}
	
	function get_ad_check2($user, $pass){
		$CI =& get_instance();
		$hasil_ = false;
		$postorget = 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628715';
		$api_url =	'http://service.uin-suka.ac.id/servad/adlogauth.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		
		return $CI->curl->simple_get($api_url);
	}

	function get_ad_jabatan_ex($data){
		$CI =& get_instance();
		
		$arr_prodi 	= array();
		$arr_fak 	= array();
		$arr_nfak 	= array();
		$arr_jabat 	= array();
		
		//comment when DB SIA is activated again
		#return array(array(),array(),array(),array('KKNADM'));
		
		//cek dosen apa bukan
		#if($this->is_dosen($data[0][427])){ $arr_jabat[] = 'DSN'; }
		if($this->is_dosen($data[0]['NamaPengguna'])){ $arr_jabat[] = 'DSN'; }
		
		//cek dosen wali apa bukan
		#if($this->is_dosen_wali($data[0][427])){ $arr_jabat[] = 'DPA'; }
		if($this->is_dosen_wali($data[0]['NamaPengguna'])){ $arr_jabat[] = 'DPA'; }
		
		$kd_pgw = trim(strtoupper($data[0]['NamaPengguna']));

		//data dari *simpeg 
		$date1 = date('d/m/Y');
		$parameter = array('api_kode' => 1121, 'api_subkode' => 3, 'api_search' => array($date1,$kd_pgw,'1'));
		#$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array($data[0][427]));
		
		$db_jabat = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
		foreach($db_jabat as $d){ 
			$arr_jabat[] = $d['KD_JABATAN']; 
					
			$parameter 	= array('api_kode' => 90004, 'api_subkode' => 1, 'api_search' => array($d['KD_JABATAN']));
			$akses_ 	= $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
					
			if (subsub2($d['KD_JABATAN'], $arr_jabat)) { $arr_jabat[] = $d['KD_JABATAN']; }
			if(!empty($akses_)){
				foreach ($akses_ as $akses__){
					if (subsub2($akses__['KD_PRODI'], $arr_prodi)) { $arr_prodi[] = $akses__['KD_PRODI']; }
					if (subsub2($akses__['KD_FAK'], $arr_fak)) { $arr_fak[] = $akses__['KD_FAK']; }
					if (subsub2($akses__['NM_FAK'], $arr_nfak)) { $arr_nfak[] = $akses__['NM_FAK']; }
				}
			}
		}
		return array($arr_prodi, $arr_fak, $arr_nfak, $arr_jabat);
	}

	function get_ad_jabatan($data){
		$CI =& get_instance();
		
		$arr_prodi 	= array();
		$arr_fak 	= array();
		$arr_nfak 	= array();
		$arr_jabat 	= array();
		$arr_sjb 	= array();
		
		//cek dosen apa bukan
		if($this->is_dosen($data[0]['NamaPengguna'])){ $arr_sjb[] = 'DSN'; }
				
		$kd_pgw = trim(strtoupper($data[0]['NamaPengguna']));
				
		//simpeg, JABATAN SISTEM melekat ke JABATAN STRUKTURAL 
		$date1 = date('d/m/Y');
		$parameter = array('api_kode' => 1121, 'api_subkode' => 3, 'api_search' => array($date1,$kd_pgw,'1'));
		$db_jbstr = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
		foreach($db_jbstr as $x1){
			$parameter = array('api_kode' => 1181, 'api_subkode' => 2, 'api_search' => array($x1['STR_ID']));
			$db_autoj = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
			if(!empty($db_autoj)){ foreach($db_autoj as $x2){
				if(!in_array($x2['R2S_SIS_ID'], $arr_sjb, true)){ array_push($arr_sjb, $x2['R2S_SIS_ID']); }
			}}
		}
		
		//simpeg, JABATAN SISTEM manual PER ORANG
		$parameter = array('api_kode' => 1124, 'api_subkode' => 2, 'api_search' => array($kd_pgw));
		$db_jabat = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
		foreach($db_jabat as $x1){
			if(!in_array($x1['SIS_ID'], $arr_sjb, true)){ array_push($arr_sjb, $x1['SIS_ID']); }
		}
				
		return array(array(), array(), array(), $arr_sjb);
	}	
	
	function get_ad_jabatan_tester900($data){
		$CI =& get_instance();
		
		$arr_prodi 	= array();
		$arr_fak 	= array();
		$arr_nfak 	= array();
		$arr_jabat 	= array();
		
		//comment when DB SIA is activated again
		#return array(array(),array(),array(),array('KKNADM'));
		
		//cek dosen apa bukan
		#if($this->is_dosen($data[0][427])){ $arr_jabat[] = 'DSN'; }
		if($this->is_dosen($data[0]['NamaPengguna'])){ $arr_jabat[] = 'DSN'; }
		
		//cek dosen wali apa bukan
		#if($this->is_dosen_wali($data[0][427])){ $arr_jabat[] = 'DPA'; }
		if($this->is_dosen_wali($data[0]['NamaPengguna'])){ $arr_jabat[] = 'DPA'; }
		
		//data dari *simpeg 
		#$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array($data[0]['NamaPengguna']));
		$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array('199104210000111201'));
		#$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array($data[0][427]));
		
		$db_jabat = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
		return($parameter);
		
		foreach($db_jabat as $d){ 
			$arr_jabat[] = $d['KD_JABATAN']; 
					
			$parameter 	= array('api_kode' => 90004, 'api_subkode' => 1, 'api_search' => array($d['KD_JABATAN']));
			$akses_ 	= $CI->s00_lib_api->get_api_json(URL_API_SIMPEG1.'simpeg_mix/data_search', 'POST', $parameter);
					
			if (subsub2($d['KD_JABATAN'], $arr_jabat)) { $arr_jabat[] = $d['KD_JABATAN']; }
			if(!empty($akses_)){
				foreach ($akses_ as $akses__){
					if (subsub2($akses__['KD_PRODI'], $arr_prodi)) { $arr_prodi[] = $akses__['KD_PRODI']; }
					if (subsub2($akses__['KD_FAK'], $arr_fak)) { $arr_fak[] = $akses__['KD_FAK']; }
					if (subsub2($akses__['NM_FAK'], $arr_nfak)) { $arr_nfak[] = $akses__['NM_FAK']; }
				}
			}
		}
		return array($arr_prodi, $arr_fak, $arr_nfak, $arr_jabat);
	}
	
	
	#sigit
	function get_sibayar_check($u1 = '', $p1 = ''){
		/*
			kode : 0 - 8;
		*/
		$postdata = http_build_query(
			array(
				'KODE_PMB' => $u1,
				'PIN_PMB' => $p1
			)
		);

		$username = 'admis1';
		$password = 'admi511';
		$postorget = 'POST';
		$url = URL_API_BAYAR0."data/pmb/pmb_login/format/json";
		$context = stream_context_create(
					array(
					'http' => array(
								'method' => 'POST',
								'header' => "Authorization: Basic " . base64_encode("$username:$password"),
								'content' => $postdata
							)
					));
		
		$gropo3 = @file_get_contents($url,false,$context);
		$get_bayar = json_decode($gropo3,true);
		return $get_bayar;
	}	
	
	
	
	

}