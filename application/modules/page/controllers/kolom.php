<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kolom extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('format_tanggal');
		$this->load->helper('text_manipulation');
		$this->load->library('pagination');
		$this->load->model('page/page_model');
	}
 
	function index($page=0)
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Kolom', '/');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('kolom/total_row');
		$config['base_url'] = site_url('page/kolom/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['kolom'] = $this->webserv->admisi('kolom/kolom_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="page/kolom/arsip_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
	}
	
   public function detail($id=0){	
		$count= $this->webserv->admisi('kolom/add_counter',array('ID'=>$id));	
		$kolom= $this->webserv->admisi('kolom/kolom_detil',array('ID'=>$id));
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Kolom', site_url('page/kolom'));
		$this->breadcrumb->append_crumb(substr($kolom->judul,0,130).' ...', '/');
		$data['title']=$kolom->judul;
		$arr_filter=array();
		$arr_filter=related_text($kolom->judul);	
		$data['rec'] = $this->webserv->admisi('kolom/related_kolom',
					array('ID'=>$id,
					'RELATED'=>$arr_filter)
		);	
		$data['pop'] = $this->webserv->admisi('kolom/popular_kolom');		
		$data['d'] =$kolom;
		$data['content']="page/kolom/detail_view";
				
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
   }
   

   	 function feed(){  
		$data['feed_name'] = 'Kolom';  
		$data['encoding'] = 'utf-8';  
		$data['feed_url'] = site_url('page/kolom/feed');
		$data['feed_description'] = 'UIN Sunan Kalijaga Yogyakarta';  
		$data['page_language'] = 'en-en';  
		$data['kolom'] = $this->webserv->admisi('kolom/kolom_list',array('LIMIT'=>20,'OFFSET'=>0));
		header("Content-Type: application/rss+xml");  
		$this->load->view('kolom/rss_kolom', $data);  
	}
}
 
/* End of file kolom.php */
