<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		PRAREGISTRASI
 * @creator     Adi Wirawan
 * @created     21/05/2014
*/
class data_keluarga extends CI_Controller {
	function __construct(){
        parent::__construct();    
        error_reporting(0);   
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();		
    }
    function index(){
        $this->load->library('lib_reg_fungsi');
    	$api_url 	= URL_API_ADMISI.'admisi_pengumuman/data_view';
		$parameter  = array('api_kode' => 88001, 'api_subkode' => 4, 'api_search' => array());
		$data['liputan'] = $this->s00_lib_api->get_api_json($api_url,'POST',$parameter);
        //////////////////////////////////////////
        $NISN=$this->lib_reg_fungsi->session_nisn();
        $NO_TEST=$this->lib_reg_fungsi->session_no_test();
        $NAMA=$this->lib_reg_fungsi->session_nama();
        ////////////////////////
        $data_mahasiswa = json_decode($this->lib_reg_fungsi->get_data_siswa($NO_TEST),true);
       
        $ANAK_KE='';
        $JUM_SAUDARA='';
        $JUM_TANGGUNGAN='';
        $GAJI_IBU='';
        $GAJI_BAPAK='';
        $GAJI_WALI='';
        $STATUS_KAWIN='';
        $NM_PASANGAN='';
        $KETERANGAN='';
        $err='';
        //////////////////
        $id_step_tujuan=$this->input->post('id_step_tujuan');
        if($id_step_tujuan){
            $ANAK_KE=$this->lib_reg_fungsi->bersihkan($this->input->post('ANAK_KE'));
            $JUM_SAUDARA=$this->lib_reg_fungsi->bersihkan($this->input->post('JUM_SAUDARA'));
            $JUM_TANGGUNGAN=$this->lib_reg_fungsi->bersihkan($this->input->post('JUM_TANGGUNGAN'));
            $GAJI_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('GAJI_IBU'));
            $GAJI_BAPAK=$this->lib_reg_fungsi->bersihkan($this->input->post('GAJI_BAPAK'));
            $GAJI_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('GAJI_WALI'));
            $STATUS_KAWIN=$this->lib_reg_fungsi->bersihkan($this->input->post('STATUS_KAWIN'));
            $NM_PASANGAN=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_PASANGAN'));
            $KETERANGAN=$this->lib_reg_fungsi->bersihkan($this->input->post('KETERANGAN'));
            ///////////////////////////
            $ANAK_KE=trim($ANAK_KE);
            if($ANAK_KE!='0' and $ANAK_KE<1){
                $err=$err."<li>Silahkan isikan urutan anda anak ke berapa</li>";
            }
            $JUM_SAUDARA=trim($JUM_SAUDARA);
            if($JUM_SAUDARA!='0' and $JUM_SAUDARA<1){
                $err=$err."<li>Silahkan masukkan jumlah saudara yang anda miliki</li>";
            }
            $JUM_TANGGUNGAN=trim($JUM_TANGGUNGAN);
            if($JUM_TANGGUNGAN!='0' and $JUM_TANGGUNGAN<1){
                $err=$err."<li>Silahkan masukkan jumlah tanggungan keluarga anda</li>";
            }
            $GAJI_IBU=trim($GAJI_IBU);
            if($GAJI_IBU!='0' and $GAJI_IBU<1){
                $err=$err."<li>Silahkan masukkan Gaji Ibu (jika tidak ada diisi <b>0</b>).</li>";
            }
            $GAJI_NAPAK=trim($GAJI_BAPAK);
            if($GAJI_BAPAK!='0' and $GAJI_BAPAK<1){
                $err=$err."<li>Silahkan masukkan Gaji Bapak (jika tidak ada diisi <b>0</b>).</li>";
            }
            $GAJI_WALI=trim($GAJI_WALI);
            if($GAJI_WALI!='0' and $GAJI_WALI<1){
                $err=$err."<li>Silahkan masukkan Gaji Wali (jika tidak ada diisi <b>0</b>).</li>";
            }
            if($STATUS_KAWIN=='K' and (empty($NM_PASANGAN) or strlen($NM_PASANGAN)<=3)){                
                if(strlen($NM_PASANGAN)<=3){
                    $err=$err."<li>Silahkan pastikan Nama Pasangan anda lebih dari 3 karakter jika status pernikahan anda adalah Kawin</li>";
                }
            }
            if($STATUS_KAWIN=='B'){
                $NM_PASANGAN='';
            }
            //////////////////////////////
            if(empty($err)){
                ////////////////////////////
                $ARR_DATA=array(
                    'NAMA'=>$NAMA,
                    'NISN'=>$NISN,
                    'NO_TEST'=>$NO_TEST,
                    'NO_TEST'=>$NO_TEST,
                    'ANAK_KE'=>$ANAK_KE,
                    'JUM_SAUDARA'=>$JUM_SAUDARA,
                    'JUM_TANGGUNGAN'=>$JUM_TANGGUNGAN,
                    'GAJI_IBU'=>$GAJI_IBU,
                    'GAJI_BAPAK'=>$GAJI_BAPAK,
                    'GAJI_WALI'=>$GAJI_WALI,
                    'STATUS_KAWIN'=>$STATUS_KAWIN,
                    'NM_PASANGAN'=>$NM_PASANGAN,
                    'KETERANGAN'=>$KETERANGAN
                );
                $update=$this->lib_reg_fungsi->post_data_global($ARR_DATA);
                //echo "isi $update";
                header("location:$id_step_tujuan");
            }
        }else{
            $ANAK_KE=$data_mahasiswa['ANAK_KE'];  
            $JUM_SAUDARA=$data_mahasiswa['JUM_SAUDARA'];  
            $JUM_TANGGUNGAN=$data_mahasiswa['JUM_TANGGUNGAN'];  
            $GAJI_IBU=$data_mahasiswa['GAJI_IBU'];   
            $GAJI_BAPAK=$data_mahasiswa['GAJI_BAPAK'];      
            $GAJI_WALI=$data_mahasiswa['GAJI_WALI'];   
            $STATUS_KAWIN=$data_mahasiswa['STATUS_KAWIN'];  
            $NM_PASANGAN=$data_mahasiswa['NM_PASANGAN'];   
            $KETERANGAN=$data_mahasiswa['KETERANGAN'];       
        }
        //////////////////
        $data['judul_halaman']="Data Keluarga";
        $data['ANAK_KE']=$ANAK_KE;
        $data['JUM_SAUDARA']=$JUM_SAUDARA;
        $data['JUM_TANGGUNGAN']=$JUM_TANGGUNGAN;
        $data['GAJI_IBU']=$GAJI_IBU;
        $data['GAJI_BAPAK']=$GAJI_BAPAK;
        $data['GAJI_WALI']=$GAJI_WALI;
        $data['STATUS_KAWIN']=$STATUS_KAWIN;
        $data['NM_PASANGAN']=$NM_PASANGAN;
        $data['KETERANGAN']=$KETERANGAN;
        $data['err']=$err;
        ///////////////////
        $TOMBOL['lokasi_selanjutnya']="data_ibu";
        $TOMBOL['lokasi_sebelumnya']="";
        $TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
        $data['TOMBOL']=$TOMBOL;
    	//$this->output99->output_display('praregistrasi/v_data_keluarga', $data);
        $data['content']='praregistrasi/v_data_keluarga';
        $this->load->view('s00_vw_all', $data);
    }
}