<?php
/**
* class for easy uploading of files for CI
* @author zeratool
* @uses CI::Upload class
*
*/
class service_lib{
        function __construct()
        {
            $this->CI =& get_instance();
        }
 
	function api_registrasi($modul,$postdata="",$array=true){
	
			$username='regist';
			$password='regist123';
		
			$this->CI->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servadmisi/index.php/".$modul;
			$hasil = $this->CI->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil,$array);
	}
        
	function api_praregistrasi($modul,$postdata="",$array=true){
	
			$username='regist';
			$password='regist123';
		
			$this->CI->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://admisi11:42m151@service.uin-suka.ac.id/servadmisi/index.php/".$modul;
			return $hasil = $this->CI->curl->simple_post($api_url,$postdata);
			//return $nilai=json_decode($hasil,$array);
	}
        
   
}
 
?>