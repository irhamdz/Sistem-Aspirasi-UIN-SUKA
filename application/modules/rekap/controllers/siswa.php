<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
		$this->load->helper('format_tanggal');
    }

	function daftar_siswa($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('rekap', ' ');	
		$this->breadcrumb->append_crumb('Pendaftar', '/');	
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
		$cfg=$this->webserv->rekap('siswa/total_row');
		$config['base_url'] = site_url('rekap/siswa/daftar_siswa');
		$config['total_rows'] = $cfg->TOTAL;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$per_page;
		$data['offset']=$offset;
		$data['siswa'] = $this->webserv->rekap('siswa/pendaftar',array('TAHUN'=>$tahun,'LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="rekap/siswa/siswa_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_siswa($np=0){
		$data['d'] = $this->webserv->rekap('siswa/detail_siswa',array('NP'=>$np));
		$data['content']="rekap/siswa/detail_siswa_view";
		$this->load->view('admin/modal',$data);
	}

	function impor(){		
		if($_POST == null){
			$data['content']="rekap/siswa/impor";
			$this->load->view('admin/header',$data);
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
						if($data->val($i,1)!=null) $di[$j]['NO_PMB']	= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['NM_CMB']   		= $data->val($i,2);  		
						if($data->val($i,3)!=null) $di[$j]['KD_JALUR']   		= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['KD_TA']   		= $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['KD_PRODI_PIL_1']   	= $data->val($i,5);  
						if($data->val($i,6)!=null) $di[$j]['KD_PRODI_PIL_2']  	= $data->val($i,6);  
						if($data->val($i,7)!=null) $di[$j]['KD_PRODI_PIL_3']   		= $data->val($i,7);  
						if($data->val($i,8)!=null) $di[$j]['KD_PRODI_PIL_DITERIMA'] = $data->val($i,8);  
						if($data->val($i,9)!=null) $di[$j]['TGL_LAHIR']   				= $data->val($i,9);  
						if($data->val($i,10)!=null) $di[$j]['J_KELAMIN']   				= $data->val($i,10);  
						if($data->val($i,11)!=null) $di[$j]['NO_HP']   			= $data->val($i,11);  
						if($data->val($i,12)!=null) $di[$j]['NPSN']   			= $data->val($i,12);  
						if($data->val($i,13)!=null) $di[$j]['NM_SEKOLAH']   		= $data->val($i,13);  
						if($data->val($i,14)!=null) $di[$j]['JURUSAN'] 		= $data->val($i,14);   
						if($data->val($i,15)!=null) $di[$j]['KETERANGAN'] 	= $data->val($i,15);   
					}	
				}
				//PRINT_R($di);die();
				//$rs = $this->webserv->rekap('siswa/impor',array('TAHUN'=>$tahun,'DI'=>$di));
				$cdi=array_chunk($di,60);
				foreach($cdi as $di){
					$rs[] = $this->webserv->rekap('siswa/impor',array('TAHUN'=>$tahun,'DI'=>$di));
				}
				 
				echo"<pre>";
				print_r($rs);
				echo"</pre>";die(); 
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('rekap/siswa/daftar_siswa');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('rekap/siswa/impor');
			}		
		}	
		
	}

}
