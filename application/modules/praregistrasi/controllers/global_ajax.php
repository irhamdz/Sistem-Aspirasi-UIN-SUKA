<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class global_ajax extends CI_Controller {
	function __construct(){
        parent::__construct();       
        error_reporting(E_ALL);
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();	
		
    }
	function kabupaten_cari(){
		$this->load->library('lib_reg_fungsi');
		$katakunci=$this->input->post('katakunci');
		$lokasi_balik=$this->input->post('lokasi_balik');
		$lokasi=$this->input->post('lokasi');
		$lokasi_tampil=$this->input->post('lokasi_tampil');
		if($katakunci){
			$data	= $this->lib_reg_fungsi->data_kabupaten($katakunci);
			$data['isi']=$data;
			//$data['lokasi']=$lokasi;			
			if($lokasi_balik=='KD_KAB'){
				$propinsi="1";
			}else{
				$propinsi='0';
			}
			$data['propinsi']=$propinsi;
			$data['lokasi_balik']=$lokasi_balik;
			$data['lokasi']="$lokasi#$lokasi_balik#$lokasi_tampil";
			$this->load->view('praregistrasi/v_ajax_kab',$data);
		}else{
			echo "";
		}
	}
	function propinsi_cari(){
		$this->load->library('lib_reg_fungsi');
		$kd_kab=$this->input->post('kd_kab');
		if($kd_kab){
			$data=$this->lib_reg_fungsi->data_kabupaten_detail($kd_kab);
			$KD_PROP=$data['KD_PROP'];
			$NM_PROP=$data['NM_PROP'];
			echo "$KD_PROP#$NM_PROP";
		}else{
			echo "";
		}
	}
	function ajax_data_sekolah(){
		$this->load->library('lib_reg_fungsi');
		$KD_PEND=$this->input->post('KD_PEND');
		$hasil='';
		$hasil=$this->lib_reg_fungsi->data_sekolah2($KD_PEND);
		$data['hasil']=$hasil;
		$this->load->view("praregistrasi/v_ajax_pendidikan",$data);
	}
}	
?>