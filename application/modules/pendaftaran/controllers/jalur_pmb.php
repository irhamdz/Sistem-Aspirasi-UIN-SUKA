<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH.'/libraries/REST_Controller.php';

class Jalur_pmb extends CI_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->library('webserv');
		
	}
	
	function index()
	{
		
	}

	
	function validate_jalur_pmb($kode_pmb)
	{		


			$kode=array('kode_bayar'=>$kode_pmb);
			
			$detail_bayar=array('DETAIL_BAYAR'=>$kode);
			
			$hasil = $this->webserv->admisi('input_data/detail_penawaran_jalur',$detail_bayar);

			$kode_bayar=array('DETAIL_BAYAR'=>$kode);
			
			$datajalur = $this->webserv->admisi('input_data/detail_penawaran_jalur',$kode_bayar);
			foreach ($datajalur as $valjalur);
				$data_jalur=$valjalur->kode_jalur;
				$penawaran_jalur=$valjalur->kode_penawaran;
			
			$kode_jalur=array('kode_jalur'=>$data_jalur);

			$post_data_jalur=array('CARI_FORM'=>$kode_jalur); 

			$ambil_form=array('KODE_JALUR'=>$kode_jalur);
			$data['data_grup_aktif'] = $this->webserv->admisi('data_form/grup_form',$ambil_form);
			$data['data_form_aktif'] = $this->webserv->admisi('data_form/grup_jalur_form',$ambil_form);
			$user=array('nomor_pendaftar'=>$this->session->userdata('username'));				
			
			
			$data['kode_bayar']=$kode;
			if(!is_null($hasil))
			{
					$insert_nomor=array('NO_PENDAFTAR'=>$user);
					$masuk=$this->webserv->admisi('input_data/insert_nomor_pendaftar',$insert_nomor);
					if($masuk)
					{
						$jal['nomor_pendaftar']=$this->session->userdata('username');
						$jal['kode_penawaran']=$penawaran_jalur;
						$kirim=array('INSERT_JALUR'=>$jal);
						$masukan_jalur=$this->webserv->admisi('input_data/insert_mhs_jalur',$kirim);
						$id=array('CARI_DATA_DIRI'=>$user);
						$data['foto']= $this->webserv->admisi('data_form/foto_pendaftar',$id);
						$status=array('STATUS_SIMPAN'=>$user);
						$data['status_simpan']= $this->webserv->admisi('data_form/cek_status_simpan',$status);
						$data['kode_penawaran']=$penawaran_jalur;
						$data['kode_jalur']=$data_jalur;
						$data['kode_bayar']=$kode_pmb;
						$data['content']="form/lihat_form";
						$this->load->view('pendaftaran/content',$data);	

					}
					else
					{
						redirect(base_url());//GAGAL MEMASUKKAN NOMOR_PENDAFTAR
					}
					
				
			}	
			else
			{
				//echo "tidak memiliki hak ";
				redirect(base_url());
			}
			
	}

}