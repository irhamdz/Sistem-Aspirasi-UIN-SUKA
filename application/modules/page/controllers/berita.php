<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class berita extends CI_Controller {

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
		$this->breadcrumb->append_crumb('Berita', '/');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('news/total_row');
		$config['base_url'] = site_url('page/berita/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['berita'] = $this->webserv->admisi('news/news_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="page/berita/arsip_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
	}
	
   public function detail($id=0){
		$berita= $this->webserv->admisi('news/news_detil',array('ID'=>$id));
		//print_r($berita);die();
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Berita', site_url('page/berita'));
		$this->breadcrumb->append_crumb(substr($berita->judul,0,130).' ...', '/');
		$data['title']=$berita->judul;
		$arr_filter=array();
		$arr_filter=related_text($berita->judul);	
		$data['rec'] = $this->webserv->admisi('news/related_news',
					array('ID'=>$id,
					'RELATED'=>$arr_filter)
		);	
		$data['pop'] = $this->webserv->admisi('news/popular_news');		
		$count= $this->webserv->admisi('news/add_counter',array('ID'=>$id));		
		if(count($berita)){
			$data['d'] =$this->webserv->admisi('news/news_detil',array('ID'=>$id));
		}
		$data['content']="page/berita/detail_view";
				
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
   }
   
   function feed(){  
		$data['feed_name'] = 'Berita';  
		$data['encoding'] = 'utf-8';  
		$data['feed_url'] = site_url('page/berita/feed');
		$data['feed_description'] = 'UIN Sunan Kalijaga Yogyakarta';  
		$data['page_language'] = 'en-en';  
		$data['berita'] = $this->webserv->admisi('news/news_list',array('LIMIT'=>20,'OFFSET'=>0));
		header("Content-Type: application/rss+xml");  
		$this->load->view('berita/rss_berita', $data);  
	}
}
 
/* End of file berita.php */
