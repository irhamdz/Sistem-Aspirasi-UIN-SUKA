<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller {
    public function __construct()
       {
            parent::__construct();
			$this->load->library('curl');
		//	$this->load->library('excel_reader');
			$this->load->library('s00_lib_api');
			$this->load->library('service_lib');
			$this->load->helper('to_excel');
       }
	  
	function ceklist(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Rekap Ceklist', '/');	
		if($_POST==null){
			$data['kode_prodi']=$kd_prodi=$this->session->userdata('kd_prodi');	
			if(isset($kd_prodi)and $kd_prodi!=null){
				$prodi = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
								array('api_kode'=>18000, 'api_subkode' => 3, 'api_search' => array($kd_prodi)));
				$mhs = $arr_mhs_sia[] = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>26000, 'api_subkode' => 13, 'api_search' => array($prodi[0]['KD_PRODI'],'2014')));
			}
			
			
			$dok=$this->service_lib->api_registrasi('registrasi/get_dokumen_registrasi');		
			$data['dokumen']=$dok;	
			$ceklist=$this->service_lib->api_registrasi('registrasi/get_ceklist_all');	
					
			$arr_ceklist=array();
			foreach($ceklist as $n){
				if(!isset($arr_ceklist[$n->NIM])) {
					$arr_ceklist[$n->NIM] = array();
				}
				 
				if(!isset($arr_ceklist[$n->NIM][$n->KODE_DOKUMEN])) {
					$arr_ceklist[$n->NIM][$n->KODE_DOKUMEN] = array();
				}
				 $arr_ceklist[$n->NIM][$n->KODE_DOKUMEN] = $n->STATUS;
			}
			//print_r($arr_ceklist);
			$data['arr_ceklist']=$arr_ceklist;
			
			@$data['mhs']=$mhs;
			$data['prodi']=$this->service_lib->api_registrasi('yudisium/get_prodi');
		//	print_r($data['prodi']);
			$data['content']='registrasi/rekap/ceklist';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			//$this->load->view('s00_vw_all', $data);
		}
	}	
	 
	function ceklist_xls(){
		if($_POST==null){
			$data['kode_prodi']=$kd_prodi=$this->session->userdata('kd_prodi');	
			if(isset($kd_prodi)and $kd_prodi!=null){
				$prodi = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
								array('api_kode'=>18000, 'api_subkode' => 3, 'api_search' => array($kd_prodi)));
				$mhs = $arr_mhs_sia[] = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>26000, 'api_subkode' => 13, 'api_search' => array($prodi[0]['KD_PRODI'],'2014')));
			}
			$nm_prodi=$prodi[0]['NM_PRODI'];
			
			$dok=$this->service_lib->api_registrasi('registrasi/get_dokumen_registrasi');		
			$data['dokumen']=$dok;	
			$ceklist=$this->service_lib->api_registrasi('registrasi/get_ceklist_all');	
					
			$arr_ceklist=array();
			foreach($ceklist as $n){
				if(!isset($arr_ceklist[$n->NIM])) {
					$arr_ceklist[$n->NIM] = array();
				}
				 
				if(!isset($arr_ceklist[$n->NIM][$n->KODE_DOKUMEN])) {
					$arr_ceklist[$n->NIM][$n->KODE_DOKUMEN] = array();
				}
				 $arr_ceklist[$n->NIM][$n->KODE_DOKUMEN] = $n->STATUS;
			}
			//print_r($arr_ceklist);
			$data['arr_ceklist']=$arr_ceklist;
			$data['mhs']=$mhs;
			
			
			$title=array("Daftar Ceklist Mahasiswa Program Studi ".$nm_prodi);
			$header=array("NO","NIM","NAMA");
			foreach($dok as $d){
				array_push($header,$d->NAMA_SINGKAT);
			} 
									
									
			$data2 = array($title,$header);
			$filename  = 'Daftar_Ceklist_Mahasiswa_'.str_replace(" ","_",$nm_prodi);
			$loop = 0;
			
			
			 foreach($mhs as $m){
							
				$content[$loop] = array($loop+1,$m['NIM'],$m['NAMA']);
					foreach($dok as $d){
				  if(isset($arr_ceklist[$m['NIM']][$d->KODE_DOKUMEN]) and $arr_ceklist[$m['NIM']][$d->KODE_DOKUMEN]){
					array_push($content[$loop],"Ada");
				  }else{
					array_push($content[$loop]," ");
				  }
				}
				array_push($data2, $content[$loop]);
				$loop++; 
			}
			 
		//print_r($data2);
			$this->load->helper('to_excel');
			array_to_excel($data2, $filename);
		}
	}	
	
 	function set_prodi($url="",$prodi=""){
		$this->session->set_userdata(array('kd_prodi'=>$prodi));
		redirect('registrasi/rekap/'.$url);
	}
	
	
	function verifikasi_rapor(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Rekap Ceklist', '/');	
		if($_POST==null){
			$kd_prodi=$this->session->userdata('kd_prodi');
			$data['kode_prodi']=$kd_prodi;
			$dp=$this->service_lib->api_registrasi('registrasi/get_prodi');	
			$data['prodi']=$dp;
			$data['kd_jalur']=$kd_jalur=$this->session->userdata('kd_jalur');
			$data['tahun']=$tahun=$this->session->userdata('tahun');
			$data['reg_jalur']=$this->service_lib->api_registrasi('registrasi/get_jalur');
			//print_r($data['reg_jalur']);
			$postdata=array('PTN'=>1,'KD_PRODI'=>$kd_prodi,'TAHUN'=>$tahun, 'KD_JALUR'=>$kd_jalur);
			$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
			$data['ver_nilai']= $this->service_lib->api_registrasi('registrasi/get_hasil_verifikasi',$postdata);
			
		//print_r($ver_nilai);
			$data['content']='registrasi/rekap/rapor';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
		}else{
			$this->session->set_userdata(array(
				'kd_prodi'=>$this->input->post('prodi'),
				'kd_jalur'=>$this->input->post('jalur'),
				'tahun'=>$this->input->post('tahun')
			));
				redirect('registrasi/rekap/verifikasi_rapor');
		}	
	}	
	 
	function verifikasi_profil(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Rekap Ceklist', '/');	
		if($_POST==null){
			$kd_prodi=$this->session->userdata('kd_prodi');
			$data['kode_prodi']=$kd_prodi;
			$dp=$this->service_lib->api_registrasi('registrasi/get_prodi');	
			$data['prodi']=$dp;
			$data['kd_jalur']=$kd_jalur=$this->session->userdata('kd_jalur');
			$data['tahun']=$tahun=$this->session->userdata('tahun');
			$data['reg_jalur']=$this->service_lib->api_registrasi('registrasi/get_jalur');
			//print_r($data['reg_jalur']);
			$postdata=array('PTN'=>1,'KD_PRODI'=>$kd_prodi,'TAHUN'=>$tahun, 'KD_JALUR'=>$kd_jalur);
			$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
			$data['siswa']= $this->service_lib->api_registrasi('registrasi/get_verifikasi_profil',$postdata);
			
		//print_r($ver_nilai);
			$data['content']='registrasi/rekap/profil';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
		}else{
			$this->session->set_userdata(array(
				'kd_prodi'=>$this->input->post('prodi'),
				'kd_jalur'=>$this->input->post('jalur'),
				'tahun'=>$this->input->post('tahun')
			));
				redirect('registrasi/rekap/verifikasi_profil');
		}	
	}	
	 
	function verifikasi_profil_xls(){
			$kd_prodi=$this->session->userdata('kd_prodi');
			$data['kode_prodi']=$kd_prodi;
			$dp=$this->webserv->snmptn('penilaian/get_prodi');		
			$data['prodi']=$dp;
			$data['kd_jalur']=$kd_jalur=$this->session->userdata('kd_jalur');
			$data['tahun']=$tahun=$this->session->userdata('tahun');
			$data['jalur']=$this->service_lib->api_registrasi('registrasi/get_jalur',array('KD_JALUR'=>$kd_jalur));
			//print_r($data['jalur']);
			$postdata=array('PTN'=>1,'KD_PRODI'=>$kd_prodi,'TAHUN'=>$tahun, 'KD_JALUR'=>$kd_jalur);
			$data['siswa']= $this->service_lib->api_registrasi('registrasi/get_verifikasi_profil',$postdata);
			$this->load->view('registrasi/rekap/profil_xls',$data);
	
	
	}	
	
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
  }
	
	function cetak_verifikasi_rapor(){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Rekap Ceklist', '/');	
		
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$dp=$this->service_lib->api_registrasi('registrasi/get_prodi');
		$data['prodi']=$dp;
		$data['p']=$this->webserv->snmptn('penilaian/get_prodi',array('KD_PRODI'=>$kd_prodi));
		$data['unit']=$this->webserv->admisi('data_form/data_uin2',array());
		$postdata=array('PTN'=>1,'KD_PRODI'=>$kd_prodi);
		$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
		$data['ver_nilai']= $this->service_lib->api_registrasi('registrasi/get_hasil_verifikasi',$postdata);
		
		//print_r($ver_nilai);
			//$data['content']='registrasi/rekap/cetak_rapor';
			$this->load->view('registrasi/rekap/cetak_rapor',$data);
	}	
	 
	 
	 function logo (){		
		
		$this->load->helper(array('url','mediatutorialpdf'));
		$postdata=array('PTN'=>1,'KD_PRODI'=>$kd_prodi);
		$data['siswa']=$this->webserv->snmptn('penilaian/get_siswa_diterima',$postdata);
		$data['ver_nilai']= $this->service_lib->api_registrasi('registrasi/get_hasil_verifikasi');
		
		 
	 }
	function api_registrasi($modul,$postdata=""){
	
			$username='regist';
			$password='regist123';
		
			$this->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servsiasuper/index.php/".$modul;
			$hasil = $this->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil,true);
	}


	
	
}
