<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Data_form extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
    }

     function data_ambil_jadwal_post()
    {

        $id=$this->input->post('AMBIL_JADWAL');

        $data=$this->db->query("SELECT * FROM pilih_jadwal where nomor_pendaftar ='".$id['nomor_pendaftar']."' ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function update_pilih_jadwal_post()
    {
        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM update_pilih_jadwal('".$id['nomor_pendaftar']."','".$id['kode_jadwal']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function data_jadwal_ujian_post()
    {

        $id=$this->input->post('DATA_JADWAL');

        $data=$this->db->query("SELECT * FROM view_jadwal_penawaran where kode_jalur ='".$id['kode_jalur']."' ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function data_sertifikasi_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_sertifikasi where nomor_pendaftar ='".$id['nomor_pendaftar']."' ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

     function delete_piljur_post()
    {

        $id=$this->input->post('DELETE_PILJUR');

        $data=$this->db->query("DELETE from pilihan_jurusan where id_piljur='".$id['id_piljur']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_piljur_post()
    {
        $id=$this->input->post('INSERT_DATA');

        $cek=$this->db->query("SELECT COUNT(*) as ada from pilihan_jurusan where nomor_pendaftar='".$id['nomor_pendaftar']."' and pilihan='".$id['pilih']."'")->result();
        foreach ($cek as $jml) {
            $ada=$jml->ada;
        }
        if($ada < 1)
        {
             $data=$this->db->query("SELECT * FROM insert_pilih_jurusan('".$id['pilihan']."','".$id['nomor_pendaftar']."','".$id['kode_jalur']."','".$id['tahun']."','".$id['status']."','".$id['jenjang']."','".$id['pilih']."')");
             if($data)
             {
             $this->response(array('message'=>'SUCCESS'), 200);
             }else{
             $this->response(array('error' => 'Data tidak ditemukan'), 404);
             }   
        }
        else
        {
             $data=$this->db->query("SELECT * FROM update_pilih_jurusan('".$id['pilihan']."','".$id['nomor_pendaftar']."','".$id['kode_jalur']."','".$id['tahun']."','".$id['status']."','".$id['jenjang']."','".$id['pilih']."')");
             if($data)
             {
             $this->response(array('message'=>'SUCCESS'), 200);
             }else{
             $this->response(array('error' => 'Data tidak ditemukan'), 404);
             }  
        }
        
    }

    function jenis_pmb_post()
    {
        
       $data=$this->db->query("SELECT * FROM jenis_pendaftar_pmb order by jenis_pendaftar asc")->result(); 
      
        if($data)
        {
            $this->response($data, 200); 

        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function detail_penawaran_jalur_post()
   {
        
        $id=$this->input->post('REQUEST_PRODI');
        
       $data=$this->db->query("SELECT * FROM view_penawaran_jalur where kode_jalur='".$id['kode_jalur']."'")->result(); 
      
        if($data)
        {
            $this->response($data, 200); 

        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

     function pilih_prodi_post()
    {
        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM view_lokasi_jurusan where nomor_pendaftar ='".$id['nomor_pendaftar']."' order by pilihan asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }


    function delete_grup_form_post()
    {
        $id=$this->input->post('DELETE_GRUP');

        $data=$this->db->query("DELETE from rel_grup_form where id='".$id['id']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

     function delete_disertasi_post()
    {

        $id=$this->input->post('DELETE_DISERTASI');

        $data=$this->db->query("DELETE from judul_disertasi where nomor_pendaftar='".$id['nomor_pendaftar']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_disertasi_post()
    {

        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_judul_disertasi('".$id['nomor_pendaftar']."','".$id['judul']."','".$id['disertasi']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }    
    }

     function judul_disertasi_post()
    {
        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM judul_disertasi where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }


     function delete_karya_tulis_post()
    {

        $id=$this->input->post('DELETE_KARYA_TULIS');

        $data=$this->db->query("DELETE from data_karya_tulis where id_karya='".$id['id_karya']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_karya_tulis_post()
    {
        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_data_karya_tulis('".$id['nomor_pendaftar']."','".$id['judul']."','".$id['penerbit']."','".$id['tahun']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }    
    }

      function data_karya_tulis_post()
    {
        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_karya_tulis where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function data_penelitian_post()
    {
        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_penelitian where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function data_riwayat_pendidikan_s2_post()
    {
        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_riwayat_pendidikan_s2 where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function insert_riwayat_pend_post()
    {
        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_pendidikan_terakhir('".$id['nomor_pendaftar']."','".$id['jurusan']."','".$id['nama_sekolah']."','".$id['tahun_lulus']."','".$id['jenjang']."','".$id['nisn']."','".$id['no_ijazah']."','".$id['uan']."','".$id['sttb']."','".$id['ijazah']."','".$id['keterangan']."','".$id['npsn']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }      
    }

    function pendidikan_terakhir_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM view_pendidikan_terakhir where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function sekolah_post()
    {

        $data=$this->db->query("SELECT * FROM sekolah order by kode_sekolah asc ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function data_wali_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_wali where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }


    function rumah_tinggal_keluarga_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_rumah_tinggal_keluarga where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_riwayat_nilai_post()
    {
        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_riwayat_nilai_pendidikan_formal('".$id['nomor_pendaftar']."','".$id['pendidikan']."','".$id['semester']."','".$id['rangking']."','".$id['jumlah']."','".$id['raport']."','".$id['kkm']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function riwayat_nilai_pendidikan_formal_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM riwayat_nilai_pendidikan_formal where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

     function rencana_hidup_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM rencana_hidup where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function prestasi_lomba_mahasiswa_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM prestasi_lomba_mahasiswa where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function update_status_form_post()
    {
         $id=$this->input->post('UPDATE_STATUS_FORM');

        $data=$this->db->query("SELECT * FROM update_status_form('".$id['kode_form']."','".$id['status_form']."')");
        if($data)
        {
           $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

  function detail_grup_form_post()
    {

        $id=$this->input->post('CARI_DATA_GRUP');

        $data=$this->db->query("SELECT * FROM view_form_grup where kode_grup_form ='".$id['kode_grup_form']."' order by kode_form")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function delete_riwayat_pendidikan_post()
    {

        $id=$this->input->post('DELETE_RIWAYAT_PENDIDIKAN');

        $data=$this->db->query("DELETE from pendidikan_terakhir where nomor_pendaftar='".$id['nomor_pendaftar']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function delete_riwayat_nilai_post()
    {

        $id=$this->input->post('DELETE_RIWAYAT_NILAI');

        $data=$this->db->query("DELETE from riwayat_nilai_pendidikan_formal where nomor_pendaftar='".$id['nomor_pendaftar']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }


    function delete_organisasi_post()
    {

        $id=$this->input->post('DELETE_ORGANISASI');

        $data=$this->db->query("DELETE from data_organisasi where nomor_pendaftar='".$id['nomor_pendaftar']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_organisasi_post()
    {

        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_data_organisasi('".$id['nama_organisasi']."','".$id['bidang_organisasi']."','".$id['waktu']."','".$id['jabatan']."','".$id['keterangan']."','".$id['nomor_pendaftar']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_organisasi_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_organisasi where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function insert_data_minat_post()
    {

        $id=$this->input->post('INSERT_DATA');

        $data=$this->db->query("SELECT * FROM insert_minat_ketrampilan('".$id['jenis_minat']."','".$id['nama_minat']."','".$id['keterangan']."','".$id['nomor_pendaftar']."')");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function delete_minat_post()
    {

        $id=$this->input->post('DELETE_MINAT');

        $data=$this->db->query("DELETE from minat_ketrampilan where id_min_ket='".$id['id_min_ket']."'");
        if($data)
        {
             $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_minat_ketrampilan_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM view_minat_ketrampilan where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function data_kesehatan_post()
    {

     
        $data=$this->db->query("SELECT * FROM kesehatan order by id_kesehatan asc ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_kontak_darurat_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM kontak_darurat where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_kesehatan_mahasiswa_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM kesehatan_mahasiswa where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_kemampuan_berbeda_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM kemampuan_berbeda where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }


    function detail_data_kegiatan_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM kegiatan_mahasiswa where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_data_keluarga_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_keluarga where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_data_orang_tua_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_orang_tua where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_penawaran_prodi_post()
    {
        $id=$this->input->post('REQUEST_PRODI');

        $data=$this->db->query("SELECT * FROM view_penawaran_jurusan where kode_jalur ='".$id['kode_jalur']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }  
    }

    function foto_pendaftar_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT foto FROM data_diri_pendaftar where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_data_diri_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM data_diri_pendaftar where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function detail_pekerjaan_mahasiswa_post()
    {

        $id=$this->input->post('CARI_DATA_DIRI');

        $data=$this->db->query("SELECT * FROM pekerjaan_mahasiswa where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }   
    }

    function foto_user_post()
    {
         $id=$this->input->post('FOTO_PENDAFTAR');

        $data=$this->db->query("SELECT foto FROM data_diri_pendaftar where nomor_pendaftar ='".$id['nomor_pendaftar']."'")->result_array();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function form_post()
    {
      
        $data=$this->db->query("SELECT * FROM form_aktif order by kode_form asc")->result();
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function grup_id_post()
    {
        $id=$this->input->post('CARI_GRUP');

        $data=$this->db->query("SELECT kode_grup_form FROM grup_form WHERE nama_grup_form='".$id['nama_grup_form']."'")->result();
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function form_item_post()
    {
      
        $id=$this->input->post('FORM_AKTIF');

        $data=$this->db->query("SELECT * FROM form_aktif WHERE kode_grup_form='".$id['kode_grup_form']."' order by kode_form asc")->result();
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function jenis_kejuaraan_post()
    {
   
        $data=$this->db->query("SELECT * FROM jenis_kejuaraan order by id_jenis asc")->result();
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function spesifik_form_post()
    {
        
        $form=array();
        $jalur=$this->input->post('CARI_FORM');
        
            $query1=$this->db->query("SELECT * FROM rel_grup_form where kode_grup_form=(select kode_grup_form from grup_form where kode_jalur='".$jalur['kode_jalur']."')")->result();
            foreach ($query1 as $data_form) {
                $data=$this->db->query("SELECT * FROM form_aktif where kode_form='".$data_form->kode_form."' and status_form='1'")->result();
                foreach ($data as $value) {
                     array_push($form, $value);
                }
               
            }
           
           
            if($form){
                $this->response($form, 200); 
            }else{
                $this->response(array('error' => 'Data tidak ditemukan'), 404);
            }

        
    }

     function detail_form_post()
    {
         $id=$this->input->post('DETAIL_FORM');

        $data=$this->db->query("SELECT * FROM form_aktif where kode_form ='".$id['kode_form']."' order by kode_form asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function grup_form_post()
    {
   
        $data=$this->db->query("SELECT * FROM grup_form where status_grup ='1' order by kode_grup_form asc")->result();
       	
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function pekerjaan_orang_tua_post()
    {
   
        $data=$this->db->query("SELECT * FROM pekerjaan_orang_tua order by id_pekerjaan asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function kesehatan_post()
    {
   
        $data=$this->db->query("SELECT * FROM health_condition order by id_health asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function kegiatan_post()
    {
   
        $data=$this->db->query("SELECT * FROM jenis_kegiatan order by id_kegiatan asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function jenjang_post()
    {
   
        $data=$this->db->query("SELECT * FROM jenjang order by id_jenjang asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }


    function negara_post()
    {
   
        $data=$this->db->query("SELECT * FROM negara order by kode_negara asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function jalur_post()
    {
   
        $data=$this->db->query("SELECT * FROM jalur order by kode_jalur asc")->result();
        
        if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function insert_data_form_post()
    {
    	ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
        
        $data=$this->db->query("SELECT * FROM insert_form_aktif('".$insert_data['kode_form']."','".$insert_data['nama_form']."','".$insert_data['status_form']."')");
       
        if($data){
            $this->response($insert_data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function insert_setting_grup_form_post()
    {
    	
        $data_setting=$this->input->post('INSERT_DATA');
        $data_grup=$data_setting['DATA_GRUP'];
        $data_form=$data_setting['DATA_FORM'];
  
        for($i=0; $i<count($data_form); $i++)
        {
           $data=$this->db->query("SELECT * FROM insert_rel_grup_form('".$data_form[$i]."','".$data_grup."') ");
        }
    	
        if($data){
           $this->response(array('message'=>'SUCCESS'), 200);
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }

    }

    function agama_post()
    {
        $data=$this->db->query('SELECT * FROM agama order by id_agama asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function provinsi_post()
    {
        $data=$this->db->query('SELECT * FROM provinsi order by nama_provinsi asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function kabupaten_post()
    {
        $data=$this->db->query('SELECT * FROM kabupaten order by nama_kabupaten asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function jenis_minat_post()
    {
        $data=$this->db->query('SELECT * FROM jenis_minat_ket order by jenis_minat asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function sumber_listrik_post()
    {
        $data=$this->db->query('SELECT * FROM sumber_listrik order by id_sumber asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function bahan_dinding_post()
    {
        $data=$this->db->query('SELECT * FROM bahan_dinding order by id_bahan_dinding asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function bahan_lantai_post()
    {
        $data=$this->db->query('SELECT * FROM bahan_lantai order by id_bahan_lantai asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
     function bahan_atap_post()
    {
        $data=$this->db->query('SELECT * FROM bahan_atap order by id_bahan_atap asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function sumber_air_post()
    {
        $data=$this->db->query('SELECT * FROM sumber_air order by id_sumber_air asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function jenis_mck_post()
    {
        $data=$this->db->query('SELECT * FROM jenis_mck order by id_mck asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function kepemilikan_rumah_post()
    {
        $data=$this->db->query('SELECT * FROM kepemilikan_rumah order by id_kepemilikan asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function detail_kabupaten_post()
    {
         $id=$this->input->post('DETAIL_KABUPATEN');

        $data=$this->db->query("SELECT * FROM kabupaten WHERE kode_provinsi='".$id['kode_provinsi']."' order by nama_kabupaten asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function riwayat_pendidikan_s2_post()
    {

        $data=$this->db->query("SELECT * FROM riwayat_pendidikan_s2 order by id_pendidikan asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function detail_wilayah_post()
    {
        $id=$this->input->post('DETAIL_WILAYAH');

        $data=$this->db->query("SELECT * FROM wilayah WHERE kode_provinsi='".$id['kode_provinsi']."' and kode_kabupaten='".$id['kode_kabupaten']."' order by nama_wilayah asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

   
 }