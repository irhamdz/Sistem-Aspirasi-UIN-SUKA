<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C00_operator extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->output69 = $this->it00_lib_output;
		$this->api = $this->s00_lib_api;
		$this->kd_ta = date('Y');
		$this->load->library('it00_lib','','lib_basic');
		$this->load->helper('format_tanggal');
		$this->load->helper('text_manipulation');
		$this->load->library('pagination');
		if($this->session->userdata('status') != 'staff'){ redirect(); }
		#echo $this->session->userdata('status');
	}
 
 public function abal($value='')
 {
 	print_r($this->session->all_userdata());
 }

   public function detail($id=0){
		//$get_data = $this->db->get_where("berita",array('id_berita'=>$id));
		//$berita = $get_data->row();
			// $this->breadcrumb->append_crumb('Beranda', base_url());
			// $this->breadcrumb->append_crumb('Berita', site_url('page/berita'));
			// $this->breadcrumb->append_crumb(substr($berita->judul,0,130).' ...', '/');
			// $data['title']=$berita->judul;
			// $this->page_model->page_counter($id,'berita');
			
			$data['berita'] = $berita = $this->api_curl('news/news_detil/id/'.$id);
			$arr_filter=array();
			foreach($berita as $b){}
			$arr_filter=related_text($b->JUDUL);
			//$filter	="WHERE id_berita <> '".$id."' AND  (judul LIKE '%".rtrim(implode("%' OR judul LIKE '%",$arr_filter)," OR judul LIKE '%")."%')";
			//$data['rec']=$this->db->query("SELECT id_berita,judul,tanggal,jam from berita ".$filter." ORDER BY tanggal desc LIMIT 0,5")->result();
			//$data['pop']=$this->db->query("SELECT id_berita,judul,tanggal,jam from berita ORDER BY counter desc LIMIT 0,5")->result();
			
	
			$data['content']="page/berita/detail_view";
				
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
				
		
   }
   
   function index(){
   		echo "this is index";
   		$this->lib_basic->dump_session();
		/*$dt_jadwal = array(
						array('PREJ_KD' => '1','PER_BULAN' => '5 November 2014'),
						array('PREJ_KD' => '2','PER_BULAN' => '5 Desember 2014'),
						array('PREJ_KD' => '3','PER_BULAN' => '5 Januari 2015'),
					);
		#$m = array('dt_jadwal' => $dt_jadwal, 'passing' => 'hai');
		print_r($m);
		#$this->output69->output_display('sertifikasi/peserta/view_form_data_peserta',$m);
		$this->load->view('page/test_output',$m);*/
   }
      
 	function periode($bln='',$kd_per=null) #cek jadwal terisi belum
	{
		//cek udah ada periode?
		if(!empty($bln))
		{
			//get periode(bln)
			$xpl = explode("-", $bln);
			$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$xpl[0],$xpl[1]);
			// print_r($get_periode); die();
			$m = array('get_periode' => $get_periode);
			if(isset($kd_per))
			{
				$dt_per = $this->lib_basic->select_row('M_PERIODE',array('PER_KD' => $kd_per));
				if(!$dt_per){redirect('sertifikasi/c00_operator/periode');}
				$m['kd_per'] = $kd_per;
			}
			$this->load->view('sertifikasi/operator/vw_tabel/tbl_periode',$m);
		}
		else
		{
			if($this->input->post('op') == 'tarr'):
				#menampilkan bulan
				$xx2 = '<option value="xx">Pilih Bulan</option>';
				$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$this->input->post('kd'));
				if($get_bulan){
					foreach ($get_bulan as $key => $value) {
						$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
				}
				echo $xx2;					
			//pilih bulan
			elseif($this->input->post('op') == 'berr'):
				$val = explode("-",$this->input->post('berr'));
				//get periode bdsr kd_bln & kd_ta
				@$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				$m = array('get_periode' => $get_periode);
				echo $this->load->view('sertifikasi/operator/vw_tabel/tbl_periode',$m);
			//aksi tambah
			elseif($this->input->post('op') == 'tmbh'):
				$date = $this->input->post('tanggal');
				if(!$date){
					$date = date('d/m/Y',time());
				}
				//echo $date; die();
				$tgl_fix = "TO_DATE('$date','DD/MM/YYYY')";
				$per_bulan = date_trans_foracle($date, 1, '0 231 000',' ');
				$per_nm = "Hari ".str_replace(array(",","'"),array("","''"), date_trans_foracle($date, 1, '1 000 000',' '));
				if(!$this->lib_basic->select_row('M_PERIODE',array('PER_UJI' => $date,'PER_TIPE' => '2'))){
					$xxx = array('PER_UJIX0X' => $tgl_fix,'PER_BULAN' => $per_bulan, 'PER_NM' => $per_nm, 'PER_TAWAR' => '1','PER_STAT' => '1','PER_TIPE' => '2');
					$aksi = $this->lib_basic->insert('M_PERIODE',$xxx);
				}else{
					$aksi = false;
				}
				
				$msg = ($aksi == TRUE)? '<div class="bs-callout bs-callout-success">Data periode berhasil ditambahkan.</div>' : '<div class="bs-callout bs-callout-error">Data periode gagal ditambahkan.</div>';
			//aksi hapus
			elseif($this->input->post('op') == 'hps'):
				$kd_per = $this->input->post('kd');
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$kd_per);
				if($get_jadwal == false){
					$aksi = $this->lib_basic->delete('M_PERIODE',array('PER_KD' => $kd_per));
				} else { $aksi = false; }
				$msg = ($aksi == TRUE) ? '<div class="bs-callout bs-callout-success">Data periode berhasil dihapus.</div>' : '<div class="bs-callout bs-callout-error">Data periode gagal dihapus.</div>';
				echo $msg;
			elseif($this->input->post('op') == 'simpan'):
				$kd_per = $this->input->post('kd');
				$val = $this->input->post('val');
				$aksi = $this->lib_basic->update('M_PERIODE',array('PER_TAWAR' => $val),array('PER_KD' => $kd_per));
			else:
				$x = '<option value="xx">Pilih Bulan</option>';
				$get_ta = $this->lib_basic->get_periode('thn','sr_en');
				$get_periode = '';
				if($get_ta){
					$xx = "";
					$max_thn = max($get_ta);
					foreach ($get_ta as $key => $value) {
						$xx .= '<option value="'.$value['TAHUN'].'">'.$value['TAHUN'].'</option>';
					}
					$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$max_thn['TAHUN']);
				}
				if($get_bulan){
					$x = "";
					$max_bln = max($get_bulan);
					$val = explode("-", $max_bln['BLN_FULL']);
					foreach ($get_bulan as $key => $value) {
						$x .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
					$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				}
				#ambil data rekap
				$m = array('dd_tahun' => $xx,'dd_bulan' => $x,'get_periode' => $get_periode,);				
				//$this->load->view('uedu/vw_dropdown/dd_bulan',$m);
				//print_r($m);
				$this->output69->output_display('sertifikasi/operator/view_periode_sertifikasi',$m);
			endif;
		}
	} 

	function ruang($kd_per='',$kd_ru=null)
	{
		if(!empty($kd_per))
		{
			//get periode(bln)
			$get_ruang = $this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=>$kd_per));
			$m = array('get_ruang' => $get_ruang);
			if(isset($kd_ru))
			{
				$dt_ru = $this->lib_basic->select_row('M_RUANG',array('RU_KD' => $kd_ru));
				if(!$dt_ru){redirect('sertifikasi/c00_operator/ruang');}
				$m['kd_ru'] = $kd_ru;
			}
			$this->load->view('sertifikasi/operator/vw_tabel/tbl_ruang',$m);
		}
		else{
			//periode
			if($this->input->post('op') == 'perr'):
				$val = $this->input->post('kd');
				$get_ruang = $this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=>$val));
				$m = array('get_ruang' => $get_ruang);
				echo $this->load->view('sertifikasi/operator/vw_tabel/tbl_ruang',$m);
			//aksi tambah ruang
			elseif($this->input->post('op') == 'tmbh'):
				$aksi = '';
				if(!$this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=> $this->input->post('perr'),'KD_RUANG'=> $this->input->post('ruu')))){
					$aksi = $this->lib_basic->insert('M_RUANG',array('KD_RUANG' => $this->input->post('ruu'),'RU_KAP' => $this->input->post('kap') , 'RU_KET' => $this->input->post('ket'),'PER_KD' => $this->input->post('perr')));
				}
				$msg = ($aksi == TRUE)? 'Data periode berhasil ditambahkan.' : 'Data periode gagal ditambahkan.';
				echo $msg;
			//aksi hapus
			elseif($this->input->post('op') == 'hps'):
				$kd_ru = $this->input->post('kd');
				$cek_ru_terpakai = $this->lib_basic->select_row('T_PRED_JAD',array('RU_KD' => $kd_ru));
				if(!$cek_ru_terpakai):
					$aksi = $this->lib_basic->delete('M_RUANG',array('RU_KD' => $kd_ru));
				endif;
			//aksi simpan edit penawaran
			elseif($this->input->post('op') == 'simpan'):
				$kd_ru = $this->input->post('kd');
				$val = $this->input->post('val');
				$aksi = $this->lib_basic->update('M_RUANG',array('RU_KAP' => $val),array('RU_KD' => $kd_ru));	
			else:
				$get_periode = $this->lib_basic->get_periode('tawar','sr_en',$this->kd_ta);
				$dd_ruang = $this->lib_basic->select('D_RUANG','KD_RUANG ASC');
				$x = '<option value="xx">Pilih Periode</option>';
				$get_ruang = '';
				if($dd_ruang)
				{
					$x_ru = "";
					foreach ($dd_ruang as $key => $value) {
						$x_ru .= '<option value="'.$value['KD_RUANG'].'">'.$value['NM_RUANG'].'</option>';
					}
				}

				if($get_periode)
				{
					$x = "";
					$max_per = $get_periode[0];
					foreach ($get_periode as $key => $value) {
						$x .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
					$get_ruang = $this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=>$max_per['PER_KD']));
				}
				$m = array('dd_periode' => $x,'dd_ruang' => $x_ru,'get_ruang' => $get_ruang);
				//$this->load->view('toec/vw_dropdown/dd_bulan',$m);	
				$this->output69->output_display('sertifikasi/operator/view_ruang_sertifikasi',$m);
			endif;
		}
	}
	
	function penjadwalan($kd_per='')
	{
		if(!empty($kd_per))
		{
			//get periode(bln)
			$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$kd_per);
			$m = array('get_jadwal' => $get_jadwal,);
			$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal',$m);
		}
		else{
			if($this->input->post('op') == 'perr'):
				$val = $this->input->post('kd');
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$val);
				$dd_ruang = $this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=>$val));
				$x_ru = "";
				if($dd_ruang)
				{
					foreach ($dd_ruang as $key => $value) {
						$x_ru .= '<option value="'.$value['RU_KD'].'#'.$value['RU_KAP'].'">'.$value['KD_RUANG'].'</option>';
					}
				}
				$m = array('get_jadwal' => $get_jadwal);
				echo $x_ru;
		elseif($this->input->post('op') == 'hps'):
			$kd_jadwal = $this->input->post('kd');
			$get_jad_detail = $this->lib_basic->get_jadwal('jad_detail',$kd_jadwal);
			if($get_jad_detail):
				if($get_jad_detail['TERISI'] == '0'){
					$aksi = $this->lib_basic->delete('T_PRED_JAD',array('PREJ_KD' => $kd_jadwal));
				} else {$aksi = false; }					
			else:
				$aksi = false;
			endif;

			$msg = ($aksi == TRUE)? 'Data jadwal SUKSES dihapus.' : 'Data jadwal GAGAL dihapus.';
			echo $msg;		
		
		#insert
		elseif ($this->input->post('op')=='tmbh'):
			$aksi = '';
			$ruang = explode("#", $this->input->post('ruang'));
			if($ruang =='xx' || $this->input->post('perr') =='xx' ){
				$msg = 'Data jadwal gagal ditambahkan';
			}else{
				#jika ada yg bentrok
				if(!$this->lib_basic->cek_bentrok('sr_en',array('PER_KD'=> $this->input->post('perr'),'RU_KD'=> $ruang[0], 'JAM_MULAI' => $this->input->post('jam_mulai'),'JAM_SELESAI'=>$this->input->post('jam_selesai'))))
				{
					$aksi = $this->lib_basic->insert('T_PRED_JAD',array(
						'PER_KD' => $this->input->post('perr'),
						'HAR_KD' => '0',
						'RU_KD' => $ruang[0],
						'PREJ_DAFT' => '0',
						'JAM_MULAIX0X' => "TO_DATE('".$this->input->post('jam_mulai')."','HH24:MI')",
						'JAM_SELESAIX0X' => "TO_DATE('".$this->input->post('jam_selesai')."','HH24:MI')"));
				}
				$msg = ($aksi == TRUE)? 'Data jadwal berhasil ditambahkan.' : 'Data jadwal gagal ditambahkan.';
			}
			echo $msg;			
		else:
			$x = '<option value="xx">Pilih Periode</option>';
			$xx1 = '<option value="xx">Pilih Ruang</option>';
			$get_jadwal = '';
			$get_periode = $this->lib_basic->get_periode('tawar','sr_en',$this->kd_ta);
			//print_r($get_periode); die();
			if($get_periode)
			{
				$x = '';
				$max_per = $get_periode[0];
				foreach ($get_periode as $key => $value) {
					$x .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
				}
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$max_per['PER_KD']);
				$dd_ruang = $this->lib_basic->select('M_RUANG','KD_RUANG DESC',array('PER_KD'=>$max_per['PER_KD']));
			}
			
			if(isset($dd_ruang) && ($dd_ruang == true))
			{
				$xx1 = "";
				foreach ($dd_ruang as $key => $value) {
					$xx1 .= '<option value="'.$value['RU_KD'].'#'.$value['RU_KAP'].'">'.$value['KD_RUANG'].'</option>';
				}
			}

			$m =array('dd_periode' => $x, 'get_jadwal' => $get_jadwal, 'dd_ruang' => $xx1, );
			$this->output69->output_display('sertifikasi/operator/view_penjadwalan',$m);
		endif;
		}
	}
	
	function jadwal($kd_per='',$kd_jad=null)
	{
		if(!empty($kd_per))
		{
			if(isset($kd_jad))
			{
				$get_jad_detail = $this->lib_basic->get_jadwal('jad_detail',$kd_jad);
				$get_peserta = $this->lib_basic->select('T_PRED','PRE_PIN ASC',array('PREJ_KD' => $kd_jad));
				if ($get_peserta){
					foreach($get_peserta as $key => $value):
						 $xx['PREJ_KD'] = $kd_jad;
						 $api_mhs = ($this->lib_basic->get_data_reg($value['PRE_USER']));
							foreach ($api_mhs as $key => $value){
								$dt = $value;
								$data[] = array_merge($dt,$xx);
							}
						$data_mhs = $data;
					endforeach;
				} else{ $data_mhs = null;}

				$m = array('get_jadwal' => $get_jad_detail, 'get_peserta' => $data_mhs, 'kd_menu' => 'jadwal');
				// print_r($m); //die();
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_detail',$m);
			}
			else{
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$kd_per);
				$m = array('get_jadwal' => $get_jadwal, 'kd_menu' => 'jadwal');
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_terisi',$m);
			}
		}
		else{
			if($this->input->post('op') == 'tarr'):
				#menampilkan bulan
				$xx2 = '<option value="xx">Pilih Bulan</option>';
				$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$this->input->post('kd'));
				if($get_bulan){
					foreach ($get_bulan as $key => $value) {
						$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
				}
				echo $xx2;			
			elseif($this->input->post('op') == 'berr'):
				#menampilkan periode
				$xx3 = '<option value="xx">Pilih Periode</option>';
				$val = explode("-", $this->input->post('kd'));
				$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				if($get_periode)
				{
					foreach ($get_periode as $key => $value) {
						$xx3 .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
				}
				#$m = array('dd_perr' => $x_perr, 'perr' => $get_periode[0]['PER_KD']);
				#echo json_encode($m);
				echo $xx3;
			elseif($this->input->post('op') == 'det_terisi'):
				$this->jadwal($this->input->post('perr'),$this->input->post('kd'));
			//pemindahan 
			elseif($this->input->post('op') == 'pindah'):
				$this->session->unset_userdata('ict_pst_sr');
				$isi = $this->input->post('isi');
				$this->session->set_userdata('ict_pst_sr',$isi);
			elseif($this->input->post('op') == 'do_pindah'):
				$kd_pst = $this->session->userdata('ict_pst_sr');
				$kd_jad = $this->input->post('kd');
				$get_jad_detail = $this->lib_basic->get_jadwal('jad_detail',$kd_jad);
				if(($get_jad_detail['MOVEABLE'] == '1') && ($get_jad_detail['PENUH'] == '0')){
					$aksi = $this->lib_basic->update('T_PRED',array('PREJ_KD' => $kd_jad,'PER_KD'=>$get_jad_detail['PER_KD']),array('PRE_PIN' => $kd_pst));
				} else {$aksi = false; }
				$msg = ($aksi == true)? '1' : '0';
				$this->session->unset_userdata('ict_pst_sr');
				echo $msg;
			elseif($this->input->post('op') == 'batal_pindah'):	
				$this->session->unset_userdata('ict_pst_sr');
			else:
				$x_ta = '<option value="xx">Pilih Bulan</option>';
				$x_berr = '<option value="xx">Pilih Bulan</option>';
				$x_perr = '<option value="xx">Pilih Periode</option>';
				
				$get_jadwal = '';
				$get_ta = $this->lib_basic->get_periode('thn');
				if($get_ta)
				{
					$x_ta = "";
					$max_ta = max($get_ta);
					foreach($get_ta as $key_ta => $value_ta)
					{
						$x_ta .= '<option value="'.$value_ta['TAHUN'].'">'.$value_ta['TAHUN'].'</option>';
					}
					$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$max_ta['TAHUN']);					
				}

				if($get_bulan)
				{
					$x_berr = "";
					$max_bln = max($get_bulan);
					$val = explode("-", $max_bln['BLN_FULL']);
					foreach ($get_bulan as $key => $value) {
						$x_berr .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
					$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
					// $get_periode = empty($get_periode)? '': array_reverse($get_periode);
				}
				

				if(isset($get_periode))
				{
					$x_perr = "";
					$max_per = $get_periode[0];
					foreach ($get_periode as $key => $value) {
						$x_perr .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
					$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$max_per['PER_KD']);
				}
				// $m = array('dd_bulan' => $x_berr, 'dd_periode' => $x_perr, 'get_jadwal' => $get_jadwal, 'kd_menu' => 'terisi');
				$m = array('dd_ta' => $x_ta, 'dd_bulan' => $x_berr, 'dd_periode' => $x_perr, 'get_jadwal' => $get_jadwal, 'kd_menu' => 'jadwal');
				$this->output69->output_display('sertifikasi/operator/view_jadwal_terisi',$m);
				//print_r($max_per);
			endif;
		}
	}	

	function jadwalditawarkan($value='')
	{
		$get_jadwal = $this->lib_basic->get_jadwal('tawar','sr_en');
		$m = array('get_jadwal' => $get_jadwal);
		$this->output69->output_display('sertifikasi/operator/view_jadwalditawarkan',$m);
	}

	function nilai($kd_per='',$kd_jad=null)
	{
		if(!empty($kd_per))
		{
			if(strpos($kd_per,'det') !== false){
				$kd_jad = explode("-", $kd_per);
				$get_jad_detail = $this->lib_basic->get_jadwal('jad_detail',$kd_jad[1]);
				$get_peserta = $this->lib_basic->select('T_PRED','PRE_PIN ASC',array('PREJ_KD' => $kd_jad[1]));
				if ($get_peserta){
					foreach($get_peserta as $key => $value):
						$xx = $value;
						$api_mhs = ($this->lib_basic->get_data_reg($value['PRE_USER']));
							if($api_mhs){
							foreach ($api_mhs as $key => $value){
								$dt = $value;
								$data[] = array_merge($dt,$xx);
							}
						}else{ $data[] = array_merge(array('NIM' => $value['PRE_USER'],'NAMA_F' => '-'),$xx); }
						$data_mhs = $data;
					endforeach;
				} else{ $data_mhs = null;}

				$m = array('get_jadwal' => $get_jad_detail, 'get_peserta' => $data_mhs, 'kd_jad'=> $kd_jad[1], 'kd_menu' => 'nilai');
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_detail_nilai',$m);
			}
			else{
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$kd_per);
				$m = array('get_jadwal' => $get_jadwal, 'kd_menu' => 'nilai');
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_terisi',$m);
			}
		}
		else{
			if($this->input->post('op') == 'tarr'):
				#menampilkan bulan
				$xx2 = '<option value="xx">Pilih Bulan</option>';
				$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$this->input->post('kd'));
				if($get_bulan){
					foreach ($get_bulan as $key => $value) {
						$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
				}
				echo $xx2;

			elseif($this->input->post('op') == 'berr'):
				#menampilkan periode
				$xx3 = '<option value="xx">Pilih Periode</option>';
				$val = explode("-", $this->input->post('kd'));
				$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				if($get_periode)
				{
					foreach ($get_periode as $key => $value) {
						$xx3 .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
				}
				#$m = array('dd_perr' => $x_perr, 'perr' => $get_periode[0]['PER_KD']);
				#echo json_encode($m);
				echo $xx3;
			elseif($this->input->post('op') == 'saveNilai'):
				$user = $this->input->post('user');

				$xxx = '';
 				foreach($user as $key => $value)
				{
					$word =  str_replace(',','.',$value['NIL_W']);
					$excel = str_replace(',','.',$value['NIL_E']);
					$ppt = str_replace(',','.',$value['NIL_P']);
					$inet = str_replace(',','.',$value['NIL_I']);
					$total = (floatval($value['NIL_W']) + floatval($value['NIL_E']) + floatval($value['NIL_P']) + floatval($value['NIL_I'])) / floatval(4);
					$arr = array(
							'NIL_W' => floatval($word),
							'NIL_E' => floatval($excel),
							'NIL_P' => floatval($ppt),
							'NIL_I' => floatval($inet),
							'NIL_ANGKA' => round($total),
							'NIL_HURUF' => "-",
							'PRE_URUT' => $value['URUT'],
							);
					$aksi = $this->lib_basic->update('T_PRED',$arr,array('PRE_PIN' => $key));
					// $aksi = true;
					if($aksi == FALSE) {
						$xxx .= "<li>Nilai peserta no urut ".$value['URUT']." GAGAL di-update.</li>";
					}
				}
				$msg = ($xxx == '')? '<div class="bs-callout bs-callout-success">Nilai BERHASIL di-update.</div>' : '<div class="bs-callout bs-callout-error"><ul>'.$xxx.'</ul></div>';
				echo $msg;				
				//print_r($user);
			elseif($this->input->post('op') == 'det_terisi'):
				$this->jadwal($this->input->post('perr'),$this->input->post('kd'));
			else:
				$x_ta = '<option value="xx">Pilih Bulan</option>';
				$x_berr = '<option value="xx">Pilih Bulan</option>';
				$x_perr = '<option value="xx">Pilih Periode</option>';
				
				$get_jadwal = '';
				$get_ta = $this->lib_basic->get_periode('thn');
				if($get_ta)
				{
					$x_ta = "";
					$max_ta = max($get_ta);
					foreach($get_ta as $key_ta => $value_ta)
					{
						$x_ta .= '<option value="'.$value_ta['TAHUN'].'">'.$value_ta['TAHUN'].'</option>';
					}
					$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$max_ta['TAHUN']);					
				}
				
				if(isset($get_bulan))
				{
					$x_berr = "";
					$max_bln = max($get_bulan);
					$val = explode("-", $max_bln['BLN_FULL']);
					foreach ($get_bulan as $key => $value) {
						$x_berr .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
					$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				}

				if(isset($get_periode))
				{
					$x_perr = "";
					$max_per = $get_periode[0];
					foreach ($get_periode as $key => $value) {
						$x_perr .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
					//$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$max_per['PER_KD']);
				}
				$m = array('dd_ta' => $x_ta, 'dd_bulan' => $x_berr, 'dd_periode' => $x_perr, 'kd_per'=> $max_per['PER_KD'], 'kd_menu' => 'nilai');
				$this->output69->output_display('sertifikasi/operator/view_lihatnilai',$m);
				//print_r($max_per);
			endif;
		}
	}

	function lihatnilai($kd_per='',$kd_jad=null)
	{
		if(!empty($kd_per))
		{
			if(strpos($kd_per,'det') !== false){
				$kd_jad = explode("-", $kd_per);
				$get_jad_detail = $this->lib_basic->get_jadwal('jad_detail',$kd_jad[1]);
				$get_peserta = $this->lib_basic->select('T_PRED','PRE_PIN ASC',array('PREJ_KD' => $kd_jad[1]));
				if ($get_peserta){
					foreach($get_peserta as $key => $value):
						$xx = $value;
						$api_mhs = ($this->lib_basic->get_data_reg($value['PRE_USER']));
						if($api_mhs){
							foreach ($api_mhs as $key => $value){
								$dt = $value;
								$data[] = array_merge($dt,$xx);
							}
						}else{ $data[] = array_merge(array('NIM' => $value['PRE_USER'],'NAMA_F' => '-'),$xx); }
							
						$data_mhs = $data;
					endforeach;
				} else{ $data_mhs = null;}

				$m = array('get_jadwal' => $get_jad_detail, 'get_peserta' => $data_mhs, 'kd_jad'=> $kd_jad[1], 'kd_menu' => 'lihatnilai');
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_detail_nilai',$m);
			}
			else{
				$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$kd_per);
				$m = array('get_jadwal' => $get_jadwal, 'kd_menu' => 'lihatnilai');
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_terisi',$m);
			}
		}
		else{
			if($this->input->post('op') == 'tarr'):
				#menampilkan bulan
				$xx2 = '<option value="xx">Pilih Bulan</option>';
				$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$this->input->post('kd'));
				if($get_bulan){
					foreach ($get_bulan as $key => $value) {
						$xx2 .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
				}
				echo $xx2;

			elseif($this->input->post('op') == 'berr'):
				#menampilkan periode
				$xx3 = '<option value="xx">Pilih Periode</option>';
				$val = explode("-", $this->input->post('kd'));
				$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				if($get_periode)
				{
					foreach ($get_periode as $key => $value) {
						$xx3 .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
				}
				#$m = array('dd_perr' => $x_perr, 'perr' => $get_periode[0]['PER_KD']);
				#echo json_encode($m);
				echo $xx3;
			elseif($this->input->post('op') == 'det_terisi'):
				$this->jadwal($this->input->post('perr'),$this->input->post('kd'));
			else:
				$x_ta = '<option value="xx">Pilih Bulan</option>';
				$x_berr = '<option value="xx">Pilih Bulan</option>';
				$x_perr = '<option value="xx">Pilih Periode</option>';
				$get_jadwal = '';
				$get_ta = $this->lib_basic->get_periode('thn');
				if($get_ta)
				{
					$x_ta = "";
					$max_ta = max($get_ta);
					foreach($get_ta as $key_ta => $value_ta)
					{
						$x_ta .= '<option value="'.$value_ta['TAHUN'].'">'.$value_ta['TAHUN'].'</option>';
					}
					$get_bulan = $this->lib_basic->get_periode('bln_thn','sr_en',$max_ta['TAHUN']);						
				}
				
				if(isset($get_bulan))
				{
					$x_berr = "";
					$max_bln = max($get_bulan);
					$val = explode("-", $max_bln['BLN_FULL']);
					foreach ($get_bulan as $key => $value) {
						$x_berr .= '<option value="'.$value['BLN_FULL'].'">'.$this->lib_basic->mm_to_month($value['BLN']).'</option>';
					}
					$get_periode = $this->lib_basic->get_periode('tgl_thnbln','sr_en',$val[0],$val[1]);
				}

				if(isset($get_periode))
				{
					$x_perr = "";
					$max_per = $get_periode[0];
					foreach ($get_periode as $key => $value) {
						$x_perr .= '<option value="'.$value['PER_KD'].'">'.$value['PER_NM'].', '.$value['PER_BULAN'].' ('.$value['NM_TAWAR'].')</option>';
					}
					//$get_jadwal = $this->lib_basic->get_jadwal('jad_terisi',$max_per['PER_KD']);
				}
				$m = array('dd_ta' => $x_ta, 'dd_bulan' => $x_berr, 'dd_periode' => $x_perr, 'kd_per'=> $max_per['PER_KD'], 'kd_menu' => 'lihatnilai');
				$this->output69->output_display('sertifikasi/operator/view_lihatnilai',$m);
				//print_r($max_per);
			endif;
		}
	}	
	
	function cetaksertifikat()
	{
		/*
			search nim -> histori jadwal
			tampilkan semua jadwal yg pernah diambil
			kasih button cetak
		*/
		if($this->input->post('op') == 'search'):
			$b_cet = 1;
			$nim = $this->input->post('nim');
			$get_jadwal = $this->lib_basic->get_jadwal('jad_diambil','semua','sr_en',$nim);
			$data_mhs = $this->lib_basic->get_data_reg($nim);
			
			foreach ($get_jadwal as $key => $value) {
				if ($value['NIL_ANGKA'] == '0'){
					$msg_cetak = '';
					$b_cet = 0;
					$msg_cetak .= "- Nilai belum ada, silakan hubungi Petugas Input Nilai.<br>";
				}
				//bisa dicetak
				if($b_cet){
					$dt_cet = $this->lib_basic->select('T_BANYCET','BC_KD ASC',array('PRE_USER' => $value['PRE_USER']));
					if($dt_cet){
						$msg_cetak = '';
						$hist_cetak = '';
						foreach ($dt_cet as $key_cet => $value_cet) {
							$hist_cetak .= '<li>Cetak ke-'.$value_cet['BC_KE'].' Tanggal: '.date('d/m/Y H:i:s',$value_cet['BC_TGL']).'</li>';
						}
						$msg_cetak .= "&nbsp&nbsp&nbsp Cetak ke- ";
						$max_cetak = max(array_values($dt_cet));
						$max_cetak_ke = $max_cetak['BC_KE'];
						$cetak_ke = (int)$max_cetak_ke + (int)1;

						$msg_cetak .= "<select name='kerr' class=''>";
						$msg_cetak .= "<option value ='$cetak_ke'>$cetak_ke</option>";
						$msg_cetak .= "<option value ='$max_cetak_ke'>$max_cetak_ke</option>";
						$msg_cetak .= "</select>";
						$msg_cetak .= " Tanggal: ".date('d/m/Y').", Keterangan: <input type='text' class=''>";
						$msg_cetak .= " <button style='margin-bottom:10px;' class='btn btn-small btn-inverse'><i class='icon-white icon-print'></i> Cetak Sertifikat</button>";					
					
					}else{
						$cetak_ke = 1;
						$msg_cetak = '';
						$hist_cetak = '';
						$msg_cetak .= "&nbsp&nbsp&nbsp Cetak ke ";
						$msg_cetak .= "<select name='kerr' class=''>";
						$msg_cetak .= "<option value ='$cetak_ke'>$cetak_ke</option>";
						$msg_cetak .= "</select>";
						$msg_cetak .= " Tanggal: ".date('d/m/Y').", Keterangan: <input type='text' class=''>";
						$msg_cetak .= " <button style='margin-bottom:10px;' class='btn btn-small btn-inverse'><i class='icon-white icon-print'></i> Cetak Sertifikat</button>";
					}
				}
				$get_jadwal[$key]['hist_cetak'] = $hist_cetak;
				$get_jadwal[$key]['msg_cetak'] = $msg_cetak;
			}
			if($data_mhs){
				$m = array('get_jadwal' => $get_jadwal,'data_mhs' => $data_mhs[0],'kd_menu' => 'cetak');
				//print_r($m); die();
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_diambil_2',$m);
			}else echo "<h2>Data tidak ditemukan.</h2>";
		else:
			$m = array();
			$this->output69->output_display('sertifikasi/operator/view_cetaksertifikat',$m);
		endif;
	}

	function historipeserta()
	{
		if($this->input->post('op') == 'search'):
			$nim = $this->input->post('nim');
			$get_jadwal = $this->lib_basic->get_jadwal('jad_diambil','semua','sr_en',$nim);
			$data_mhs = $this->lib_basic->get_data_reg($nim);
			if($data_mhs){
				$m = array('get_jadwal' => $get_jadwal,'data_mhs' => $data_mhs[0]);
				$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_diambil',$m);
			}else echo "<h2>Data tidak ditemukan.</h2>";
		else:
			$m = array();
			$this->output69->output_display('sertifikasi/operator/view_historipeserta',$m);
		endif;
	}
	
	function api_curl($modul="",$postdata=""){
			$this->load->library('curl');
			$postorget 	= 'POST';
			$api_url="http://service.uin-suka.ac.id/servweb/index.php/it/".$modul;
			$hasil = $this->curl->simple_get($api_url);
			$nilai=json_decode($hasil);
			return $nilai;
	}
   
     

}
 
/* End of file berita.php */
