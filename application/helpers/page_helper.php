<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_prodi')){
	function get_prodi(){
		$d=explode('.',str_replace('http://','',base_url()));
		
		//$dom="pmi";
		$dom=$d[0];
		$url='http://www.uin-suka.ac.id/index.php/service/get_prodi/'.$dom;
		$data=file_get_contents($url);
		$data=json_decode($data);
		foreach($data as $d){ 
			$kd_prodi=$d->kd_prodi;
		}
		return $kd_prodi;	
	}
}
if ( ! function_exists('get_nm_prodi')){
	function get_nm_prodi(){
		$d=explode('.',str_replace('http://','',base_url()));
		
		//$dom="pmi";
		$dom=$d[0];
		$url='http://www.uin-suka.ac.id/index.php/service/get_prodi/'.$dom;
		$data=file_get_contents($url);
		$data=json_decode($data);
		foreach($data as $d){ 
			$nm_prodi=$d->nm_prodi;
		}
		return $nm_prodi;	
	}
}

   function aasort(&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}