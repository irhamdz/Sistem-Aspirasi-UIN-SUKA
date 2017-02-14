<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrasi extends CI_Controller {
    public function __construct(){
            parent::__construct();
			$this->load->library('curl');
			$this->load->library('service_lib');
			$this->load->library('lib_yudisium');
            $this->load->library('Webserv');
			$data=$this->session->all_userdata();
			error_reporting(0);
			$allow='REG004#AAZ002#AAZ001';
			$jbt = $this->session->userdata('jabatan');
			$who = array_intersect($jbt,explode("#",$allow));
			if(count($who)<=0){
					redirect(base_url());
			}	
       }

	function scan(){	
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Scan NIM', '#');	
		if($_POST == null){
			$data['content']='registrasi/antrian';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			
		}else{
			$nim=$this->input->post('nim');
			$this->load->library('s00_lib_api');
			$mhs = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
								array('api_kode'=>26000, 'api_subkode' => 7, 'api_search' => array($nim)));
			if($mhs){
				$data=array('NIM'=>$mhs[0]['NIM'],'NOMOR_PENDAFTARAN'=>$mhs[0]['NO_TEST'],'NAMA'=>$mhs[0]['NAMA']);
				$postdata=array('NIM'=>$nim,'USER_BARCODE'=>$this->session->userdata('id_user'));
				$hasil=$this->service_lib->api_registrasi('registrasi/set_mahasiswa_reg',$postdata);	
			
				if($hasil){
					$this->session->set_flashdata('message',$data);
					redirect('registrasi/scan');
				}
			}else{
				$data=array('error'=>"Data Tidak Ditemukan");
				$this->session->set_flashdata('message',$data);
				redirect('registrasi/scan');
			
			}
		}	
	}
	
	
	function ceklist(){		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Registrasi', '#');	
		$this->breadcrumb->append_crumb('Ceklist Dokumen', '#');	
		if($_POST == null){
			$data['content']='registrasi/ceklist';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			//$this->load->view('s00_vw_all', $data);
		}else{
			$nim=$this->input->post('nim');
			$this->load->library('s00_lib_api');
			$mhs = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
								array('api_kode'=>26000, 'api_subkode' => 7, 'api_search' => array($nim)));

			if(!empty($mhs)){
					$postdata=array('NIM'=>$nim);
					$dok=$this->service_lib->api_registrasi('registrasi/get_dokumen_registrasi',$postdata);		
					$data['dokumen']=$dok;
					$data['nim']=$nim;
					
					$ceklist=$this->service_lib->api_registrasi('registrasi/get_ceklist_registrasi',$postdata);		
					//print_r($dok);	
					$arr_ceklist=array();
					foreach($ceklist as $c){
						 //$arr_ceklist[$c->KODE_DOKUMEN]= $c->STATUS; //removed by adiwirawan
						 $arr_ceklist[$c['KODE_DOKUMEN']]= $c['STATUS'];
					}
				//	print_r($arr_ceklist);
			}
			$data['arr_ceklist']=$arr_ceklist;
			$data['mhs']=$mhs;
			$data['content']='registrasi/ceklist';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			//$this->load->view('s00_vw_all', $data);
		}			
	}
		
	function cek_dokumen_registrasi($nim="",$kd_dok="",$status="0"){
		$data['NIM']=$nim;
		$data['KODE_DOKUMEN']=$kd_dok;
		$data['STATUS']=$status;
		$data['USER_CHECK']=$this->session->userdata('username');
		$verifikasi= $this->service_lib->api_registrasi('registrasi/set_ceklist',$data);
		if($verifikasi){
			echo json_encode($data);
		}
	}
	
