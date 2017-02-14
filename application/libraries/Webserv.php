<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Webserv {

	function post($module="",$postdata=array())
	{
	$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service2.uin-suka.ac.id/servweb/index.php/it/'.$module);
		
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
		return $result;
	}

	function pegawai($postdata=array())
	{
	$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service2.uin-suka.ac.id/servsimpeg/simpeg_public/simpeg_mix/data_search');
		
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
		return $result;
	}
	
	function yudisium($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/it/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	function admisi($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/it/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	function snmptn($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/snmptn/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	function spanptkin($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/spanptkin/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}


	function rekap($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.uin-suka.ac.id/servadmisi/rekap/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	function registrasi($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/registrasi/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	function bayar($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service2.uin-suka.ac.id/servsibayar/index.php/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}
	function akreditasi_post($module="",$postdata=array()){
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		$CI->load->library('curl');
		$CI->curl->create('http://service.uin-suka.ac.id/servakreditasi/index.php/akreditasi/'.$module);
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}

	
	function cbt($module="",$postdata=array())
	{
		$CI =& get_instance();
		$username = 'admin';
		$password = '1234';
		 
		$CI->load->library('curl');
		 
		$CI->curl->create('http://service.admisi.uin-suka.ac.id/index.php/servcbt/'.$module);
	   
		$CI->curl->http_login($username, $password);
		
		$CI->curl->post($postdata);
		$result = json_decode($CI->curl->execute());
	  return $result;
	}
}