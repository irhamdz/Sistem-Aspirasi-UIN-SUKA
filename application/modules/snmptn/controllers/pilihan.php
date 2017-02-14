<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pilihan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
    }

	function daftar_pilihan($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Pilihan', '/');	
		if($_POST != null){
			$nama_pilihan=$this->input->post('nama_pilihan');
			$this->session->set_userdata('nama_pilihan',$nama_pilihan);
		}
		$nama_pilihan=$this->session->userdata('nama_pilihan');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=50;
		$cfg=$this->webserv->snmptn('pilihan/total_row');
		$config['base_url'] = site_url('snmptn/pilihan/daftar_pilihan');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['pilihan'] = $this->webserv->snmptn('pilihan/data_pilihan',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		//print_r($data['pilihan']);
		$data['content']="snmptn/pilihan/pilihan_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_pilihan($npsn=0){
		$data['d'] = $this->webserv->snmptn('pilihan/detail_pilihan',array('NPSN'=>$npsn));
		$data['content']="snmptn/pilihan/detail_pilihan_view";
		$this->load->view('admin/modal',$data);
	}


	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Pilihan', site_url('snmptn/pilihan/daftar_pilihan'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/pilihan/impor";
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{
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
						$di[$j]['nomor_pendaftaran']								= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['urutan_ptn']   			= $data->val($i,2);  
						if($data->val($i,3)!=null) $di[$j]['urutan_program_studi'] 	= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['kode_program_studi']  	= $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['program_studi']  		= $data->val($i,5);  
						if($data->val($i,6)!=null) $di[$j]['diterima_ptn_lain'] 	= $data->val($i,6); 
					}	
				}
				$cdi=array_chunk($di,150);
				foreach($cdi as $di){
				$rs[] = $this->webserv->snmptn('pilihan/impor',array('DI'=>$di));
				}
				/*  echo"<pre>";
				print_r($rs);
				echo"</pre>";die();  */
		
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/pilihan/daftar_pilihan');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/pilihan/impor');
			}	
		}	
	}

}
