<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: Wihikan Mawi Wijna_
	Created		: 17:02 18 November 2013 

	s02			: sia "kamar" 00, (s00, s01, s02, ..., s99)
	lib			: ct = controller, vw = view, mdl = model, lib = library
	menu		: unique name {sesuai fungsi utama controller/view/model/library ini}
*/
class S00_lib_sh_menu {

	#protected $crumbs = array(array($this->get_url_link	=> base_url($this->get_url_link)));
	
	var $url_prefix = '.html';
	var $url_link 	= 'xorang';
	
	public function get_url_prefix(){
		return $this->url_prefix;
	}
	
	public function get_url_link(){
		return $this->url_link;
	}
	
	public function set_var($namevar, $valvar){
		$this->$namevar = $valvar;
	}
	
	public function build_url($link = '', $cust_link = ''){
		if($cust_link != ''){ $c01 = $cust_link; } else { $c01 = $this->get_url_link(); }
		
		if(trim($link) != ''){
		return $c01.'/'.$link.$this->get_url_prefix(); 
		} else {
		return $c01;
		}
	}
	
	function build_url_var($id='', $var1 = '', $cust_link = ''){
		$arr_url_var = $this->get_url_var();
		
		if($var1 != ''){ $var1 = '-'.$var1; }
		$url1 = $arr_url_var[$id]; $url1 = explode('#',$url1);
		if($cust_link != ''){
		return $cust_link.'/'.$url1[0].$var1.$this->url_prefix;
		} else {
		return $this->url_link.'/'.$url1[0].$var1.$this->url_prefix;
		}
	}
	
	function build_url_stt($id='', $cust_link = ''){
		$arr_url_stt = $this->get_url_stt();
		
		$url1 = $arr_url_stt[$id]; $url1 = explode('#',$url1);
		if($cust_link != ''){
		return $cust_link.'/'.$url1[0].$this->url_prefix;
		} else {
		return $this->url_link.'/'.$url1[0].$this->url_prefix;
		}
	}
	
