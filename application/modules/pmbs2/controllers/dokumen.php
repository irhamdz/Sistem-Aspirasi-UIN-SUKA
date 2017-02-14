<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('admin/admin_model');
		is_logged_in();
	}
	function index()
	{
		$data['dokumen']=$this->db->query("SELECT * FROM dokumen  order by id_dokumen desc limit 0,20")->result();
 		$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
		$this->load->view('admin/dokumen/dokumen_view');
		$this->load->view('admin/footer');
	}
	
	function dokumen_json(){
		isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagenum = isset($_GET['pagenum'])?$_GET['pagenum']:1; 
		$pagesize = isset($_GET['pagesize'])?$_GET['pagesize']:1; 
		$start = $pagenum * $pagesize;
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM dokumen LIMIT $start, $pagesize";
		$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
		$rows = mysql_query($sql);
		$rows = mysql_fetch_assoc($rows);
		$total_rows = $rows['found_rows'];
		$filterquery = "";
		
		// filter data.
			
		if (isset($_GET['sortdatafield']))
		{
			
			$sortfield = isset($_GET['sortdatafield'])?$_GET['sortdatafield']:'id_dokumen'; 
			$sortorder = $_GET['sortorder'];
			//$sortorder ='desc';
			if ($sortorder != '')
			{
				if ($_GET['filterscount'] == 0)
				{
					if ($sortorder == "desc")
					{
						$query = "SELECT * FROM dokumen ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
					}
					else if ($sortorder == "asc")
					{
						$query = "SELECT * FROM dokumen ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
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
			$query = "SELECT * FROM dokumen ORDER BY id_dokumen desc LIMIT $start, $pagesize";
		}
		
		$result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
		$dokumen = null;
		// get data and store in a json array
		$no=$start;
		foreach($result->result() as $row) {
			$dokumen[] = array(
				'no'=> ++$no,
				'judul' => $row->nama,
				'tgl_upload' => $row->tgl_posting." ".$row->jam_posting,
				'action'=>'<a href="'.site_url('admin/dokumen/edit/'.$row->id_dokumen).'" class="edit-btn"> &nbsp;</a>
							<a href="'.site_url('admin/dokumen/delete/'.$row->id_dokumen).'" class="delete-btn" onClick=\'return confirm("Apakah anda yakin akan menghapus data ini?");\'> &nbsp;</a>'
			  );
		}
		  $data[] = array(
		   'TotalRows' => $total_rows,
		   'Rows' => $dokumen
		);
		echo json_encode($data);
	}
	
	public function add() {
		
		if($_POST==NULL) {
			$this->load->view('admin/header');
			$this->load->view('admin/menu'); 
			$this->load->view('admin/dokumen/adddokumen_view');
			$this->load->view('admin/footer');
		}else{	
				$judul= $this->input->post('judul');
				$url= $this->input->post('url');
				$sumber= $this->input->post('sumber');
				$tgl_posting=date('Y-m-d');
				$jam_posting=date('H:i:s');
				$filename=date('Ymd')."_".$_FILES['photo']['name'];
				move_uploaded_file($_FILES["photo"]["tmp_name"],"./media/dokumen_akademik/".$filename);
					
				$data = array(
				  'nama'=>$judul,
				  'file_data'=>$filename,
				  'tgl_posting'=>$tgl_posting,
				  'jam_posting'=>$jam_posting
				);
				
			if($this->db->insert('dokumen',$data)){
				$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				redirect('admin/dokumen/index');
			}
		}			
	}
	function edit($id=""){
		if($_POST==NULL) {
			$data['page'] = $this->admin_model->get_dokumen($id);
			$this->load->view('admin/header');
			$this->load->view('admin/menu',$data); 
			$this->load->view('admin/dokumen/editdokumen_view');
			$this->load->view('admin/footer');
		}else{	
				$judul= $this->input->post('judul');
				$url= $this->input->post('url');
				$sumber= $this->input->post('sumber');
				$filename=date('Ymd')."-".$_FILES['photo']['name'];
				move_uploaded_file($_FILES["photo"]["tmp_name"],"./media/dokumen_akademik/".$filename);
					
				if($filename != null){
				$data = array(
				  'nama'=>$judul,
				  'file_data'=>$filename,
				);
				}else{
				$data = array(
				  'nama'=>$judul,
				);
				}
					
			if($this->db->where('id_dokumen',$id)->update('dokumen',$data)){
				$this->session->set_flashdata('msg', 'Data berhasil disimpan');
				redirect('admin/dokumen/index');
			}
		}			
	}

	function delete($id=""){
		$this->db->where('id_dokumen',$id)->delete('dokumen');
		$this->session->set_flashdata('msg', 'Data berhasil dihapus');
				redirect('admin/dokumen/index');
	}


}
