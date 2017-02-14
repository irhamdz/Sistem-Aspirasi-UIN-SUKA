<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		PRAREGISTRASI
 * @creator     Adi Wirawan
 * @created     21/05/2014
*/
class data_fisik extends CI_Controller {
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
		$data['liputan'] = $this->s00_lib_api->get_api_jsob($api_url,'POST',$parameter);
        //////////////////////////////////////////
        $NISN=$this->lib_reg_fungsi->session_nisn();
        $NO_TEST=$this->lib_reg_fungsi->session_no_test();
        $NAMA=$this->lib_reg_fungsi->session_nama();
        $data_mahasiswa = json_decode($this->lib_reg_fungsi->get_data_siswa($NO_TEST),true);
        /////////////////////////
        $JUM_KENDARAAN_RODA2='';
        $JUM_KENDARAAN_RODA4='';
        $LUAS_TANAH_ORTU='';
        $DAYA_LISTRIK_ORTU='';
        $PEMBAYARAN_PBB_AKHIR='';
        $PEMBAYARAN_LISTRIK_AKHIR='';
        $err='';
        //////////////////
        $id_step_tujuan=$this->input->post('id_step_tujuan');
        if($id_step_tujuan){
            $JUM_KENDARAAN_RODA2=$this->lib_reg_fungsi->bersihkan($this->input->post('JUM_KENDARAAN_RODA2'));
            $JUM_KENDARAAN_RODA4=$this->lib_reg_fungsi->bersihkan($this->input->post('JUM_KENDARAAN_RODA4'));
            $LUAS_TANAH_ORTU=$this->lib_reg_fungsi->bersihkan($this->input->post('LUAS_TANAH_ORTU'));
            $DAYA_LISTRIK_ORTU=$this->lib_reg_fungsi->bersihkan($this->input->post('DAYA_LISTRIK_ORTU'));
            $PEMBAYARAN_PBB_AKHIR=$this->lib_reg_fungsi->bersihkan($this->input->post('PEMBAYARAN_PBB_AKHIR'));
            $PEMBAYARAN_LISTRIK_AKHIR=$this->lib_reg_fungsi->bersihkan($this->input->post('PEMBAYARAN_LISTRIK_AKHIR'));
            ///////////////////////////
            $JUM_KENDARAAN_RODA2=trim($JUM_KENDARAAN_RODA2);
            if($JUM_KENDARAAN_RODA2!='0' and $JUM_KENDARAAN_RODA2<1){
                $err=$err."<li>Silahkan isikan jumlah kendaraan roda 2 yang dimiliki Ibu, Bapak atau wali</li>";
            }
            $JUM_KENDARAAN_RODA4=trim($JUM_KENDARAAN_RODA4);
            if($JUM_KENDARAAN_RODA4!='0' and $JUM_KENDARAAN_RODA4<1){
                $err=$err."<li>Silahkan isikan jumlah kendaraan roda 4 yang dimiliki Ibu, Bapak atau wali</li>";
            }
            $LUAS_TANAH_ORTU=trim($LUAS_TANAH_ORTU);
            if($LUAS_TANAH_ORTU!='0' and $LUAS_TANAH_ORTU<1){
                $err=$err."<li>Silahkan isikan Luas total tanah yang dimiliki Ibu, Bapak atau wali</li>";
            }
            $DAYA_LISTRIK_ORTU=trim($DAYA_LISTRIK_ORTU);
            if($DAYA_LISTRIK_ORTU!='0' and $DAYA_LISTRIK_ORTU<1){
                $err=$err."<li>Silahkan isikan total daya listrik yang dilanggan di rumah Ibu, Bapak atau wali</li>";
            }
            $PEMBAYARAN_PBB_AKHIR=trim($PEMBAYARAN_PBB_AKHIR);
            if($PEMBAYARAN_PBB_AKHIR!='0' and $PEMBAYARAN_PBB_AKHIR<1){
                $err=$err."<li>Silahkan isikan total pembayaran PBB terakhir</li>";
            }
            $PEMBAYARAN_LISTRIK_AKHIR=trim($PEMBAYARAN_LISTRIK_AKHIR);
            if($PEMBAYARAN_LISTRIK_AKHIR!='0' and $PEMBAYARAN_LISTRIK_AKHIR<1){
                $err=$err."<li>Silahkan isikan total pembayaran Listrik terakhir</li>";
            }
            //////////////////////////////
            if(empty($err)){
                ////////////////////////////
                $ARR_DATA=array(
                    'NAMA'=>$NAMA,
                    'NISN'=>$NISN,
                    'NO_TEST'=>$NO_TEST,
                    'JUM_KENDARAAN_RODA2'=>$JUM_KENDARAAN_RODA2,
                    'JUM_KENDARAAN_RODA4'=>$JUM_KENDARAAN_RODA4,
                    'LUAS_TANAH_ORTU'=>$LUAS_TANAH_ORTU,
                    'DAYA_LISTRIK_ORTU'=>$DAYA_LISTRIK_ORTU,
                    'PEMBAYARAN_PBB_AKHIR'=>$PEMBAYARAN_PBB_AKHIR,
                    'PEMBAYARAN_LISTRIK_AKHIR'=>$PEMBAYARAN_LISTRIK_AKHIR
                );
                $update=$this->lib_reg_fungsi->post_data_global($ARR_DATA);
                header("location:$id_step_tujuan");
            }
        }else{
            $JUM_KENDARAAN_RODA2=$data_mahasiswa['JUM_KENDARAAN_RODA2'];  
            $JUM_KENDARAAN_RODA4=$data_mahasiswa['JUM_KENDARAAN_RODA4'];  
            $LUAS_TANAH_ORTU=$data_mahasiswa['LUAS_TANAH_ORTU'];  
            $DAYA_LISTRIK_ORTU=$data_mahasiswa['DAYA_LISTRIK_ORTU'];       
            $PEMBAYARAN_PBB_AKHIR=$data_mahasiswa['PEMBAYARAN_PBB_AKHIR'];   
            $PEMBAYARAN_LISTRIK_AKHIR=$data_mahasiswa['PEMBAYARAN_LISTRIK_AKHIR'];  
                  
        }
        //////////////////
        $data['judul_halaman']="Data Fisik";
        $data['JUM_KENDARAAN_RODA2']=$JUM_KENDARAAN_RODA2;
        $data['JUM_KENDARAAN_RODA4']=$JUM_KENDARAAN_RODA4;
        $data['LUAS_TANAH_ORTU']=$LUAS_TANAH_ORTU;
        $data['DAYA_LISTRIK_ORTU']=$DAYA_LISTRIK_ORTU;
        $data['PEMBAYARAN_PBB_AKHIR']=$PEMBAYARAN_PBB_AKHIR;
        $data['PEMBAYARAN_LISTRIK_AKHIR']=$PEMBAYARAN_LISTRIK_AKHIR;
        $data['err']=$err;
        ///////////////////
        $TOMBOL['lokasi_selanjutnya']="data_file";
        $TOMBOL['lokasi_sebelumnya']="data_wali";
        $TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
        $data['TOMBOL']=$TOMBOL;
    	//$this->output99->output_display('praregistrasi/v_data_fisik', $data);
        $data['content']='praregistrasi/v_data_fisik';
        $this->load->view('s00_vw_all', $data);
    }
}