	public function get_url_stt(){
		return array(				'mmk1' 	=> 'khs-semester#_0200_khs_semester',
									'mmk2'	=> 'khs-kumulatif#_0200_khs_kumulatif',
									'mmk3'	=> 'ip-sejarah#_0200_ip_sejarah',
									'mmp1'	=> 'presensi-kuliah#_0200_presensi_kuliah',
									'mmp2'	=> 'presensi-ujian#_0200_presensi_ujian',
									'mmp4'	=> 'jadwal-ujian#_0200_jadwal_ujian',
									'mmp3'	=> 'jadwal-kuliah#_0200_jadwal_kuliah',
									'mmi1'	=> 'isikrs-syarat#_0200_krs_input_s01',
									'mmi4'	=> 'isikrs-pilih#_0200_krs_input_s02',
									'mmi2'	=> 'krssemua-lihat#_0200_krs_output',
									'mmi3'	=> 'krspendek-input#_0250_init_smt_pendek',
									'mm99'	=> 'krs-cetak#_0225_krs_cetak',
									'mmb0'	=> ' #x',
									'mmb1'	=> 'pembayaran-riwayat#_0200_uang_bayar',
									'mmb2'	=> 'tagihan-riwayat#_0200_uang_tagih',
									'mmb3'	=> 'bayar25#_0200_uang_awal',
									'mmb4'	=> 'mahasiswa#_0200_uang_awal',
									'mmb5'	=> 'wali#_0200_uang_awal',
									'mmb6'	=> 'syarat-pembayaran#_0200_uang_syarat',
									'mmu1'	=> 'pembaruan-biodata#_0200_biodata_update',
									'mmIK'	=> 'cek-ikd#_0224_ikd_cek',
									'mmkk'	=> 'matakuliah-kurikulum#_0200_kurikulum_mk',
									'mmds'	=> 'dosenprodi-daftar#_0200_dosenprodi',
									'm404'	=> 'error#_0200_error_404',
									
									'md01' 	=> 'pembimbingan#_0300_bimbing_daftar',
									'md02'	=> 'kepenasihatan-krs#_0300_perwalian_daftar',
									'md03'	=> 'jadwal-kuliah#_0300_jadwal_kuliah',
									'md04'	=> 'jadwal-ujian#_0300_jadwal_ujian',
									'md05'	=> 'presensiinput-daftar#_0300_presensi_input_daftar',
									'md06'	=> 'nilaiinput-daftar#_0300_nilai_daftar',
									'md07'	=> 'soalinput-daftar#_0300_soal_daftar',
									'mdkk'	=> 'matakuliah-kurikulum#_0300_kurikulum_mk',
									'mdds'	=> 'dosenprodi-daftar#_0300_dosenprodi',
									'tdxx'	=> 'presensi-input2#_0305_presensi_daftar',
									'mdx9'	=> 'error#_0300_error_404',
									
									'max9'	=> 'error#_0400_error_404',
									'mab0'	=> 'admberita-utama#_0400_berita_daftar#1',
									'mab1'	=> 'admberita-arsipliputan#_0400_berita_daftar#1',
									'mab2'	=> 'admberita-arsippengumuman#_0400_berita_daftar#2',
									'mab3'	=> 'admberita-arsipberita#_0400_berita_daftar#3',
									'mab4'	=> 'admberita-arsipagenda#_0400_berita_daftar#4',
									'mab5'	=> 'admberita-arsipkolom#_0400_berita_daftar#5',
									
									'm0b1'	=> 'awal-kalender-akademik#n101_inf_kalender',
									'm0b2'	=> 'awal-matakuliah-dosen#n101_inf_mkdosen',
									'm0b3'	=> 'awal-petunjuk-pembayaran#n101_inf_bayar',
									'm0b4'	=> 'awal-daftar-dosenprodi#n101_inf_mkdosen_dosendaftar',
									'm0b5'	=> 'awal-daftar-matkulprodi#n101_inf_mkdosen_matkuldaftar',
									'maaa'	=> ' #x',
									
									'm0c1'	=> 'liputan-arsip/#_0000_berita_post',
									'm0c2'	=> 'pengumuman-arsip/#_0000_berita_post',
									'm0c3'	=> 'berita-arsip/#_0000_berita_post',
									'm0c4'	=> 'agenda-arsip/#_0000_berita_post',
									'm0c5'	=> 'kolom-arsip/#_0000_berita_post',
									
									'm0201'	=> 'menu-satu', #sigit
									
									
									);
	}
	
