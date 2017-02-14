<?php 
/*ADMINLAPORAN PMB SIDEBAR */
if($this->session->userdata('status') == 'staff'){ 
	#if($this->session->userdata('id_user') == '199111280000001101'): 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(2)));
		$buka = ($data[0] == 'admlaporan')? 'buka' :'';
/*
AAZFXX, XX isinya 01 sampai 09
01:adab
02:dakwah
dst..
09:
*/
	$cek_jabatan = $this->session->userdata('jabatan');
	$status = explode('#', $cek_jabatan);
	// echo $cek_jabatan;
	$menu1='<li class="submenu">'.anchor('adminpmb/admlaporan-informasi_ruang_ujian', 'Informasi Ruang Ujian', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('adminpmb/admlaporan-statistik_peminat_perprodi', 'Statistik Peminat Per Prodi', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('adminpmb/admlaporan-data_pendaftar', 'Data Pendaftar', 'title=""').'</li>';
	$menu4='<li class="submenu">'.anchor('adminpmb/admlaporan-statistik_pendaftar', 'Statistik Pendaftar', 'title=""').'</li>';
	$menu5='<li class="submenu">'.anchor('adminpmb/admlaporan-hasil_kepribadian', 'Hasil Kepribadian', 'title=""').'</li>';
	$menu6='<li class="submenu">'.anchor('adminpmb/admlaporan-placement_test', 'Placement Test', 'title=""').'</li>';
			echo '<li id="li-menu-laporan-admin-pmb" class="item"><a href="#menu-adminlaporan-pmb" class="item"   name="ul-sub1-c"><span>Admin Laporan</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-adminlaporan-pmb" class="'.$buka.'">';
					if(in_array('AAZ001',$status) || in_array('POU001',$status)|| in_array('AAZF09',$status)):
								echo $menu1;
								#echo $menu3;
								echo $menu5;
								echo $menu6;
					endif;
					if(in_array('AAZ001',$status) || in_array('AAZF09',$status)|| in_array('AAZ007',$status)):
								echo $menu3;
								echo $menu2;
								echo $menu4;
					endif;
			echo '</ol></li>'; 
	#endif;
} ?>