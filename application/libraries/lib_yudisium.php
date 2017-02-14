<?php
/**
* class for easy uploading of files for CI
* @author zeratool
* @uses CI::Upload class
*
*/
class lib_yudisium{
        function __construct()
        {
            $this->CI =& get_instance();
        }
 
        /**
         * uploads the file
         * @access public
         *
         */
		 
		 
		 
	function api_yudisium($modul,$postdata=""){
	
			$username='regist';
			$password='regist123';
		
			$this->CI->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servadmisi/index.php/".$modul;
			$hasil = $this->CI->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil);
	} 
		 
	function api_registrasi($modul,$postdata=""){
	
			$username='regist';
			$password='regist123';
		
			$this->CI->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servadmisi/index.php/".$modul;
			$hasil = $this->CI->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil);
	} 
	
	function api_snmptn($modul,$postdata=""){
	
			$username='regist';
			$password='regist123';
		
			$this->CI->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servadmisi/index.php/".$modul;
			$hasil = $this->CI->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil);
	}
        
   
}
 
?>