		//URL for page with varible
	public function get_url_var(){	
		return array(				'vmk1' 	=> 'krsnormal-hapus#_0295_krs_hapus',
									'vmk2' 	=> 'krsnormal-ambil#_0295_krs_ambil',
									'vmk3' 	=> 'krspendek-hapus#_0295_smt_pendek_hapus',
									'vmk4' 	=> 'krspendek-ambil#_0295_smt_pendek_ambil',
									'vmk5' 	=> 'krsmatkul-aksi#_0295_krs_input_aksi',
									'vmn1' 	=> 'kknpendek-hapus#_0295_sp_kkn_hapus',
									'vmn1' 	=> 'kknpendek-ambil#_0295_sp_kkn_ambil',
									'vmp1' 	=> 'presensikuliah-detil#_0200_presensi_kuliah_detil',
									'vmp2' 	=> 'presensiujian-detil#_0200_presensi_ujian_detil',
									'vmb1' 	=> 'pembayaran-detil#_0200_uang_bayar_detil',
									'vmb2' 	=> 'tagihan-detil#_0200_uang_tagih_detil',
									'vmmk' 	=> 'matakuliah-detil#_0200_kurikulum_mk_detil',
									'vmds'	=> 'dosenprodi-detil#_0200_dosenprodi_detil',
									'vmdp'	=> 'dosenprodi-prodi#_0200_dosenprodi_prodi',
									
									'vm99'	=> 'coba-coba#_0200_tester',
									
									'v0ds'	=> 'awal-detil-dosenprodi#n101_inf_mkdosen_dosendetil',
									'v0ds'	=> 'awal-detil-dosenprodi#n101_inf_mkdosen_dosendetil',
									'v0mk'	=> 'awal-detil-matkulprodi#n101_inf_mkdosen_matkuldetil',
									
									'vdm1' 	=> 'mhs-kuliahdaftar#_0300_bimbing_pres_kuliah_daftar',
									'vdm2' 	=> 'mhs-kuliahdetil#_0300_bimbing_pres_kuliah_detil',
									'vdm3' 	=> 'mhs-ujiandaftar#_0300_bimbing_pres_ujian_daftar',
									'vdm4' 	=> 'mhs-ujiandetil#_0300_bimbing_pres_ujian_detil',
									'vdm5' 	=> 'mhs-bayardaftar#_0300_bimbing_bayar_daftar',
									'vdm6' 	=> 'mhs-bayardetil#_0300_bimbing_bayar_detil',
									'vdm7' 	=> 'mhs-tagihdaftar#_0300_bimbing_tagih_daftar',
									'vdm8' 	=> 'mhs-tagihdetil#_0300_bimbing_tagih_detil',
									
									'vdr1' 	=> 'rekap-presensikelas#_0300_jadwal_kuliah_pres_umum',
									'vdr2' 	=> 'rekap-presensitatap#_0300_jadwal_kuliah_pres_tatap',
									'vdr3' 	=> 'rekap-presensimhs#_0300_jadwal_kuliah_pres_mhs',
									'vdr4' 	=> 'rekap-presensiujian#_0300_jadwal_ujian_pres_umum',									
									'vdb1' 	=> 'mhs-biodata#_0300_bimbing_bio',
									'vdb2' 	=> 'mhs-krs#_0300_bimbing_krs',
									
									'vdw1' 	=> 'kepenasihatan-krslihat#_0300_perwalian_krs',
									'vdxx' 	=> 'kepenasihatan-000#_0300_perwalian_krs2',
									'vdw2' 	=> 'kepenasihatan-krsanulir#_0395_perwalian_000_relarang',
									'vdw3' 	=> 'kepenasihatan-krshapus#_0395_perwalian_000_rehapus',
									'vdw4' 	=> 'kepenasihatan-saranambil#_0395_perwalian_saran',
									'vdw5' 	=> 'kepenasihatan-saranhapus#_0395_perwalian_saran_hapus',
									'vdw6' 	=> 'kepenasihatan-cetak#_0300_perwalian_cetak',
									
									'vdp1' 	=> 'presensiinput-kelas#_0300_presensi_input_kelas',
									'vdp2' 	=> 'presensiinput-ubah#_0300_presensi_input_ubah',
									'vdp3' 	=> 'presensi-detil#_0300_presensi_detil',
																		
									'vdn1' 	=> 'nilaiinput-ubah#_0300_nilai_unduh',
									'vdn2' 	=> 'nilaiinput-lihat#_0300_nilai_mahasiswa',
									'vdn3' 	=> 'soalinput-ubah#_0300_soal_unduh',
									'vdn4' 	=> 'soalinput-lihat#_0300_soal_mahasiswa',
																		
									#'vdd1'	=> 'dsdsds301-131313#_0300_sessionid',
									'vmd1'	=> 'mhmhmh200-242424#_0200_sessionid',
									
									'v0c0'	=> 'x#y',
									'vdmk' 	=> 'matakuliah-detil#_0300_kurikulum_mk_detil',
									'vdds'	=> 'dosenprodi-detil#_0300_dosenprodi_detil',
									'vddp'	=> 'dosenprodi-prodi#_0300_dosenprodi_prodi',
									
									'vab0'	=> 'admberita-baru#_0400_berita_ubahhapus',
									'vab1'	=> 'admberita-ubah#_0400_berita_ubahhapus',
									'vab2'	=> 'admberita-hapus#_0400_berita_ubahhapus',
									
									'v0b9'	=> 'feed-rss/#_0000_berita_post',
									'v0b0'	=> 'liputan-detil/#_0000_berita_post',
									'v0b1'	=> 'berita-detil/#_0000_berita_post',
									'v0b2'	=> 'agenda-detil/#_0000_berita_post',
									'v0b3'	=> 'kolom-detil/#_0000_berita_post',
									'v0b10'	=> 'pengumuman-detil/#_0000_berita_post',
									
									'v0b4'	=> 'liputan-arsip/#_0000_berita_post',
									'v0b5'	=> 'pengumuman-arsip/#_0000_berita_post',
									'v0b6'	=> 'berita-arsip/#_0000_berita_post',
									'v0b7'	=> 'agenda-arsip/#_0000_berita_post',
									'v0b8'	=> 'kolom-arsip/#_0000_berita_post',
									
									'v0ba' 	=> 'awal-matakuliah-detil#_0000_berita_postx',
									'v0bb'	=> 'awal-dosenprodi-detil#_0000_berita_postx',								
									);
	}	
		
