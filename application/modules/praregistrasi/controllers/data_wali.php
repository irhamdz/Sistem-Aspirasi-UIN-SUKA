<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class data_wali extends CI_Controller {

	function __construct(){
        parent::__construct();       
        error_reporting(0);
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();	
		
    }
    function xxyyzz(){
    	
    }
	function index(){
		$this->load->library('lib_reg_fungsi');
		$this->output=$this->s00_lib_output;
		$step='1';
		$err='';
		$judul_halaman="Data Wali";
		//data mahasiswanya
		$NISN=$this->lib_reg_fungsi->session_nisn();
        $NO_TEST=$this->lib_reg_fungsi->session_no_test();
        $NAMA=$this->lib_reg_fungsi->session_nama();
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
		$TOMBOL['lokasi_selanjutnya']="data_fisik";
		$TOMBOL['lokasi_sebelumnya']="data_bapak";
		//data di post
		$id_step_tujuan=$this->input->post('id_step_tujuan');
		if($id_step_tujuan){
			$NIM=$this->nim;
			$NM_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_WALI'));
			$TMP_LAHIR_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('TMP_LAHIR_WALI'));
			$TGL_LAHIR_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('TGL_LAHIR_WALI'));
			$KD_AGAMA_WALI=$this->input->post('KD_AGAMA_WALI');
			$KD_PEND_WALI=$this->input->post('KD_PEND_WALI');
			$KERJA_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_WALI'));
			$ALAMAT_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('ALAMAT_WALI'));
			$RT_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('RT_WALI'));
			//RW WALI
			$RW_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('RW_WALI'));
			////////
			$DESA_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('DESA_WALI'));
			$KD_KEC_WALI=$this->input->post('KD_KEC_WALI');
			$NM_KEC_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_KEC_WALI'));
			$KD_KAB_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KAB_WALI'));
			$KD_PROP_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_PROP_WALI'));
			$KD_NEGARA_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_NEGARA_WALI'));
			$KODE_POS_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KODE_POS_WALI'));
			$TELP_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('TELP_WALI'));
			$HP_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('HP_WALI'));
			$EMAIL_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('EMAIL_WALI'));
			$KD_KERJA_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KERJA_WALI'));
			//echo "kd kerja wali $KD_KERJA_WALI";
			$KERJA_WALI_DETAIL=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_WALI_DETAIL'));
			$STATUS_WALI=$this->lib_reg_fungsi->bersihkan($this->input->post('STATUS_WALI'));
			if(strtoupper($NM_WALI)=='TIDAK ADA'){
				$TMP_LAHIR_WALI='';
				$TMP_LAHIR_WALI='';
				$TGL_LAHIR_WALI='';
				$KD_AGAMA_WALI='';
				$KD_PEND_WALI='';
				$KERJA_WALI='';
				$ALAMAT_WALI='';
				$RT_WALI='';
				//RW WALI
				$RW_WALI='';
				$DESA_WALI='';
				$KD_KEC_WALI='';
				$NM_KEC_WALI='';
				$KD_KAB_WALI='';
				$KD_PROP_WALI='';
				$KD_NEGARA_WALI='';
				$KODE_POS_WALI='';
				$TELP_WALI='';
				$HP_WALI='';
				$EMAIL_WALI='';
				$KD_KERJA_WALI='';
				$KERJA_WALI_DETAIL='';
				$STATUS_WALI='';
			}
			if(trim(strtoupper($NM_WALI))!='TIDAK ADA' and isset($NM_WALI) and empty($STATUS_WALI)){		
				$err=$err."<li>Jika nama Wali ada (tidak ditulis <b>TIDAK ADA</b>) maka isikan Status Wali.</li>";		
			}
			if(empty($err)){				
				$ARR_DATA_BARU=array(
					'NAMA'=>$NAMA,
					'NISN'=>$NISN,
					'NO_TEST'=>$NO_TEST,
					'NM_WALI'=>$NM_WALI,
					'TMP_LAHIR_WALI'=>$TMP_LAHIR_WALI,
					'TGL_LAHIR_WALI'=>$TGL_LAHIR_WALI,
					'KD_AGAMA_WALI'=>$KD_AGAMA_WALI,
					'KD_PEND_WALI'=>$KD_PEND_WALI,
					//'KERJA_WALI'=>$KERJA_WALI,
					'ALAMAT_WALI'=>$ALAMAT_WALI,
					'RW_WALI'=>$RW_WALI,
					'RT_WALI'=>$RT_WALI,
					'DESA_WALI'=>$DESA_WALI,
					'KD_KEC_WALI'=>$KD_KEC_WALI,
					'NM_KEC_WALI'=>$NM_KEC_WALI,
					'KD_KAB_WALI'=>$KD_KAB_WALI,
					'KD_PROP_WALI'=>$KD_PROP_WALI,
					'KODE_POS_WALI'=>$KODE_POS_WALI,
					'TELP_WALI'=>$TELP_WALI,
					'EMAIL_WALI'=>$EMAIL_WALI,
					'STATUS_WALI'=>$STATUS_WALI,
					'KD_KERJA_WALI'=>$KD_KERJA_WALI,
					'KERJA_WALI_DETAIL'=>$KERJA_WALI_DETAIL,
					'KD_NEGARA_WALI'=>$KD_NEGARA_WALI,
					'HP_BPK'=>$HP_BPK,
					'HP_WALI'=>$HP_WALI
				);
				$update=$this->lib_reg_fungsi->post_data_global($ARR_DATA_BARU);
				//echo "update isi $update";
				header("location:$id_step_tujuan");
			}
		}else{
			$NM_WALI=$data_mahasiswa['NM_WALI'];
			$TMP_LAHIR_WALI=$data_mahasiswa['TMP_LAHIR_WALI'];
			$TGL_LAHIR_WALI=$data_mahasiswa['TGL_LAHIR_WALIX'];
			$KD_AGAMA_WALI=$data_mahasiswa['KD_AGAMA_WALI'];
			$KD_PEND_WALI=$data_mahasiswa['KD_PEND_WALI'];
			$KERJA_WALI=$data_mahasiswa['KERJA_WALI'];
			$ALAMAT_WALI=$data_mahasiswa['ALAMAT_WALI'];
			$RT_WALI=$data_mahasiswa['RT_WALI'];
			//RW WALI
			$RW_WALI=$data_mahasiswa['RW_WALI'];
			/////////
			$DESA_WALI=$data_mahasiswa['DESA_WALI'];
			$NM_KEC_WALI=$data_mahasiswa['NM_KEC_WALI'];
			$KD_KAB_WALI=$data_mahasiswa['KD_KAB_WALI'];
			$KD_PROP_WALI=$data_mahasiswa['KD_PROP_WALI'];
			$KD_NEGARA_WALI=$data_mahasiswa['KD_NEGARA_WALI'];
			$KODE_POS_WALI=$data_mahasiswa['KODE_POS_WALI'];
			$TELP_WALI=$data_mahasiswa['TELP_WALI'];
			$HP_WALI=$data_mahasiswa['HP_WALI'];
			$EMAIL_WALI=$data_mahasiswa['EMAIL_WALI'];
			$KD_KERJA_WALI=$data_mahasiswa['KD_KERJA_WALI'];
			$KERJA_WALI_DETAIL=$data_mahasiswa['KERJA_WALI_DETAIL'];
			$STATUS_WALI=$data_mahasiswa['STATUS_WALI'];
		}

		//MASTER DATA
		$data['MASTER_DATA_AGAMA']=$data_agama;
		$data['MASTER_DATA_PENDIDIKAN']=$data_pendidikan;
		$data['MASTER_DATA_PEKERJAAN']=$data_pekerjaan;
		//isiannya
		$data['NM_WALI']=$NM_WALI;
		$data['TMP_LAHIR_WALI']=$TMP_LAHIR_WALI;
		$data['TGL_LAHIR_WALI']=$TGL_LAHIR_WALI;
		$data['KD_AGAMA_WALI']=$KD_AGAMA_WALI;
		$data['KD_PEND_WALI']=$KD_PEND_WALI;
		$data['KERJA_WALI']=$KERJA_WALI;
		$data['ALAMAT_WALI']=$ALAMAT_WALI;
		$data['RT_WALI']=$RT_WALI;
		//RW WALI
		$data['RW_WALI']=$RW_WALI;
		////////
		$data['DESA_WALI']=$DESA_WALI;
		$data['NM_KEC_WALI']=$NM_KEC_WALI;
		$data['KD_KAB_WALI']=$KD_KAB_WALI;
		$NM_KAB_ARR=$this->lib_reg_fungsi->data_kabupaten_detail($KD_KAB_WALI);
		$data['NM_KAB_WALI']=$NM_KAB_ARR['NM_KAB'];
		$data['KD_PROP_WALI']=$KD_PROP_WALI;
		$data['KD_NEGARA_WALI']=$KD_NEGARA_WALI;
		$NM_PROP_ARR=$this->lib_reg_fungsi->data_PROPINSI_detail($KD_PROP_WALI);
		$data['NM_PROP_WALI']=$NM_PROP_ARR['NM_PROP'];
		$data['KODE_POS_WALI']=$KODE_POS_WALI;
		$data['TELP_WALI']=$TELP_WALI;
		$data['HP_WALI']=$HP_WALI;
		$data['EMAIL_WALI']=$EMAIL_WALI;
		$data['KD_KERJA_WALI']=$KD_KERJA_WALI;
		$data['KERJA_WALI_DETAIL']=$KERJA_WALI_DETAIL;
		$data['STATUS_WALI']=$STATUS_WALI;
		//HARUS ADA
		$TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
		$data['TOMBOL']=$TOMBOL;
		$data['judul_halaman']=$judul_halaman;
		$data['err']=$err;		
		//$this->s00_lib_output->output_display('praregistrasi/v_data_wali', $data);	
		$data['content']='praregistrasi/v_data_wali';
        $this->load->view('s00_vw_all', $data);		
	}
}	
?>