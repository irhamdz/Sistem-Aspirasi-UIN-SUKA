<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
	}
	function index($page=0)
	{
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('document/total_row');
		$config['base_url'] = site_url('admin/dokumen/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['doc'] = $this->webserv->admisi('document/history_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="admin/dokumen/dokumen_view";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}
	
	public function add() {
		if($_POST==NULL) {
			$data['doc'] = $this->webserv->admisi('document/document_get');
			$data['content']="admin/dokumen/dokumen_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$nama_dokumen= $this->input->post('nama_dokumen');
				$nama_histori= $this->input->post('nama_histori');
				
					
				$di = array(
				  'id_dokumen'=>$nama_dokumen,
				  'nama_histori'=>$nama_histori
				);
				if(!empty($_FILES['file']['tmp_name'])){
					$blobdata = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
					$di['file']=$blobdata;
					$di['nama_file']=$_FILES['file']['name'];
				}
				if(!empty($_FILES['file_sumber']['tmp_name'])){
					$blobdata = base64_encode(file_get_contents($_FILES['file_sumber']['tmp_name']));
					$di['file_sumber']=$blobdata;
					$di['nama_file_sumber']=$_FILES['file_sumber']['name'];
				}
				
				$data=array('INSERT_DATA'=>$di);
			//print_r($data);die();
				$result=$this->webserv->admisi('document/add_history',$data);
			//	print_r($result);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('admin/dokumen/index');
		}			
	}

	public function edit($id=0) {
		if($_POST==NULL) {
			$data['doc'] = $this->webserv->admisi('document/document_get');
			$data['d'] = $this->webserv->admisi('document/history_detil',array('ID'=>$id));
			$data['content']="admin/dokumen/dokumen_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$nama_dokumen= $this->input->post('nama_dokumen');
				$nama_histori= $this->input->post('nama_histori');
									
				$di = array(
				  'id_dokumen'=>$nama_dokumen,
				  'nama_histori'=>$nama_histori
				);
				if(!empty($_FILES['file']['tmp_name'])){
					$blobdata = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
					$di['file']=$blobdata;
					$di['nama_file']=$_FILES['file']['name'];
				}
				if(!empty($_FILES['file_sumber']['tmp_name'])){
					$blobdata = base64_encode(file_get_contents($_FILES['file_sumber']['tmp_name']));
					$di['file_sumber']=$blobdata;
					$di['nama_file_sumber']=$_FILES['file_sumber']['name'];
				}
				
			$data=array('ID'=>$id,'INSERT_DATA'=>$di);
			$result = $this->webserv->admisi('document/edit_history',$data);
		//	print_r($result);die();
			$this->session->set_flashdata('message', 'Data berhasil disimpan.');
			redirect('admin/dokumen/index');
		}			
	}

	function delete($id=""){
		$data['d'] = $this->webserv->admisi('document/history_detil',array('ID'=>$id));
		$data=array('ID'=>$id);
		$result = $this->webserv->admisi('document/delete_history',$data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus.');
			redirect('admin/dokumen/index');
	}
	
	function docfile($id=''){
		$data= $this->webserv->admisi('document/docfile',array('ID'=>$id));
		$file_isi = $data->file;
		$file_nama = $data->nama_histori;
		if($file_nama){
			header("Content-Type: application/pdf");
			flush();
			echo base64_decode($file_isi);
			exit;
		}else{
			echo "Thanks for landing captain!";
		} 
	}

}