		//Page name for URL
	public function get_mnu_stt(){	
		return array( 				
									'mmi3'	=> 'Input KRS Semester Pendek',
									'mm99'	=> 'Lihat KRS Semester Pendek',
									'mmk1'	=> 'KHS Semester',
									'mmk2'	=> 'KHS Kumulatif',
									'mmk3'	=> 'Sejarah IP',
									'mmp1'	=> 'Presensi Kuliah',
									'mmp2'	=> 'Presensi Ujian',
									'mmp3'	=> 'Jadwal Kuliah',
									'mmp4'	=> 'Jadwal Ujian',
									
									'mmi1'	=> 'Isi KRS',
									'mmi4'	=> 'Isi KRS',
									'mmi2'	=> 'Lihat KRS',
									'mmb0'	=> 'Pembayaran',
									'mmb1'	=> 'Riwayat Pembayaran',
									'mmb2'	=> 'Tagihan Pembayaran',
									'mmb3'	=> 'Pembayaran',
									'mmb4'	=> 'Pembayaran',
									'mmb5'	=> 'Pembayaran',
									'mmb6'	=> 'Syarat Pembayaran',
									'mm02'	=> 'Mahasiswa',
									'mm05'	=> 'Wali',
									'mmkk'	=> 'Mata Kuliah',
									'mmds'	=> 'Dosen',
									
									'md01'	=> 'Pembimbingan',
									'md02'	=> 'Kepenasihatan KRS',
									'md03'	=> 'Jadwal Kuliah Dosen',
									'md04'	=> 'Jadwal Ujian Dosen',
									'md05'	=> 'Isi Presensi MK Dosen',
									'md06'	=> 'Isi Nilai MK Dosen',
									'md07'	=> 'Isi Soal Ujian Dosen',
									'mdkk'	=> 'Mata Kuliah',
									'mdds'	=> 'Dosen',
									'mmu1'	=> 'Pembaruan Data Diri',
									
									'mab0'	=> 'Admin Informasi',
									'mab1'	=> 'Liputan',
									'mab2'	=> 'Pengumuman',
									'mab3'	=> 'Berita',
									'mab4'	=> 'Agenda',
									'mab5'	=> 'Kolom',
									'maaa'	=> 'Beranda',
									
									'm0c1'	=> 'Liputan',
									'm0c2'	=> 'Pengumuman',
									'm0c3'	=> 'Berita',
									'm0c4'	=> 'Agenda',
									'm0c5'	=> 'Kolom',
									
									'm0201' => 'Menu 1', #sigit
									
								);
	}
	
