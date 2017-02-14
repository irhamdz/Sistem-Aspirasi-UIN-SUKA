<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Input_data_m extends CI_Model
{
	function __construct()
    {
        parent::__construct();

    }

    function get_jalur()
    {
    	$data=$this->db->query('SELECT * FROM jalur order by kode_jalur asc');
    	return $data->result_array();
    }

    function get_ruang($id_gedung)
    {
        $data=$this->db->query("SELECT * FROM ruang where status_ruang='1' and id_gedung='$id_gedung' order by id_ruang asc");
        return $data->result_array();
    }

    function get_gedung()
    {
    	$data=$this->db->query("SELECT * FROM gedung where status_gedung ='1' order by id_gedung asc");
    	return $data->result_array();
    }

    function get_penawaran_jalur()
    {
        $data=$this->db->query("SELECT * FROM view_penawaran_jalur order by tahun desc");
        return $data->result_array();
    }

    function get_jadwal_ujian()
    {
        $data=$this->db->query("SELECT * FROM jadwal_ujian order by tanggal_ujian asc");
        return $data->result_array();
    }

    function insert_penawaran_jalur($kode_penawaran,$kode_jalur, $tahun)
    {
   		$data=$this->db->query("SELECT * FROM INSERT_PENAWARAN_JALUR('$kode_penawaran','$kode_jalur','$tahun')");
   		if($data)
			{
				redirect(base_url('admin/input_data_c'));
			}
		
    }

    function insert_ruang($id_ruang,$id_gedung, $nama_ruang,$status_ruang)
    {
   		$data=$this->db->query("SELECT * FROM INSERT_RUANG('$id_ruang','$id_gedung','$nama_ruang','$status_ruang')");
   		if($data)
			{
				redirect(base_url('admin/input_data_c'));
			}
		
    }

    function insert_jadwal_ujian($kode_jadwal,$hari, $tgl,$jam_mulai,$jam_selesai,$kode_penawaran)
    {
        $data=$this->db->query("SELECT * FROM insert_jadwal_ujian('$kode_jadwal','$hari','$tgl','$jam_mulai','$jam_selesai','$kode_penawaran')");
        if($data)
            {
                redirect(base_url('admin/input_data_c'));
            }
        
    }

 }