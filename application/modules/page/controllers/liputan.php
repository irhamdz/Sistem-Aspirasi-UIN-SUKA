<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liputan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('format_tanggal');
		$this->load->helper('text_manipulation');
		$this->load->library('pagination');
		$this->load->model('page/page_model');
	}
 
	function index($page=0)
	{
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('liputan/total_row');
		$config['base_url'] = site_url('page/liputan/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['liputan'] = $this->webserv->admisi('liputan/liputan_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		//print_r($data['liputan']);
		$data['content']="page/liputan/arsip_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
	}
	
   public function detail($id=0){
		$count= $this->webserv->admisi('liputan/add_counter',array('ID'=>$id));
		$liputan= $this->webserv->admisi('liputan/liputan_detil',array('ID'=>$id));
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Liputan', site_url('page/liputan'));
		$this->breadcrumb->append_crumb(substr($liputan->judul,0,130).' ...', '/');
		$data['title']=$liputan->judul;
		$arr_filter=array();
		$arr_filter=related_text($liputan->judul);	
		$data['rec'] = $this->webserv->admisi('liputan/related_liputan',
					array('ID'=>$id,
					'RELATED'=>$arr_filter)
		);	
		$data['pop'] = $this->webserv->admisi('liputan/popular_liputan');				
		$data['d'] =$liputan;
		$data['content']="page/liputan/detail_view";
				
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
				
		
   }
   

   	function api_curl($modul="",$postdata=""){
			$this->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://service.uin-suka.ac.id/servweb/index.php/it/".$modul;
			$hasil = $this->curl->simple_get($api_url);
			$nilai=json_decode($hasil);
			return $nilai;
	}
   
     

}
 
/* End of file liputan.php */
