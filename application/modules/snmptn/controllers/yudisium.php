<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yudisium extends CI_Controller {
    public function __construct()
       {
           parent::__construct();
        //  $this->load->database();
            $this->load->library('lib_yudisium');
            $this->load->library('s00_lib_api');
			$this->load->helper('format_tanggal');
            $this->load->library('Webserv');
       }
	   
	function index(){
		 $kd_prodi=$this->session->userdata('kd_prodi');
		 $username=$this->session->userdata('username');
		
		$dp=$this->webserv->snmptn('penilaian/get_prodi',array('ID_USER'=>$username));		
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
						
		if($_POST == null){
				$bobot=$this->webserv->snmptn('penilaian/get_bobot');
				foreach($bobot as $b){
					$bobot2[$b->kode_nilai]=$b->bobot;
				}
				$data['b']=$bobot2;
				
				$dp=$this->webserv->snmptn('penilaian/get_prodi',array('ID_USER'=>$username));		
				$data['prodi']=$dp;
				$arp=array();
				foreach($dp as $dp){
					$arp[$dp->kode_program_studi]=$dp;
				}	
				$kd_prodi=$this->session->userdata('kd_prodi');
				$data['kode_prodi']=$kd_prodi;
				if(isset($kd_prodi)and $kd_prodi!=null){
			
				/*========================*/
			 $prestasi=$this->webserv->snmptn('penilaian/get_prestasi');
				$arr_prestasi=array();
				foreach($prestasi as $p){
					if(!isset($arr_prestasi[$p->nomor_pendaftaran])) {
						$arr_prestasi[$p->nomor_pendaftaran] = array();
					}

					 $arr_prestasi[$p->nomor_pendaftaran][] = $p;
				}
				$data['prestasi']=$arr_prestasi;
				 $postdata=array(
					'TAHUN'=>2015,
					'KD_PRODI'=>$kd_prodi,
					'PILIHAN'=>$pilihan
				);
					$data['siswa']=$this->webserv->snmptn('penilaian/get_nilai_yudisium',$postdata);
				}
				$data['content']='snmptn/yudisium_form';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
		}else{
				$diterima=$this->input->post('diterima');
				$postdata=array(
					'PTN'=>1,
					'KD_PRODI'=>$kd_prodi,
					'PILIHAN'=>$pilihan,
					'DITERIMA'=>$diterima
				);
				$result=$this->webserv->snmptn('penilaian/set_siswa_diterima',$postdata);
				$this->session->set_flashdata('message',array("success","Data berhasil disimpan."));
				redirect('snmptn/yudisium/index');
		}
	} 
	
 	function set_prodi($url="",$prodi=""){
		$this->session->set_userdata(array('kd_prodi'=>$prodi));
		redirect('snmptn/yudisium/'.$url);
	}
	
	function accepted()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Siswa Diterima', '/');
		
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		$dp=$this->webserv->snmptn('penilaian/get_prodi');	
		$data['prodi']=$dp;
		
		
		$this->load->library('s00_lib_api');	
		$arp=array();
		foreach($dp as $dp){
			$arp[$dp->kode_program_studi]=$dp;
		}
		//	print_r($arp);	
		if($kd_prodi!=null){
		
		$postdata=array('PTN'=>$ptn,'KD_PRODI'=>$kd_prodi);
		$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
		}
		$data['content']='snmptn/accepted_view';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	}   

 
	function sk_rektor($prodi=""){
		$data['config']=$this->webserv->snmptn('penilaian/get_config');
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		$data['p']=$this->webserv->snmptn('penilaian/get_prodi',array('KD_PRODI'=>$kd_prodi));
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$postdata=array('PTN'=>$ptn,'KD_PRODI'=>$kd_prodi);
		$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
		$this->load->view('snmptn/sk_rektor_view',$data);
	}   
	
	
	function sk_yudisium($prodi=""){
		$data['config']=$this->webserv->snmptn('penilaian/get_config');
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		$data['p']=$this->webserv->snmptn('penilaian/get_prodi',array('KD_PRODI'=>$kd_prodi));
		$p=$this->webserv->snmptn('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$postdata=array('PTN'=>$ptn,'KD_PRODI'=>$kd_prodi);
		$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
		$this->load->view('snmptn/sk_yudisium_view',$data);
	}   

function tes(){
 $NOMOR_PENDAFTARAN='1411004910';
	$du=$this->lib_yudisium->api_yudisium('yudisium/get_siswa_diterima',array('NOMOR_PENDAFTARAN'=>$NOMOR_PENDAFTARAN));
	print_r($du);
}
	
}
