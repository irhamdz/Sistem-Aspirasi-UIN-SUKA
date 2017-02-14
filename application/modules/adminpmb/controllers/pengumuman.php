<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
		$this->load->library('pagination');
		$this->load->library('webserv');
	}
	function index($page=0)
	{
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->post('announcement/total_row');
		$config['base_url'] = site_url('admin/pengumuman/index/');
		$config['total_rows'] = $cfg->TOTAL;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['pengumuman'] = $this->webserv->post('announcement/announcements',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="admin/pengumuman/pengumuman_view";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	
	public function add() {
		if($_POST==NULL) {
			$data['content']="admin/pengumuman/pengumuman_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$judul= $this->input->post('judul');
				$url= $this->input->post('url');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['file']['name'];
				move_uploaded_file($_FILES["file"]["tmp_name"],"./media/pengumuman/".$filename);
					
				$insert_data = array(
				  'JUDUL'=>$judul,
				  'URL'=>$url,
				  'NAMA_FILE'=>$filename,
				  'SUMBER'=>$sumber
				);
				
				$data=array('INSERT_DATA'=>$insert_data);
			
				$this->webserv->post('announcement/add_announcement',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('admin/pengumuman/index');
		}			
	}

	public function edit($id=0) {
		if($_POST==NULL) {
			$data['d'] = $this->webserv->post('announcement/announcement_detil',array('ID'=>$id));
			$data['content']="admin/pengumuman/pengumuman_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$judul= $this->input->post('judul');
				$url= $this->input->post('url');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['file']['name'];
				move_uploaded_file($_FILES["file"]["tmp_name"],"./media/pengumuman/".$filename);
				$insert_data = array(
				  'JUDUL'=>$judul,
				  'URL'=>$url,
				  'SUMBER'=>$sumber
				);
				if($_FILES['file']['name']){
					$insert_data['NAMA_FILE']=$filename;
				}
			$data=array('ID'=>$id,'INSERT_DATA'=>$insert_data);
			$result = $this->webserv->post('announcement/edit_announcement',$data);
			$this->session->set_flashdata('message', 'Data berhasil disimpan.');
			redirect('admin/pengumuman/index');
		}			
	}

	function delete($id=""){
		$data['d'] = $this->webserv->post('announcement/announcement_detil',array('ID'=>$id));
		$data=array('ID'=>$id);
		$result = $this->webserv->post('announcement/delete_announcement',$data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus.');
			redirect('admin/pengumuman/index');
	}

}