	public function get_mnu_var(){	
		return array( 				'vdm1' 	=> 'Presensi Kuliah Mahasiswa',
									'vdm2' 	=> 'Presensi Kuliah Mahasiswa',
									'vdm3' 	=> 'Presensi Ujian Mahasiswa',
									'vdm4' 	=> 'Presensi Ujian Mahasiswa',
									'vdm5' 	=> 'Riwayat Pembayaran Mahasiswa',
									'vdm6' 	=> 'Riwayat Pembayaran Mahasiswa',
									'vdm7' 	=> 'Riwayat Tagihan Mahasiswa',
									'vdm8' 	=> 'Riwayat Tagihan Mahasiswa',
									
									'vdr1' 	=> 'rkp-presensikelas',
									'vdr2' 	=> 'rkp-presensitatap',
									'vdr3' 	=> 'rkp-presensimhs',
																		
									'vdb1' 	=> 'Biodata Mahasiswa',
									'vdb2' 	=> 'Prestasi Akademik Mahasiswa',
									
									'vdw1' 	=> 'Kepenasihatan KRS',
									'vdw2' 	=> 'penasihat-krsanulir',
									'vdw3' 	=> 'penasihat-krshapus',
									'vdw4' 	=> 'penasihat-saranambil',
									'vdw5' 	=> 'penasihat-saranhapus',
									'vdw6' 	=> 'penasihat-cetak',
									
									'vdp1' 	=> 'presensi-kuliah',
									'vdp2' 	=> 'presensi-lihat',
									'vdp3' 	=> 'presensi-detil',
																		
									'vdn1' 	=> 'nilai-input',
									'vdn2' 	=> 'nilai-lihat',
									
								);
	}
	
	public function get_ttt_stt($vteks = ''){	
		return array(
				'maaa'	=> 'Beranda',
				'mmi3'	=> 'Input mata kuliah KRS semester pendek untuk '.$vteks,
				'mm99'	=> 'Daftar KRS semester pendek untuk '.$vteks,
				'mmk1'	=> 'Lihat dan cetak KHS per semester untuk '.$vteks,
				'mmk2'	=> 'Lihat dan cetak KHS kumulatif untuk '.$vteks,
				'mmk3'	=> 'Lihat dan cetak sejarah perolehan IP untuk '.$vteks,
				'mmp3'	=> 'Lihat dan cetak jadwal kuliah untuk '.$vteks,
				'mmp4'	=> 'Lihat dan cetak jadwal ujian untuk '.$vteks,
				'mmp1'	=> 'Lihat dan cetak presensi perkuliahan untuk '.$vteks,
				
				'mmi1'	=> 'Isi mata kuliah ke dalam KRS untuk '.$vteks,
				'mmi4'	=> 'Isi mata kuliah ke dalam KRS untuk '.$vteks,
				'mmi2'	=> 'Lihat dan cetak KRS semester untuk '.$vteks,
				'mmb6'	=> 'Lihat syarat pembayaran untuk '.$vteks,
				'mmb1'	=> 'Lihat riwayat pembayaran untuk '.$vteks,
				'mmb2'	=> 'Lihat riwayat tagihan untuk '.$vteks,
				'mm02'	=> 'Halaman utama mahasiswa',
				'mm05'	=> 'Halaman utama wali',
				'mmp2'	=> 'Lihat dan cetak presensi ujian untuk '.$vteks,
				'mmkk'	=> 'Lihat daftar mata kuliah kurikulum prodi '.$vteks,
				'mmds'	=> 'Lihat daftar dosen prodi '.$vteks,
				
				'md03'	=> 'Lihat dan cetak jadwal kelas perkuliahan yang diampu oleh dosen '.$vteks,
				'md04'	=> 'Lihat dan cetak jadwal ujian kelas perkuliahan yang diampu oleh dosen '.$vteks,
				'md06'	=> 'Isi nilai mata kuliah yang diampu oleh dosen '.$vteks,
				'md07'	=> 'Isi soal ujian mata kuliah yang diampu oleh dosen '.$vteks,
				'md05'	=> 'Isi presensi kelas perkuliahan yang diampu oleh dosen '.$vteks,
				'md02'	=> 'Kepenasihatan KRS untuk mahasiswa bimbingan '.$vteks,
				'md01'	=> 'Pembimbingan akademik untuk mahasiswa bimbingan '.$vteks,
				'mdkk'	=> 'Lihat daftar mata kuliah kurikulum prodi '.$vteks,
				'mdds'	=> 'Lihat daftar dosen prodi '.$vteks,
				
				'mab0'	=> 'Tambah, ubah, atau hapus informasi',
				'mab1'	=> 'Tambah, ubah, atau hapus informasi pada halaman akademik yang berjenis liputan',
				'mab2'	=> 'Tambah, ubah, atau hapus informasi pada halaman akademik yang berjenis pengumuman',
				'mab3'	=> 'Tambah, ubah, atau hapus informasi pada halaman akademik yang berjenis berita',
				'mab4'	=> 'Tambah, ubah, atau hapus informasi pada halaman akademik yang berjenis agenda',
				'mab5'	=> 'Tambah, ubah, atau hapus informasi pada halaman akademik yang berjenis kolom',
				
				'm0201' => 'Menu Satu Calon Mahasiswa S1 D3', #sigit
			);
	}
		
