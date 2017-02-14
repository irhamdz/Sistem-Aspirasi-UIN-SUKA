<?php 
if($this->session->userdata('status') == 'staff'){ 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(1)));
		if($data[0]=='rekap'){
			$buka='buka';
		}else{
			$buka='';
		}
	$cek_jabatan = $this->session->userdata('jabatan');
	$status=$cek_jabatan;
#	$status = explode('#', $cek_jabatan);
	$menu1='<li class="submenu">'.anchor('rekap/siswa/daftar_siswa', 'Siswa Pendaftar', 'title=""').'</li>';
			echo '<li id="li-menu-rekap" class="item"><a href="#menu-rekap" class="item"   name="ul-sub1-c"><span>Rekap Pendaftar</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-rekap" class="'.$buka.'">';
					if( in_array('AAZ001',$status)){
						echo $menu1;
					}
			echo '</ol></li>'; 
} ?>