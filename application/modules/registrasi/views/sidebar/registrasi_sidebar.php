<?php 
if($this->session->userdata('status') == 'staff'){ 
		$data = explode("-",$this->security->xss_clean($this->uri->segment(1)));
		if($data[0]=='registrasi'){
			$buka='buka';
		}else{
			$buka='';
		}
	$cek_jabatan = $this->session->userdata('jabatan');
	$status = $cek_jabatan;

	//$menu1='<li class="submenu">'.anchor('registrasi/scan', 'Scan NIM', 'title=""').'</li>';
	$menu1='<li class="submenu"><a href="'.base_url('registrasi/registrasi/scan').'">Scan NIM</a></li>';
	$menu1.='<li class="submenu"><a href="'.base_url('registrasi/ceklist').'">Ceklist Dokumen</a></li>';
	$menu1.='<li class="submenu"><a href="'.base_url('registrasi/rekap/ceklist').'">Rekap Ceklist Dokumen</li>';
	$menu1.='<li class="submenu"><a href="'.base_url('registrasi/verifikasi').'">Verifikasi Pra Registrasi</a></li>';
	$menu1.='<li class="submenu"><a href="'.base_url('registrasi/rekap/verifikasi_rapor').'">Rekap Verifikasi Rapor</a></li>';
	$menu1.='<li class="submenu"><a href="'.base_url('registrasi/rekap/verifikasi_profil').'">Rekap Isi Data Profil Mahasiswa dan Verifikasi</a></li>';
	$menu2='<li class="submenu"><a href="'.base_url('registrasi/verifikasi').'">Verifikasi Pra Registrasi</a></li>';
	
	//$menu1.='<li class="submenu">'.anchor('registrasi/ceklist', 'Ceklist Dokumen', 'title=""').'</li>';
	//$menu1.='<li class="submenu">'.anchor('registrasi/rekap/ceklist', 'Rekap Ceklist Dokumen', 'title=""').'</li>';
	//$menu1.='<li class="submenu">'.anchor('registrasi/verifikasi', 'Verifikasi Pra Registrasi', 'title=""').'</li>';
	//$menu2='<li class="submenu">'.anchor('registrasi/verifikasi', 'Verifikasi Pra Registrasi', 'title=""').'</li>';
			echo '<li id="li-menu-registrasi" class="item"><a href="#menu-registrasi" class="item"   name="ul-sub1-c"><span>Pra Registrasi & Registrasi</span></a>
					<div class="underline-menu"></div>
					<ol id="ol-menu-registrasi" class="'.$buka.'">';
					if(in_array('REG001',$status) or in_array('AAZ002',$status) or in_array('AAZ001',$status)){
						echo $menu1;
					}else if(in_array('REG004',$status)){
						echo $menu1;
					}else{
						echo $menu2;
					}
			echo '</ol></li>'; 
} ?>