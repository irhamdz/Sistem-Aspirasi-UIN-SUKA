<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		include_once ( APPPATH."libraries/excel_reader2.php");
        $this->load->library('lib_yudisium');
        $this->load->library('Webserv');
		$this->load->helper('format_tanggal');
    }

	function daftar_kelas($page=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('SNMPTN', ' ');	
		$this->breadcrumb->append_crumb('Daftar Kelas Pendaftar', '/');	
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
		$cfg=$this->webserv->snmptn('kelas/total_row',array('TAHUN'=>$tahun));
		$config['base_url'] = site_url('snmptn/kelas/daftar_kelas');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$per_page;
		$data['offset']=$offset;
		$data['kelas'] = $this->webserv->snmptn('kelas/data_kelas',array('TAHUN'=>$tahun,'LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="snmptn/kelas/kelas_view";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function detail_kelas($np=0){
		$data['d'] = $this->webserv->snmptn('kelas/detail_kelas',array('NP'=>$np));
		$data['content']="snmptn/kelas/detail_kelas_view";
		$this->load->view('admin/modal',$data);
	}

	function impor(){		
		if($_POST == null){
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('SNMPTN', '/');	
			$this->breadcrumb->append_crumb('Daftar Kelas Pendaftar', site_url('snmptn/kelas/daftar_kelas'));	
			$this->breadcrumb->append_crumb('Impor Data', '/');	
			$data['content']="snmptn/kelas/impor";
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
						if($data->val($i,1)!=null) $di[$j]['id_kelas']			= $data->val($i,1);  
						if($data->val($i,2)!=null) $di[$j]['tahun_kelas']   	= $data->val($i,2);  		
						if($data->val($i,3)!=null) $di[$j]['tingkat']   		= $data->val($i,3);  
						if($data->val($i,4)!=null) $di[$j]['nama_kelas']   		= $data->val($i,4);  
						if($data->val($i,5)!=null) $di[$j]['kode_jenis_kelas']  = $data->val($i,5);  
						if($data->val($i,6)!=null) $di[$j]['id_jurusan']  		= $data->val($i,6);  
					}	
				}
				$cdi=array_chunk($di,100);
				foreach($cdi as $di){
					$rs[] = $this->webserv->snmptn('kelas/impor',array('DI'=>$di));
				}
				
				/* echo"<pre>";
				print_r($rs);
				echo"</pre>";die(); */
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('snmptn/kelas/daftar_kelas');
			}else{
				$this->session->set_flashdata('message', 'Format berkas tidak sesuai. Gunakan file excel dengan ekstensi .xls');
				redirect('snmptn/kelas/impor');
			}		
		}	
		
	}

}
