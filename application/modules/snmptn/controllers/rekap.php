<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller {
    public function __construct()
       {
            parent::__construct();
        $this->load->library('lib_yudisium');
            $this->load->library('Webserv');
        //  $this->load->database();
		//  $this->load->model('yudisium_model');
       }
	 
	function peminat(){
		$peminat1=$this->webserv->snmptn('rekap/rekap_peminat',array('PTN'=>1));
		$peminat2=$this->webserv->snmptn('rekap/rekap_peminat',array('PTN'=>2));
		$arr_peminat1=array();
		foreach($peminat1 as $p){
			if(!isset($arr_peminat1[$p->program_studi])) {
				$arr_peminat1[$p->program_studi] = array();
			}
			$arr_peminat1[$p->program_studi][] = $p;
		}	
		$data['peminat1']=$arr_peminat1;
		$arr_peminat2=array();
		foreach($peminat2 as $p){
			if(!isset($arr_peminat2[$p->program_studi])) {
				$arr_peminat2[$p->program_studi] = array();
			}
			$arr_peminat2[$p->program_studi][] = $p;
		}	
		$data['peminat2']=$arr_peminat2;
		$data['content']='snmptn/rekap/peminat';
		$this->load->view('admin/header',$data);
	}   
	function jenis_kelamin(){	
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Rekap Yudisium', '');	
		$this->breadcrumb->append_crumb('Rekap Jenis Kelamin', '/');	
		$data['jenis_kelamin1']=$this->webserv->snmptn('rekap/rekap_jenis_kelamin',array('PTN'=>1));
		$data['jenis_kelamin2']=$this->webserv->snmptn('rekap/rekap_jenis_kelamin',array('PTN'=>2));
		$data['jenis_kelamin']=$this->webserv->snmptn('rekap/rekap_jenis_kelamin');
		$data['content']='snmptn/rekap/jenis_kelamin';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	}
	function provinsi($ptn=1){
		$data['prov1']=$this->webserv->snmptn('rekap/rekap_provinsi',array('PTN'=>$ptn));
		$data['ptn']=$ptn;
		$data['content']='snmptn/rekap/provinsi';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	}
	function kabupaten($ptn=1){
		$data['kab1']=$this->webserv->snmptn('rekap/rekap_kabupaten',array('PTN'=>$ptn));
		//$data['kab2']=$this->lib_yudisium->api_yudisium('snmptn/yudisium/rekap_kabupaten',array('PTN'=>2));
		$data['ptn']=$ptn;
		$data['content']='snmptn/rekap/kabupaten';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	} 
	  	
	function nilai(){		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Rekap Yudisium', '');	
		$this->breadcrumb->append_crumb('Rekap Nilai', '/');	
		$data['nilai']=$this->webserv->snmptn('rekap/rekap_nilai');
		$data['content']='snmptn/rekap/nilai';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	} 
	
	function sekolah(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('admin/login');
		}else{
			$data['sekolah']=$this->db->query("SELECT SEKOLAH.NAMA_SEKOLAH,COUNT(SISWA.NOMOR_PENDAFTARAN) JUMLAH FROM SISWA
								LEFT JOIN SEKOLAH ON SEKOLAH.NPSN=SISWA.NPSN_SEKOLAH
								GROUP BY SEKOLAH.NAMA_SEKOLAH
								ORDER BY JUMLAH DESC
								")->result_array();
										
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');										
			$this->load->view('yudisium/rekap/sekolah');
			$this->load->view('admin/footer');
		}
	} 
	
	function diterima(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Rekap Yudisium', '');	
		$this->breadcrumb->append_crumb('Rekap Diterima', '/');
		$data['diterima']=$this->webserv->snmptn('rekap/rekap_diterima');
		$data['content']='snmptn/rekap/diterima';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
	} 
	
 	function set_prodi($url="",$prodi=""){
		$this->session->set_userdata(array('kd_prodi'=>$prodi));
		redirect('yudisium/'.$url);
	}
	
	
}
