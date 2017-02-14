<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes_Kcfinder extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
	}

	function index()
	{
		$this->load->view('tes-kcfinder/login');
	}
	function login()
	{
		$usr = $this->input->post('username');
		$pass = $this->input->post('password');
		if($usr=="admin" || $pass=="admin"){ 
			$_SESSION['ses_admin']="admin";
			$_SESSION['ses_kcfinder']=array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->admin2(); 
		}
		else { $this->index(); }
	}
	function admin2()
	{
			$_SESSION['ses_kcfinder']=array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			
		 $this->load->view('tes-kcfinder/admin2');
	}
	
	function logout()
	{
		session_destroy();
		$this->login();
	}
}
