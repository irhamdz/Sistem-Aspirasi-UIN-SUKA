<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		Revitalisasi SIA
 * @creator     Adi Wirawan
 * @created     27/10/2013
 * $description data pendidikan digunakan untuk melakukan pendataan pendidikan yang telah ditempuh mahasiswa
*/
class index extends CI_Controller {
	function __construct(){
        parent::__construct();          
		$this->nim 			= $this->session->userdata('id_user');
		$status 		= $this->session->userdata('status');
		if(empty($this->nim)){
			redirect('');
		}
		//assign tahfidz 
		//$this->kode_tahfidz=1024;
		$this->api 		= $this->s00_lib_api;
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek();
		
    }
}