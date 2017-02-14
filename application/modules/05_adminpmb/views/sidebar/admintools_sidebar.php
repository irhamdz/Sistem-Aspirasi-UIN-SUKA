<?php 
/*ADMINTOOLS PMB SIDEBAR */
if($this->session->userdata('status') == 'staff'){ 
	#if($this->session->userdata('id_user') == '199111280000001101'): 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(2)));
		#echo $data;
		if($data[0]=='admtools'){
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
	$menu1='<li class="submenu">'.anchor('adminpmb/admtools-album_ujian', 'Album Ujian', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('adminpmb/admtools-kartu_ujian', 'Kartu Ujian', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('adminpmb/admtools-urut_gedung', 'Urut Gedung', 'title=""').'</li>';
	$menu4='<li class="submenu">'.anchor('adminpmb/admtools-ruang_ujian', 'Ruang Ujian', 'title=""').'</li>';
	$menu5='<li class="submenu">'.anchor('adminpmb/admtools-moco_dat', 'Kelola LJK', 'title=""').'</li>';
	$menu6='<li class="submenu">'.anchor('adminpmb/admtools-form_soal/prosentase', 'Kelola Nilai Tes', 'title=""').'</li>';
	$menu7='<li class="submenu">'.anchor('adminpmb/admtools-status_jalur_masuk', 'Status Jalur Masuk', 'title=""').'</li>';
			echo '<li id="li-menu-tools-admin-pmb" class="item"><a href="#menu-admintools-pmb" class="item"   name="ul-sub1-c"><span>Admin Tools</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-admintools-pmb" class="'.$buka.'">';
					if(in_array('AAZ001',$status) || in_array('AAZ002',$status)):
								echo $menu1;
								echo $menu2;
								echo $menu3;
								echo $menu4;
								echo $menu5;
								echo $menu6;
								echo $menu7;
					endif;
					/*
					if(in_array('AAZ001',$status) || in_array('AAZF09',$status)):
								echo $menu3;
								echo $menu2;
					endif;
					*/
			echo '</ol></li>'; 
	#endif;
} ?>