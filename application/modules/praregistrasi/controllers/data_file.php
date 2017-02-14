<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		PRAREGISTRASI
 * @creator     Adi Wirawan
 * @created     21/05/2014
*/
class data_file extends CI_Controller {
	function __construct(){
        parent::__construct();  
        error_reporting(0);     
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();		
    }

     

    function oo(){
         $this->load->library('lib_reg_fungsi');
         $ARR_DATA_X=array(
            'no_test'=> '10310175',
            'kolom' => '2'
        );
        $x = $this->lib_reg_fungsi->get_uploaded_data($ARR_DATA_X);
        $data=json_decode($x,true);
        $file_isi = $data['file'];
        $file_nama = $data['file_nama'];
        if($file_nama){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file_nama));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            //header('Content-Length: ' . filesize($FILE));
            ob_clean();
            flush();
            echo base64_decode($file_isi);
            //readfile($file);
            exit;
        }else{
            echo "Thanks for landing captain! $FILE";
        }
    }

    function download(){
         $this->load->library('lib_reg_fungsi');
         $kolom = $this->input->get('kolom');
         //////////////////
         $NO_TEST=$this->lib_reg_fungsi->session_no_test();
         $ARR_DATA_X=array(
            'no_test'=> "$NO_TEST",
            'kolom' => "$kolom"
        );
        $x = $this->lib_reg_fungsi->get_uploaded_data($ARR_DATA_X);
        $data=json_decode($x,true);
        $file_isi = $data['file'];
        $file_nama = $data['file_nama'];
        if($file_nama){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file_nama));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            ob_clean();
            flush();
            echo base64_decode($file_isi);
            exit;
        }else{
            echo "Thanks for landing captain!";
        }
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
        ///////////////////////////
        /*$isi_file = base64_encode(file_get_contents('http://admisi.uin-suka.ac.id/praregistrasi_data/0000004219DOC_KK.jpg'));
        $ARR_DATA_X=array(
            'no_test'=> '10310175',
            'file_nama'=>'FILE_penghasilan_ibu.jpg',
            'file' => "$isi_file",
            'kolom' => '1'
        );
        $x = $this->lib_reg_fungsi->post_upload_data($ARR_DATA_X);
        $x = json_decode($x,true);
        */


        /////////////////////////
        $DOC_PENGHASILAN_IBU_HIDDEN='';
        $DOC_PENGHASILAN_BPK_HIDDEN='';
        $DOC_PENGHASILAN_WALI_HIDDEN='';
        $DOC_PBB_HIDDEN='';
        $DOC_REK_LISTRIK_HIDDEN='';
        $DOC_KK_HIDDEN='';
        $DOC_KARTU_MISKIN_HIDDEN='';
        $err='';
        //////////////////
        $id_step_tujuan=$this->input->post('id_step_tujuan');
        if($id_step_tujuan){
            //$err=1;
            //////////
            $DOC_PENGHASILAN_IBU_HIDDEN=$this->input->post('DOC_PENGHASILAN_IBU_HIDDEN');
            $AKSI_1=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_PENGHASILAN_IBU',"1");
            if(ereg("<li>",$AKSI_1)){
                $ERR_AKSI_1=$AKSI_1;               
                //$err=1;
            }else{
                $DOC_PENGHASILAN_IBU=$AKSI_1;
            }            
            if(empty($_FILES['DOC_PENGHASILAN_IBU']['name']) && empty($DOC_PENGHASILAN_IBU_HIDDEN)){
                //$err=1;
                $ERR_AKSI_1=$ERR_AKSI_1."<li>Silahkan melakukan upload Surat Penghasilan Ibu</li>";
            }            
            if($_FILES['DOC_PENGHASILAN_IBU']['name'] && empty($ERR_AKSI_1)){
                $sukses=$sukses."<li>File Penghasilan Ibu berhasil diupload.</li>";
            }
            //////////
            $DOC_PENGHASILAN_BPK_HIDDEN=$this->input->post('DOC_PENGHASILAN_BPK_HIDDEN');
            $AKSI_2=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_PENGHASILAN_BPK',"2");

            if(ereg("<li>",$AKSI_2)){
                $ERR_AKSI_2=$AKSI_2;
                //$err=1;
            }else{
                $DOC_PENGHASILAN_BPK=$AKSI_2;
            }
            if(empty($_FILES['DOC_PENGHASILAN_BPK']['name']) && empty($DOC_PENGHASILAN_BPK_HIDDEN)){
                //$err=1;
                $ERR_AKSI_2=$ERR_AKSI_2."<li>Silahkan melakukan upload Surat Penghasilan Bapak</li>";
            }
            
            if($_FILES['DOC_PENGHASILAN_BPK']['name'] && empty($ERR_AKSI_2)){
                $sukses=$sukses."<li>File Penghasilan Bapak berhasil diupload.</li>";
            }
            //////////pilihan
            $DOC_PENGHASILAN_WALI_HIDDEN=$this->input->post('DOC_PENGHASILAN_WALI_HIDDEN');
            $AKSI_3=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_PENGHASILAN_WALI',"3");
            if(ereg("<li>",$AKSI_3)){
                $ERR_AKSI_3=$AKSI_3;
                //$data['err_3']=$ERR_AKSI_3;
                //$err=1;
            }else{
                $DOC_PENGHASILAN_WALI=$AKSI_3;
            }
            if(empty($_FILES['DOC_PENGHASILAN_WALI']['name']) && empty($DOC_PENGHASILAN_WALI_HIDDEN)){
                //$err=1;
                $ERR_AKSI_3=$ERR_AKSI_3."<li>Silahkan melakukan upload Surat Penghasilan Wali</li>";
            }            
			if($ERR_AKSI_3 && $ERR_AKSI_2 && $ERR_AKSI_1){
				$data['err_global_penghasilan']='1';
			}
            if($_FILES['DOC_PENGHASILAN_WALI']['name'] && empty($ERR_AKSI_3)){
                $sukses=$sukses."<li>File Penghasilan Wali berhasil diupload.</li>";
            }
            //////////
            $DOC_PBB_HIDDEN=$this->input->post('DOC_PBB_HIDDEN');
            $AKSI_4=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_PBB',"4");
            if(ereg("<li>",$AKSI_4)){
                $ERR_AKSI_4=$AKSI_4;
                $data['err_4']=$ERR_AKSI_4;
                $err=1;
            }else{
                $DOC_PBB=$AKSI_4;
            }
            if(empty($_FILES['DOC_PBB']['name']) && empty($DOC_PBB_HIDDEN)){
                $err=1;
                $ERR_AKSI_4=$ERR_AKSI_4."<li>Silahkan melakukan upload Surat Bukti Pembayaran PBB</li>";
            }
           
            if($_FILES['DOC_PBB']['name'] && empty($ERR_AKSI_4)){
                $sukses=$sukses."<li>File PBB berhasil diupload.</li>";
            }
            ///////////////////
            $DOC_REK_LISTRIK_HIDDEN=$this->input->post('DOC_REK_LISTRIK_HIDDEN');
            $AKSI_5=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_REK_LISTRIK',"5");
            if(ereg("<li>",$AKSI_5)){
                $ERR_AKSI_5=$AKSI_5;
                $data['err_5']=$ERR_AKSI_5;
                $err=1;
            }else{
                $DOC_REK_LISTRIK=$AKSI_5;
            }
            if(empty($_FILES['DOC_REK_LISTRIK']['name']) && empty($DOC_REK_LISTRIK_HIDDEN)){
                $err=1;
                $ERR_AKSI_5=$ERR_AKSI_5."<li>Silahkan melakukan upload Pembayaran Rekening Listrik</li>";
            }
            
            if($_FILES['DOC_REK_LISTRIK']['name'] && empty($ERR_AKSI_5)){
                $sukses=$sukses."<li>File Pembayaran Rekening Listrik berhasil diupload.</li>";
            }
            ///////////
            $DOC_KK_HIDDEN=$this->input->post('DOC_KK_HIDDEN');
            $AKSI_6=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_KK',"6");
            if(ereg("<li>",$AKSI_6)){
                $ERR_AKSI_6=$AKSI_6;
                $data['err_6']=$ERR_AKSI_6;
                $err=1;
            }else{
                $DOC_KK=$AKSI_6;
            }
            if(empty($_FILES['DOC_KK']['name']) && empty($DOC_KK_HIDDEN)){
                $err=1;
                $ERR_AKSI_6=$ERR_AKSI_6."<li>Silahkan melakukan upload Kartu keluarga</li>";
            }
           
            if($_FILES['DOC_KK']['name'] && empty($ERR_AKSI_6)){
                $sukses=$sukses."<li>File Kartu keluarga berhasil diupload.</li>";
            }
            ////////////////pilihan
            $DOC_KARTU_MISKIN_HIDDEN=$this->input->post('DOC_KARTU_MISKIN_HIDDEN');
            $AKSI_7=$this->lib_reg_fungsi->dokumen_upload_service($NO_TEST,'DOC_KARTU_MISKIN',"7");
            if(ereg("<li>",$AKSI_7)){
                $ERR_AKSI_7=$AKSI_7;

               // $data['err_7']=$ERR_AKSI_7;
               // $err=1;
            }else{
                $DOC_KARTU_MISKIN=$AKSI_7;
            }
            if(empty($_FILES['DOC_KARTU_MISKIN']['name']) && empty($DOC_KARTU_MISKIN_HIDDEN)){
               // $err=1;
               // $ERR_AKSI_7=$ERR_AKSI_7."<li>Silahkan melakukan upload Surat Keterangan Tidak Mampu / Kartu miskin</li>";
            }
            
            if($_FILES['DOC_KARTU_MISKIN']['name'] && empty($ERR_AKSI_7)){
                $sukses=$sukses."<li>File Kartu Miskin berhasil diupload.</li>";
            }
            ////////////////
            //////////////////////////////
            if(empty($err)){
                
                ////////////////////////////
                $ARR_DATA=array(
                    'NAMA'=>$NAMA,
                    'NISN'=>$NISN,
                    'NO_TEST' => $NO_TEST,
                    'DOC_PENGHASILAN_IBU'=>$DOC_PENGHASILAN_IBU,
                    'DOC_PENGHASILAN_BPK'=>$DOC_PENGHASILAN_BPK,
                    'DOC_PENGHASILAN_WALI'=>$DOC_PENGHASILAN_WALI,
                    'DOC_PBB'=>$DOC_PBB,
                    'DOC_REK_LISTRIK'=>$DOC_REK_LISTRIK,
                    'DOC_KK'=>$DOC_KK,
                    'DOC_KARTU_MISKIN'=>$DOC_KARTU_MISKIN
                );
                //print_r($ARR_DATA);
                $update=$this->lib_reg_fungsi->post_data_global($ARR_DATA);
                header("location:$id_step_tujuan");
            }
        }else{
            $DOC_PENGHASILAN_IBU_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_IBU'];  
            $DOC_PENGHASILAN_BPK_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_BPK'];  
            $DOC_PENGHASILAN_WALI_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_WALI'];  
            $DOC_PBB_HIDDEN=$data_mahasiswa['DOC_PBB'];       
            $DOC_REK_LISTRIK_HIDDEN=$data_mahasiswa['DOC_REK_LISTRIK'];   
            $DOC_KK_HIDDEN=$data_mahasiswa['DOC_KK'];  
            $DOC_KARTU_MISKIN_HIDDEN=$data_mahasiswa['DOC_KARTU_MISKIN'];
                  
        }
        //////////////////
        $data_mahasiswa = json_decode($this->lib_reg_fungsi->get_data_siswa($NO_TEST),true);
        $DOC_PENGHASILAN_IBU_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_IBU'];
        $DOC_PENGHASILAN_BPK_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_BPK'];
        $DOC_PENGHASILAN_WALI_HIDDEN=$data_mahasiswa['DOC_PENGHASILAN_WALI'];
        $DOC_PBB_HIDDEN=$data_mahasiswa['DOC_PBB'];
        $DOC_REK_LISTRIK_HIDDEN=$data_mahasiswa['DOC_REK_LISTRIK'];
        $DOC_KK_HIDDEN=$data_mahasiswa['DOC_KK'];
        $DOC_KARTU_MISKIN_HIDDEN=$data_mahasiswa['DOC_KARTU_MISKIN'];
        //////////////////
        $data['judul_halaman']="Data File";
        $data['DOC_PENGHASILAN_IBU_HIDDEN']=$DOC_PENGHASILAN_IBU_HIDDEN;
        $data['DOC_PENGHASILAN_BPK_HIDDEN']=$DOC_PENGHASILAN_BPK_HIDDEN;
        $data['DOC_PENGHASILAN_WALI_HIDDEN']=$DOC_PENGHASILAN_WALI_HIDDEN;
        $data['DOC_PBB_HIDDEN']=$DOC_PBB_HIDDEN;
        $data['DOC_REK_LISTRIK_HIDDEN']=$DOC_REK_LISTRIK_HIDDEN;
        $data['DOC_KK_HIDDEN']=$DOC_KK_HIDDEN;
        $data['DOC_KARTU_MISKIN_HIDDEN']=$DOC_KARTU_MISKIN_HIDDEN;
        $data['err']=$err;
        $data['sukses']=$sukses;
        //////////////////
        $data['err_1']=$ERR_AKSI_1;
        $data['err_2']=$ERR_AKSI_2;
        $data['err_3']=$ERR_AKSI_3;
        $data['err_4']=$ERR_AKSI_4;
        $data['err_5']=$ERR_AKSI_5;
        $data['err_6']=$ERR_AKSI_6;
        $data['err_7']=$ERR_AKSI_7;
        ///////////////////
        $TOMBOL['lokasi_selanjutnya']="";
        $TOMBOL['lokasi_sebelumnya']="data_fisik";
        $TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
        $data['TOMBOL']=$TOMBOL;
    	//$this->output99->output_display('praregistrasi/v_data_file', $data);
        $data['content']='praregistrasi/v_data_file';
        $this->load->view('s00_vw_all', $data);
    }
}