	public function build_sidebar($id = '', $v_nama = ''){
		$var_ustt 	= $this->get_url_stt();
		$var_mstt 	= $this->get_mnu_stt();
		$var_link	= $this->get_url_link();
		$var_prfx	= $this->get_url_prefix();
		$var_tttt	= $this->get_ttt_stt($v_nama);
		
		$link = explode('#',$var_ustt[$id]); 
		$link = $link[0];
		$link = $var_link.'/'.$link.$var_prfx;
		echo '<li class="submenu">'.anchor($link, $var_mstt[$id], 'title="'.$var_tttt[$id].'"').'</li>';	
	}
	
	public function build_sidebar_custom($path, $prefix = '.html', $id = '', $v_nama = ''){
		$var_ustt 	= $this->get_url_stt();
		$var_mstt 	= $this->get_mnu_stt();
		$var_link	= $path;
		$var_prfx	= $prefix;
		$var_tttt	= $this->get_ttt_stt($v_nama);
		
		$link = explode('#',$var_ustt[$id]); 
		$link = $link[0];
		$link = $var_link.'/'.$link.$var_prfx;
		echo '<li class="submenu">'.anchor($link, $var_mstt[$id], 'title="'.$var_tttt[$id].'"').'</li>';	
	}
	
	public function get_url_crumbs(){
		$arr 	= array();
		$arr1 	= array($this->get_url_link() => '');

		return array(array('Perkuliahan'	=> $this->get_url_link()));
	}
	
	public function build_crumbs($menuid = array(), $reset = false){
		$var_mstt 	= $this->get_mnu_stt();
		$var_ustt 	= $this->get_url_stt();
		$var_mvar 	= $this->get_mnu_var();
		$var_uvar 	= $this->get_url_var();
		
		if(!$reset){ $crumbs = $this->get_url_crumbs(); } else { $crumbs = array(); }
		
		foreach($menuid as $mid1){
			$temp = array();
			
			if (is_array($mid1)){ //array('vm1','XXCXXCXX', 'pembayaran')
				if(substr($mid1[0],0,1) == 'v'){
				$link = explode('#',$var_uvar[$mid1[0]]); 
				} else {
				$link = explode('#',$var_ustt[$mid1[0]]); 
				}
				if($mid1[1] != ''){ $cr1 = $link[0].'-'.$mid1[1]; } else { $cr1 = $link[0]; }
				if(isset($mid1[2])){ $cr2 = $this->build_url($cr1, $mid1[2]); } else { $cr2 = $this->build_url($cr1); }
				if(substr($mid1[0],0,1) == 'v'){
				$temp[$var_mvar[$mid1[0]]] = $cr2;
				} else {
				$temp[$var_mstt[$mid1[0]]] = $cr2;
				}
				unset($link);	
			} else { //m01
				$link = explode('#',$var_ustt[$mid1]); 
				$temp[$var_mstt[$mid1]] = $this->build_url($link[0]);
				unset($link);
			}
			
			/* $link = explode('#',$var_ustt[$mid1]); 
			$temp[$var_mstt[$mid1]] = $this->build_url($link[0]);
			unset($link);*/
			$crumbs[] = $temp; 
		}
		return $crumbs;
	}
	
	
	
}
