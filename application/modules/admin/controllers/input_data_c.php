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
		$this->load->view('awal');
		$this->load->model('input_data_m');
	}
	
	function index()
	{
		
	}

	function data_jalur()
	{
		$data_jalur=array();
		$all_jalur = $this->input_data_m->get_jalur();
		foreach ( $all_jalur as $datajlr) 
		{
			$data_jalur[$datajlr['kode_jalur']] = $datajlr['jalur_masuk'];
		}
		$hasil_jalur['jalur_masuk']=$data_jalur;
		return $hasil_jalur;
	}

	function data_gedung()
	{
		$data_gedung=array();
		$all_gedung = $this->input_data_m->get_gedung();
		foreach ( $all_gedung as $datagdg) 
		{
			$data_gedung[$datagdg['id_gedung']] = $datagdg['nama_gedung'];
		}
		$hasil_gedung['nama_gedung']=$data_gedung;
		return $hasil_gedung;

	}

	function data_penawaran()
	{
		$data_penawaran=array();
		$all_penawaran = $this->input_data_m->get_penawaran_jalur();
		foreach ( $all_penawaran as $datapnw) 
		{
			$data_penawaran[$datapnw['kode_penawaran']] = $datapnw['jalur_masuk'];
		}
		$hasil_penawaran['jalur_masuk']=$data_penawaran;
		return $hasil_penawaran;
	}

	function form_penawaran_jalur()
	{
		
		$this->load->view('form_penawaran_jalur',$this->data_jalur());
	}

	function form_ruang()
	{
		$this->load->view('form_ruang',$this->data_gedung());
	}

	function form_jadwal_ujian()
	{
		
		$this->load->view('form_jadwal_ujian',$this->data_penawaran());
		
	}

	function ruang_post()
	{
		$data['id_ruang']=$this->input->post('id_ruang');
		$data['id_gedung']=$this->input->post('id_gedung');
		$data['nama_ruang']=$this->input->post('nama_ruang');
		$data['status_ruang']=$this->input->post('status_ruang');
		$this->input_data_m->insert_ruang($data['id_ruang'],$data['id_gedung'],$data['nama_ruang'],$data['status_ruang']);	
	}

	function jadwal_ujian_post()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['hari']=$this->input->post('hari');
		$data['tanggal_ujian']=$this->input->post('tanggal_ujian');
		$data['jam_mulai_ujian']=$this->input->post('jam_mulai_ujian');
		$data['jam_selesai_ujian']=$this->input->post('jam_selesai_ujian');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$this->input_data_m->insert_jadwal_ujian($data['kode_jadwal'],$data['hari'],$data['tanggal_ujian'],$data['jam_mulai_ujian'],$data['jam_selesai_ujian'],$data['kode_penawaran']);
	}

	function penawaran_jalur_post()
	{
		$data['kode_penawaran']=$this->input->post('kode_jalur').$this->input->post('tahun');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$this->input_data_m->insert_penawaran_jalur($data['kode_penawaran'],$data['kode_jalur'],$data['tahun']);
	}
}