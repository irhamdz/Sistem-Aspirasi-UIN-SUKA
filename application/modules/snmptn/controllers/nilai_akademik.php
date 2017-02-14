<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_akademik extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
		$this->load->helper('format_tanggal');
    }

	function daftar_nilai_akademik($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Nilai Akademik', '/');	
		if($_POST != null){
			$tahun=$this->input->post('tahun');
			$this->session->set_userdata('tahun',$tahun);
		}
		$tahun=$this->session->userdata('tahun');
		if(empty($tahun))$tahun=date('Y');
		$data['tahun']=$tahun;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=50;
		$cfg=$this->webserv->snmptn('nilai_akademik/total_row',array('TAHUN'=>$tahun));
		$config['base_url'] = site_url('snmptn/nilai_akademik/daftar_nilai_akademik');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['nilai_akademik'] = $this->webserv->snmptn('nilai_akademik/data_nilai_akademik',array('TAHUN'=>$tahun,'LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="snmptn/nilai_akademik/nilai_akademik_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_nilai_akademik($np=0){
		$data['d'] = $this->webserv->snmptn('nilai_akademik/detail_nilai_akademik',array('NP'=>$np));
		$data['content']="snmptn/nilai_akademik/detail_nilai_akademik_view";
		$this->load->view('admin/modal',$data);
	}

	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Nilai Akademik', site_url('snmptn/nilai_akademik/daftar_nilai_akademik'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/nilai_akademik/impor";
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{
			$tahun=$this->input->post('tahun');
			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			if($ext=='xls' AND ($_FILES['file']['type']=='application/ms-excel' or $_FILES['file']['type']=='application/vnd.ms-excel' or $_FILES['file']['type']=='application/x-msexcel')){
					$data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);  
				//print_r($data);
				$filename=$_FILES['file']['name'];
				//move_uploaded_file($_FILES["file"]["tmp_name"],"./files/" . $_FILES["file"]["name"]);
				$j = -1;  
				
				for ($i=2; $i <= ($data->rowcount($sheet_index=0)); $i++){ 
					$j++; 
					if($data->val($i,1)!=null){
						if($data->val($i,1)!=null) $di[$j]['nomor_pendaftaran']		= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['id_kelas']   			= $data->val($i,2);  		
						if($data->val($i,3)!=null) $di[$j]['semester']   			= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['kode_mata_pelajaran']   = $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['mata_pelajaran_kesetaraan']   	= $data->val($i,5);  
						if($data->val($i,6)!=null) $di[$j]['nilai']  				= $data->val($i,6);  
						if($data->val($i,7)!=null) $di[$j]['remedial']   			= $data->val($i,7);  
						if($data->val($i,8)!=null) $di[$j]['kkm']  		 			= $data->val($i,8);  
					}	
				}
				$cdi=array_chunk($di,100);
				foreach($cdi as $di){
					$rs[] = $this->webserv->snmptn('nilai_akademik/impor',array('DI'=>$di));
				}
				
				/* echo"<pre>";
				print_r($rs);
				echo"</pre>";die(); */
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/nilai_akademik/daftar_nilai_akademik');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/nilai_akademik/impor');
			}		
		}	
		
	}

}
