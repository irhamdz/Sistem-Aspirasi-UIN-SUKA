<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {
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
		$cfg=$this->webserv->post('news/total_row');
		$config['base_url'] = site_url('admin/berita/index/');
		$config['total_rows'] = $cfg->TOTAL;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['berita'] = $this->webserv->post('news/news_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="admin/berita/berita_view";
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
			$data['content']="admin/berita/berita_form";
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
				  'ISI_BERITA'=>$isi,
				  'DESKRIPSI_FOTO'=>$deskripsi_foto,
				  'SUMBER'=>$sumber
				);
				
				if($_FILES['foto']['name']){
					$insert_data['FOTO']=$filename;
				}
				
				$data=array('INSERT_DATA'=>$insert_data);
			
				$this->webserv->post('news/add_news',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('admin/berita/index');
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
			$data['d'] = $this->webserv->post('news/news_detil',array('ID'=>$id));
			$data['content']="admin/berita/berita_form";
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
				  'ISI_BERITA'=>$isi,
				  'DESKRIPSI_FOTO'=>$deskripsi_foto,
				  'SUMBER'=>$sumber
				);
				if($_FILES['foto']['name']){
					$insert_data['FOTO']=$filename;
				}
			$data=array('ID'=>$id,'INSERT_DATA'=>$insert_data);
			$result = $this->webserv->post('news/edit_news',$data);
			$this->session->set_flashdata('message', 'Data berhasil disimpan.');
			redirect('admin/berita/index');
		}			
	}

	function delete($id=""){
		$data['d'] = $this->webserv->post('news/news_detil',array('ID'=>$id));
		$data=array('ID'=>$id);
		$result = $this->webserv->post('news/delete_news',$data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus.');
			redirect('admin/berita/index');
	}

}
