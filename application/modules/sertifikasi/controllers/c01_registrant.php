<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c01_registrant extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->output69 = $this->it00_lib_output;
		$this->load->library('it00_lib','','lib_basic');
		$this->load->library('lib_reg_fungsi');
		$this->load->helper('format_tanggal');
		$this->load->helper('text_manipulation');
		$this->load->library('pagination');
		$this->pin = $this->session->userdata('id_user');
		$this->username = $this->session->userdata('username');
		$this->is_daftar();
		if($this->session->userdata('status') != 'pendaftar'){ redirect(); }
	}

	private function is_daftar()
	{
		if($this->lib_basic->select_row('D_PENDAFTAR',array('PRE_PIN' => $this->pin,'PRE_USER' => $this->username)) == false){
			$status = '0';
		}else{
			if($this->lib_basic->select_row('T_PRED',array('PRE_PIN' => $this->pin,'PRE_USER' => $this->username)) == false){
				$status = '1';
			}else{
				$status = '2';
			}
		}
		$this->session->set_userdata('st_daftar',$status);
		return $status;
	}
	
	function index(){
		$this->isidatadiri();
		// echo("hai");
	}

	function abal($value='')
	{
		$dt = $this->lib_basic->select_row('T_PRED',array('PRE_PIN' => $this->pin));
		if($this->lib_basic->select_row('T_PRED',array('PRE_PIN' => $this->pin)) == false){
			echo("belum");
		}else { echo "udah";}
	}

	function foto_pendaftar()
	{
		$get_foto = $this->lib_basic->getBlob($this->pin);
		if($get_foto){
			$foto1 = base64_decode($get_foto[0]['FOTO']);
			$n1 = substr($foto1, -200);
			$n2  = substr($foto1, 0, strlen($foto1) - 200);
			header("Content-type: image/jpeg");
			echo base64_decode($n1.$n2);	
		}else{
			header("Content-type: image/jpeg");
			echo "Tidak ada foto.";
		}
		
	}

	function isidatadiri()
	{
		if($this->input->post('aksi') == 'prop'){
			$kd_prop = $this->input->post('kd_prop');
			
			$arrkab = $this->lib_basic->get_data_region('kabupaten',$kd_prop);
			
			if(!empty($arrkab)){
				$select_kab = '';
				foreach($arrkab as $idx => $ab){
					if(substr($ab['NM_KAB'],0,12) == 'KAB. LAINNYA'){
						$KD_KAB_LAIN=$ab['KD_KAB'];
						continue;
					}
					$select_kab	.= '<option value="'.$ab['KD_KAB'].'">'.$ab['NM_KAB'].'</option>';
				}
				$select_kab=$select_kab.'<option value="'.$KD_KAB_LAIN.'">KABUPATEN LAINNYA</option>';
			}else{ $select_kab	= '<option value="">-</option>'; }
			
			echo json_encode(array('kab' => $select_kab));
		}elseif($this->input->post('aksi') == 'kab'){
			$kd_kab = $this->input->post('kd_kab');
			
			$arrkec = $this->lib_basic->get_data_region('kecamatan',$kd_kab);
			
			$select_kec = '';
			foreach($arrkec as $idx => $ab){
				$select_kec	.= '<option value="'.$ab['KD_KEC'].'">'.strtoupper($ab['NM_KEC']).'</option>';
			}
			$select_kec.='<option value="999999">KEC. LAINNYA</option>';
			echo json_encode(array('kec' => $select_kec));
		}elseif($this->input->post('op') == 'kab_cari'){
			$katakunci=$this->input->post('katakunci');
			$lokasi_balik=$this->input->post('lokasi_balik');
			$lokasi=$this->input->post('lokasi');
			$lokasi_tampil=$this->input->post('lokasi_tampil');
			if($katakunci){
				$data	= $this->lib_reg_fungsi->data_kabupaten($katakunci);
				$data['isi']=$data;
				//$data['lokasi']=$lokasi;			
				if($lokasi_balik=='KD_KAB'){
					$propinsi="1";
				}else{
					$propinsi='0';
				}
				$data['propinsi']=$propinsi;
				$data['lokasi_balik']=$lokasi_balik;
				$data['lokasi']="$lokasi#$lokasi_balik#$lokasi_tampil";
				$this->load->view('sertifikasi/pendaftar/v_ajax_kab',$data);
			}
		}elseif($this->input->post('OP') == 'INS'){
			$get_pendaftar = $this->lib_basic->select_row('D_PENDAFTAR',array('PRE_USER' => $this->username,'PRE_PIN' => $this->pin));
			foreach($this->input->post() as $key => $value){
				if($key != 'OP'){
					if($key == 'TGL_LAHIR'){
						$aa['TGL_LAHIR'] = strtoupper(date("d-M-y",strtotime($value)));
					}elseif($key == 'TGL_KTP'){
						$aa['TGL_KTP'] = strtoupper(date("d-M-y",strtotime($value)));
					}else{
						$aa[$key] = $value;	
					}
				}
			}
		
			$cek = $this->lib_basic->cek_lengkap($aa);
			if($cek['status'] == false){
				$msg = '<div class="bs-callout bs-callout-error">Maaf, data gagal disimpan karena ada beberapa data yang belum diisi.<ol>'.$cek['msg'].'</ol></div>';
				$st = 0;
			}else{
				if($get_pendaftar){
					//update
					if($cek['status'] == true){
						$where = array('PRE_PIN' => $aa['PRE_PIN'], 'PRE_USER' => $aa['PRE_USER']);
						$aksi = $this->lib_basic->update('D_PENDAFTAR',$aa,$where);	
						#$aksi = true;
					}else { $st = 0; $msg = '<div class="bs-callout bs-callout-error">Maaf, data gagal disimpan karena ada beberapa data yang belum diisi.<ol>'.$cek['msg'].'</ol></div>';}
					if($aksi){ 
						//insert image
						#print_r($_FILES['userfile']);
						if(!empty($_FILES['userfile']['tmp_name'])){
							$file   = $_FILES['userfile']['tmp_name'];
							$upload = $this->lib_basic->insertBlob('D_FOTO',array('FOTO' => base64_encode(file_get_contents($file)) ), array('PRE_PIN' => $this->pin));
							if($upload['result'] == true){ }
						}
						#$this->lib_basic->insertBlob('D_PENDAFTAR',array(),array());
						$st = 1; $msg = '<div class="bs-callout bs-callout-success">Data berhasil diperbarui.</div>';}else{ $st = 0; $msg = '<div class="bs-callout bs-callout-error">Data gagal diperbarui.</div>';}	
				}else{
					//insert
					if($cek['status'] == true){
						$aksi = $this->lib_basic->insert('D_PENDAFTAR',$aa);
					}else{ $msg = '<div class="bs-callout bs-callout-error">Maaf, data gagal disimpan karena ada beberapa data yang belum diisi.<ol>'.$cek['msg'].'</ol></div>'; }
					if($aksi){
						//insert image
						$st = 1; $msg = '<div class="bs-callout bs-callout-success">Data berhasil dimasukkan.</div>';}else{ $st = 0; $msg = '<div class="bs-callout bs-callout-error">Data gagal dimasukkan.</div>';}	
				}
			}
			$hasil = array('st' => $st, 'pesan' => $msg);
			echo json_encode($hasil);
			
		}else{
			// 1. get data agama
			$get_agama = $this->lib_basic->get_data_religion();
			if($get_agama){
				$dd_agama = '';
				//print_r($get_agama);
				foreach ($get_agama as $key => $value) {
					if($value['KD_AGAMA'] != '10'){ $dd_agama .= '<option value="'.$value['KD_AGAMA'].'">'.$value['NM_AGAMA'].'</option>';	}
				}
				$dd_agama .= '<option value="10">LAINNYA</option>';
			}
			

			// 2. get data provinsi
			$data_propinsi_list=$this->lib_reg_fungsi->data_propinsi_list();	
				
			$get_pendaftar = $this->lib_basic->select_row('D_PENDAFTAR',array('PRE_PIN' => $this->pin, 'PRE_USER' => $this->username));

			if ($get_pendaftar) {
				$dt_reg[0] = $get_pendaftar;
				//GET NAMA KAB LAHIR
				$NM_KAB_LAHIR_ARR = $this->lib_reg_fungsi->data_kabupaten_detail($dt_reg[0]['KD_KAB_LAHIR']);
				$dt_reg[0]['NM_KAB_LAHIR']=$NM_KAB_LAHIR_ARR['NM_KAB'];
			}else{
				$dt_reg = array(array(
								'PRE_USER' => $this->username,
								'PRE_PIN' => $this->pin,
								'GELAR_DEPAN' => '',
								'GELAR_DEPAN_NA' => '',
								'NAMA' => '',
								'GELAR_BELAKANG_NA' => '',
								'GELAR_BELAKANG' => '',
								'TMP_LAHIR' => '',
								'KD_KAB_LAHIR' => '',
								'NM_KAB_LAHIR' => '',
								'J_KELAMIN' => '',
								'NO_KTP' => '',
								'ALAMAT_MHS' => '',
								'RT_MHS' => '',
								'RW_MHS' => '',
								'DESA' => '',
								'KD_PROP' => '',
								'KD_KAB' => '',
								'KD_KEC' => '',
								'KODE_POS' => '',
								'TELP_MHS' => '',
								'EMAIL_MHS' => '',
								));
			}
			// 5. get data negara
			$get_warganegara = $this->lib_basic->get_data_region('negara');

			if($get_warganegara){
				$dd_wn = '';
				foreach ($get_warganegara as $key => $value) {
					if(isset($dt_reg[0]['WARGANEGARA']) && $dt_reg[0]['WARGANEGARA'] == $value['KD_NEGARA']){
						$dd_wn .= '<option selected value="'.$value['KD_NEGARA'].'">'.$value['NM_NEGARA'].'</option>';
					}else{ $dd_wn .= '<option value="'.$value['KD_NEGARA'].'">'.$value['NM_NEGARA'].'</option>';}
				}

				$dd_neg = '';
				foreach ($get_warganegara as $key_neg => $value_neg) {
					if(isset($dt_reg[0]['KD_NEGARA']) && $dt_reg[0]['KD_NEGARA'] == $value_neg['KD_NEGARA']){
						$dd_neg .= '<option selected value="'.$value_neg['KD_NEGARA'].'">'.$value_neg['NM_NEGARA'].'</option>';
					}else{ $dd_neg .= '<option value="'.$value_neg['KD_NEGARA'].'">'.$value_neg['NM_NEGARA'].'</option>';}
				}
			}
			$get_daftar = $this->lib_basic->select_row('T_PRED',array('PRE_PIN' => "$this->pin"));
			$st_daftar = ($get_daftar == true)? 1 : 0;
			$m = array('isi' => $dt_reg,'dd_agama' => $dd_agama, 'dd_wn' => $dd_wn,'PROP_LIST' => $data_propinsi_list, 'dd_neg' => $dd_neg,'st_daftar' => $st_daftar,);
			#print_r($m);
			$this->output69->output_display('sertifikasi/pendaftar/view_form_data_pendaftar',$m);
		}
	}


	function daftarsertifikasi($value='')
	{
		if ($this->input->post('op')=='do_ambil'):
			$kd_jad = $this->input->post('kd');
			$dt_jadwal = $this->lib_basic->get_jadwal('jad_detail',$kd_jad);
			$dt_foto = $this->lib_basic->cek_foto($this->pin);
			$st_ambil = 0;
			if($dt_jadwal){
				if($dt_foto){
					if($dt_jadwal['PENUH'] == '0' && $dt_jadwal['MOVEABLE'] == '1'){
						if($this->lib_basic->select_row('T_PRED',array('PRE_PIN' => $this->pin,'PRE_USER' => $this->username)) == false){
							$arr = array('PRE_PIN' => $this->pin, 'PRE_USER' => "$this->username", 'PREJ_KD' => $kd_jad, 'PER_KD' => $dt_jadwal['PER_KD'],
										 'NIL_W' => 0, 'NIL_E' => 0, 'NIL_P' => 0, 'NIL_I' => 0, 'NIL_ANGKA' => '0', 'NIL_HURUF' => '-', 'NIL_KET' => '',
										 'PRE_URUT' => 0, 'TGL_INPUTX0X' => 'SYSDATE');
							$aksi = $this->lib_basic->insert('T_PRED',$arr);
							// $aksi = true;
							$msg = ($aksi == TRUE)? '<div class="bs-callout bs-callout-success">Jadwal yang dipilih berhasil diambil.</div>' : '<div class="bs-callout bs-callout-error">Maaf, jadwal gagal diambil.</div>';
							$st_ambil = ($aksi == TRUE)? '1' : '0';
						} else { $msg = '<div class="bs-callout bs-callout-error">Maaf, jadwal tidak dapat diambil karena Anda sudah mengambil jadwal.</div>'; } #udah daftar
					} else { $msg = '<div class="bs-callout bs-callout-error">Maaf, jadwal tidak dapat diambil karena sudah penuh.</div>'; } #kuota penuh atau lewat tanggal
				} else { $msg = '<div class="bs-callout bs-callout-error">Maaf, jadwal tidak dapat diambil karena Anda belum meng-upload foto.</div>'; } #belum upload foto
			} else { $msg = '<div class="bs-callout bs-callout-error">Maaf, data jadwal tidak dapat ditemukan.</div>'; } #ga ada data jadwal
			$balikan = array('notif' => $msg, 'st' => $st_ambil);
			echo json_encode($balikan);
		else:
			if($this->lib_basic->select_row('D_PENDAFTAR',array('PRE_PIN' => $this->pin,'PRE_USER' => $this->username)) == false){
				redirect('pendaftar/isidatadiri');
			}else{
				if($this->lib_basic->select_row('T_PRED',array('PRE_PIN' => $this->pin,'PRE_USER' => $this->username)) == false){
					//belum daftar
					$get_jadwal = $this->lib_basic->get_jadwal('tawar','sr_en');
					$m = array('get_jadwal' => $get_jadwal);
					$this->output69->output_display('sertifikasi/pendaftar/view_jadwal_ditawarkan_sr',$m);
				}else{
					//udah daftar
					$m = array('st_daftar' => true);
					$this->output69->output_display('sertifikasi/pendaftar/view_jadwal_ditawarkan_sr',$m);
				}
			}
		endif;
	}


	function jadwalsertifikasi($kd_per='')
	{
		if(!empty($kd_per))
		{
			$bln = explode("-", $kd_per);
			$get_jadwal = $this->lib_basic->get_jadwal('jad_histori','sr_en',$bln[0],$bln[1]);
			$m = array('get_jadwal' => $get_jadwal,);
			$this->load->view('sertifikasi/pendaftar/vw_tabel/tbl_jadwal_udah_lalu',$m);
		}
		else{
			if($this->input->post('op') == 'thn'):
				$kd_thn = $this->input->post('kd');
				$xx2 = '<option>Pilih Bulan</option>';
				$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$kd_thn);
				foreach($get_bulan as $key => $value) :
					$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
				endforeach;	
			elseif($this->input->post('op') == 'bln'):
				$bln = explode("-",$this->input->post('kd'));
				$get_jadwal = $this->lib_basic->get_jadwal('jad_histori','sr_en',$bln[0],$bln[1]);
				$m = array('get_jadwal' => $get_jadwal,);
				$this->load->view('sertifikasi/pendaftar/vw_tabel/tbl_jadwal_udah_lalu',$m);
			elseif($this->input->post('op') == 'hps'):
				$kd_jad = $this->input->post('kd');
				$aksi = $this->lib_basic->delete('T_PRED',array('PRE_USER' => $this->nim, 'PREJ_KD' => $kd_jad));
				$msg = ($aksi == TRUE)? '<div class="bs-callout bs-callout-success">Jadwal yang dipilih berhasil dihapus.</div>' : '<div class="bs-callout bs-callout-error">Maaf, jadwal gagal dihapus.</div>';
				echo $msg;					
			else:
				#data jadwal akan diikuti
				$get_jadwal_ikut =  $this->lib_basic->get_jadwal('jad_diambil','akan','sr_en',$this->pin);

				#data jadwal yg terlaksana
				$xx1 = '<option>Pilih Tahun</option>';
				$xx2 = '<option>Pilih Bulan</option>';
				$xx3 = '<option>Pilih Periode</option>';
				$get_jadwal = '';
				$get_thn = $this->lib_basic->get_periode('thn','sr_en');
				if($get_thn){
					$xx1 = '';
					$max_ta = max($get_thn);
					foreach($get_thn as $key => $value) :
						$xx1 .= '<option value="'.$value['TAHUN'].'">'.$value['TAHUN'].'</option>';
					endforeach;
					$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$max_ta['TAHUN']);
				}
				
				if(isset($get_bulan) && $get_bulan == true){
					$xx2 = '';
					$max_bln = $get_bulan[0];
					$bln = explode("-", $max_bln['BLN_FULL']);
					foreach($get_bulan as $key => $value) :
						$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					endforeach;
					$get_jadwal = $this->lib_basic->get_jadwal('jad_histori','sr_en',$bln[0],$bln[1]);
				}				
				
				$m = array(
						'get_jadwal_ikut' => $get_jadwal_ikut,
						'get_jadwal' => $get_jadwal,
						'kd_menu' => 'akan',
						'dd_thn' => $xx1,
						'dd_bln' => $xx2,
						'dd_prd' => $xx3,
						);
				$this->output69->output_display('sertifikasi/pendaftar/view_lihatjadwal_sr',$m);
			endif;
		}
	}
	function riwayatsertifikasi()
	{
		$get_jadwal = $this->lib_basic->get_jadwal('jad_diambil','riwayat','sr_en',$this->pin);
		$m = array('get_jadwal' => $get_jadwal); 
		$this->output69->output_display('sertifikasi/pendaftar/view_riwayat_sertifikasi',$m);
	}
}