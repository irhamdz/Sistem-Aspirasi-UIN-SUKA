<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Input_data extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
    
    }
    
    function index()
    {
        
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

    function insert_nomor_pendaftar_post()
    {
    	$id=$this->input->post('NO_PENDAFTAR');

	    $cek=$this->db->query("SELECT count(*) as ada from data_diri_pendaftar where nomor_pendaftar='".$id['nomor_pendaftar']."'")->result();

	   foreach ($cek as $jml)
       {
        $val=$jml->ada;
       }
	   if($val==0)
	   {
	   		 $data=$this->db->query("SELECT * FROM insert_nomor_pendaftar('".$id['nomor_pendaftar']."')");

				if($data)
				{
					$this->response(array('message'=>'SUCCESS'), 200);   
				}
				else
				{
					$this->response(array('error' => 'Data tidak ditemukan'), 404);
				}
	   }
	   else
	   {
	   		if($cek)
				{
					$this->response(array('message'=>'SUCCESS'), 200);   
				}
				else
				{
					$this->response(array('error' => 'Data tidak ditemukan'), 404);
				}

	   }
	    /*
       
        
        */
    }

    function data_mhs_post()
    {
        $id=$this->input->post('DATA_MHS');

        $data=$this->db->query("SELECT * FROM view_presensi WHERE kode_jalur='".$id['kode_jalur']."' order by nama_ruang asc ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function presensi_post()
    {
        $id=$this->input->post('PRESENSI');

        $data=$this->db->query("SELECT * FROM view_presensi WHERE kode_jalur='".$id['kode_jalur']."' and id_ruang='".$id['id_ruang']."' and kode_jadwal='".$id['kode_jadwal']."' order by nama_ruang asc ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    
     function detail_penawaran_prodi_post()
    {
        $id=$this->input->post('DETAIL_PRODI');

        $data=$this->db->query("SELECT * FROM view_penawaran_jurusan WHERE kode_jalur='".$id['kode_jalur']."' order by nama_prodi asc ")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }


    function grup_ruang_ujian_post()
    {
        $data=$this->db->query('SELECT * FROM view_grup_ruang_ujian order by nama_ruang asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function data_penawaran_prodi_jalur_post()
    {
        $id=$this->input->post('CEK_JURUSAN');

        $data=$this->db->query("SELECT * FROM view_penawaran_jurusan where kode_penawaran='".$id['kode_penawaran']."' order by kode_jalur asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function data_penawaran_prodi_post()
    {
        $data=$this->db->query('SELECT * FROM view_penawaran_jurusan order by kode_jalur asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function data_program_studi_post()
    {
        $data=$this->db->query('SELECT * FROM program_studi order by id_prodi asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function update_kode_bayar_post()
    {
        $id=$this->input->post('UPDATE_BAYAR');

        $data=$this->db->query("SELECT * from update_kode_bayar('".$id['kode_bayar1']."','".$id['kode_bayar2']."','".$id['nama_pembayaran']."')");
    
        if($data)
        {
            $this->response(array('SUCCESS' => 'Berhasil'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function data_kode_pembayaran_post()
    {
    	$data=$this->db->query('SELECT * FROM kode_pembayaran order by kode_bayar asc')->result();
    	if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function detail_kode_pembayaran_post()
    {
         $id=$this->input->post('DETAIL_BAYAR');

        $data=$this->db->query("SELECT * FROM kode_pembayaran where kode_bayar ='".$id['kode_bayar']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

	function jalur_post()
    {
    	$data=$this->db->query('SELECT * FROM jalur order by kode_jalur asc')->result();
    	if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function view_prodi_post()
    {
        $data=$this->db->query('SELECT * FROM view_prodi order by id_fakultas asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function minat_post()
    {
    	$data=$this->db->query('SELECT * FROM minat order by kode_minat asc')->result();
    	if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
	
    function ruang_post()
    {
        $data=$this->db->query('SELECT * FROM view_ruang_gedung order by id_gedung asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function ruang_ujian_post()
    {
        $data=$this->db->query('SELECT * FROM view_ruang_ujian order by id_urut_gedung asc')->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function detail_ruang_post()
    {

        $id=$this->input->post('DETAIL_RUANG');
        $data=$this->db->query("SELECT * FROM ruang WHERE id_gedung='".$id['id_gedung']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

     function data_gelombang_jalur_post()
   {
        $data=$this->db->query("SELECT gelombang FROM view_penawaran_jalur order by kode_jalur asc ")->result(); 
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

   function cek_minat_prodi_post()
   {
        $id=$this->input->post('CEK_MINAT');
        $data=$this->db->query("SELECT * FROM penawaran_minat where kode_penawaran='".$id['kode_penawaran']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

   function data_penawaran_jalur_cek_get()
   {
        $data=$this->db->query("SELECT * FROM view_penawaran_jalur_all order by kode_jalur asc ")->result(); 
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

   function data_penawaran_jalur_post()
   {
        $data=$this->db->query("SELECT * FROM view_penawaran_jalur order by kode_jalur asc ")->result(); 
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

    function data_penawaran_jalur_all_post()
   {
        $data=$this->db->query("SELECT * FROM view_penawaran_jalur_all")->result(); 
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

    function detail_boleh_datar_post()
   {
        
        $id=$this->input->post('DETAIL_BAYAR');
        $kode=$id['kode_bayar'];
        $tgl=$id['tanggal_bayar'];
        
       $data=$this->db->query("SELECT * FROM view_penawaran_jalur where kode_bayar='$kode' and '$tgl' between (select tanggal_mulai_bayar from view_penawaran_jalur where kode_bayar='$kode') and (select tanggal_selesai_bayar from view_penawaran_jalur where kode_bayar='$kode')")->result(); 
      
        if($data)
        {
            $this->response($data, 200); 

        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

    function detail_penawaran_jalur_post()
   {
        
        $id=$this->input->post('DETAIL_BAYAR');
        
       $data=$this->db->query("SELECT * FROM view_penawaran_jalur where kode_bayar='".$id['kode_bayar']."'")->result(); 
      
        if($data)
        {
            $this->response($data, 200); 

        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
   }

    function gedung_post()
    {
    	$data=$this->db->query("SELECT * FROM gedung where status_gedung ='1' order by id_gedung asc")->result();
    	if($data){
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }


    function jadwal_ujian_post()
    {
        $data=$this->db->query("SELECT * FROM view_jadwal_penawaran order by tanggal_ujian asc")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function detail_jadwal_ujian_post()
    {

        $id=$this->input->post('DETAIL_JADWAL_UJIAN');
        $data=$this->db->query("SELECT * FROM view_jadwal_penawaran where kode_jalur='".$id['kode_jalur']."'")->result();
        if($data)
        {
            $this->response($data, 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }


    function insert_kode_pembayaran_post()
    { 
    	ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
   		$data=$this->db->query("SELECT * FROM insert_pembayaran('".$insert_data['kode_bayar']."','".$insert_data['nama_pembayaran']."')");
        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
		
    }

    function delete_penawaran_prodi_post()
    { 
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("DELETE FROM penawaran_jurusan where kode_penawaran='".$id['kode_penawaran']."' and id_prodi='".$id['id_prodi']."' and kode_minat='".$id['kode_minat']."' ");

         if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
        
    }

     function insert_penawaran_prodi_post()
    { 
        ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
        $data=$this->db->query("SELECT * FROM insert_penawaran_jurusan('".$insert_data['kode_penawaran']."','".$insert_data['id_prodi']."','".$insert_data['kode_minat']."')");
        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
        
    }

	function insert_penawaran_jalur_post()
    { 
    	ini_set('display_errors', 1);
        $insert_data=$this->input->post('INSERT_DATA');

        //to_timestamp('30/12/2011 00:30:00', 'DD/MM/YYYY HH24:MI:SS')::timestamp without time zone
        
        $mulai_daftar="to_timestamp('".$insert_data['tanggal_mulai_daftar']."', 'DD/MM/YYYY HH24:MI:SS')::timestamp without time zone";
        $mulai_bayar="to_timestamp('".$insert_data['tanggal_mulai_bayar']."', 'DD/MM/YYYY HH24:MI:SS')::timestamp without time zone";
                    
        $selesai_daftar="to_timestamp('".$insert_data['tanggal_selesai_daftar']."', 'DD/MM/YYYY HH24:MI:SS')::timestamp without time zone";
        $selesai_bayar="to_timestamp('".$insert_data['tanggal_selesai_bayar']."', 'DD/MM/YYYY HH24:MI:SS')::timestamp without time zone";

        $min=(array)$insert_data['minat'];
        $jml=(array)$insert_data['jumlah'];       

   		$data=$this->db->query("SELECT * FROM insert_penawaran_jalur('".$insert_data['kode_jalur']."','".$insert_data['tahun']."',".$mulai_daftar.",".$selesai_daftar.",".$mulai_bayar.",".$selesai_bayar.",'".$insert_data['kode_bayar']."','".$insert_data['gelombang']."')");
        
        $data=$insert_data;
        $kode_penawaran=$insert_data['kode_jalur'].$insert_data['gelombang'].$insert_data['tahun'];
        if($data)
        {

             for($i=0; $i<count($jml); $i++)
            {

              $minat=$this->db->query("SELECT * FROM insert_penawaran_minat('".$min[$i]."','".$kode_penawaran."','".$jml[$i]."')");

            }
            

                
           
        }
        else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }

        
     
                
            
		
    }

    function insert_ruang_post()
    {
    	ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
        
        $data=$this->db->query("SELECT * FROM insert_ruang('".$insert_data['id_ruang']."','".$insert_data['id_gedung']."','".$insert_data['nama_ruang']."','".$insert_data['status_ruang']."')");
       
        if($data){
           $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function insert_ruang_ujian_post()
    {
        ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
        
        $data=$this->db->query("SELECT * FROM insert_ruang_ujian('".$insert_data['id_ruang']."','".$insert_data['id_urut_gedung']."','".$insert_data['kapasitas_ruang']."','".$insert_data['no_ujian_awal']."','".$insert_data['no_ujian_akhir']."','".$insert_data['kode_jalur']."','".$insert_data['status_ruang_ujian']."','".$insert_data['tahun_ruang_ujian']."','".$insert_data['kode_jadwal']."')");
       
        if($data){

            $head=$insert_data['nomor_peserta'];

            for($i=$insert_data['no_ujian_awal']; $i<=$insert_data['no_ujian_akhir']; $i++)
            {

                $no=$head.str_pad($i, 5, "0", STR_PAD_LEFT);  
                $this->db->query("INSERT INTO nomor_peserta_ujian values('".$insert_data['id_ruang']."','".$no."','".$insert_data['kode_jalur']."')");

            }

            
        $this->response(array('message'=>'SUCCESS'), 200); 
                
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

	function insert_jadwal_ujian_post()
    {
    	ini_set('display_errors', 1);

        $insert_data=$this->input->post('INSERT_DATA');
       
        $data=$this->db->query("SELECT * FROM insert_jadwal_ujian('".$insert_data['hari']."',to_date('".($insert_data['tanggal_ujian'])."','dd/mm/yyyy'),'".$insert_data['lokasi_ujian']."','".$insert_data['jam_mulai_ujian']."','".$insert_data['jam_selesai_ujian']."','".$insert_data['kode_penawaran']."',to_date('".($insert_data['pengumuman'])."','dd/mm/yyyy'))");
        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
        
    }

    function delete_penawaran_jalur_post()
    {
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("SELECT * FROM delete_penawaran_jalur('".$id['kode_penawaran']."')");

        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function delete_ruang_post()
    {
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("SELECT * FROM delete_ruang('".$id['id_ruang']."')");

        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function delete_jadwal_ujian_post()
    {
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("SELECT * FROM delete_jadwal_ujian('".$id['kode_jadwal']."')");

        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function delete_kode_pembayaran_post()
    {
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("SELECT * FROM delete_kode_pembayaran('".$id['kode_bayar']."')");

        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function delete_ruang_ujian_post()
    {
        ini_set('display_errors', 1);

        $id=$this->input->post('HAPUS_DATA');
       
        $data=$this->db->query("SELECT * FROM delete_ruang_ujian('".$id['id_ruang_ujian']."')");

        if($data){
            $this->response(array('message'=>'SUCCESS'), 200); 
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
}