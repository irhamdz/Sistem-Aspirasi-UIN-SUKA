<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct() {
		parent::__construct();		
		session_start();
		$this->load->helper('auth');
		$this->load->library('it00_lib_auth','','auth');
		$this->api 		= $this->s00_lib_api;
			ini_set('display_errors', 1);
	}
	function index()
	{
 		$this->load->view('admin/header');
		$this->load->view('admin/login'); //ngko genti menu
		$this->load->view('admin/footer');
	}
	function validate()	{
		$this->load->library('curl');
		$user=$this->input->post('username');
		$pass=$this->input->post('password');
		// print_r($this->input->post());die();
		$postorget 	= 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628728';
		$api_url 	= 'http://service.uin-suka.ac.id/servad/adlogauthgr.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		$hasil 		= $this->curl->simple_get($api_url);
		
		$hasil 		= json_decode($hasil, true);
		//print_r($hasil); die();
		if($hasil[0]>0){
			$duser=$hasil[0];
			$data = array(
				'username' => $duser['NamaPengguna'],
				'user' => $duser['NamaDepan'],
				'is_logged_in' => true
			);
			
			$parameter = array('api_kode' => 1124, 'api_subkode' => 2, 'api_search' => array($hasil[0]['NamaPengguna']));
			$db_jabat = $this->api->get_api_json(URL_API_SIMPEG.'/simpeg_mix/data_search', 'POST', $parameter);
			foreach($db_jabat as $d){
				$ar_dj[]=$d['SIS_ID'];
			}	
			//$ar_dj[]='UED3002';
			$allow='AAZ001#AAZ002#AAZ003#AAZ004#AAZ005#AAZ006#AAZF09#POU001#REG002#REG004';
			$ar_akses=array_intersect(explode('#',$allow),$ar_dj);
			if(!empty($ar_akses)){
				$data['level']='1';
				$data['status']	= $this->auth->parse_ad_status($duser['AnggotaDari']);
				$data['jabatan'] = $ar_akses;
				$this->session->set_userdata($data);
				$_SESSION['ses_kcfinder']=array();
				$_SESSION['ses_kcfinder']['disabled'] = false;
				$_SESSION['ses_kcfinder']['uploadURL'] = "../../media";
				redirect('admin/dash');
			}else{
				$messg="Username atau password anda salah";
				redirect(base_url());
			}		
		}else{		
			$postdata = http_build_query(
			array(
				'KODE_PMB' => $user,
				'PIN_PMB' => $pass
				)
			);
			$username = 'cek';
			$password = 'kec';
			$postorget = 'POST';
			$url = "http://service2.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_login/format/json";
			$context = stream_context_create(
						array(
						'http' => array(
									'method' => 'POST',
									'header' => "Authorization: Basic " . base64_encode("$username:$password"),
									'content' => $postdata
								)
						));
			
			$gropo3 = @file_get_contents($url,false,$context);
			$get_bayar = json_decode($gropo3,true);
			//print_r($gropo3);
		
				redirect(base_url('adminpmb/jalur_pmb/validate_jalur_pmb/'.$get_bayar['JENIS_PMB']));
				
			
			
		}
	}
	
	
	function dash()
	{
		is_logged_in();
		#$data['status']	= $this->auth->parse_ad_status(array(0=>array(0=>'StaffGroup')));
 		//print_r($this->session->all_userdata());
 		#print_r($data);
	
		$data['content']="admin/home";
				
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_logged_in');
		$this->session->sess_destroy();
		session_destroy();
		redirect(base_url());
	}
}
