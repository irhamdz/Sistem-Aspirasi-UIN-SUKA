<?php
/**
* 
*/
class Home_s2 extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$data['data_agama'] = $this->webserv->admisi('input_data/agama',array());
		//$data['nama_gedung'] = $this->webserv->admisi('input_data/gedung',array());
		$data['content']="home_s2_v";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function form_tampil()
	{
		

	}

}
