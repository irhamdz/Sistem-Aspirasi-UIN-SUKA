<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prestasi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
		$this->load->helper('format_tanggal');
    }

	function daftar_prestasi($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Prestasi', '/');	
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
		$cfg=$this->webserv->snmptn('prestasi/total_row',array('TAHUN'=>$tahun));
		$config['base_url'] = site_url('snmptn/prestasi/daftar_prestasi');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['prestasi'] = $this->webserv->snmptn('prestasi/data_prestasi',array('TAHUN'=>$tahun,'LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="snmptn/prestasi/prestasi_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_prestasi($np=0){
		$data['d'] = $this->webserv->snmptn('prestasi/detail_prestasi',array('NP'=>$np));
		$data['content']="snmptn/prestasi/detail_prestasi_view";
		$this->load->view('admin/modal',$data);
	}

	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Prestasi', site_url('snmptn/prestasi/daftar_prestasi'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/prestasi/impor";
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
						if($data->val($i,1)!=null) $di[$j]['nomor_pendaftaran']	= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['id_prestasi']   	= $data->val($i,2);  		
						if($data->val($i,3)!=null) $di[$j]['jenis_prestasi']   	= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['jenjang_prestasi']  = $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['file_sertifikat']   = $data->val($i,5);  
					}	
				}
				$cdi=array_chunk($di,100);
				foreach($cdi as $di){
					$rs[] = $this->webserv->snmptn('prestasi/impor',array('DI'=>$di));
				}
				
				/* echo"<pre>";
				print_r($rs);
				echo"</pre>";die(); */
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/prestasi/daftar_prestasi');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/prestasi/impor');
			}		
		}	
		
	}

}
