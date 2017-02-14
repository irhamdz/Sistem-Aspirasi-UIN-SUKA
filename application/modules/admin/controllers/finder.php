<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finder extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		$this->load->helper('url');
		is_logged_in();
	}
	
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/menu'); 
		$this->load->view('finder/finder_view');
		$this->load->view('admin/footer');
	}
	
	public function elfinder()
	{
//	echo base_url('myfile');
		require_once './asset/elfinder/php/elFinderConnector.class.php';
		require_once './asset/elfinder/php/elFinder.class.php';
		require_once './asset/elfinder/php/elFinderVolumeDriver.class.php';
		require_once './asset/elfinder/php/elFinderVolumeLocalFileSystem.class.php';
		
		$conn = new elFinderConnector(new elFinder(array(
			'roots'=>array(
				array(
					'driver'=>'LocalFileSystem',
					'path'=>'./media',
					'URL'=>base_url().'/media/',
				)
			)
		)));
		$conn->run();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */