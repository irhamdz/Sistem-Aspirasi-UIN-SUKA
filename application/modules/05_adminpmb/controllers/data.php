<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("pagination");
		$this->load->library("lib_adminpmb", '', 'adminpmb');
		
		#$this->session->set_userdata('app', 'adminpmb');
		if($this->adminpmb->cek_allowed("AAZF01#AAZF09#AAZ001")){
			
		}else{
			redirect();
		}
		
	
	}
			
	function data(){ 
		if($_POST['cek']=='CEKDATA'){
		#echo $_GET['pin'];
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 4, 'api_search' => array($_POST['pin']));
		$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		#print_r($data['cek']);
		$this->output99->output_display('05_adminpmb/cek', $data);
		}else{
		$this->output99->output_display('05_adminpmb/cek');	
		
		}
	
	}
	
	function reset_data_peserta(){ 
		
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 168, 'api_subkode' => 5, 'api_search' => array($_POST['pin']));
		$data['cek'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);	
		print_r($data['cek']);
		
	
	}
	
	
}