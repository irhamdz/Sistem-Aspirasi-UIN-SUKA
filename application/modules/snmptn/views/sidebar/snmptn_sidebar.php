<?php 
if($this->session->userdata('status') == 'staff'){ 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(1)));
		if($data[0]=='snmptn'){
			$buka='buka';
		}else{
			$buka='';
		}
	$cek_jabatan = $this->session->userdata('jabatan');
	$status=$cek_jabatan;
#	$status = explode('#', $cek_jabatan);
	$menu1='<li class="submenu">'.anchor('snmptn/siswa/daftar_siswa', 'Siswa Pendaftar', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/sekolah/daftar_sekolah', 'Daftar Sekolah', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/pilihan/daftar_pilihan', 'Pilihan Program Studi', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/jurusan/daftar_jurusan', 'Daftar Jurusan', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/jurusan_sekolah/daftar_jurusan_sekolah', 'Daftar Jurusan Sekolah', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/kelas/daftar_kelas', 'Daftar Kelas Siswa', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/mata_pelajaran/daftar_mata_pelajaran', 'Daftar Mata Pelajaran', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/nilai_akademik/daftar_nilai_akademik', 'Nilai Akademik', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/prestasi/daftar_prestasi', 'Prestasi Pendukung Akademik', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/riwayat_sbmptn/daftar_riwayat_sbmptn', 'Riwayat SBMPTN', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/riwayat_snmptn/daftar_riwayat_snmptn', 'Riwayat SNMPTN', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/peminat_mandiri/daftar_peminat_mandiri', 'Nilai Peminat Mandiri', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekam_jejak_alumni/daftar_rekam_jejak_alumni', 'Nilai Rekam Jejak Alumni', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/pembobotan', 'Pembobotan', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/penilaian/nilai_akademik', 'Nilai Akademik (Rapor)', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/penilaian/nilai_prestasi', 'Nilai Pendukung Akademik', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/penilaian/nilai_peringkat_sekolah', 'Nilai Peringkat Sekolah', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/penilaian/nilai_yudisium', 'Data Nilai Total', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/yudisium/accepted', 'Siswa Diterima', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('snmptn/rekap/peminat', 'Rekap Peminat', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekap/provinsi', 'Rekap Per Provinsi', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekap/kabupaten', 'Rekap Per Kabupaten', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekap/jenis_kelamin', 'Rekap Jenis Kelamin', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekap/nilai', 'Rekap Nilai', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('snmptn/rekap/diterima', 'Rekap Diterima', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('snmptn/penilaian/nilai_prestasi', 'Nilai Pendukung Akademik', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('snmptn/yudisium', 'Daftar Nilai Peserta', 'title=""').'</li>';
			echo '<li id="li-menu-snmptn" class="item"><a href="#menu-snmptn" class="item"   name="ul-sub1-c"><span>SNMPTN</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-snmptn" class="'.$buka.'">';
					if( in_array('AAZ001',$status)){
						echo $menu1;
					}else if(in_array('AAZ002',$status)){
						echo $menu2;	
					}else if(in_array('AAZ006',$status)){
						echo $menu3;	
					}
			echo '</ol></li>'; 
} ?>