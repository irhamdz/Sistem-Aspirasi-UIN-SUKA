<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unit extends CI_Controller {

	public $data 	= 	array();
	
	public function __construct() {
		
		parent::__construct();

		$this->load->helper('ckeditor');
		$this->load->helper('format_tanggal');
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
		$this->data['ckeditor'] = array(
			'id' 	=> 	'text1',
			'path'	=>	'asset/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'300px',	//Setting a custom height
			),	
		);
	}
	function index()
	{
		$data['unit']=$this->db->query("SELECT * FROM unit  order by id_unit desc limit 0,20")->result();
 		$this->load->view('admin/header');
		$this->load->view('admin/menu'); 
		$this->load->view('admin/unit/unit_view');
		$this->load->view('admin/footer');
	}
	
	function unit_json(){
		isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagenum = isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagesize = isset($_GET['pagesize'])?$_GET['pagesize']:1; 
		$start = $pagenum * $pagesize;
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM unit LIMIT $start, $pagesize";
		$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
		$rows = mysql_query($sql);
		$rows = mysql_fetch_assoc($rows);
		$total_rows = $rows['found_rows'];
		$filterquery = "";
		
		// filter data.
			
		if (isset($_GET['sortdatafield']))
		{
			
			$sortfield = isset($_GET['sortdatafield'])?$_GET['sortdatafield']:'id_unit'; 
			$sortorder = $_GET['sortorder'];
			//$sortorder ='desc';
			if ($sortorder != '')
			{
				if ($_GET['filterscount'] == 0)
				{
					if ($sortorder == "desc")
					{
						$query = "SELECT * FROM unit ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
					}
					else if ($sortorder == "asc")
					{
						$query = "SELECT * FROM unit ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
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
			$query = "SELECT * FROM unit ORDER BY id_unit asc LIMIT $start, $pagesize";
		}
		
		$result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
		$unit = null;
		// get data and store in a json array
		$no=$start;
	foreach($result->result() as $row) {
			$isi=preg_replace('/<p align="center">(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",htmlspecialchars_decode($row->deskripsi));
			$isi=preg_replace('/<p>(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",$isi);
			$isi=preg_replace('/(&nbsp;)*/iu',"",$isi);
			$isi= substr(strip_tags(html_entity_decode($isi)),0,100);
					
			$unit[] = array(
				'no'=> ++$no,
				'nama_unit' => $row->nama_unit,
				'content' => $isi,
				'action'=>'<a href="'.site_url('admin/unit/edit/'.$row->id_unit).'" class="edit-btn"> &nbsp;</a>
							<a href="'.site_url('admin/unit/delete/'.$row->id_unit).'" class="delete-btn" onClick=\'return confirm("Apakah anda yakin akan menghapus data ini?");\'> &nbsp;</a>'
			  );
		}
		  $data[] = array(
		   'TotalRows' => $total_rows,
		   'Rows' => $unit
		);
		echo json_encode($data);
	}
	
	public function add() {
		if($_POST==NULL) {
			$data=$this->data;
			$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
			$this->load->view('admin/unit/addunit_view', $data);
			$this->load->view('admin/footer');
		}else{	
				$judul =$this->input->post('judul');
				$deskripsi= $this->input->post('isi');
				$jenis_unit= $this->input->post('jenis_unit');
				$data = array(
				  'nama_unit'=>$judul,
				  'deskripsi'=>$deskripsi,
				);
				
			if($this->db->insert('unit',$data)){
				$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				redirect('admin/unit/index');
			}
		}			
	}
	function edit($id){
		if($_POST==NULL) {
			$data=$this->data;
			$data['unit']=$this->admin_model->get_unit($id);
			$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
			$this->load->view('admin/unit/editunit_view', $data);
			$this->load->view('admin/footer');
		}else{	
				$judul =$this->input->post('judul');
				$deskripsi= $this->input->post('isi');
				$jenis_unit= $this->input->post('jenis_unit');
				$data = array(
				  'nama_unit'=>$judul,
				  'deskripsi'=>$deskripsi,
				);
				
						
			if($this->db->where('id_unit',$id)->update('unit',$data)){
				$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				redirect('admin/unit/index');
			};
		}			
	}

	function delete($id=""){
		$this->db->where('id_unit',$id)->delete('unit');
		$this->session->set_flashdata('msg', 'Data berhasil dihapus');
				redirect('admin/unit/index');
	}


}
