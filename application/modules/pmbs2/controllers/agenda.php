<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class agenda extends CI_Controller {

	public $data 	= 	array();
	
	public function __construct() {
		
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
		$this->load->library('webserv');
		$this->load->library('pagination');
		$this->load->helper('ckeditor');
		$this->load->library('session');
	}
	function index($page=0)
	{
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->post('agenda/total_row');
		$config['base_url'] = site_url('admin/agenda/index/');
		$config['total_rows'] = $cfg->TOTAL;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['agenda'] = $this->webserv->post('agenda/agenda_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="admin/agenda/agenda_view";
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
			
			$data['ruang']=$this->admin_model->get_api('simar_general/cari_ruang', 'json', 'POST', 
			array('api_kode'=>1001, 'api_subkode'=>2));
			//print_r($ruang);
			if($this->session->userdata('data_agenda')){
				$data['d']=(object)$this->session->userdata('data_agenda');
				$this->session->unset_userdata('data_agenda');
			}
			$data['content']="admin/agenda/agenda_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{	
				$nama_agenda= $this->input->post('nama_agenda');
				$deskripsi= $this->input->post('deskripsi');
				$tgl_mulai= $this->input->post('tgl_mulai');
				$tgl_selesai= $this->input->post('tgl_selesai');
				$jam_mulai= $this->input->post('jam_mulai');
				$jam_selesai= $this->input->post('jam_selesai');
				$tempat= $this->input->post('tempat');
				$kd_ruang= $this->input->post('ruang');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['file']['name'];
				move_uploaded_file($_FILES["file"]["tmp_name"],"./media/agenda/".$filename);
					
				$insert_data = array(
				  'NAMA_AGENDA'=>$nama_agenda,
				  'DESKRIPSI'=>$deskripsi,
				  'TGL_MULAI'=>$tgl_mulai,
				  'TGL_SELESAI'=>$tgl_selesai,
				  'JAM_MULAI'=>$jam_mulai,
				  'JAM_SELESAI'=>$jam_selesai,
				  'KD_RUANG'=>$kd_ruang,
				  'TEMPAT'=>$tempat,
				  'SUMBER'=>$sumber
				);
				if($_FILES['file']['name']){
					$insert_data['LAMPIRAN']=$filename;
				}
				
			if($kd_ruang!=null){
				$ajm=explode(':',$jam_mulai);
				$ajs=explode(':',$jam_selesai);
							
				$druang = $this->admin_model->get_api('simar_general/get_ruang', 'json', 'POST', 
				array('api_kode' => 2201, 'api_subkode' => 7, 'api_search' => array($kd_ruang)));
				$druang=$druang[0];
				$parameter		= array('api_kode' => 1011, 'api_subkode' => 1, 'api_search' => array($kd_ruang, $tgl_mulai.' '.$ajm[0].':'.$ajm[1],  $tgl_selesai.' '.$ajs[0].':'.$ajs[1]));
				$data_simar = $this->admin_model->get_api('simar_general/get_jadwal', 'json', 'POST', $parameter);
				
				
				$data_pinjam = array(
					'kd_peminjam'=>'',
					'nama'=>$this->session->userdata('username'),
					'alamat'=>'',
					'institusi'=>'UIN Sunan Kalijag',
					'jabatan'=>'',
					'telp'=>'',
					'tgl_mulai'=>$tgl_mulai.' '.$ajm[0].':'.$ajm[1],
					'tgl_selesai'=>$tgl_selesai.' '.$ajs[0].':'.$ajs[1],
					'keperluan'=>$nama_agenda,
					'kd_group_user'=>'4',
					'kd_gedung'=>$druang['KD_GEDUNG'],
					'kd_system'=>'0',
				);	
				$this->session->set_userdata("druang",array('ruang'=>$kd_ruang));
				$this->session->set_userdata("data_pinjam",$data_pinjam);	
				$this->session->set_userdata("data_agenda",$insert_data);
				
				if(!empty($data_simar)){
					$data['data_peminjam']=$data_simar;
					$data['content']="admin/agenda/agenda_confirm";
					$this->load->view('admin/header',$data);
					$this->load->view('admin/content');
					$this->load->view('page/footer');
				}else{
					$this->add_proc();
				}	

			}else{
				$data=array('INSERT_DATA'=>$insert_data);
				$result=$this->webserv->post('agenda/add_agenda',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				redirect('admin/agenda/index');
			
			}
		}			
	}
	
	
	function add_proc(){
		$data_pinjam=$this->session->userdata('data_pinjam');
		$druang=$this->session->userdata('druang');
		//print_r($data_pinjam);
		$ruang=$druang['ruang'];
		if(!empty($data_pinjam)){	
			$hasil = $this->admin_model->get_api('simar_general/insert_procedure_peminjaman_kelas02', 'json', 'POST', 
			array('api_kode' => 1044, 'api_subkode' => 1, 'api_search' => $data_pinjam));
			 
			#============== INSERT TABEL DETAIL PEMINJMAN RUANG
			 $kd_peminjaman = $hasil['data'][':hasil'];
			
				$api_search = array(
						'kd_peminjaman'=>$kd_peminjaman,
						'kd_ruang'=>$ruang
				);
				$insert_detail = $this->admin_model->get_api('simar_general/insert_det_peminjaman_kelas', 'json', 'POST', 
								array('api_kode' => 1050, 'api_subkode' => 1, 'api_search' => $api_search));
				if($insert_detail){
					$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				}
				$data_agenda=$this->session->userdata('data_agenda');
				$data_agenda['KD_PEMINJAMAN']=$kd_peminjaman;
				$data_agenda['KD_RUANG']=$ruang;
				
				$data=array('INSERT_DATA'=>$data_agenda);
				$result=$this->webserv->post('agenda/add_agenda',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				$this->session->unset_userdata("data_agenda");	
				$this->session->unset_userdata("druang");
				redirect('admin/agenda/index');
				$this->session->unset_userdata("data_pinjam",$data_pinjam);
		}
	}
	
	
	function edit($id=0){
		if($_POST==NULL) {
			$data=$this->data;
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
			
			$ruang=$this->admin_model->get_api('simar_general/cari_ruang', 'json', 'POST', 
			array('api_kode'=>1001, 'api_subkode'=>2));
			$data['d'] =$this->webserv->post('agenda/agenda_detil',array('ID'=>$id));
			$data['ruang']=$ruang;
			$data['content']="admin/agenda/agenda_form";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');
		}else{		
				$d = $this->webserv->post('agenda/agenda_detil',array('ID'=>$id));
				if($d->KD_PEMINJAMAN!=null){
				$this->hapus_peminjaman($d->KD_PEMINJAMAN);
				}		
				$nama_agenda= $this->input->post('nama_agenda');
				$deskripsi= $this->input->post('deskripsi');
				$tgl_mulai= $this->input->post('tgl_mulai');
				$tgl_selesai= $this->input->post('tgl_selesai');
				$jam_mulai= $this->input->post('jam_mulai');
				$jam_selesai= $this->input->post('jam_selesai');
				$tempat= $this->input->post('tempat');
				$kd_ruang= $this->input->post('ruang');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."_".$_FILES['file']['name'];
				move_uploaded_file($_FILES["file"]["tmp_name"],"./media/agenda/".$filename);
					
				$insert_data = array(
				  'NAMA_AGENDA'=>$nama_agenda,
				  'DESKRIPSI'=>$deskripsi,
				  'TGL_MULAI'=>$tgl_mulai,
				  'TGL_SELESAI'=>$tgl_selesai,
				  'JAM_MULAI'=>$jam_mulai,
				  'JAM_SELESAI'=>$jam_selesai,
				  'KD_RUANG'=>$kd_ruang,
				  'TEMPAT'=>$tempat,
				  'SUMBER'=>$sumber
				);
				if($_FILES['file']['name']){
					$insert_data['LAMPIRAN']=$filename;
				}
				
			if($kd_ruang!=null){
				$ajm=explode(':',$jam_mulai);
				$ajs=explode(':',$jam_selesai);
							
				$druang = $this->admin_model->get_api('simar_general/get_ruang', 'json', 'POST', 
				array('api_kode' => 2201, 'api_subkode' => 7, 'api_search' => array($kd_ruang)));
				$druang=$druang[0];
				$parameter		= array('api_kode' => 1011, 'api_subkode' => 1, 'api_search' => array($kd_ruang, $tgl_mulai.' '.$ajm[0].':'.$ajm[1],  $tgl_selesai.' '.$ajs[0].':'.$ajs[1]));
				$data_simar = $this->admin_model->get_api('simar_general/get_jadwal', 'json', 'POST', $parameter);
				
				
				$data_pinjam = array(
					'kd_peminjam'=>'',
					'nama'=>$this->session->userdata('username'),
					'alamat'=>'',
					'institusi'=>'UIN Sunan Kalijag',
					'jabatan'=>'',
					'telp'=>'',
					'tgl_mulai'=>$tgl_mulai.' '.$ajm[0].':'.$ajm[1],
					'tgl_selesai'=>$tgl_selesai.' '.$ajs[0].':'.$ajs[1],
					'keperluan'=>$nama_agenda,
					'kd_group_user'=>'4',
					'kd_gedung'=>$druang['KD_GEDUNG'],
					'kd_system'=>'0',
				);	
				$this->session->set_userdata("druang",array('ruang'=>$kd_ruang));
				$this->session->set_userdata("data_pinjam",$data_pinjam);
				$this->session->set_userdata("data_agenda",$insert_data);	
				
				if(!empty($data_simar)){
					$data['data_peminjam']=$data_simar;
					$data['id_agenda']=$id;
					$data['content']="admin/agenda/agenda_confirm";
					$this->load->view('admin/header',$data);
					$this->load->view('admin/content');
					$this->load->view('page/footer');
				}else{
					$this->edit_proc($id);
				}	

			}else{
				$data=array('ID'=>$id,'INSERT_DATA'=>$insert_data);
				$result=$this->webserv->post('agenda/edit_agenda',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				print_r($result);
				redirect('admin/agenda/index');
			
			}
		}
	}
	
	function edit_proc($id=0){
		
		$data_pinjam=$this->session->userdata('data_pinjam');
		$druang=$this->session->userdata('druang');
		//print_r($data_pinjam);
		$ruang=$druang['ruang'];
		if(!empty($data_pinjam)){	
			$hasil = $this->admin_model->get_api('simar_general/insert_procedure_peminjaman_kelas02', 'json', 'POST', 
			array('api_kode' => 1044, 'api_subkode' => 1, 'api_search' => $data_pinjam));
			 
			#============== INSERT TABEL DETAIL PEMINJMAN RUANG
			 $kd_peminjaman = $hasil['data'][':hasil'];
			
				$api_search = array(
						'kd_peminjaman'=>$kd_peminjaman,
						'kd_ruang'=>$ruang
				);
				$insert_detail = $this->admin_model->get_api('simar_general/insert_det_peminjaman_kelas', 'json', 'POST', 
								array('api_kode' => 1050, 'api_subkode' => 1, 'api_search' => $api_search));
				if($insert_detail){
					$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				}
				$data_agenda=$this->session->userdata('data_agenda');
				$data_agenda['KD_PEMINJAMAN']=$kd_peminjaman;
				$data_agenda['KD_RUANG']=$ruang;
				
				$data=array('ID'=>$id,'INSERT_DATA'=>$data_agenda);
				$result=$this->webserv->post('agenda/edit_agenda',$data);
				$this->session->set_flashdata('message', 'Data berhasil disimpan.');
				$this->session->unset_userdata("data_agenda");	
				$this->session->unset_userdata("druang");
				$this->session->unset_userdata("data_pinjam",$data_pinjam);
				//print_r($data);
				redirect('admin/agenda/index');
		}
	}
	
	function delete($id=""){	
		$d = $this->webserv->post('agenda/agenda_detil',array('ID'=>$id));
		$data=array('ID'=>$id);
		if($d->KD_PEMINJAMAN!=null){
		$this->hapus_peminjaman($d->KD_PEMINJAMAN);
		}
		print_r($d);
		$result = $this->webserv->post('agenda/delete_agenda',$data);
		$this->session->set_flashdata('message', 'Data berhasil dihapus.');
		redirect('admin/agenda/index');
		
	}


	
	function hapus_peminjaman($kd_peminjaman=""){
		$hasil = $this->admin_model->get_api('simar_general/delete_peminjaman', 'json', 'POST', 
		array('api_kode' => 1066, 'api_subkode' => 1, 'api_search' => array($kd_peminjaman)));
		print_r($hasil);
	}
	
}
