<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
    public function __construct()
       {
            parent::__construct();
            $this->load->library('lib_yudisium');
       }

	function index(){		
		if($_POST == null){
		$data['pembobotan']=$this->db->select('*')->from('PEMBOBOTAN')->get()->result();
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/setup/setup');
			$this->load->view('admin/footer');
		}else{
			$bobot=$this->input->post('bobot');
			$nilai=$this->input->post('nilai');
			
			foreach($bobot as $id=>$bobot){
			$this->db->query("UPDATE PEMBOBOTAN SET BOBOT='".$bobot."' WHERE ID_PEMBOBOTAN='".$id."'");
			}
			$this->session->set_flashdata('message',array("error","Data pembobotan berhasil disimpan."));
			redirect('yudisium/pembobotan');
		}	
		
	}
	
	function siswa(){	
		$this->load->library('s00_lib_api');			
		$dp=$this->lib_yudisium->api_yudisium('yudisium/get_prodi');	
		$arp=array();
		foreach($dp as $dp){
			$arp[$dp['KODE_REGULER']]=$dp;
		}	
		$siswa = $this->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/admisi_public/admisi_pmb/data_search', 'POST', 
				array('api_kode'=>10, 'api_subkode' => 51, 'api_search' =>array('GELOMBANG' => 10,'TAHUN' => 2014,'KD_PIL' => 37)));
	//	echo count($siswa);
		$data_search=array('KODE_JALUR' => 10,'TAHUN' => 2014);		
		
	//	$ds=$this->lib_yudisium->api_yudisium('yudisium/set_siswa_yudisium',$data_search);	
	//	echo count($ds);
		if($_POST == null){		
				$prodi=$this->lib_yudisium->api_yudisium('yudisium/setup_prodi');	
				$arr_prodi=array();				
				foreach($prodi as $p){
					if(!isset($arr_prodi[$p['PROGRAM_STUDI']])) {
						$arr_prodi[$p['PROGRAM_STUDI']] = array();
					}
					
					 
					if(!isset($arr_prodi[$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']])) {
						$arr_prodi[$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']] = array();
					}
					 $arr_prodi[$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']] = $p;
				}
				
				$data['arr_prodi']=$arr_prodi;
				$data['content']='yudisium/setup_pendaftar';
				$this->load->view('page/header',$data);					
				$this->load->view('page/content');			
				$this->load->view('page/footer');
		}else{
			$nama=$this->input->post('nama');
			
			$ds1=$this->db->query("SELECT SISWA.NOMOR_PENDAFTARAN,SISWA.NAMA_SISWA,
											SISWA.NISN,TO_CHAR(SISWA.TANGGAL_LAHIR,'DD/MM/YYYY') TGL_LAHIR 
											FROM SISWA
											LEFT JOIN NILAI_YUDISIUM ON NILAI_YUDISIUM.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
											WHERE DITERIMA='1' AND
											SISWA.NAMA_SISWA LIKE '%".$nama."%'")->result_array();
			$data_search=array(
			'nama'=>$nama,
		);
		$this->load->library('curl');
		$postorget 	= 'POST';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628722';
		$api_url 	= 'http://yudisium.uin-suka.ac.id/spanptain/index.php/service/siswa/search_siswa';
		$hasil 		= $this->curl->simple_post($api_url,$data_search);
		$ds2=json_decode($hasil,true);
		$data['siswa']=array_merge($ds1,$ds2);
		//print_r($ds2);
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/setup/siswa');
			$this->load->view('admin/footer');
		}	
		
	}
	
	


	
}
