<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH.'/libraries/REST_Controller.php';

class Jalur_pmb extends CI_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->library('webserv');
		
	}
	
	function index()
	{
		
	}

	function validate_jalur_pmb($kode_pmb)
	{

			$kode_bayar=array('kode_bayar'=>$kode_pmb);
			$data=array('DETAIL_BAYAR'=>$kode_bayar);
			$data['detail_penawaran_jalur'] = $this->webserv->admisi('input_data/detail_penawaran_jalur',$data);
			
			


			$data['content']="v_penawaran_pmb/penawaran";
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
			
			
	}

}