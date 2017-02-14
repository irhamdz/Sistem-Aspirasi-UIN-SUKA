<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mata_pelajaran extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
    }

	function daftar_mata_pelajaran($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Mata Pelajaran', '/');	
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=50;
		$cfg=$this->webserv->snmptn('mata_pelajaran/total_row');
		$config['base_url'] = site_url('snmptn/mata_pelajaran/daftar_mata_pelajaran');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['mata_pelajaran'] = $this->webserv->snmptn('mata_pelajaran/data_mata_pelajaran',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		//print_r($data['mata_pelajaran']);
		$data['content']="snmptn/mata_pelajaran/mata_pelajaran_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Mata Pelajaran', site_url('snmptn/mata_pelajaran/daftar_mata_pelajaran'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/mata_pelajaran/impor";
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
						$di[$j]['kode_mata_pelajaran']								= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['mata_pelajaran']   		= $data->val($i,2);  
					}	
				}
				$cdi=array_chunk($di,500);
				foreach($cdi as $di){
				$rs[] = $this->webserv->snmptn('mata_pelajaran/impor',array('DI'=>$di));
				}
				/*  echo"<pre>";
				print_r($rs);
				echo"</pre>";die();  */
		
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/mata_pelajaran/daftar_mata_pelajaran');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/mata_pelajaran/impor');
			}	
		}	
	}

}
