<?php

class Slide extends CI_Controller {
  public $data= array();
	public function __construct() {
		
		parent::__construct();

		$this->load->helper('ckeditor');
		$this->load->helper('format_tanggal');
		$this->load->model('admin/admin_model');
		//$this->load->library('image_moo') ;
		
	}
	function index()
	{
		$data['slide']=$this->db->query("SELECT * FROM slide  order by id_slide desc limit 0,20")->result();
 		$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
		$this->load->view('admin/slide/slide_view');
		$this->load->view('admin/footer');
	}
	
	function slide_json(){
		isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagenum = isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagesize = isset($_GET['pagesize'])?$_GET['pagesize']:1; 
		$start = $pagenum * $pagesize;
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM slide LIMIT $start, $pagesize";
		$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
		$rows = mysql_query($sql);
		$rows = mysql_fetch_assoc($rows);
		$total_rows = $rows['found_rows'];
		$filterquery = "";
		
		// filter data.
			
		if (isset($_GET['sortdatafield']))
		{
			
			$sortfield = isset($_GET['sortdatafield'])?$_GET['sortdatafield']:'id_slide'; 
			$sortorder = $_GET['sortorder'];
			//$sortorder ='desc';
			if ($sortorder != '')
			{
				if ($_GET['filterscount'] == 0)
				{
					if ($sortorder == "desc")
					{
						$query = "SELECT * FROM slide ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
					}
					else if ($sortorder == "asc")
					{
						$query = "SELECT * FROM slide ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
					}
				}
				else
				{
					if ($sortorder == "desc")
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
					}
					else if ($sortorder == "asc")	
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
					}
					$query = $filterquery;
				}		
			}
		}else{
			$query = "SELECT * FROM slide ORDER BY id_slide desc LIMIT $start, $pagesize";
		}
		
		$result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
		$slide = null;
		// get data and store in a json array
		$no=$start;
		foreach($result->result() as $row) {
			$slide[] = array(
				'no'=> ++$no,
				'judul' => $row->judul,
				'active' => $row->active,
				'image' => "<img src='".base_url()."media/slide/".$row->image."' height='60'/>",
				'action'=>'<a href="'.site_url('admin/slide/edit/'.$row->id_slide).'" class="edit-btn"> &nbsp;</a>
							<a href="'.site_url('admin/slide/delete/'.$row->id_slide).'" class="delete-btn" onClick=\'return confirm("Apakah anda yakin akan menghapus data ini?");\'> &nbsp;</a>'
			  );
		}
		  $data[] = array(
		   'TotalRows' => $total_rows,
		   'Rows' => $slide
		);
		echo json_encode($data);
	}
	

	function adminslide($offset=0){
	  $perpage = 10;
		$this->load->library('pagination');
		$config = array(
            'base_url' => base_url() . 'slide/adminslide/',
            'total_rows' => count($this->slide_model->select()),
            'per_page' => $perpage,
        );
        $this->pagination->initialize($config);
        $data['slide'] = $this->slide_model->select(array('perpage' => $perpage, 'offset' => $offset));
		$data['offset']=$offset;
       
			$data['main_content'] = 'adminslide_view';
			$this->load->view('fishy/content', $data);
					
	}
	function dslide($id){
		$this->load->model('slide_model');
			$data['slide'] = $this->slide_model->get_slide(str_replace("'"," ",$id));
			$data['main_content'] = 'dslide_view';
			$this->load->view('cream/content', $data);
				
	}
	
	function add(){
		$upload_path          = "media/slide/" ;
		if($_POST==null){
			$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
			$this->load->view('slide/crop_form');
			$this->load->view('admin/footer');
		}else{	
			
			if(empty($_POST['crop'])){
				$judul= $this->input->post('judul');
				$deskripsi= $this->input->post('deskripsi');
				$url = $this->input->post('url');
				$active= $this->input->post('active');
				$caps = array(
					  'judul'=>$judul,
					  'url'=>$url,
					  'deskripsi'=>$deskripsi,
					  'active'=>$active
				);
				$this->session->set_userdata('caps',$caps);
								
				$config['upload_path']  = $upload_path ;
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size']     = '60000';
				$config['max_width']    = '60000';
				$config['max_height']   = '60000';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload("image")) {
					$data['img']	 = $this->upload->data();
					
				}
					
				$this->load->view('admin/header',$data);
				$this->load->view('admin/menu'); 
				$this->load->view('slide/crop');
				$this->load->view('admin/footer');
			}else{
				$caps=$this->session->userdata('caps');
				print_r($caps);
				ini_set('memory_limit', '-1');
				$vdir_upload = './media/slide/';
				$targ_w = 600;
				$targ_h = 360;
				$jpeg_quality = 90;			
				
				if(!isset($_POST['x']) || !is_numeric($_POST['x'])) {
				  die('Please select a crop area.');
				}
				$file_name=$this->input->post('filename');
				$src = './media/slide/'.$file_name;
				list($width, $height) = getimagesize($src);
				//echo $width;
				$img_r = imagecreatefromjpeg($src);
				$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
				$dx=$_POST['x']*$width/640;
				$dy=$_POST['y']*$width/640;
				$dw=$_POST['w']*$width/640;
				$dh=$_POST['h']*$width/640;
				imagecopyresampled($dst_r,$img_r,0,0,$dx,$dy,
				$targ_w,$targ_h,$dw,$dh);
				imagejpeg($dst_r,$vdir_upload.$file_name);
				$caps['image']=$file_name;
				if($this->db->insert('slide',$caps)){
					redirect('admin/slide');
				}
				
			}
		}	
	}
	
	public function edit($id) {
		$upload_path          = "media/slide/" ;
		if($_POST==null){
			$data['page'] = $this->admin_model->get_slide($id);
			$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
			$this->load->view('slide/crop_form', $data);
			$this->load->view('admin/footer');
		}else{	
			if(empty($_POST['crop'])){
				$judul= $this->input->post('judul');
				$deskripsi= $this->input->post('deskripsi');
				$url = $this->input->post('url');
				$active= $this->input->post('active');
				$caps = array(
					  'judul'=>$judul,
					  'url'=>$url,
					  'deskripsi'=>$deskripsi,
					  'active'=>$active
				);
				
				
				$config['upload_path']  = $upload_path ;
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size']     = '60000';
				$config['max_width']    = '60000';
				$config['max_height']   = '60000';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload("image")) {
					$this->session->set_userdata('caps',$caps);
					$data['img']	 = $this->upload->data();
					$this->load->view('admin/header',$data);
					$this->load->view('admin/menu'); 
					$this->load->view('slide/crop');
					$this->load->view('admin/footer');
				}else{
					if($this->db->where('id_slide',$id)->update('slide',$caps)){
						redirect('admin/slide');
					}
				}	
				
			}else{
				$caps=$this->session->userdata('caps');
				print_r($caps);
				ini_set('memory_limit', '-1');
				$vdir_upload = './media/slide/';
				$targ_w = 980;
				$targ_h = 360;
				$jpeg_quality = 90;			
				
				if(!isset($_POST['x']) || !is_numeric($_POST['x'])) {
				  die('Please select a crop area.');
				}
				$file_name=$this->input->post('filename');
				$src = './media/slide/'.$file_name;
				list($width, $height) = getimagesize($src);
				//echo $width;
				$img_r = imagecreatefromjpeg($src);
				$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
				$dx=$_POST['x']*$width/640;
				$dy=$_POST['y']*$width/640;
				$dw=$_POST['w']*$width/640;
				$dh=$_POST['h']*$width/640;
				imagecopyresampled($dst_r,$img_r,0,0,$dx,$dy,
				$targ_w,$targ_h,$dw,$dh);
				imagejpeg($dst_r,$vdir_upload.$file_name);
				$caps['image']=$file_name;
					if($this->db->where('id_slide',$id)->update('slide',$caps)){
						redirect('admin/slide');
					}
				
			}
		}	
    }
	
	
	function delete($id=""){
		$this->db->where('id_slide',$id)->delete('slide');
		$this->session->set_flashdata('msg', 'Data berhasil dihapus');
				redirect('admin/slide/index');
	}

	
}

