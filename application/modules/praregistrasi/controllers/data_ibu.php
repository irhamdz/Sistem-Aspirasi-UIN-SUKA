<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class data_ibu extends CI_Controller {
	function __construct(){
        parent::__construct();       
        error_reporting(0);
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();	
		
    }
	function index(){
		$this->load->library('lib_reg_fungsi');		
		$step='1';
		$err='';
		//////////////
		$NISN=$this->lib_reg_fungsi->session_nisn();
        $NO_TEST=$this->lib_reg_fungsi->session_no_test();
        $NAMA=$this->lib_reg_fungsi->session_nama();
		//////////////////
		$judul_halaman="Data Ibu";
		//data mahasiswanya
		$data_mahasiswa	= json_decode($this->lib_reg_fungsi->get_data_siswa($NO_TEST),true);
		//data agama
		$data_agama=$this->lib_reg_fungsi->data_agama();
		//data pendidikan
		$data_pendidikan=$this->lib_reg_fungsi->data_pendidikan();
		//data pekerjaan
		$data_pekerjaan=$this->lib_reg_fungsi->data_pekerjaan();
		/////////////////
		$data['step']=$step;
		$TOMBOL['lokasi_selanjutnya']="data_bapak";
		$TOMBOL['lokasi_sebelumnya']="data_keluarga";
		//data di post
		$id_step_tujuan=$this->input->post('id_step_tujuan');
		if($id_step_tujuan){
			$NM_IBU_KANDUNG=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_IBU_KANDUNG'));
			$TMP_LAHIR_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('TMP_LAHIR_IBU'));
			$TGL_LAHIR_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('TGL_LAHIR_IBU'));
			$KD_AGAMA_IBU=$this->input->post('KD_AGAMA_IBU');
			$KD_PEND_IBU=$this->input->post('KD_PEND_IBU');
			$KERJA_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_IBU'));
			$ALAMAT_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('ALAMAT_IBU'));
			$RT_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('RT_IBU'));
			//RW IBU
			$RW_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('RW_IBU'));
			/////
			$DESA_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('DESA_IBU'));
			$KD_KEC_IBU=$this->input->post('KD_KEC_IBU');
			$NM_KEC_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_KEC_IBU'));
			$KD_KAB_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KAB_IBU'));
			$KD_PROP_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_PROP_IBU'));
			$KD_NEGARA_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_NEGARA_IBU'));
			$HP_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('HP_IBU'));
			$KODE_POS_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KODE_POS_IBU'));
			$TELP_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('TELP_IBU'));
			$EMAIL_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('EMAIL_IBU'));
			$KD_KERJA_IBU=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KERJA_IBU'));
			$KERJA_IBU_DETAIL=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_IBU_DETAIL'));
			if(empty($NM_IBU_KANDUNG)){
				$err=$err."<li>Silahkan masukkan nama Ibu anda.</li>";
			}
			if(empty($KERJA_IBU_DETAIL)){
				$err=$err."<li>Silahkan masukkan Pangkat/golongan/keterangan Pekerjaan Ibu anda.</li>";
			}
			if(empty($err)){
				$ARR_DATA_BARU=array(
					'NAMA'=>$NAMA,
					'NISN'=>$NISN,
					'NO_TEST'=>$NO_TEST,
					'NM_IBU_KANDUNG'=>$NM_IBU_KANDUNG,
					'TMP_LAHIR_IBU'=>$TMP_LAHIR_IBU,
					'TGL_LAHIR_IBU'=>$TGL_LAHIR_IBU,
					'KD_AGAMA_IBU'=>$KD_AGAMA_IBU,
					'KD_PEND_IBU'=>$KD_PEND_IBU,
					//'KERJA_IBU'=>$KERJA_IBU,
					'ALAMAT_IBU'=>$ALAMAT_IBU,					
					'RT_IBU'=>$RT_IBU,
					'RW_IBU'=>$RW_IBU,
					'DESA_IBU'=>$DESA_IBU,
					'NM_KEC_IBU'=>$NM_KEC_IBU,
					'KD_KAB_IBU'=>$KD_KAB_IBU,
					'KD_PROP_IBU'=>$KD_PROP_IBU,
					'KD_NEGARA_IBU'=>$KD_NEGARA_IBU,
					'KODE_POS_IBU'=>$KODE_POS_IBU,
					'TELP_IBU'=>$TELP_IBU,
					'HP_IBU'=>$HP_IBU,
					'EMAIL_IBU'=>$EMAIL_IBU,
					'KD_KERJA_IBU'=>$KD_KERJA_IBU,
					'KERJA_IBU_DETAIL'=>$KERJA_IBU_DETAIL
				);
				$update=$this->lib_reg_fungsi->post_data_global($ARR_DATA_BARU);
				//echo "updte isi $update";
				header("location:$id_step_tujuan");
			}
		}else{
			$NM_IBU_KANDUNG=$data_mahasiswa['NM_IBU_KANDUNG'];
			$TMP_LAHIR_IBU=$data_mahasiswa['TMP_LAHIR_IBU'];
			if($data_mahasiswa['TGL_LAHIR_IBUX']){
				$TGL_LAHIR_IBU=$data_mahasiswa['TGL_LAHIR_IBUX'];
			}else{
				$TGL_LAHIR_IBU='';
			}
			$KD_AGAMA_IBU=$data_mahasiswa['KD_AGAMA_IBU'];
			$KD_PEND_IBU=$data_mahasiswa['KD_PEND_IBU'];
			//$KERJA_IBU=$data_mahasiswa['KERJA_IBU'];
			$ALAMAT_IBU=$data_mahasiswa['ALAMAT_IBU'];
			$RT_IBU=$data_mahasiswa['RT_IBU'];
			//RW IBU
			$RW_IBU=$data_mahasiswa['RW_IBU'];
			////
			$DESA_IBU=$data_mahasiswa['DESA_IBU'];
			$NM_KEC_IBU=$data_mahasiswa['NM_KEC_IBU'];
			$KD_KAB_IBU=$data_mahasiswa['KD_KAB_IBU'];
			$KD_PROP_IBU=$data_mahasiswa['KD_PROP_IBU'];
			$KD_NEGARA_IBU=$data_mahasiswa['KD_NEGARA_IBU'];
			$KODE_POS_IBU=$data_mahasiswa['KODE_POS_IBU'];
			$TELP_IBU=$data_mahasiswa['TELP_IBU'];
			$HP_IBU=$data_mahasiswa['HP_IBU'];
			$EMAIL_IBU=$data_mahasiswa['EMAIL_IBU'];
			$KD_KERJA_IBU=$data_mahasiswa['KD_KERJA_IBU'];
			$KERJA_IBU_DETAIL=$data_mahasiswa['KERJA_IBU_DETAIL'];
		}
		//MASTER DATA
		$data['MASTER_DATA_AGAMA']=$data_agama;
		$data['MASTER_DATA_PENDIDIKAN']=$data_pendidikan;
		$data['MASTER_DATA_PEKERJAAN']=$data_pekerjaan;
		//isiannya
		$data['NM_IBU_KANDUNG']=$NM_IBU_KANDUNG;
		$data['TMP_LAHIR_IBU']=$TMP_LAHIR_IBU;
		$data['TGL_LAHIR_IBU']=$TGL_LAHIR_IBU;
		$data['KD_AGAMA_IBU']=$KD_AGAMA_IBU;
		$data['KD_PEND_IBU']=$KD_PEND_IBU;
		//$data['KERJA_IBU']=$KERJA_IBU;
		$data['ALAMAT_IBU']=$ALAMAT_IBU;
		$data['RT_IBU']=$RT_IBU;
		//RW IBU
		$data['RW_IBU']=$RW_IBU;
		///
		$data['DESA_IBU']=$DESA_IBU;
		$data['NM_KEC_IBU']=$NM_KEC_IBU;
		$data['KD_KAB_IBU']=$KD_KAB_IBU;
		$NM_KAB_ARR=$this->lib_reg_fungsi->data_kabupaten_detail($KD_KAB_IBU);
		$data['NM_KAB_IBU']=$NM_KAB_ARR['NM_KAB'];
		$data['KD_PROP_IBU']=$KD_PROP_IBU;
		$NM_PROP_ARR=$this->lib_reg_fungsi->data_PROPINSI_detail($KD_PROP_IBU);
		$data['NM_PROP_IBU']=$NM_PROP_ARR['NM_PROP'];
		$data['KD_NEGARA_IBU']=$KD_NEGARA_IBU;
		$data['KODE_POS_IBU']=$KODE_POS_IBU;
		$data['TELP_IBU']=$TELP_IBU;
		$data['EMAIL_IBU']=$EMAIL_IBU;
		$data['HP_IBU']=$HP_IBU;
		$data['KD_KERJA_IBU']=$KD_KERJA_IBU;
		$data['KERJA_IBU_DETAIL']=$KERJA_IBU_DETAIL;
		//HARUS ADA
		$TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
		$data['TOMBOL']=$TOMBOL;
		$data['judul_halaman']=$judul_halaman;
		$data['err']=$err;
		//$this->output99->output_display('praregistrasi/v_data_ibu', $data);			
		$data['content']='praregistrasi/v_data_ibu';
        $this->load->view('s00_vw_all', $data);
	}
}	
?>