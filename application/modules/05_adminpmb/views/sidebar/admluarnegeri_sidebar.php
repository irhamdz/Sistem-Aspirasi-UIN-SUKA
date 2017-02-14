<?php 
/*ADMINTOOLS PMB SIDEBAR */
if($this->session->userdata('status') == 'staff'){ 
	#if($this->session->userdata('id_user') == '199111280000001101'): 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(2)));
		#echo $data;
		if($data[0]=='admluarnegeri'){
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
	$menu1='<li class="submenu">'.anchor('adminpmb/admluarnegeri-list_pendaftar', 'List Pendaftar', 'title=""').'</li>';
	
			echo '<li id="li-menu-tools-admin-pmb" class="item"><a href="#menu-admluarnegeri-pmb" class="item"   name="ul-sub1-c"><span>PMB Luar Negeri</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-admluarnegeri-pmb" class="'.$buka.'">';
					if(in_array('AAZ001',$status)):
								echo $menu1;
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