function verifikasi(){	
	$this->breadcrumb->append_crumb('Beranda', base_url());
	$this->breadcrumb->append_crumb('Registrasi', '#');
	$this->breadcrumb->append_crumb('Verifikasi Pra Registrasi', '#');		
	$arr_verifikasi=array();
	$arr_profil=array();
	$arr_prestasi_reg=array();
	$arr_nilai=array();
		if($_POST == null){
			$data['content']='registrasi/verifikasi';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			//$this->load->view('s00_vw_all', $data);
		}else{
			$nomor=$this->input->post('nomor');
			$data['np']=$nomor;
			$postdata=array('NOMOR_PENDAFTARAN'=>$nomor);
			$this->load->library('curl');
			$modul 	= "registrasi/get_rapor_siswa";
			$nilai 		= $this->webserv->registrasi('registrasi/rapor',$postdata,true);		
			//$nilai 		= $this->service_lib->api_registrasi('registrasi/get_rapor_span',$postdata,true);		
			//print_r($nilai);
			if(!empty($nilai)){
				$arr_nilai=array();
				foreach($nilai as $n){
					if(!isset($arr_nilai[$n->tingkat])) {
						$arr_nilai[$n->tingkat] = array();
					}
					 
					if(!isset($arr_nilai[$n->tingkat][$n->semester])) {
						$arr_nilai[$n->tingkat][$n->semester] = array();
					}
					 $arr_nilai[$n->tingkat][$n->semester][] = $n;
				}
			}
		
		//	print_r($arr_nilai);
			$ver_nilai= $this->service_lib->api_registrasi('registrasi/get_verifikasi_rapor',$postdata,true);	
		//	print_r($ver_nilai);
			if(!empty($ver_nilai)){
				$arr_verifikasi=array();
				foreach($ver_nilai as $vn){
					if(!isset($arr_verifikasi[$vn['TINGKAT']])) {
						$arr_verifikasi[$vn['TINGKAT']] = array();
					}
					 
					if(!isset($arr_verifikasi[$vn['TINGKAT']][$vn['SEMESTER']])) {
						$arr_verifikasi[$vn['TINGKAT']][$vn['SEMESTER']] = array();
					}
					if(!isset($arr_verifikasi[$vn['TINGKAT']][$vn['SEMESTER']][$vn['KODE_MATA_PELAJARAN']])) {
						$arr_verifikasi[$vn['TINGKAT']][$vn['SEMESTER']][$vn['KODE_MATA_PELAJARAN']] = array();
					}
					 $arr_verifikasi[$vn['TINGKAT']][$vn['SEMESTER']][$vn['KODE_MATA_PELAJARAN']] = $vn['VERIFIKASI'];
				}
			}
				
			$ver_prestasi= $this->webserv->registrasi('registrasi/prestasi',$postdata,true);	
	//		print_r($ver_prestasi);	die())		
		/* 	$ver_profil= $this->service_lib->api_registrasi('registrasi/get_dokumen_profil',$postdata,true);	
			//print_r($ver_profil);
			if(!empty($ver_profil)){
				$arr_profil=array();
				foreach($ver_profil as $vn){
					if(!isset($arr_profil[$vn['DOKUMEN']])) {
						$arr_profil[$vn['DOKUMEN']] = array();
					}
					 
					 $arr_profil[$vn['DOKUMEN']]= $vn['VERIFIKASI'];
				}
			}
			*/
			$ver_prestasi_reg= $this->service_lib->api_registrasi('registrasi/get_prestasi_reg',$postdata,true);	
			if(!empty($ver_prestasi_reg)){
				$arr_prestasi_reg=array();
				foreach($ver_prestasi_reg as $vpr){
					if(!isset($arr_prestasi_reg[$vpr['ID_PRESTASI']])) {
						$arr_prestasi_reg[$vpr['ID_PRESTASI']] = array();
					}
					 
					 $arr_prestasi_reg[$vpr['ID_PRESTASI']]= $vpr['VERIFIKASI'];
				}
			}
			//print_r($arr_prestasi_reg);
			$data['profil']= json_decode($this->service_lib->api_praregistrasi('praregistrasi/d_mahasiswa/get_data_siswa?NO_TEST='.$nomor),true);
			$data['ket']= $this->service_lib->api_registrasi('registrasi/get_keterangan',$postdata,true);
			$data['data_profil']= json_decode($this->service_lib->api_praregistrasi('praregistrasi/d_mahasiswa/get_uploaded_data?no_test='.$nomor.'&kolom=1'),true);
			$data['siswa']= $this->webserv->registrasi('registrasi/siswa',$postdata,true); 
			//print_r($data['ket']);
			$data['nilai_rapor']= $arr_nilai;
			
			 $data['ver_rapor']= $arr_verifikasi;
			$data['arr_profil']= $arr_profil;
			$data['arr_prestasi']= $ver_prestasi;
			$data['arr_prestasi_reg']= $arr_prestasi_reg; 
			$data['np']=$nomor;
			$data['content']='registrasi/verifikasi';
			$this->load->view('page/header',$data);
			$this->load->view('admin/content');
			$this->load->view('page/footer');	
			//$this->load->view('s00_vw_all', $data);
		}	
	}
	
	function keterangan_nilai($np="",$kelas="",$smt="",$kd_mp=""){
		if($_POST==null){
			$this->load->view('registrasi/keterangan_nilai');
		}else{
			$data['NOMOR_PENDAFTARAN']=$np;
			$data['TINGKAT']=$kelas;
			$data['SEMESTER']=$smt;
			$data['KODE_MATA_PELAJARAN']=$kd_mp;
			$data['VERIFIKASI']=0;
			$data['KETERANGAN']=$this->input->post('keterangan');
			$data['USER']=$this->session->userdata('user');
			$postdata=$data;
			$verifikasi= $this->service_lib->api_registrasi('registrasi/set_verifikasi_rapor',$postdata);
			if($verifikasi){
				//echo json_encode($data);
				echo"<script>
					parent.jQuery.fn.colorbox.close();
					</script>";
			}
		}
	}
	function keterangan_prestasi($np="",$id_prestasi=""){
		if($_POST==null){
			$this->load->view('registrasi/keterangan_nilai');
		}else{
			$data['NOMOR_PENDAFTARAN']=$np;
			$data['ID_PRESTASI']=$id_prestasi;
			$data['KETERANGAN']=$this->input->post('keterangan');
			$data['USER']=$this->session->userdata('user');
			$postdata=$data;
			$verifikasi= $this->service_lib->api_registrasi('registrasi/set_verifikasi_prestasi',$postdata);
			if($verifikasi){
				//echo json_encode($data);
				echo"<script>
					parent.jQuery.fn.colorbox.close();
					</script>";
			}
		}
	}
	
	function profile_doc($nomor=0,$kode=0){
	//	$nomor='4150284949';
	$x= $this->service_lib->api_praregistrasi('praregistrasi/d_mahasiswa/get_uploaded_data?no_test='.$nomor.'&kolom='.$kode);
				
    $data=json_decode($x,true);
    $file_isi = $data['file'];
    $file_nama = $data['file_nama'];
    if($file_nama){
		header("Content-Type: application/jpg");
        flush();
        echo base64_decode($file_isi);
        exit;
    }else{
        echo "Thanks for landing captain!";
    }
}
	function verifikasi_rapor($np="",$kelas="",$smt="",$kd_mp="",$ver="1"){
		$data['NOMOR_PENDAFTARAN']=$np;
		$data['TINGKAT']=$kelas;
		$data['SEMESTER']=$smt;
		$data['KODE_MATA_PELAJARAN']=$kd_mp;
		$data['VERIFIKASI']=$ver;
		$data['USER']=$this->session->userdata('user');
		$postdata=$data;
		$verifikasi= $this->service_lib->api_registrasi('registrasi/set_verifikasi_rapor',$postdata);
		if($verifikasi){
			echo json_encode($data);
		}
	}

	function verifikasi_dokumen($np="",$doc="",$ver="1"){		
		$arr_doc=array(
			'1'=>"DOC_PENGHASILAN_IBU",
			'2'=>"DOC_PENGHASILAN_BPK",
			'3'=>"DOC_PENGHASILAN_WALI",
			'4'=>"DOC_PBB",
			'5'=>"DOC_REK_LISTRIK",
			'6'=>"DOC_KK",
			'7'=>"DOC_KARTU_MISKIN",
		);	
		$arr_col=array(
			'1'=>"GAJI_IBU",
			'2'=>"GAJI_BAPAK",
			'3'=>"GAJI_WALI",
			'4'=>"LUAS_TANAH_ORTU",
			'5'=>"DAYA_LISTRIK_ORTU",
			'6'=>"JUM_TANGGUNGAN",
			'7'=>"DOC_KARTU_MISKIN",
		);
		$data['NOMOR_PENDAFTARAN']=$np;
		$data['DOKUMEN']=$arr_doc[$doc];
		$data['KOLOM']=$arr_doc[$doc];
		$data['VERIFIKASI']=$ver;
		$arr_ver=array('<label class="label label-danger">Tidak Sesuai</label>','<span class="label label-success">Sesuai</span>');
		$postdata=$data;
		$verifikasi= $this->service_lib->api_registrasi('registrasi/set_verifikasi_profil',$postdata);
		if($verifikasi){
			echo"<script>
			parent.$('#".$np."_".$arr_doc[$doc]."').html('".$arr_ver[$ver]."')
			parent.$.fn.colorbox.close();</script>";
		}
	}	
	function verifikasi_profil(){	
		$data=array();	
		$gaji_ibu=$this->input->post('gaji_ibu');
		$gaji_bapak=$this->input->post('gaji_bapak');
		$gaji_wali=$this->input->post('gaji_wali');
		$luas_tanah_ortu=$this->input->post('luas_tanah_ortu');
		$pembayaran_pbb=$this->input->post('pembayaran_pbb');
		$daya_listrik_ortu=$this->input->post('daya_listrik_ortu');
		$pembayaran_listrik=$this->input->post('pembayaran_listrik');
		$jum_tanggungan=$this->input->post('jum_tanggungan');
		$keterangan=$this->input->post('ket_profil');
		if($gaji_ibu!=null)$data['GAJI_IBU']=$gaji_ibu;
		if($gaji_bapak!=null)$data['GAJI_BAPAK']=$gaji_bapak;
		if($gaji_wali!=null)$data['GAJI_WALI']=$gaji_wali;
		if($luas_tanah_ortu!=null)$data['LUAS_TANAH_ORTU']=$luas_tanah_ortu;
		if($daya_listrik_ortu!=null)$data['DAYA_LISTRIK_ORTU']=$daya_listrik_ortu;
		if($pembayaran_listrik!=null)$data['PEMBAYARAN_LISTRIK_AKHIR']=$pembayaran_listrik;
		if($pembayaran_pbb!=null)$data['PEMBAYARAN_PBB_AKHIR']=$pembayaran_pbb;
		if($jum_tanggungan!=null)$data['JUM_TANGGUNGAN']=$jum_tanggungan;
		$data2=$this->session->all_userdata();
		$data['VERIFIKATOR']=$data2['id_user'];
		//print_r($_POST);
		echo $postdata['NOMOR_PENDAFTARAN']=$np=$this->input->post('np');
		$postdata['data_update']=$data;
		$verifikasi= $this->service_lib->api_registrasi('registrasi/set_koreksi_profil',$postdata);
		$verifikasi2= $this->service_lib->api_registrasi('registrasi/set_keterangan',
						array('NOMOR_PENDAFTARAN'=>$np, 'KETERANGAN'=>$keterangan));
		//print_r($verifikasi2);die();
		//if($verifikasi){
				$this->session->set_flashdata('message',array("success","Data berhasil disimpan."));
				redirect('registrasi/verifikasi');
		//}
	}	
	
	function verifikasi_prestasi($np="",$id="",$ver="1"){
		$data['NOMOR_PENDAFTARAN']=$np;
		$data['ID_PRESTASI']=$id;
		$data['VERIFIKASI']=$ver;
		//$arr_ver=array('<label class="label label-danger">Tidak Sesuai</label>','<span class="label label-success">Sesuai</span>');
		$postdata=$data;
		$verifikasi= $this->service_lib->api_registrasi('registrasi/set_verifikasi_prestasi',$postdata);
		if($verifikasi){
			echo json_encode($verifikasi);
		}
	}
	
	function tes(){
		$data=$this->session->all_userdata();
		$arr_jabatan=explode('#',$data['jabatan']);
		$allow='REG004';
		$jbt = $this->session->userdata('jabatan');
		$who = array_intersect(explode("#",$jbt),explode("#",$allow));
		echo count($who);
	}

	function sertifikat($NP="",$ID_PRESTASI="",$doc=""){
		$postdata=array(
					'NOMOR_PENDAFTARAN'=>$NP,
					'ID_PRESTASI'=>$ID_PRESTASI
				);	
		$sertifikat= $this->service_lib->api_registrasi('registrasi/get_sertifikat_spanptkin',$postdata);
		//	print_r($sertifikat);
		//base_url('dokumen/spanptkin/prestasi/'.$p->FILE_SERTIFIKAT)
		$doc=$sertifikat[0]['FILE_SERTIFIKAT'];
		$data['file']=base_url('dokumen/spanptkin/prestasi/'.$doc);
		
	//	base_url()."dokumen/snmptn/prestasi/".$NP."/".$doc;
		$data['href']=site_url('registrasi/verifikasi_prestasi/'.$NP.'/'.$ID_PRESTASI);
		$this->load->view('registrasi/prestasi',$data);
	}
	function sertifikat_snmptn($NP="",$ID_PRESTASI="",$doc=""){
		$postdata=array(
					'NOMOR_PENDAFTARAN'=>$NP,
					'ID_PRESTASI'=>$ID_PRESTASI
				);	
		$sertifikat= $this->service_lib->api_registrasi('registrasi/get_sertifikat',$postdata);
		//	print_r($sertifikat);
		$doc=$sertifikat[0]['FILE_SERTIFIKAT'];
		$data['file']=base_url()."dokumen/snmptn/prestasi/".$NP."/".$doc;
		$data['href']=site_url('registrasi/verifikasi_prestasi/'.$NP.'/'.$ID_PRESTASI);
		$this->load->view('registrasi/prestasi',$data);
	}
	

	function document($NP="",$doc=""){
		if($_POST==null){
			$profil= json_decode($this->service_lib->api_praregistrasi('praregistrasi/d_mahasiswa/get_data_siswa?NO_TEST='.$NP),true);	
				
		$arr_doc=array(
			'1'=>"DOC_PENGHASILAN_IBU",
			'2'=>"DOC_PENGHASILAN_BPK",
			'3'=>"DOC_PENGHASILAN_WALI",
			'4'=>"DOC_PBB",
			'5'=>"DOC_REK_LISTRIK",
			'6'=>"DOC_KK",
			'7'=>"DOC_KARTU_MISKIN",
		);	
		$arr_col=array(
			'1'=>"GAJI_IBU",
			'2'=>"GAJI_BAPAK",
			'3'=>"GAJI_WALI",
			'4'=>"LUAS_TANAH_ORTU",
			'5'=>"DAYA_LISTRIK_ORTU",
			'6'=>"JUM_TANGGUNGAN",
			'7'=>"DOC_KARTU_MISKIN",
		);
		$data['capt']=$arr_col[$doc];
		$data['val']=$profil[$arr_col[$doc]];
		$data['img']=site_url('registrasi/profile_doc/'.$NP.'/'.$doc);
		$data['href']=site_url('registrasi/verifikasi_dokumen/'.$NP.'/'.$doc);
		$this->load->view('registrasi/document',$data);
		}
	}
		
	
	function api_registrasi($modul,$postdata=""){
	
			$username='regist';
			$password='regist123';
		
			$this->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://regist:regist123@service.uin-suka.ac.id/servsiasuper/index.php/".$modul;
			$hasil = $this->curl->simple_post($api_url,$postdata);
			return $nilai=json_decode($hasil,true);
	}


	
}
