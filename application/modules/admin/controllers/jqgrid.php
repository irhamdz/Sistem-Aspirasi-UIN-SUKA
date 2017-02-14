<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jqgrid extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('dosen_jqgrid_model');
		$this->load->database();
	}

	function index()
	{
    		$this->load->view('jqgrid/home');
	}
 
	function tampil_data(){
		 $page = isset($_POST['page'])?$_POST['page']:1; 
		 $limit = isset($_POST['rows'])?$_POST['rows']:10;
		$sidx = isset($_POST['sidx'])?$_POST['sidx']:'nama_dosen';
        $sord = isset($_POST['sord'])?$_POST['sord']:'';    
	 

 
        $q = $this->db->select('*')
            ->from('tbl_nama_dosen')->get();
 
        $row = $q->result();
        $count = count($row);
 
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) $page=$total_pages;
        $start = (($page-1) * $limit);  
        $q = $this->db->select('*')
            ->from('tbl_nama_dosen')
            ->order_by($sidx.' '.$sord)
            ->limit($limit)
            ->offset($start)->get();
        $row = $q->result();
		 $responce= new stdClass;
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        $i=0;
		$no=$start;
        foreach($row as $row){
            $responce->rows[$i]['id']=$row->kode_dosen;
            $responce->rows[$i]['cell']=array(++$no,'aa',$row->kode_dosen,$row->NIDN,$row->nama_dosen);
            $i++;
        }
        echo json_encode($responce);
		
		
		
		
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
