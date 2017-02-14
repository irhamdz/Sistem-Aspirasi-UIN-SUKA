<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Pendaftaran extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
    
    }
    
    function index()
    {
       // $data=$this->db->query("SELECT * from update_data_diri('".$id['nomor_pendaftar']."','".$id['status_simpan']."','".$id['nama_lengkap']."','".$id['gelar_depan']."','".$id['gelar_belakang']."','".$id['gelar_depan_na']."','".$id['gelar_belakang_na']."','".$id['alamat_lengkap']."','".$id['tempat_lahir']."',".$id['tgl_lahir'].",'".$id['telp']."','".$id['nohp']."','".$id['id_agama']."','".$id['jenis_kelamin']."','".$id['gol_darah']."','".$id['kabupaten_lahir']."','".$id['no_ktp']."','".$id['kode_provinsi']."','".$id['kode_kabupaten']."','".$id['kode_kecamatan']."','".$id['kelurahan']."','".$id['rt']."','".$id['rw']."','".$id['kode_pos']."','".$id['warga_negara']."','".$id['negara_asal']."','".$id['tinggi_badan']."','".$id['berat_badan']."','".$id['tanggal_akhir_ktp']."','".$id['alamat_asal']."','".$id['rt_asal']."','".$id['rw_asal']."','".$id['kode_provinsi_asal']."','".$id['kode_kabupaten_asal']."','".$id['kode_kecamatan_asal']."','".$id['kelurahan_asal']."','".$id['kode_pos_asal']."','".$id['akta_kelahiran']."','".$id['website']."','".$id['email']."','".$id['facebook']."','".$id['twitter']."','".$id['blog']."','".$id['foto']."')");

    }

    function data_diri_post()
    {
       $id=$this->input->post('SEND_DATA_DIRI');
       
       //$data=$this->db->query("SELECT * from update_data_diri('".$id['nomor_pendaftar']."','".$id['status_simpan']."','".$id['nama_lengkap']."','','".$id['gelar_belakang']."','".$id['gelar_depan_na']."','".$id['gelar_belakang_na']."','".$id['alamat_lengkap']."','".$id['tempat_lahir']."',null,'".$id['telp']."','".$id['nohp']."','".$id['id_agama']."','".$id['jenis_kelamin']."','".$id['gol_darah']."','".$id['kabupaten_lahir']."','".$id['no_ktp']."','".$id['kode_provinsi']."','".$id['kode_kabupaten']."','".$id['kode_kecamatan']."','".$id['kelurahan']."','".$id['rt']."','".$id['rw']."','".$id['kode_pos']."','".$id['warga_negara']."','".$id['negara_asal']."','".$id['tinggi_badan']."','".$id['berat_badan']."',null,'".$id['alamat_asal']."','".$id['rt_asal']."','".$id['rw_asal']."','".$id['kode_provinsi_asal']."','".$id['kode_kabupaten_asal']."','".$id['kode_kecamatan_asal']."','".$id['kelurahan_asal']."','".$id['kode_pos_asal']."','".$id['akta_kelahiran']."','".$id['website']."','".$id['email']."','".$id['facebook']."','".$id['twitter']."','".$id['blog']."','".$id['foto']."')");

      $data=$this->db->query("SELECT * from update_data_diri('".$id['nomor_pendaftar']."','".$id['status_simpan']."','".$id['nama_lengkap']."','".$id['gelar_depan']."','".$id['gelar_belakang']."','".$id['gelar_depan_na']."','".$id['gelar_belakang_na']."','".$id['alamat_lengkap']."','".$id['tempat_lahir']."',to_date('".date($id['tgl_lahir'])."','dd/mm/yyyy'),'".$id['telp']."','".$id['nohp']."','".$id['id_agama']."','".$id['jenis_kelamin']."','".$id['gol_darah']."','".$id['kabupaten_lahir']."','".$id['no_ktp']."','".$id['kode_provinsi']."','".$id['kode_kabupaten']."','".$id['kode_kecamatan']."','".$id['kelurahan']."','".$id['rt']."','".$id['rw']."','".$id['kode_pos']."','".$id['warga_negara']."','".$id['negara_asal']."','".$id['tinggi_badan']."','".$id['berat_badan']."',to_date('".date($id['tanggal_akhir_ktp'])."','dd/mm/yyyy'),'".$id['alamat_asal']."','".$id['rt_asal']."','".$id['rw_asal']."','".$id['kode_provinsi_asal']."','".$id['kode_kabupaten_asal']."','".$id['kode_kecamatan_asal']."','".$id['kelurahan_asal']."','".$id['kode_pos_asal']."','".$id['foto']."','".$id['akta_kelahiran']."','".$id['website']."','".$id['email']."','".$id['facebook']."','".$id['twitter']."','".$id['blog']."')");

         if($data)
         {
                $this->response(array('sukses' => 'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function pekerjaan_mahasiswa_post()
        {
            $id=$this->input->post('UPDATE_PK');
            $data=$this->db->query("SELECT * from update_pekerjaan_mahasiswa('".$id['nomor_pendaftar']."','".$id['nama_pekerjaan']."','".$id['alamat']."','".$id['rt']."','".$id['rw']."','".$id['kode_provinsi']."','".$id['kode_kabupaten']."','".$id['kode_kecamatan']."','".$id['kode_kelurahan']."','".$id['kode_pos']."','".$id['fax']."','".$id['email']."','".$id['telp']."')");

         if($data)
         {
                $this->response(array('sukses' => 'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
        }

    function data_keluarga_post()
    {
        $id=$this->input->post('UPDATE_DATA_KEL');
        $data=$this->db->query("SELECT * from update_data_keluarga(
   '".$id['nomor_pendaftar']."',
    '".$id['jumlah_saudara']."',
    '".$id['tanggungan_orang_tua']."',
    '".$id['gaji_ibu']."',
    '".$id['jumlah_tabungan_ibu']."',
    '".$id['jumlah_hutang_ibu']."',
    '".$id['cicilan_hutang_ibu']."',
    '".$id['jumlah_piutang_ibu']."',
    '".$id['cicilan_piutang_ibu']."',
    '".$id['gaji_ayah']."',
    '".$id['jumlah_tabungan_ayah']."',
    '".$id['jumlah_hutang_ayah']."',
    '".$id['cicilan_hutang_ayah']."',
    '".$id['jumlah_piutang_ayah']."',
    '".$id['cicilan_piutang_ayah']."',
    '".$id['gaji_wali']."',
    '".$id['jumlah_tabungan_wali']."',
    '".$id['jumlah_hutang_wali']."',
    '".$id['cicilan_hutang_wali']."',
    '".$id['jumlah_piutang_wali']."',
    '".$id['cicilan_piutang_wali']."',
    '".$id['kartu_keluarga']."',
    '".$id['surat_keterangan_penghasilan_ibu']."',
    '".$id['surat_keterangan_penghasilan_ayah']."',
    '".$id['surat_keterangan_penghasilan_wali']."',
    '".$id['kartu_miskin']."',
    '".$id['status_perkawinan']."',
    '".$id['nama_suami_istri']."',
    '".$id['keterangan']."',
    '".$id['anak']."')");
       
        //$data=$this->db->query("SELECT * from update_data_keluarga('".$id['nomor_pendaftar']."','".$id['jumlah_saudara']."','".$id['tanggungan_orang_tua']."','".$id['gaji_ibu']."','".$id['jumlah_tabungan_ibu']."','".$id['jumlah_hutang_ibu']."','".$id['cicilan_hutang_ibu']."','".$id['jumlah_piutang_ibu']."','".$id['cicilan_piutang_ibu']."','".$id['gaji_ayah']."','".$id['jumlah_tabungan_ayah']."','".$id['jumlah_hutang_ayah']."','".$id['cicilan_hutang_ayah']."','".$id['jumlah_piutang_ayah']."','".$id['cicilan_piutang_ayah']."','".$id['gaji_wali']."','".$id['jumlah_tabungan_wali']."','".$id['jumlah_hutang_wali']."','".$id['cicilan_hutang_wali']."','".$id['jumlah_piutang_wali']."','".$id['cicilan_piutang_wali']."','".$id['kartu_keluarga']."','".$id['surat_katerangan_penghasilan_ibu']."','".$id['surat_katerangan_penghasilan_ayah']."','".$id['surat_katerangan_penghasilan_wali']."','".$id['kartu_miskin']."','".$id['status_perkawinan']."','".$id['nama_suami_istri']."','".$id['keterangan']."','".$id['anak']."')");

         if($data)
         {
                $this->response(array('sukses' => 'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function data_ibu_post()
    {
        $id=$this->input->post('UPDATE_IBU');

       $data=$this->db->query("SELECT * from update_data_ibu('".$id['nomor_pendaftar']."','".$id['nama_lengkap_ibu']."','".$id['alamat_lengkap_ibu']."','".$id['nohp_ibu']."','".$id['telp_ibu']."','".$id['status_simpan']."','".$id['rt_ibu']."','".$id['rw_ibu']."','".$id['desa_ibu']."','".$id['kec_ibu']."','".$id['kab_ibu']."','".$id['prop_ibu']."','".$id['kode_pos_ibu']."','".$id['status_ibu']."','".$id['id_agama_ibu']."','".$id['id_jenjang_pendidikan_ibu']."','".$id['pekerjaan_ibu']."','".$id['email_ibu']."',to_date('".date($id['tanggal_lahir_ibu'])."','dd/mm/yyyy'),'".$id['tempat_lahir_ibu']."','".$id['id_negara_ibu']."','".$id['golongan_ibu']."')");
        //$data=$this->db->query("SELECT * FROM update_data_ibu('".$id['nomor_pendaftar']."','".$id['nama_lengkap_ibu']."','".$id['alamat_lengkap_ibu']."','".$id['nohp_ibu']."','".$id['telp_ibu']."','".$id['status_simpan_ortu']."','".$id['rt_ibu']."','".$id['rw_ibu']."','".$id['desa_ibu']."','".$id['kec_ibu']."','".$id['kab_ibu']."','".$id['prop_ibu']."','".$id['kode_pos_ibu']."','".$id['status_ibu']."','1','".$id['id_jenjang_pendidikan_ibu']."','".$id['pekerjaan_ibu']."','".$id['email_ibu']."','".date($id['tanggal_lahir_ibu'])."','".$id['tempat_lahir_ibu']."','".$id['id_negara_ibu']."','".$id['golongan_ibu']."')");
        if($data)
         {
                $this->response(array('sukses' => 'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function data_ayah_post()
    {
        $id=$this->input->post('UPDATE_AYAH');
        $data=$this->db->query("SELECT * from update_data_ayah('".$id['nomor_pendaftar']."','".$id['nama_lengkap_ayah']."','".$id['alamat_lengkap_ayah']."','".$id['nohp_ayah']."','".$id['telp_ayah']."','".$id['status_simpan']."','".$id['rt_ayah']."','".$id['rw_ayah']."','".$id['desa_ayah']."','".$id['kec_ayah']."','".$id['kab_ayah']."','".$id['prop_ayah']."','".$id['kode_pos_ayah']."','".$id['status_ayah']."','".$id['id_agama_ayah']."','".$id['id_jenjang_pendidikan_ayah']."','".$id['pekerjaan_ayah']."','".$id['email_ayah']."',to_date('".date($id['tanggal_lahir_ayah'])."','dd/mm/yyyy'),'".$id['tempat_lahir_ayah']."','".$id['id_negara_ayah']."','".$id['golongan_ayah']."')");
       
        if($data)
         {
                $this->response(array('sukses' => 'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function data_kegiatan_post()
    {
        $id=$this->input->post('UPDATE_KEGIATAN');

        //$data=$this->db->query("SELECT * FROM UPDATE_KEGIATAN_MAHASISWA('".$id['nomor_pendaftar']."','coba','1','0','SSS','W',NULL,NULL,'S','A')");
         $data=$this->db->query("SELECT * FROM UPDATE_KEGIATAN_MAHASISWA('".$id['nomor_pendaftar']."','".$id['nama_kegiatan']."','".$id['id_kegiatan']."','".$id['no_bukti_sertifikat']."','".$id['sertifikat_kegiatan']."','".$id['keterangan']."',to_date('".$id['tanggal_selesai']."', 'dd/mm/yyyy'),to_date('".date($id['tanggal_mulai'])."', 'dd/mm/yyyy'),'".$id['nama_penyelenggara']."','".$id['keterangan_jenis']."')");
          
          if($data)
         {
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function data_difable_post()
    {

        $id=$this->input->post('INSERT_DIFABLE');

        $data=$this->db->query("SELECT * FROM insert_data_difable('".$id['nomor_pendaftar']."','".$id['id_kesehatan']."')");   
          if($data)
         {
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function batal_difable_post()
    {

        $id=$this->input->post('DELETE_DIFABLE');

        $data=$this->db->query("SELECT * FROM delete_data_difable('".$id['nomor_pendaftar']."','".$id['id_kesehatan']."')");   
          if($data)
         {
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function update_kesehatan_post()
    {

         $id=$this->input->post('UPDATE_RIWAYAT_SAKIT');

        $data=$this->db->query("SELECT * FROM update_riwayat_kesehatan('".$id['nomor_pendaftar']."','".$id['riwayat']."')");   
          if($data)
         {
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
        

    }


    function kontak_darurat_post()
    {
         $id=$this->input->post('KONTAK_DARURAT');
        
        $data=$this->db->query("SELECT * FROM update_kontak_darurat('".$id['nomor_pendaftar']."','".$id['nama_dihubungi']."','".$id['telp']."','".$id['hp']."','".$id['alamat']."','".$id['rt']."','".$id['rw']."','".$id['kelurahan']."','".$id['kode_provinsi']."','".$id['kode_kabupaten']."','".$id['kode_kecamatan']."','".$id['kode_negara']."','".$id['kode_pos']."','".$id['hubungan']."','".$id['keterangan_hubungan']."')");   
         if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
       

    }

    function hapus_prestasi_post()
    {
        $id=$this->input->post('HAPUS_PRESTASI');
        $data=$this->db->query("DELETE FROM prestasi_lomba_mahasiswa where id_prestasi='".$id['id_prestasi']."'");
        
          if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function insert_prestasi_post()
    {
        $id=$this->input->post('INSERT_PRESTASI');
        
        $data=$this->db->query("SELECT * FROM insert_prestasi_lomba_mahasiswa(
   '".$id['nomor_pendaftar']."',
    '".$id['nama_perlombaan']."',
    '".$id['juara_ke']."',
    '".$id['jenis_kompetisi']."',
    '".$id['tingkat_kejuaraan']."',
    '".$id['jenis_kejuaraan']."',
    '".$id['tahun_penghargaan']."',
    '".$id['nama_penyelenggara']."',
    to_date('".$id['tanggal_mulai']."','dd/mm/yyyy'),
    to_date('".$id['tanggal_selesai']."','dd/mm/yyyy'),
    '".$id['nomor_sertifikat']."',
    '".$id['sertifikat']."',
    '".$id['keterangan']."',
    '".$id['keterangan_jenis']."')");

          if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
       
    }

     function update_rumah_post()
    {
         $id=$this->input->post('UPDATE_RUMAH');
       
    $data=$this->db->query("SELECT * FROM update_data_rumah_tinggal_keluarga('".$id['nomor_pendaftar']."','".$id['id_kepemilikan']."','".$id['tahun_peroleh']."','".$id['id_sumber']."','".$id['daya_listrik']."','".$id['luas_tanah']."','".$id['luas_bangunan']."','".$id['njop']."','".$id['id_mck']."','".$id['id_sumber_air']."','".$id['id_bahan_atap']."','".$id['id_bahan_dinding']."','".$id['id_bahan_lantai']."','".$id['jarak_pusat_kota']."','".$id['jumlah_orang_tinggal']."','".$id['pbb']."','".$id['pln']."','".$id['pdam']."','".$id['telkom']."','".$id['internet']."','".$id['foto_rumah']."','".$id['bukti_pembayaran_pbb']."','".$id['bukti_pembayaran_pln']."','".$id['bukti_pembayaran_pdam']."','".$id['bukti_pembayaran_telkom']."','".$id['bukti_pembayaran_internet']."','".$id['ket_listrik']."','".$id['ket_air']."','".$id['ket_atap']."','".$id['ket_dinding']."','".$id['ket_lantai']."','".$id['ket_mck']."')");
   if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }

    }

    function update_wali_post()
    {

         $id=$this->input->post('UPDATE_WALI');
       
         $data=$this->db->query("SELECT * FROM update_data_wali(
           '".$id['nomor_pendaftar']."',
           '".$id['nama_wali']."',
           '".$id['alamat']."',
           '".$id['hp']."',
           '".$id['telp']."',
           '".$id['status_simpan_wali']."',
           '".$id['rt']."',
           '".$id['rw']."',
           '".$id['kelurahan']."',
           '".$id['kode_kecamatan']."',
           '".$id['kode_kabupaten']."',
           '".$id['kode_provinsi']."',
           '".$id['kode_pos']."',
           '".$id['status_wali']."',
           '".$id['id_agama']."',
           '".$id['id_jenjang']."',
           '".$id['id_pekerjaan']."',
           '".$id['email']."',
         to_date('".$id['tanggal_lahir']."','dd/mm/yyyy'),
         '".$id['tempat_lahir']."',
         '".$id['kode_negara']."',
         '".$id['golongan']."',
         '".$id['keterangan']."')");

              if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }

    function update_pend_s2_post()
    {
         $id=$this->input->post('UPDATE_PEND_S2');
            $data=$this->db->query("SELECT * FROM update_data_riwayat_pendidikan_s2('".$id['nomor_pendaftar']."','".$id['id_pendidikan']."','".$id['nama_pt']."','".$id['tahun_ijazah']."','".$id['ipk']."','".$id['pend_lain']."','".$id['status_simpan']."')");
        
          if($data)
         {
           
                $this->response(array('sukses'=>'berhasil'), 200); 
         }
         else
         {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
         }
    }
} 