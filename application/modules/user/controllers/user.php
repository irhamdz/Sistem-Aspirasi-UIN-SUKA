<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('format_tanggal_helper');
		$this->load->helper('page_helper');
		$this->load->helper('text_manipulation_helper');
		$this->load->model('page/page_model');
		$this->load->library('webserv');
	}
	
	function index()
	{
		$this->breadcrumb->append_crumb('Halaman Utama', '#');
		$this->breadcrumb->append_crumb('Aspirasi','/');
		$data="";
		
		$this->load->view('user/header',$data);
		$this->load->view('user/home');
		$this->load->view('user/footer');
	}

	function history()
	{
		$this->breadcrumb->append_crumb('History Aspirasi', '#');
		$this->breadcrumb->append_crumb('Cek History Aspirasi', '/');

		$data['content']="user/history/history_view";

		$this->load->view('user/header',$data);
		$this->load->view('user/content_2');
		$this->load->view('user/footer');
	}

	function input()
	{
		$this->breadcrumb->append_crumb('Halaman Utama', base_url('user'));
		$this->breadcrumb->append_crumb('Input Aspirasi', '/');

		$data['content']="user/input/input_view";

		$this->load->view('user/header',$data);
		$this->load->view('user/content_2');
		$this->load->view('user/footer');
	}
	
	function api_curl($modul="",$postdata=""){
			$this->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://service.uin-suka.ac.id/servweb/index.php/it/".$modul;
			$hasil = $this->curl->simple_get($api_url);
			$nilai=json_decode($hasil);
			return $nilai;
	}

	
	function unit($id=0){
		$this->load->model('page_model');
		$data['page'] = $this->page_model->get_unit($id);
		if( !$data ){
			return false;
		}else{
			$data_page = $this->db->get_where("unit",array('id_unit'=>$id));
		    $page = $data_page->row();
			
			if($data_page->num_rows()>0){
				$this->breadcrumb->append_crumb('Beranda', base_url());;
				$this->breadcrumb->append_crumb($page->nama_unit, '/');
				
				$data['content']="page/prodi/unit_view";
				$this->load->view('page/header',$data);
				$this->load->view('page/content');
				$this->load->view('page/footer');
			}
		}			
	}

	
	/**CREATE ARSIP PENGUMUMAN**/
	function arsip_pengumuman_json(){
		$data= $this->webserv->admisi('announcement/year_archives');
		echo json_encode($data,true);		
	}
	
	function pengumuman_bulan_json($tahun='',$bulan=''){
		$pengumuman=$this->webserv->admisi('announcement/month_archives',array('TAHUN'=>$tahun,'BULAN'=>$bulan));
		$i=0;
		foreach($pengumuman as $d){
			if($d->nama_file!=null){
				$url = site_url('page/pengumuman/detail/'.$d->id_pengumuman.'/'.url_title(strtolower($d->judul)));
			}else{						
				$url =$d->url;
			}
			$data[] = array(
						'title'=> "<a target='_blank' href='".$url."' title='".$d->judul."'>".$d->judul."</a>"
					);
			}
		echo json_encode($data,true);
	}
		
			
	/**CREATE ARSIP BERITA**/
	function arsip_berita_json(){
		$data= $this->webserv->admisi('news/year_archives');
		echo json_encode($data,true);		
	}
	
	function berita_bulan_json($tahun='',$bulan=''){
		$berita=$this->webserv->admisi('news/month_archives',array('TAHUN'=>$tahun,'BULAN'=>$bulan));
		$i=0;
		foreach($berita as $d){
				$data[] = array(
						'title'=> "<a target='_self' href='".site_url('page/berita/detail/'.$d->id_berita.'/'.url_title(strtolower($d->judul)))."' title='".$d->judul."'>".$d->judul."</a>"
					);
			}
		echo json_encode($data,true);
	}
				
	/**CREATE ARSIP LIPUTAN**/
	function arsip_liputan_json(){
		$data= $this->webserv->admisi('liputan/year_archives');
		echo json_encode($data,true);		
	}
	
	function liputan_bulan_json($tahun='',$bulan=''){
		$liputan=$this->webserv->admisi('liputan/month_archives',array('TAHUN'=>$tahun,'BULAN'=>$bulan));
		$i=0;
		foreach($liputan as $d){
				$data[] = array(
						'title'=> "<a target='_self' href='".site_url('page/liputan/detail/'.$d->id_liputan.'/'.url_title(strtolower($d->judul)))."' title='".$d->judul."'>".$d->judul."</a>"
					);
			}
		echo json_encode($data,true);
	}
			
	/**CREATE ARSIP KOLOM**/
	function arsip_kolom_json(){
		$data= $this->webserv->admisi('kolom/year_archives');
		echo json_encode($data,true);	
	}
	
	function kolom_bulan_json($tahun='',$bulan=''){
		$kolom=$this->webserv->admisi('kolom/month_archives',array('TAHUN'=>$tahun,'BULAN'=>$bulan));
		$i=0;
		foreach($kolom as $d){
				$data[] = array(
						'title'=> "<a target='_self' href='".site_url('page/kolom/detail/'.$d->id_kolom.'/'.url_title(strtolower($d->judul)))."' title='".$d->judul."'>".$d->judul."</a>"
					);
			}
		echo json_encode($data,true);
	}
		
				
	/**CREATE ARSIP AGENDA**/
	function arsip_agenda_json(){
		$data= $this->webserv->admisi('agenda/year_archives');
		echo json_encode($data,true);		
	}
	
	function agenda_bulan_json($tahun='',$bulan=''){
		$agenda=$this->webserv->admisi('agenda/month_archives',array('TAHUN'=>$tahun,'BULAN'=>$bulan));
		$i=0;
		foreach($agenda as $d){
				$data[] = array(
						'title'=> "<a target='_self' href='".site_url('page/agenda/detail/'.$d->id_agenda.'/'.url_title(strtolower($d->nama_agenda)))."' title='".$d->nama_agenda."'>".$d->nama_agenda."</a>"
					);
			}
		echo json_encode($data,true);
	}
		
		
	
		
   public function search($page=0){
		$this->load->library('pagination');
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Pencarian', '/');
			if($_POST!=null){
				$cari=$this->input->post('cari');
				$this->session->set_userdata('cari',$cari);
			}else{
				$cari= $this->session->userdata('cari');
			}		  
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$per_page=10;
			$total=$this->webserv->admisi('page/search',array('FILTER'=>$cari));
			$config['base_url'] = site_url('page/search');
			$config['total_rows'] = $total;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$limit=$offset+$per_page;
			$data['offset']=$offset;
			
			$data['cari']=$this->webserv->admisi('page/search',array('FILTER'=>$cari,'LIMIT'=>$limit,'OFFSET'=>$offset));
			
			$halaman="";
			if($this->session->userdata('username') != '')
			{
				$halaman="admin";
			}
			else
			{
				$halaman="page";
			}

			$data['content']="page/search_view";
			$this->load->view('page/header',$data);
			$this->load->view($halaman.'/content');
			$this->load->view('page/footer');
   }
   
}
