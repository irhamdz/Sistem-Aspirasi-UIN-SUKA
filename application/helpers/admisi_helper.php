<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function admisi_urlfoto($url = ''){
	$url = str_replace('http://service.uin-suka.ac.id/servadmisi/admisi_public/foto',base_url('foto'),$url);
	$url = str_replace('http://service.uin-suka.ac.id/servadmisi/index.php/admisi_public/foto',base_url('foto'),$url);
	return $url;
	// http://service.uin-suka.ac.id/servadmisi/index.php/admisi_public/foto
}

function tg_encode($kd_kelas){ $hasil = ''; #return $kd_kelas;
		$str 	= 'sng3bAdac5UEmQzv2YBTH8CVh7jXpRo0etfOK4MINSlwFZ6iL9kPD1JWyuqGxr#-.:/';
		$arr_e = array();  $arr_e1 = array(); $arr_r = array(); $arr_r1 = array();
		for($j = 0; $j < strlen($str); $j++){
			$j_ = $j; if ($j_ < 10) { $j_ = '0'.$j_; }
			$arr_e1[$j] = substr($str,$j,1);
			$arr_e[$j_] = substr($str,$j,1);
			$arr_r1[substr($str,$j,1)] = $j;
			$arr_r[substr($str,$j,1)] = $j_;
		}
		
		$total = 0;
		for($i = 0; $i < strlen($kd_kelas); $i++){
			$total = (int)substr($kd_kelas,$i,1) + $total; 
		} $u = fmod($total,10);
		
		$kd_enc = $arr_e1[$u];
		for($i = 0; $i < strlen($kd_kelas); $i++){
			$k = ($arr_r1[substr($kd_kelas,$i,1)]+$u); if($k < 10) { $k = '0'.$k; }
			$kd_enc .= ''.$k.rand(0,9); 
		} return $kd_enc;
}




/* End of file sia_helper.php */
/* Location: ./system/helpers/date_helper.php */