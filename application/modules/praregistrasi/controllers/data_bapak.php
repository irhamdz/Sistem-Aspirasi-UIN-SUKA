<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class data_bapak extends CI_Controller {

	function __construct(){
        parent::__construct();       
        error_reporting(0);
        $this->output99	= $this->s00_lib_output;   
		$this->load->library('lib_reg_fungsi');
		$this->lib_reg_fungsi->cek_awal();	
		
    }
	function index(){
		$this->load->library('lib_reg_fungsi');
		$this->output=$this->s00_lib_output;
		$step='1';
		$err='';
		$judul_halaman="Data Bapak";
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
		$TOMBOL['lokasi_selanjutnya']="data_wali";
		$TOMBOL['lokasi_sebelumnya']="data_ibu";
		//data di post
		$id_step_tujuan=$this->input->post('id_step_tujuan');
		if($id_step_tujuan){
			$NIM=$this->nim;
			$NM_BPK_KANDUNG=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_BPK_KANDUNG'));
			$TMP_LAHIR_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('TMP_LAHIR_BPK'));
			$TGL_LAHIR_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('TGL_LAHIR_BPK'));
			$KD_AGAMA_BPK=$this->input->post('KD_AGAMA_BPK');
			$KD_PEND_BPK=$this->input->post('KD_PEND_BPK');
			$KERJA_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_BPK'));
			$ALAMAT_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('ALAMAT_BPK'));
			$RT_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('RT_BPK'));
			//RW BPK
			$RW_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('RW_BPK'));
			///
			$DESA_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('DESA_BPK'));
			$KD_KEC_BPK=$this->input->post('KD_KEC_BPK');
			$NM_KEC_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('NM_KEC_BPK'));
			$KD_KAB_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KAB_BPK'));
			$KD_PROP_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_PROP_BPK'));
			$KD_NEGARA_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_NEGARA_BPK'));
			$KODE_POS_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KODE_POS_BPK'));
			$TELP_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('TELP_BPK'));
			$EMAIL_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('EMAIL_BPK'));
			$HP_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('HP_BPK'));
			$KD_KERJA_BPK=$this->lib_reg_fungsi->bersihkan($this->input->post('KD_KERJA_BPK'));
			$KERJA_BPK_DETAIL=$this->lib_reg_fungsi->bersihkan($this->input->post('KERJA_BPK_DETAIL'));
			if(strtoupper($NM_BPK_KANDUNG)=='TIDAK ADA'){
				$TMP_LAHIR_BPK='';
				$TMP_LAHIR_BPK='';
				$TGL_LAHIR_BPK='';
				$KD_AGAMA_BPK='';
				$KD_PEND_BPK='';
				$KERJA_BPK='';
				$ALAMAT_BPK='';
				$RT_BPK='';
				$RW_BPK='';
				$DESA_BPK='';
				$KD_KEC_BPK='';
				$NM_KEC_BPK='';
				$KD_KAB_BPK='';
				$KD_PROP_BPK='';
				$KD_NEGARA_BPK='';
				$KODE_POS_BPK='';
				$TELP_BPK='';
				$HP_BPK='';
				$EMAIL_BPK='';
				$KD_KERJA_BPK='';
				$KERJA_BPK_DETAIL='';
			}
			if(trim(strtoupper($NM_BPK_KANDUNG))!='TIDAK ADA' and empty($KERJA_BPK_DETAIL)){		
				$err=$err."<li>Jika nama Bapak ada (tidak ditulis <b>TIDAK ADA</b>) maka isian pekerjaan wajib diisi.</li>";
		
			}
			if(empty($err)){
				$ARR_DATA_BARU=array(
					'NAMA'=>$NAMA,
					'NISN'=>$NISN,
					'NO_TEST'=>$NO_TEST,
					'NM_BPK_KANDUNG'=>$NM_BPK_KANDUNG,
					'TMP_LAHIR_BPK'=>$TMP_LAHIR_BPK,
					'TGL_LAHIR_BPK'=>$TGL_LAHIR_BPK,
					'KD_AGAMA_BPK'=>$KD_AGAMA_BPK,
					'KD_PEND_BPK'=>$KD_PEND_BPK,
					//'KERJA_BPK'=>$KERJA_BPK,
					'ALAMAT_BPK'=>$ALAMAT_BPK,					
					'RT_BPK'=>$RT_BPK,
					'RW_BPK'=>$RW_BPK,
					'DESA_BPK'=>$DESA_BPK,
					'NM_KEC_BPK'=>$NM_KEC_BPK,
					'KD_KAB_BPK'=>$KD_KAB_BPK,
					'KD_PROP_BPK'=>$KD_PROP_BPK,
					'KD_NEGARA_BPK'=>$KD_NEGARA_BPK,
					'KODE_POS_BPK'=>$KODE_POS_BPK,
					'TELP_BPK'=>$TELP_BPK,
					'HP_BPK'=>$HP_BPK,
					'EMAIL_BPK'=>$EMAIL_BPK,
					'KD_KERJA_BPK'=>$KD_KERJA_BPK,
					'KERJA_BPK_DETAIL'=>$KERJA_BPK_DETAIL
				);
				$update=$this->lib_reg_fungsi->post_data_global($ARR_DATA_BARU);
				//echo "updte isi $update";
				header("location:$id_step_tujuan");
			}
		}else{
			$NM_BPK_KANDUNG=$data_mahasiswa['NM_BPK_KANDUNG'];
			$TMP_LAHIR_BPK=$data_mahasiswa['TMP_LAHIR_BPK'];
			if($data_mahasiswa['TGL_LAHIR_BPKX']){
				$TGL_LAHIR_BPK=$data_mahasiswa['TGL_LAHIR_BPKX'];
			}else{
				$TGL_LAHIR_BPK='';
			}
			$KD_AGAMA_BPK=$data_mahasiswa['KD_AGAMA_BPK'];
			$KD_PEND_BPK=$data_mahasiswa['KD_PEND_BPK'];
			$KERJA_BPK=$data_mahasiswa['KERJA_BPK'];
			$ALAMAT_BPK=$data_mahasiswa['ALAMAT_BPK'];
			$RT_BPK=$data_mahasiswa['RT_BPK'];
			//RW BPK
			$RW_BPK=$data_mahasiswa['RW_BPK'];
			////////
			$DESA_BPK=$data_mahasiswa['DESA_BPK'];
			$NM_KEC_BPK=$data_mahasiswa['NM_KEC_BPK'];
			$KD_KAB_BPK=$data_mahasiswa['KD_KAB_BPK'];
			$KD_PROP_BPK=$data_mahasiswa['KD_PROP_BPK'];
			$KD_NEGARA_BPK=$data_mahasiswa['KD_NEGARA_BPK'];
			$KODE_POS_BPK=$data_mahasiswa['KODE_POS_BPK'];
			$TELP_BPK=$data_mahasiswa['TELP_BPK'];
			$HP_BPK=$data_mahasiswa['HP_BPK'];
			$EMAIL_BPK=$data_mahasiswa['EMAIL_BPK'];
			$KD_KERJA_BPK=$data_mahasiswa['KD_KERJA_BPK'];
			$KERJA_BPK_DETAIL=$data_mahasiswa['KERJA_BPK_DETAIL'];
		}
		//MASTER DATA
		$data['MASTER_DATA_AGAMA']=$data_agama;
		$data['MASTER_DATA_PENDIDIKAN']=$data_pendidikan;
		$data['MASTER_DATA_PEKERJAAN']=$data_pekerjaan;
		//isiannya
		$data['NM_BPK_KANDUNG']=$NM_BPK_KANDUNG;
		$data['TMP_LAHIR_BPK']=$TMP_LAHIR_BPK;
		$data['TGL_LAHIR_BPK']=$TGL_LAHIR_BPK;
		$data['KD_AGAMA_BPK']=$KD_AGAMA_BPK;
		$data['KD_PEND_BPK']=$KD_PEND_BPK;
		$data['KERJA_BPK']=$KERJA_BPK;
		$data['ALAMAT_BPK']=$ALAMAT_BPK;
		$data['RT_BPK']=$RT_BPK;
		//RW BPK
		$data['RW_BPK']=$RW_BPK;
		////////
		$data['DESA_BPK']=$DESA_BPK;
		$data['NM_KEC_BPK']=$NM_KEC_BPK;
		$data['KD_KAB_BPK']=$KD_KAB_BPK;
		$NM_KAB_ARR=$this->lib_reg_fungsi->data_kabupaten_detail($KD_KAB_BPK);
		$data['NM_KAB_BPK']=$NM_KAB_ARR['NM_KAB'];
		$data['KD_PROP_BPK']=$KD_PROP_BPK;
		$data['KD_NEGARA_BPK']=$KD_NEGARA_BPK;
		$NM_PROP_ARR=$this->lib_reg_fungsi->data_PROPINSI_detail($KD_PROP_BPK);
		$data['NM_PROP_BPK']=$NM_PROP_ARR['NM_PROP'];
		$data['KODE_POS_BPK']=$KODE_POS_BPK;
		$data['HP_BPK']=$HP_BPK;
		$data['TELP_BPK']=$TELP_BPK;
		$data['EMAIL_BPK']=$EMAIL_BPK;
		$data['KD_KERJA_BPK']=$KD_KERJA_BPK;
		$data['KERJA_BPK_DETAIL']=$KERJA_BPK_DETAIL;
		//HARUS ADA
		$TOMBOL['NISN']=$NISN;
        $TOMBOL['NO_TEST']=$NO_TEST;
		$data['TOMBOL']=$TOMBOL;
		$data['judul_halaman']=$judul_halaman;
		$data['err']=$err;
		//$this->output99->output_display('praregistrasi/v_data_bapak', $data);				
		$data['content']='praregistrasi/v_data_bapak';
        $this->load->view('s00_vw_all', $data);
	}
}	
?>