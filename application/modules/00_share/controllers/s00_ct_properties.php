<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author		: Wihikan Mawi Wijna
	Created		: 14:27 10/11/2013 

	s00			: sia "kamar" 01, (s00, s01, s02, ..., s99)
	ct			: ct = controller, vw = view, mdl = model, lib = library
	properties	: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S00_ct_properties extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->key		= '&&&&&&&********';
		
		$this->api 		= $this->s00_lib_api;
		$this->output9	= $this->s00_lib_output;
		$this->load->library('s00_lib_general');
		$this->load->library('s00_lib_siaenc');
		
		#$this->session->set_userdata('app','login');
	}
	
	function index(){ echo 'properti'; }
	
	private function p200_mainbaseurl($url){
		$chars = preg_split('//', $url, -1, PREG_SPLIT_NO_EMPTY);
		$slash = 3; // 3rd slash
		$i = 0;
		foreach($chars as $key => $char){
			if($char == '/'){
				$j = $i++;
			}
			if($i == 3){
				$pos = $key; break;
			}
		}
		$main_base = substr($url, 0, $pos);
		return $main_base.'/';
	}
	
	private function p200_checker(){
		$pass = false;
		if(isset($_SERVER['HTTP_REFERER'])){
			$main_base = $this->p200_mainbaseurl($_SERVER['HTTP_REFERER']);
			$pass = preg_match("/uin-suka.ac.id/", $main_base);
		} return $pass;
	}
	
	function n100_mahasiswa_auto($nim = ''){
		$nim 		= preg_replace("/[^0-9]/", "", $nim);
		// $api_url = 'http://service.uin-suka.ac.id/servsiasuper/index.php/foto/ns_mahasiswa_auto/'.$nim;
		$api_url = 'http://service.uin-suka.ac.id/servadmisi/index.php/foto/ns_mahasiswa_auto/'.$nim;
		
		#echo $api_url; 
		
		$builder = http_build_query(array('g3mb0k' => $this->key),'','&');
		$opts = array('http' =>
				array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $builder
				)
			);
			
		header("Content-type: image/jpeg");
		echo file_get_contents($api_url, false, stream_context_create($opts));
	}
	
	function n100_mahasiswa_jenis($jenis = '1', $nim = ''){
		$nim 		= preg_replace("/[^0-9]/", "", $nim);
		$jenis		= preg_replace("/[^a-z0-9]/", "", $jenis);
		$api_url 	= 'http://service.uin-suka.ac.id/servadmisi/index.php/foto/mahasiswa_sel_rs_custom/'.$jenis.'/180/300/'.$nim;
		
		#if(): echo 'xxxx'; else:
		
		if($this->p200_checker() || (isset($_POST['g3mb1k1']) && ($_POST['g3mb1k1'] == $this->key))){
			$builder = http_build_query(array('g3mb0k' => $this->key),'','&');
			$opts = array('http' =>
					array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $builder
					)
				);
				
			header("Content-type: image/jpeg");
			echo file_get_contents($api_url, false, stream_context_create($opts));
		} else {  }
		
		#endif;
	}
	
	function n110_mahasiswa($pp1 = 'pv', $pp2 = 'wm', $jenis = '1', $nim = ''){
		$nim 		= preg_replace("/[^0-9]/", "", $nim);
		$jenis		= preg_replace("/[^a-z0-9]/", "", $jenis);
		$pp1		= preg_replace("/[^a-z0-9]/", "", $pp1);
		$pp2		= preg_replace("/[^a-z0-9]/", "", $pp2);
		
		$sp1 		= $pp1.'__'.$pp2.'__'.$jenis;
		$api_url 	= 'http://service.uin-suka.ac.id/servadmisi/index.php/foto/mahasiswa_com/'.$sp1.'/180/300/'.$nim;
		#echo $api_url; die();		
		if($pp1 == 'pb'){
			header("Content-type: image/jpeg");
			echo file_get_contents($api_url);
		} else {
			if($this->p200_checker() || (isset($_POST['g3mb1k1']) && ($_POST['g3mb1k1'] == $this->key))){
				$builder = http_build_query(array('g3mb0k' => $this->key),'','&');
				$opts = array('http' =>
						array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => $builder
						)
					);
					
				header("Content-type: image/jpeg");
				echo file_get_contents($api_url, false, stream_context_create($opts));
			} else {
				//
			}
		}
		
	}
	
	function n100_foto_pengumuman($nim = ''){
		$nim 		= preg_replace("/[^A-Z0-9]/", "", $nim);
		$api_url 	= 'http://service.uin-suka.ac.id/servadmisi/index.php/admisi_public/foto/ns_pengumuman_auto/'.$nim;
		
		if($this->p200_checker()){
			$builder = http_build_query(array('g3mb0k' => $this->key),'','&');
			$opts = array('http' =>
					array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $builder
					)
				);
				
			header("Content-type: image/jpeg");
			echo file_get_contents($api_url, false, stream_context_create($opts));
		} else { } 
	}
	function n100_foto_informasi($nim = ''){
		$nim 		= preg_replace("/[^A-Z0-9]/", "", $nim);
		$api_url 	= 'http://service.uin-suka.ac.id/servadmisi/index.php/admisi_public/foto/ns_informasi_auto/'.$nim;
		
		if($this->p200_checker()){
			$builder = http_build_query(array('g3mb0k' => $this->key),'','&');
			$opts = array('http' =>
					array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $builder
					)
				);
				
				header("Content-type: image/jpeg");
				echo file_get_contents($api_url, false, stream_context_create($opts));
		} else {  }
	}
	function n101_soal_ujian($kode = ''){ 
		#$kode = t1_encode('2#2260310340307'); echo $kode; die();
		
		$kode1			= explode('#',t1_decode($kode)); 
		if (count($kode1) == 2){
			$kd_kelas 	= $kode1[1]; 
			$ujian 		= $kode1[0];
				
			$aksi		= $this->api->get_api_json(URL_API_SIA.'sia_absensi/data_search', 'POST', 
			array('api_kode'=>75002, 'api_subkode' => 2, 'api_search' => array($kd_kelas, $ujian)));
			
			if(!empty($aksi)){ 
				header("Content-type: application/vnd.ms-word");
				header("Content-Disposition: attachment; filename='".$kode.rand(10,99).".doc'");
				echo base64_decode($aksi[0]['SOAL_BLOB']);
			
			}
		}
	}
	
	function tampil2(){ 
		echo '<iframe src="http://docs.google.com/viewer?url=http://akademik.uin-suka.ac.id/00_share/s00_ct_properties/n101_soal_ujian&embedded=true"  width="745" height="400" style="border: none; margin-bottom:10px;"></iframe>';
	}
	#function xxx1(){ echo 'xxxx'; }
}
