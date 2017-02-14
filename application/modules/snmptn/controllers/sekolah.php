<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
    }

	function daftar_sekolah($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Sekolah', '/');	
		if($_POST != null){
			$nama_sekolah=$this->input->post('nama_sekolah');
			$this->session->set_userdata('nama_sekolah',$nama_sekolah);
		}
		$nama_sekolah=$this->session->userdata('nama_sekolah');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=50;
		$cfg=$this->webserv->snmptn('sekolah/total_row');
		$config['base_url'] = site_url('snmptn/sekolah/daftar_sekolah');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$per_page;
		$data['offset']=$offset;
		$data['sekolah'] = $this->webserv->snmptn('sekolah/data_sekolah',array('NAMA_SEKOLAH'=>$nama_sekolah,'LIMIT'=>$limit,'OFFSET'=>$offset));
	//	print_r($data['sekolah']);
		$data['content']="snmptn/sekolah/sekolah_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_sekolah($npsn=0){
		$data['d'] = $this->webserv->snmptn('sekolah/detail_sekolah',array('NPSN'=>$npsn));
		$data['content']="snmptn/sekolah/detail_sekolah_view";
		$this->load->view('admin/modal',$data);
	}


	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Sekolah', site_url('snmptn/sekolah/daftar_sekolah'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/sekolah/impor";
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
						$di[$j]['npsn']	= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['nama_sekolah']   		= $data->val($i,2);  
						if($data->val($i,3)!=null) $di[$j]['jenis_sekolah']   		= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['kode_kabupaten']   		= $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['nama_kabupaten']  		= $data->val($i,5);  
						if($data->val($i,6)!=null) $di[$j]['kode_provinsi'] 		= $data->val($i,6);  
						if($data->val($i,7)!=null) $di[$j]['nama_provinsi']   		= $data->val($i,7);  
						if($data->val($i,8)!=null) $di[$j]['akreditasi_sekolah']	= $data->val($i,8);  
						if($data->val($i,9)!=null) $di[$j]['nilai_akreditasi']   	= $data->val($i,9);  
						if($data->val($i,10)!=null) $di[$j]['kepemilikan']   		= $data->val($i,10); 
					}	
				}
				$cdi=array_chunk($di,100);
				foreach($cdi as $di){
				$rs[] = $this->webserv->snmptn('sekolah/impor',array('DI'=>$di));
				}
				/*  echo"<pre>";
				print_r($cdi);
				echo"</pre>";die();  */
		
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/sekolah/daftar_sekolah');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/sekolah/impor');
			}	
		}	
	}

}
