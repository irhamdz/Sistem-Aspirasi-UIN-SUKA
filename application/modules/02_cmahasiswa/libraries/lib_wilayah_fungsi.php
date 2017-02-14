<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class lib_wilayah_fungsi {

	//DATA NEGARA
	function data_negara(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_jsob('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_view', 'POST', 
				array('api_kode'=>11001, 'api_subkode' => 2));	
		return $isi2;
	}
	//DATA KABUPATEN
	function data_kabupaten($katakunci){
		$CI=&get_instance();
		$data1	= array($katakunci);	
		$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
					array('api_kode'=>12000, 'api_subkode' => 3, 'api_search' => $data1));
		return $isi2;
	}
	
	function data_kabupaten_detail($KD_KAB){
		$CI=&get_instance();
		if($KD_KAB){
			$data1	= array($KD_KAB);	
			$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
						array('api_kode'=>12000, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	
	function data_kabupaten_list($KD_PROP){
		$CI=&get_instance();
		if($KD_PROP){
			$data1	= array($KD_PROP);	
			$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
						array('api_kode'=>12000, 'api_subkode' => 4, 'api_search' => array($KD_PROP)));
			return $isi2;
		}
	}
	//DATA KECAMATAN 
	function data_kecamatan_list($KD_KAB){
		$CI=&get_instance();
		if($KD_KAB){
			$data1	= array($KD_KAB);	
			$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
						array('api_kode'=>13000, 'api_subkode' => 4, 'api_search' => array($KD_KAB)));
			return $isi2;
		}
	}
	//DATA PROPINSI
	function data_propinsi_detail($KD_PROP){
		$CI=&get_instance();
		if($KD_PROP){
			$data1	= array($KD_PROP);	
			$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST', 
						array('api_kode'=>11000, 'api_subkode' => 1, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	
	function data_propinsi_list(){
		$CI=&get_instance();
			$isi2	= $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_view', 'POST', 
						array('api_kode'=>11000, 'api_subkode' => 1, 'api_search' =>array()));
			return $isi2;
	}
 
}