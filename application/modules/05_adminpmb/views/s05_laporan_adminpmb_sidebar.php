<?php 
/*LAPORAN PMB TOOL SIDEBAR */
if($this->session->userdata('status') == 'staff'){ 
	#if($this->session->userdata('id_user') == '199111280000001101'): 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(2)));
		#echo $data;
		if($data[0]=='laporan'){
			$buka='buka';
		}else{
			$buka='';
		}
	
/*
AAZFXX, XX isinya 01 sampai 09
01:adab
02:dakwah
dst..
09:
*/
	$cek_jabatan = $this->session->userdata('jabatan');
	$status = explode('#', $cek_jabatan);
	#echo $cek_jabatan;
	$menu1='<li class="submenu">'.anchor('adminpmb/laporan-status_ruangan', 'Status Ruangan', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('adminpmb/laporan-informasi_ruang_ujian', 'Informasi Ruang Ujian', 'title=""').'</li>';
    $menu3='<li class="submenu">'.anchor('adminpmb/laporan-informasi_ruang_ujian_s1d3', 'Informasi Ruang Ujian S1/D3', 'title=""').'</li>';
	$menu4='<li class="submenu">'.anchor('adminpmb/laporan-statistik_peminat_per_prodi', 'Statistik Peminat Per Prodi S2', 'title=""').'</li>';
	$menu5='<li class="submenu">'.anchor('adminpmb/laporan-statistik_peminat_per_prodi_s1d3', 'Statistik Peminat Per Prodi S1/D3', 'title=""').'</li>';
	$menu6='<li class="submenu">'.anchor('adminpmb/laporan-daftar_calon_mahasiswas1d3', 'Daftar Calon Mahasiswa S1/D3', 'title=""').'</li>';
	$menu7='<li class="submenu">'.anchor('adminpmb/laporan-daftar_calon_mahasiswa', 'Daftar Calon Mahasiswa S2', 'title=""').'</li>';
	$menu8='<li class="submenu">'.anchor('adminpmb/laporan-daftar_calon_istri', 'Daftar Calon Istri', 'title=""').'</li>';
	$menu9='<li class="submenu">'.anchor('adminpmb/laporan-statistik_pendaftar', 'Statistik Pendaftar', 'title=""').'</li>';
	$menu10='<li class="submenu">'.anchor('adminpmb/laporan-daftar_peserta_belum_selesai', 'Pendaftar Belum Selesai', 'title=""').'</li>';
	$menu11='<li class="submenu">'.anchor('adminpmb/laporan-data_pendaftar_ln', 'Pendaftar Luar Negeri', 'title=""').'</li>';
			echo '<li id="li-menu-laporan-admin-pmb" class="item"><a href="#menu-laporan-admin-pmb" class="item"   name="ul-sub1-c"><span>Laporan</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-laporan-admin-pmb" class="'.$buka.'">';
					if(in_array('AAZ001',$status)):
								echo $menu1;
								echo $menu6;
								echo $menu7;
								echo $menu8;
					endif;
					if(in_array('AAZ001',$status) || in_array('AAZ004',$status) || in_array('AAZ002',$status ) || in_array('AAZF09',$status )):
								echo $menu2;
								echo $menu4;
					endif;
					
					if(in_array('AAZ001',$status) || in_array('AAZ002',$status) || in_array('AAZ003',$status) || in_array('POU002',$status) ):
								echo $menu3;
								echo $menu5;
								echo $menu10;
								
					endif;
					if(in_array('AAZ001',$status) || in_array('AAZ003',$status) || in_array('AAZ004',$status) || in_array('AAZ002',$status) || in_array('BKDADM',$status) || in_array('AAZF09',$status) || in_array('AAZF09',$status )):
								echo $menu9;
					endif;
					if(in_array('AAZ001',$status) || in_array('AAZ004',$status)):
								echo $menu11;
					endif;
			echo '</ol></li>'; 
	#endif;
} ?>