<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: Wihikan Mawi Wijna
	Created		: 13:13 31/05/2013 

	s01			: sia "kamar" 01, (s00, s01, s02, ..., s99)
	lib			: ct = controller, vw = view, mdl = model, lib = library
	auth		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class Lib_adminpmb {
	
	function cek_allowed($allow='')
        {	
				$CI =& get_instance();
                $jbt = $CI->session->userdata('jabatan');
                $who = array_intersect(explode("#",$jbt),explode("#",$allow));
                $stat = count($who) > 0 ? TRUE : FALSE;
                return $stat;
        }
	function get_peserta_p_t($nim='')
        {		
				$CI =& get_instance();
				$datapost=array('NO_TES' => $nim);
				$api_url 	= 'http://service.uin-suka.ac.id/servsiasuper/index.php/admisi_public/admisi_pmb/data_search';
				$parameter  = array('api_kode' => 255, 'api_subkode' => 101, 'api_search' => $datapost);
				$peserta_tes = $CI->api->get_api_json($api_url,'POST',$parameter);            
				return $peserta_tes;
        }
	
	
	function get_univ($something='',$val1=null,$val2=null)
	{
		$CI =& get_instance();
		switch ($something) {
			case 'fak':
				$parameter = array(	'api_kode' => 17000,'api_subkode' => 1,'api_search'=> array());
				$data= $CI->api->get_api_json(URL_API_SIA.'sia_master/data_view','POST',$parameter);
				break;
			case 'prod':
				$parameter = array(	'api_kode' => 19000,'api_subkode' => 6,'api_search'=> array($val1));
				$data= $CI->api->get_api_json(URL_API_SIA.'sia_master/data_search','POST',$parameter);
				break;
			case 'mhs':
				$parameter = array(	'api_kode' => 26000,'api_subkode' => 16,'api_search'=> array($val1,$val2));
				$data= $CI->api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search','POST',$parameter);
				break;
			default:
				$data = false;
				break;
		}
		return $data;
	}
}