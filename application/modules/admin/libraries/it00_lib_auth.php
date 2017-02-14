<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: Wihikan Mawi Wijna
	Created		: 13:13 31/05/2013 

	s01			: sia "kamar" 01, (s00, s01, s02, ..., s99)
	lib			: ct = controller, vw = view, mdl = model, lib = library
	auth		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class It00_lib_auth {
	

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

	function is_pendaftar($data)
	{
		$get_bayar = $this->get_ad_bayar($data);
		if(isset($get_bayar['status']) && strtoupper($get_bayar['status']) == 'INVALID'){
			return false;
		}else{
			if($get_bayar['KODE_PREFIX'] != '930'){ #prefix untuk bayar ICT
				return false;
			}else{ return $get_bayar; }
		}

	}

	function get_ad_jabatan($data){
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
		$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array($data[0]['NamaPengguna']));
		#$parameter = array('api_kode' => 90003, 'api_subkode' => 1, 'api_search' => array($data[0][427]));
		
		$db_jabat = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG.'data_search', 'POST', $parameter);
		foreach($db_jabat as $d){ 
			$arr_jabat[] = $d['KD_JABATAN']; 
		}
		return array($arr_jabat);
	}

	function get_ad_bayar($data='')
	{
		//$CI =& get_instance();
		$username = 'ittc';
		$password = 'ctt1';
		$method = 'post';
		$url = URL_API_BAYAR.'training/training_login/format/json';
		
		$parameter = array('KODE_TR' => $data['kode'],'PIN_TR' => $data['pin']);

	    if(strtoupper($method)=='POST'){
        	$postdata = http_build_query($parameter);
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
	    }


        $context = stream_context_create($opts);
        $hasil= @file_get_contents($url, false, $context);
		$get_bayar = json_decode($hasil,true);
		return $get_bayar;
	}


	function parse_ad_status($id){		
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
				return implode('#',$jabatan[0]);
				// return $data;
			break;
		}
	}
}