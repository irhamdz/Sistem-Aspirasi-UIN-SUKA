<?php 
if($this->session->userdata('status') == 'staff'){ 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(1)));
		if($data[0]=='spanptkin'){
			$buka='buka';
		}else{
			$buka='';
		}
	$cek_jabatan = $this->session->userdata('jabatan');
	$status=$cek_jabatan;
#	$status = explode('#', $cek_jabatan);
	$menu1='<li class="submenu">'.anchor('spanptkin/pembobotan', 'Pembobotan', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('spanptkin/penilaian/nilai_akademik', 'Nilai Akademik (Rapor)', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/penilaian/nilai_prestasi', 'Nilai Pendukung Akademik', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/penilaian/nilai_peringkat_sekolah', 'Nilai Peringkat Sekolah', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/penilaian/nilai_yudisium', 'Data Nilai Total', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('spanptkin/yudisium/accepted', 'Siswa Diterima', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/peminat', 'Rekap Peminat', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/provinsi', 'Rekap Per Provinsi', 'title=""').'</li>';
	#$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/kabupaten', 'Rekap Per Kabupaten', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/jenis_kelamin', 'Rekap Jenis Kelamin', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/nilai', 'Rekap Nilai', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('spanptkin/rekap/diterima', 'Rekap Diterima', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('spanptkin/penilaian/nilai_prestasi', 'Nilai Pendukung Akademik', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('spanptkin/yudisium', 'Daftar Nilai Peserta', 'title=""').'</li>';
			echo '<li id="li-menu-spanptkin" class="item"><a href="#menu-spanptkin" class="item"   name="ul-sub1-c"><span>SPAN-PTKIN</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-spanptkin" class="'.$buka.'">';
					if( in_array('AAZ001',$status)){
						echo $menu1;
					}else if(in_array('AAZ002',$status)){
						echo $menu2;	
					}else if(in_array('AAZ006',$status)){
						echo $menu3;	
					}
			echo '</ol></li>'; 
} ?>