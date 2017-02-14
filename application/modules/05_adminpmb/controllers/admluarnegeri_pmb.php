<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admluarnegeri_pmb extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->api 		= $this->s00_lib_api;
		$this->output99	= $this->s00_lib_output;
		$this->menu7	= $this->s00_lib_sh_menu;
		$this->load->library("pagination");
		$this->load->library("lib_adminpmb", '', 'adminpmb');
		$this->load->library("lib_pagging", '', 'lib_pajax');
		$this->load->library("lib_wilayah_fungsi", '', 'wilayah');
		if($this->adminpmb->cek_allowed("AAZ001")){
			
		}else{
			redirect();
		}
		
	
	}
	function email1(){
		$subject = 'Halo Sayang! Ini balasan komentarmu di blog Maw Mblusuk?';
		$message = 'Halo Sayang! Ini balasan komentarmu di blog Maw Mblusuk?';
		$headers = 'From: Maw Mblusuk <wijna@mblusuk.com>' . PHP_EOL; 
		$headers .= 'X-Mailer: PHP-' . phpversion() . PHP_EOL;
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$to = "kiand.design@gmail.com";
		mail($to, $subject, $message, $headers) or die ("Failure");
	}
	
	function email_send(){
		// echo "ok";
		$config['protocol']='smtp';  
		$config['smtp_host']='ssl://smtp.googlemail.com';  
		$config['smtp_port']='465';  
		// $config['smtp_user']='199111280000001101@uin-suka.ac.id';  
		// $config['smtp_pass']='123qweasdzxc'; 
		$config['smtp_user']='event@uin-suka.ac.id';  
		// $config['smtp_user']='199111280000001101@uin-suka.ac.id';  
		// $config['smtp_pass']='123qweasdzxc';  		
		$config['smtp_pass']='eventuinsuka';  		
		$config['mailtype']='html';  
		
			
			// $nama=$this->input->post('nama');
			$email="kiand.design@gmail.com";
			// $instansi=$this->input->post('instansi');
			// $jabatan=$this->input->post('jabatan');
			// $telp=$this->input->post('telp');
			$password=rand(100001,999999);
		
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('jajal@uin-suka.ac.id');
			$this->email->to($email);		
			$this->email->subject('Konfirmasi account');
			$pesan="<p>Anda sudah terdaftar sebagai member di Sistem Management Event. Username dan password anda sebagai berikut:<br/>
			Username : ".$email."<br/>
			Password : ".$password."<br/>
			Sekarang anda sudah dapat melakukan login di Sistem Managemen Event UIN Sunan Kalijaga dengan alamat URL berikut: 
			<a href='http://event.uin-suka.ac.id/' >http://event.uin-suka.ac.id</a>";		
			$this->email->message($pesan);
			if($this->email->send()){
				echo "Da email, da email, wut wut da emails";
			}else{
				show_error($this->email->print_debugger());
			}
	}
	
	function jenjang($KD_PENDIDIKAN=''){
		// sia_master/data_search
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 76, 'api_search' => $KD_PENDIDIKAN);
		return $data['jenjang'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
		// print_r($data);		
	}
	function kd_pendidikan(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 192, 'api_subkode' => 75, 'api_search' => array());
		return 	$data['kd_pendidikan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}
	
	function opoe(){
		for($i=0;$i<1000;$i++){
		$r=rand(100001,999999);
		$registertime=strtotime(date("d-m-Y h:m:s"));
		
		echo $registertime.$r."<br />";
		}
	
	}
	function list_pendaftar_old(){
		$data['negara'] = $this->wilayah->data_negara();	
		$data['KD_PENDIDIKAN']=$this->kd_pendidikan();
		if(isset($_POST['ACT'])){
			if($_POST['ACT']=='Detail'){
				$data['pendaftar']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 70, 'api_search' => $_POST['email']));
				// print_r($data['pendaftar']);
				$data['choice']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));	
				$data['JENJANG']=$this->jenjang($data['choice'][0]->ID_JENJANG);
				$data['EDUCATION_LEVEL']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));
				$data['program']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 74, 'api_search' => ''));
				$data['program_peserta']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));
				$this->breadcrumb->append_crumb('Home', base_url());
				$salam="Detail Pendaftar";
				$this->breadcrumb->append_crumb($salam, '/');
				// $data['JENJANG']=$this->jenjang($data['choice'][0]->ID_JENJANG);
				$data['content']='05_adminpmb/admluarnegeri/pendaftar/detail_pendaftar';
				$this->load->view('s00_vw_all', $data);
			}elseif($_POST['ACT']=='Konfirmasi'){
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 80, 'api_search' => 100);
					$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					// print_r($data['no_terkahir']);  die();
					if($data['no_terkahir']==TRUE){
						// Minta id_ruang ujian
						$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
						$nomer_terakhir = substr($nomer_terakhir,5,5);
						// echo $nomer_terakhir; die();
						$nomer_terakhir = $nomer_terakhir+1;
						if (($nomer_terakhir>=0)&&($nomer_terakhir<10)) $nolny = "0000"; //00001 - 9
						elseif (($nomer_terakhir>=10)&&($nomer_terakhir<100)) $nolny = "000"; // 00010 - 99
						elseif (($nomer_terakhir>=100)&&($nomer_terakhir<1000)) $nolny = "00"; // 00100 - 999
						elseif (($nomer_terakhir>=1000)&&($nomer_terakhir<10000)) $nolny = "0"; // 001000 - 9999
						elseif ($nomer_terakhir>=10000) $nomer_terakhir = "";
						$y=date("y");
						$no=$y."100".$nolny.$nomer_terakhir; 
						// echo $no; die();
							$config['protocol']='smtp';  
							$config['smtp_host']='ssl://smtp.googlemail.com';  
							$config['smtp_port']='465';  
							$config['smtp_user']='admission@uin-suka.ac.id';  
							$config['smtp_pass']='111222';  
							$config['mailtype']='html';  
							$email=$_POST['email'];
							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from('admission@uin-suka.ac.id');
							$this->email->to($email);		
							$this->email->subject('Confirmation on your registration to UIN Sunan Kalijaga');
							$pesan="Dear ".$_POST['nama'].",<br />
									Your registration to admisi.uin-suka.ac.id has been confirmed.<br />
									You can view Your registration details by login to admisi.uin-suka.ac.id using your account.<br />
									Should you have any enquiries, please email to admission@uin-suka.<br />
									We look forward to see you in UIN Sunan Kalijaga<br /><br />
									Best Regards,<br />
									Admission Office<br />
									UIN Sunan Kalijaga Yogyakarta<br />
									admisi.uin-suka.ac.id<br />
									admission@uin-suka.ac.id
							";		
							$this->email->message($pesan);
							if($this->email->send()){					
								$DATAPOST=array(
									'PMB_PIN_PENDAFTAR' => $_POST['PMB_PIN_PENDAFTAR'],
									'PMB_NO_UJIAN_PENDAFTAR' => $no
								);
								$aksi=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST',array('api_kode'=>10, 'api_subkode' => 80,'api_search' => $DATAPOST));
								if($aksi==1){echo "Sukses";}else{echo "gagal";}
							}else{
								show_error($this->email->print_debugger());
							}
					}
			}elseif($_POST['ACT']=='Gagal'){
				echo "Konfirmasi Gagal";
			}
		}else{
			$this->breadcrumb->append_crumb('Home', base_url());
			$salam="List Pendaftar";
			$this->breadcrumb->append_crumb($salam, '/');
			$data['pendaftar']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 79, 'api_search' => $this->session->userdata('id_user')));	
			$data['content']='05_adminpmb/admluarnegeri/pendaftar/list_pendaftar';
			$this->load->view('s00_vw_all', $data);
		}
		
	}
	
	function terserah(){
	
						$config['protocol']='smtp';  
							$config['smtp_host']='ssl://smtp.googlemail.com';  
							$config['smtp_port']='465';  
							$config['smtp_user']='199111280000001101@uin-suka.ac.id';  
							$config['smtp_pass']='123qweasdzxc';  		
							$config['mailtype']='html';  
							//$email=$_POST['email'];
							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from('199111280000001101@uin-suka.ac.id');
							$this->email->to('daru.prasetyawan@uin-suka.ac.id');		
							$this->email->subject('Confirmation on your registration to UIN Sunan Kalijaga');
							$pesan="Dear ,<br />
									Your registration to admisi.uin-suka.ac.id has been confirmed.<br />
									You can view Your registration details by login to admisi.uin-suka.ac.id using your account.<br />
									Should you have any enquiries, please email to admission@uin-suka.<br />
									We look forward to see you in UIN Sunan Kalijaga<br /><br />
									Best Regards,<br />
									Admission Office<br />
									UIN Sunan Kalijaga Yogyakarta<br />
									admisi.uin-suka.ac.id<br />
									admission@uin-suka.ac.id
							";		
							$this->email->message($pesan);
							if($this->email->send()){	
							echo"success";
							}else{
								show_error($this->email->print_debugger());
							}
						
	}
	
	function kirim_email(){
			$config['protocol']='smtp';  
			$config['smtp_host']='ssl://smtp.googlemail.com';  
			$config['smtp_port']='465';  
			$config['smtp_user']='admission@uin-suka.ac.id';  
			$config['smtp_pass']='111222';  
			$config['mailtype']='html';  
			$email="kiand.design@gmail.com";
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('admission@uin-suka.ac.id');
			$this->email->to($email);		
			$this->email->subject('Confirmation on your registration to UIN Sunan Kalijaga');
			$pesan="Jajal wae";		
			$this->email->message($pesan);
			if($this->email->send()){					
				echo "iso iki lo";
			}else{
				show_error($this->email->print_debugger());
			}
		
		
	}
	
	function list_pendaftar_detail(){
	$data['negara'] = $this->wilayah->data_negara();	
		$data['KD_PENDIDIKAN']=$this->kd_pendidikan();
		if(isset($_POST['ACT'])){
			if($_POST['ACT']=='Detail'){
				// print_r($_POST); die();
				$data['pendaftar']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 70, 'api_search' => $_POST['PMB_PIN_PENDAFTAR']));
				// print_r($data['pendaftar']);
				$data['choice']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));	
				$data['JENJANG']=$this->jenjang($data['choice'][0]->ID_JENJANG);
				$data['EDUCATION_LEVEL']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));
				$data['program']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 74, 'api_search' => ''));
				$data['program_peserta']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 77, 'api_search' => $data['pendaftar'][0]->PMB_PIN_PENDAFTAR));
				$this->breadcrumb->append_crumb('Home', base_url());
				$salam="Detail Pendaftar";
				$this->breadcrumb->append_crumb($salam, '/');
				// $data['content']='05_adminpmb/admluarnegeri/pendaftar/detail_pendaftar';
				$this->load->view('05_adminpmb/admluarnegeri/pendaftar/detail_pendaftar', $data);
			}elseif($_POST['ACT']=='Konfirmasi'){
					$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
					$parameter  = array('api_kode' => 192, 'api_subkode' => 80, 'api_search' => 100);
					$data['no_terkahir'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
					// print_r($data['no_terkahir']);  die();
					if($data['no_terkahir']==TRUE){
						// Minta id_ruang ujian
						$nomer_terakhir=$data['no_terkahir'][0]->NO_UJIAN_TERAKHIR;
						$nomer_terakhir = substr($nomer_terakhir,5,5);
						// echo $nomer_terakhir; die();
						$nomer_terakhir = $nomer_terakhir+1;
						if (($nomer_terakhir>=0)&&($nomer_terakhir<10)) $nolny = "0000"; //00001 - 9
						elseif (($nomer_terakhir>=10)&&($nomer_terakhir<100)) $nolny = "000"; // 00010 - 99
						elseif (($nomer_terakhir>=100)&&($nomer_terakhir<1000)) $nolny = "00"; // 00100 - 999
						elseif (($nomer_terakhir>=1000)&&($nomer_terakhir<10000)) $nolny = "0"; // 001000 - 9999
						elseif ($nomer_terakhir>=10000) $nomer_terakhir = "";
						$y=date("y");
						$no=$y."100".$nolny.$nomer_terakhir; 
						// echo $no; die();
						//kirirm email meneh
							$config['protocol']='smtp';  
							$config['smtp_host']='ssl://smtp.googlemail.com';  
							$config['smtp_port']='465';    	
							$config['smtp_user']='admission@uin-suka.ac.id';  
							$config['smtp_pass']='111222';  	 							
							$config['mailtype']='html';  
							$email=$_POST['email'];
							
							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from('admission@uin-suka.ac.id');
							$this->email->to($email);		
							$this->email->subject('Confirmation on your registration to UIN Sunan Kalijaga');
							$pesan="
								Dear ".$_POST['nama'].",<br />
								<p align='justify'>
									Your registration to admisi.uin-suka.ac.id has been confirmed.<br />
									You can view your registration details by login to admisi.uin-suka.ac.id using your account.<br />
									Should you have any enquiries, please email to admission@uin-suka.<br />
									We look forward to see you in UIN Sunan Kalijaga
								</p>
								<br />
								Best Regards,<br />
								Admission Office<br />
								UIN Sunan Kalijaga Yogyakarta<br />
								admisi.uin-suka.ac.id<br />
								admission@uin-suka.ac.id
							";		
							$this->email->message($pesan);
							if($this->email->send()){				
								$DATAPOST=array(
								'PMB_PIN_PENDAFTAR' => $_POST['PMB_PIN_PENDAFTAR'],
								'PMB_NO_UJIAN_PENDAFTAR' => $no
									);
								$aksi=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST',array('api_kode'=>10, 'api_subkode' => 80,'api_search' => $DATAPOST));
								if($aksi==1){echo "Sukses";}else{echo "gagal";}
							}else{
								show_error($this->email->print_debugger());
							}
						
							
						
					}
			}elseif($_POST['ACT']=='Konfirmasi Gagal'){
				$config['protocol']='smtp';  
				$config['smtp_host']='ssl://smtp.googlemail.com';  
				$config['smtp_port']='465';    	
				$config['smtp_user']='admission@uin-suka.ac.id';  
				$config['smtp_pass']='111222';  	 							
				$config['mailtype']='html';  
				$email=$_POST['email'];
				
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('admission@uin-suka.ac.id');
				$this->email->to($email);		
				$this->email->subject('Confirmation on your registration to UIN Sunan Kalijaga');
				$pesan="
					Dear ".$_POST['nama'].",<br />
					<p align='justify'>
						We are sorry to inform you that your registration to UIN Sunan Kalijaga Yogyakarta has been rejected due to incomplete documents as we have required.
					</p>
					<p align=justify>					
						Your are however allowed to apply for similar or different program(s) in the future.
					</p>
					<p align=justify>					
						Should you have any enquiries regarding admission to UIN Sunan Kalijaga Yogyakarta, please do not hesitate to contact us. 
						We wish you every success for your future endeavor.
					</p>
					<p align=justify>					
						We wish you every success for your future endeavor.
					</p>
					Best Regards,<br />
					Admission Office<br />
					UIN Sunan Kalijaga Yogyakarta<br />
					admisi.uin-suka.ac.id<br />
					admission@uin-suka.ac.id
				";		
				$this->email->message($pesan);
				if($this->email->send()){	
					$DATAPOST=array(							
					'PMB_PIN_PENDAFTAR' => $_POST['PMB_PIN_PENDAFTAR'],
					'PMB_STATUS_SIMPAN_PENDAFTAR' => 3
					);
				$aksi=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST',array('api_kode'=>10, 'api_subkode' => 81,'api_search' => $DATAPOST));
				if($aksi==1){echo "Sukses";}else{echo "Gagal";}
				}else{
					show_error($this->email->print_debugger());
				}
			}
		}
	}
	function list_pendaftar(){
		if(isset($_POST['tampil'])=='sekarang'){
			if(empty($_POST['TAHUN'])){
				$error="PILIH TAHUN TERLEBIH DAHULU";
				$pesan = "<div class='bs-callout bs-callout-error'>".$error."</div>";
				echo $pesan;
			}else{
				$datapost=array('TAHUN'=>$_POST['TAHUN']);
				// print_r($datapost); DIE(); 
				$data['pendaftar']=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 79, 'api_search' =>$datapost));	
				// PRINT_R($data); die();
				$this->load->view('05_adminpmb/admluarnegeri/pendaftar/list_pendaftar', $data);
			}
		}else{
			$this->breadcrumb->append_crumb('Beranda', base_url());
			$this->breadcrumb->append_crumb('List Pendaftar', '/');
			$data['tahun_priode']=$this->tahun_priode();
			#$this->output99->output_display('05_adminpmb/admlaporan/data_ruang/form_data_inforuang', $data);
			$data['content']='05_adminpmb/admluarnegeri/pendaftar/form_list_pendaftar';
			$this->load->view('s00_vw_all', $data);
		}
	}
	
	private function tahun_priode(){
		$api_url 	= URL_API_ADMISI.'admisi_pmb/data_search';
		$parameter  = array('api_kode' => 255, 'api_subkode' => 1, 'api_search' => array());
		return $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
	}	
	
	function mail(){
	
		$kepada = "kiand.design@gmail.com";    //email tujuan 
		$subject = "kirim email";       //judul email 
		$pesan  = "guys, numpang kirim email ya";   //pesan  
		$dari = "199111280000001101@uin-suka.ac.id"; //email account anda  
		$from = "From: $dari";   
		mail($kepada,$subject,$pesan,$from);    //fungsi untuk kirim email 
		
	}
	
	function berita(){
		$berita=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 82, 'api_search' => ''));	
		echo $this->image($berita[0]->PN_ID);
	}
	
	function image($id){
		$foto=$this->api->get_api_json(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 81, 'api_search' => $id));	
		// print_r($foto);
		$q=base64_decode($foto[0]['PN_FOTO']);
		header("Content-type: image/jpeg");
		echo $q;
	}
	
	function berita_list(){
		$berita=$this->api->get_api_jsob(URL_API_ADMISI.'admisi_pmb/data_search', 'POST', array('api_kode'=>192, 'api_subkode' => 83, 'api_search' =>''));
		foreach($berita as $v){
			echo $this->image($v->PN_ID);
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
		}
	}
}