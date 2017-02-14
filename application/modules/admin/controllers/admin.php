<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct() {
		parent::__construct();		
		session_start();
		$this->load->helper('auth');
		$this->load->library('s01_lib_warning','','warning');
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

	function sbg_admin($user,$pass)
	{
			// print_r($this->input->post());die();
		$postorget 	= 'GET';
		$auth_ad_id = '8f304662ebfee3932f2e810aa8fb628715';
		$api_url 	= 'http://service.uin-suka.ac.id/servad/adlogauthgr.php?aud='.$auth_ad_id.'&uss='.$user.'&pss='.$pass;
		$hasil 		= $this->curl->simple_get($api_url);
		
		$hasil 		= json_decode($hasil, true);
		//print_r($hasil); die();

		if($hasil){
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
			//print_r($db_jabat);die();
			//$ar_dj[]='UED3002';
			$allow='AAZ001#AAZ002#AAZ003#AAZ004#AAZ005#AAZ006#AAZF09#POU001#REG002#REG004';
			$ar_akses=array_intersect(explode('#',$allow),$ar_dj);
			if(!empty($ar_akses)){
				$data['level']='1';
				$data['status']	= $this->auth->parse_ad_status($duser['AnggotaDari']);
				$data['jabatan'] = $ar_akses;
				$data['gelar']=$this->gelar_staff($duser['NamaPengguna']);
				$this->session->set_userdata($data);
				$_SESSION['ses_kcfinder']=array();
				$_SESSION['ses_kcfinder']['disabled'] = false;
				$_SESSION['ses_kcfinder']['uploadURL'] = "../../media";
				redirect('admin/dash');
			}
			else
			{
				redirect(base_url());
			}
		}
			
			
	}
	function sbg_pendaftar($user,$pass)
	{

			$postdata = http_build_query(
			array(
				'KODE_PMB' => $user,
				'PIN_PMB' => $pass
				)
				);
			
			$username = 'admis1';
			$password = 'admi511';
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
			//print_r($gropo3);die();


		 	$this->load->library('session');
		 	$this->session->set_userdata('username',$user);
		 	$this->session->set_userdata('pin_pmb',$pass);

		 		$this->val_bayar($gropo3);
		 	
			//

			
			
	}
	function sbg_praregistrasi($user,$pass)
	{
		
		$data['username']=$user;
		$data['password']=substr($pass, 0,4);
		$kirim=array('LOGIN'=>$data);
		$hasil=$this->webserv->admisi('praregistrasi/get_siswa_diterima',$kirim);
		if(!is_null($hasil))
		{
			foreach ($hasil as $auth);
			if(!empty($auth->nomor_pendaftaran))
			{
					$nama=$auth->nama_siswa;
					$kode_jalur=$auth->kode_jalur;
					$kd_ta=$auth->kd_ta;
					$u1=str_replace("-","",trim($user));
                	$p1=str_replace("-","",trim($pass));
					
					$data['logged_in']=TRUE;
					$data['nomor_pendaftaran']	= $u1;
					$data['nisn'] = $p1;
					$data['praregistrasi_kd_ta']=$kd_ta;
					$data['praregistrasi_nama']=$nama;
					$data['praregistrasi_jalur']=$kode_jalur;
					$this->session->set_userdata($data);
					
						redirect(base_url('praregistrasi','refresh'));
					
			}
			else
			{
				$this->sbg_admin($user,$pass);
				
			}
		}
		
		
	}



	function validate()	{
		$this->load->library('curl');
		$user=$this->input->post('username');
		$pass=$this->input->post('password');
			
switch (strlen($user)) {
	case '18'://staf
		$this->sbg_admin($user,$pass);
		break;
	case '8'://pendaftar
		$this->sbg_pendaftar($user,$pass);
		break;
	case '10'://prareg
		$this->sbg_praregistrasi($user,$pass);
		break;
	case '11'://prareg
		$this->sbg_praregistrasi($user,$pass);
		break;
	
	default:
		$this->sbg_admin($user,$pass);
		break;
}

	}
	
	function val_bayar($kodeb)
	{
		//echo $kodeb;die();
			$kodenya=json_decode($kodeb,true);
			foreach ($kodenya as $status_kode);
			$status=(array)$status_kode;
			if($status[0]!='invalid')
			{
			
			$kodebayar=$kodenya['KODE_PREFIX'];
			$kode=array(
			'kode_bayar'=>$kodenya['KODE_PREFIX'],
			'tanggal_bayar'=>$kodenya['TGL_BAYAR']
			);
			$data=array('DETAIL_BAYAR'=>$kode);
			$hasil= $this->webserv->admisi('input_data/detail_boleh_datar',$data);
			//print_r($hasil);die();
			if($hasil)
			{
				if(count($hasil)>0)
				{
					foreach ($hasil as $kodpen);
					$pen['kode_penawaran']=$kodpen->kode_penawaran;
					$kuota=$kodpen->kuota;
					
					$kirim=array('CEK_KUOTA'=>$pen);
					$result= $this->webserv->admisi('input_data/kuota_diambil',$kirim);
					
					if(!is_null($result))
					{
						
						foreach ($result as $resjml);
						$diambil=$resjml->jml;
						if($diambil < $kuota)
						{
							redirect(base_url('pendaftaran/jalur_pmb/validate_jalur_pmb/'.$kodebayar));
						}
						else
						{
							//KUOTA PENUH LEMPAR KE ADMIN
							redirect(base_url());
						}

					}

	
			
				}
			}
			else
			{
				//Jalur tidak aktif
				redirect(base_url());
			}

		}
		else
		{
			$this->sbg_admin($this->session->userdata('username'),$this->session->userdata('pin_pmb'));
		}
			

			
	}

	function dash()
	{
		is_logged_in();
		#$data['status']	= $this->auth->parse_ad_status(array(0=>array(0=>'StaffGroup')));
 		#print_r($this->session->all_userdata());
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

	function gelar_staff($kd_pgw)
	{
		$parameter = array('api_kode' => 2001, 'api_subkode' => 2, 'api_search' => array($kd_pgw));
		$pegawai = $this->api->get_api_json(URL_API_SIMPEG.'/simpeg_mix/data_search', 'POST', $parameter);
		$gelar=array();
		foreach ($pegawai as $pgw) {
			$gelar=array('NM_PGW'=>$pgw['NM_PGW'],'GELAR_DEPAN'=>$pgw['GELAR_DEPAN'],'GELAR_DEPAN_NA'=>$pgw['GELAR_DEPAN_NA'],'GELAR_BELAKANG'=>$pgw['GELAR_BELAKANG'],'GELAR_BELAKANG_NA'=>$pgw['GELAR_BELAKANG_NA']);
		}
		return $gelar;
	}

}
