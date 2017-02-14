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
			$this->admin(); 
		}
		else { $this->index(); }
	}
	function admin()
	{
		$session=isset($_SESSION['ses_admin']) ? $_SESSION['ses_admin']:'';
		if($session==""){
			$this->login(); 
		}
		else { $this->load->view('tes-kcfinder/admin'); }
	}
	
	function logout()
	{
		session_destroy();
		$this->login();
	}
}
