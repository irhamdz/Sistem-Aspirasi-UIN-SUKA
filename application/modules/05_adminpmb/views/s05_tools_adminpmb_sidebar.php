<?php 
/*ADMIN PMB TOOL SIDEBAR */
if($this->session->userdata('status') == 'staff'): 
	$cek_jabatan = $this->session->userdata('jabatan');
	#echo $cek_jabatan;
	$menu="";
	#echo "okoko";
	$data = explode("-",$this->security->xss_clean($this->uri->segment(2)));
	#echo $data;
	if($data[0]=='tools'){
		$buka='buka';
	}else{
		$buka='';
	}
	
	$menu1='<li class="submenu">'.anchor('adminpmb/tools-urutan_ruang_ujian', 'Urutan Ruang Ujian', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('adminpmb/tools-input_ruang_ujian', 'Input Ruang Ujian', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('adminpmb/tools-cetak_album_ujian', 'Cetak Album Ujian', 'title=""').'</li>';
	$menu4='<li class="submenu">'.anchor('adminpmb/tools-cetak_form_verifikasi', 'Cetak Form Verifikasi', 'title=""').'</li>';				
	$menu5='<li class="submenu">'.anchor('adminpmb/tools-cetak_kartu_ujian', 'Cetak Kartu Peserta Ujian', 'title=""').'</li>';				
	$menu6='<li class="submenu">'.anchor('adminpmb/tools-reset_data_peserta', 'Cek Error', 'title=""').'</li>';				
	$menu7='<li class="submenu">'.anchor('adminpmb/tools-form_soal/upload', 'Input Data LJK', 'title="Input Data LJK dari Scanner"').'</li>';				
	$menu8='<li class="submenu">'.anchor('adminpmb/tools-form_soal/prosentase', 'Input Prosentase Nilai', 'title="Input Prosentase Nilai"').'</li>';				
	$menu9='<li class="submenu">'.anchor('adminpmb/tools-cetak_album_ujian_s1d3', 'Cetak Album Ujian S1/D3', 'title="Cetak Album Ujian"').'</li>';				
	$menu10='<li class="submenu">'.anchor('adminpmb/tools-cetak_album_ujian_s1d3_difabel', 'Cetak Album Ujian S1/D3 - DIFABEL', 'title="Cetak Album Ujian"').'</li>';				
	$status = explode('#', $cek_jabatan);
	echo '<li id="li-menu-tools-admin-pmb" class="item"><a href="#menu-tools-admin-pmb" class="item" name="ul-sub1-c"><span>Tools</span></a>
					<div class="underline-menu"></div>
						<ol id="ol-menu-tools-admin-pmb" class="'.$buka.'">';
						if(in_array('AAZ001',$status)):
								echo $menu1;
								echo $menu2;
								echo $menu3;
								echo $menu4;
								echo $menu7;
								echo $menu8;
								echo $menu9;
						endif;
						if(in_array('AAZ001',$status) || in_array('AAZ004',$status)):
								echo $menu6;
						endif;
						if(in_array('AAZ001',$status) || in_array('AAZ002',$status) || in_array('AAZ003',$status) || in_array('AAZ004',$status)):
								echo $menu5;
								echo $menu10;
						endif;
							
							
						echo '</ol>
				</li>'; 
	
endif; ?>