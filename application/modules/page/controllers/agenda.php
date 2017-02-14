<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class agenda extends CI_Controller {

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
		$this->breadcrumb->append_crumb('Agenda', '/');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('agenda/total_row');
		$config['base_url'] = site_url('page/agenda/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['agenda'] = $this->webserv->admisi('agenda/agenda_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="page/agenda/arsip_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
	}
	
   public function detail($id=0){
		$count= $this->webserv->admisi('agenda/add_counter',array('ID'=>$id));	
		$agenda= $this->webserv->admisi('agenda/agenda_detil',array('ID'=>$id));
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Agenda', site_url('page/agenda'));
		$this->breadcrumb->append_crumb(substr($agenda->nama_agenda,0,130).' ...', '/');
		$data['title']=$agenda->nama_agenda;
		$arr_filter=array();
		$arr_filter=related_text($agenda->nama_agenda);	
		$data['rec'] = $this->webserv->admisi('agenda/related_agenda',
					array('ID'=>$id,
					'RELATED'=>$arr_filter)
		);	
		$data['pop'] = $this->webserv->admisi('agenda/popular_agenda');			
		$data['d'] =$agenda;
		$data['content']="page/agenda/detail_view";
				
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
   }
   
  function feed(){  
		$data['feed_name'] = 'Agenda';  
		$data['encoding'] = 'utf-8';  
		$data['feed_url'] = site_url('page/agenda/feed');
		$data['feed_description'] = 'UIN Sunan Kalijaga Yogyakarta';  
		$data['page_language'] = 'en-en';  
		$data['agenda'] = $this->webserv->admisi('agenda/agenda_list',array('LIMIT'=>20,'OFFSET'=>0));
		//print_r($data['agenda']);
		header("Content-Type: application/rss+xml");  
		$this->load->view('agenda/rss_agenda', $data);  
	}
}
 
/* End of file agenda.php */
