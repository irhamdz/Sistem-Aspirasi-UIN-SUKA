<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class liputan extends CI_Controller {
public $data 	= 	array();
	public function __construct() {
		
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
		$this->load->library('webserv');
		$this->load->library('pagination');
		$this->load->helper('ckeditor');
	}
	function index($page=0)
	{
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->post('liputan/total_row');
		$config['base_url'] = site_url('admin/liputan/index/');
		$config['total_rows'] = $cfg->TOTAL;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['liputan'] = $this->webserv->post('liputan/liputan_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="admin/liputan/liputan_view";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	
	public function add() {
		if($_POST==NULL) {
			$data['ckeditor'] = array(
				'id' 	=> 	'text1',
				'path'	=>	'asset/ckeditor',
				'config' => array(	
					'width' 	=> 	"100%",	
					'height' 	=> 	'300px',
					'toolbar' 	=> 	array(	//Setting a custom toolbar
							array('Source'),
							array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
							array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat', '-', 'Link', 'Unlink'),
							array('Outdent','Indent','-','Blockquote','CreateDiv',),
							array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'),
							array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','/'),
							array('Font','FontSize'),
						)	
				),	
			);
			$data['content']="admin/liputan/liputan_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$judul= $this->input->post('judul');
				$isi= $this->input->post('isi');
				$deskripsi_foto= $this->input->post('deskripsi_foto');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['foto']['name'];
				move_uploaded_file($_FILES["foto"]["tmp_name"],"./media/news/".$filename);
					
				$insert_data = array(
				  'JUDUL'=>$judul,
				  'ISI_LIPUTAN'=>$isi,
				  'DESKRIPSI_FOTO'=>$deskripsi_foto,
				  'SUMBER'=>$sumber
				);
				if($_FILES['foto']['name']){
					$insert_data['FOTO']=$filename;
				}
				
				$data=array('INSERT_DATA'=>$insert_data);
			
				$d=$this->webserv->post('liputan/add_liputan',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('admin/liputan/index');
		}			
	}

	public function edit($id=0) {
		if($_POST==NULL) {
			$data['ckeditor'] = array(
				'id' 	=> 	'text1',
				'path'	=>	'asset/ckeditor',
				'config' => array(	
					'width' 	=> 	"100%",	
					'height' 	=> 	'300px',
					'toolbar' 	=> 	array(	//Setting a custom toolbar
							array('Source'),
							array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
							array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat', '-', 'Link', 'Unlink'),
							array('Outdent','Indent','-','Blockquote','CreateDiv',),
							array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'),
							array('NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','/'),
							array('Font','FontSize'),
						)	
				),	
			);
			$data['d'] = $this->webserv->post('liputan/liputan_detil',array('ID'=>$id));
			$data['content']="admin/liputan/liputan_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				
				$judul= $this->input->post('judul');
				$isi= $this->input->post('isi');
				$deskripsi_foto= $this->input->post('deskripsi_foto');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['foto']['name'];
				move_uploaded_file($_FILES["foto"]["tmp_name"],"./media/news/".$filename);
				$insert_data = array(
				  'JUDUL'=>$judul,
				  'ISI_LIPUTAN'=>$isi,
				  'DESKRIPSI_FOTO'=>$deskripsi_foto,
				  'SUMBER'=>$sumber
				);
				if($_FILES['foto']['name']){
					$insert_data['FOTO']=$filename;
				}
			$data=array('ID'=>$id,'INSERT_DATA'=>$insert_data);
			$result = $this->webserv->post('liputan/edit_liputan',$data);
			$this->session->set_flashdata('message', 'Data berhasil disimpan.');
			redirect('admin/liputan/index');
		}			
	}

	function delete($id=""){
		$data['d'] = $this->webserv->post('liputan/liputan_detil',array('ID'=>$id));
		$data=array('ID'=>$id);
		$result = $this->webserv->post('liputan/delete_liputan',$data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus.');
			redirect('admin/liputan/index');
	}

}
