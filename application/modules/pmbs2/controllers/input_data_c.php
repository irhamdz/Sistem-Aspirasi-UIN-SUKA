<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH.'/libraries/REST_Controller.php';

class Input_data_c extends CI_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->library('webserv');
		
	}
	
	function index()
	{
		
	}

	function form_penawaran_jalur()
	{	
		$data['data_jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_penawaran_jalur";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function after_tranc_penawaran_jalur()
	{
		$data['data_jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur',array());
		$this->load->view("v_table/view_table_penawaran",$data);
		
	}

	function form_ruang()
	{
		$data['data_ruang'] = $this->webserv->admisi('input_data/ruang',array());
		$data['nama_gedung'] = $this->webserv->admisi('input_data/gedung',array());
		$data['content']="form_ruang";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	function form_jadwal_ujian()
	{
		$data['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur',array());
		$data['content']="form_jadwal_ujian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

		
	}

	function ruang_post()
	{
		$id_ruang=$this->input->post('id_ruang');
		$id_gedung=$this->input->post('id_gedung');
		$nama_ruang=$this->input->post('nama_ruang');
		$status_ruang=$this->input->post('status_ruang');
		
		$insert_data=array(
			'id_ruang'=>$id_ruang,
			'id_gedung'=>$id_gedung,
			'nama_ruang'=>$nama_ruang,
			'status_ruang'=>$status_ruang);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_ruang',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/input_data_c/form_ruang');
				}
				
		}

	function jadwal_ujian_post()
	{
		$kode_jadwal=$this->input->post('kode_jadwal');
		$hari=$this->input->post('hari');
		$tanggal_ujian=$this->input->post('tanggal_ujian');
		$jam_mulai_ujian=$this->input->post('jam_mulai_ujian');
		$jam_selesai_ujian=$this->input->post('jam_selesai_ujian');
		$kode_penawaran=$this->input->post('kode_penawaran');
		
		$insert_data=array(
			'kode_jadwal'=>$kode_jadwal,
			'hari'=>$hari,
			'tanggal_ujian'=>$tanggal_ujian,
			'jam_mulai_ujian'=>$jam_mulai_ujian,
			'jam_selesai_ujian'=>$jam_selesai_ujian,
			'kode_penawaran'=>$kode_penawaran);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_jadwal_ujian',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/input_data_c/form_jadwal_ujian');
				}
		
	}

	function penawaran_jalur_post()
	{


		$kode_penawaran=$this->input->post('jalur_masuk').$this->input->post('tahun');
		$kode_jalur=$this->input->post('jalur_masuk');
		$tahun=$this->input->post('tahun');
		$tanggal_mulai_daftar=$this->input->post('tanggal_mulai_daftar');
		$tanggal_selesai_daftar=$this->input->post('tanggal_selesai_daftar');
		$jam_mulai_daftar=$this->input->post('jam_mulai_daftar');
		$jam_selesai_daftar=$this->input->post('jam_selesai_daftar');
		

		$insert_data=array(
			'kode_penawaran'=>$kode_penawaran,
			'kode_jalur'=>$kode_jalur,
			'tahun'=>$tahun,
			'tanggal_mulai_daftar'=>$tanggal_mulai_daftar.' '.$jam_mulai_daftar,
			'tanggal_selesai_daftar'=>$tanggal_selesai_daftar.' '.$jam_selesai_daftar
			);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_penawaran_jalur',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/input_data_c/form_penawaran_jalur');
				}
		}

		function delete_penawaran_jalur()
		{
			$id=$this->input->post('id');

			$id_hapus=array('kode_penawaran'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);

			$hasil=$this->webserv->admisi('input_data/delete_penawaran_jalur',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_penawaran_jalur');
					
				}
		}	

		function delete_ruang()
		{
			$id=$this->input->post('id');

			$id_hapus=array('id_ruang'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);
			
			$hasil=$this->webserv->admisi('input_data/delete_ruang',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_ruang');
					
				}
		}	

		function delete_jadwal_ujian()
		{
			$id=$this->input->post('id');

			$id_hapus=array('kode_jadwal'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);
			
			$hasil=$this->webserv->admisi('input_data/delete_jadwal_ujian',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_jadwal_ujian');
					
				}
		}	
}