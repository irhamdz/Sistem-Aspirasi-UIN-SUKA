<?php
if($this->session->userdata('status') == 'staff'){ 
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminpmb_yudisium')? 'buka':'';
$cek_jabatan = $this->session->userdata('jabatan');
$status=$cek_jabatan;

	$menu1='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_prodi', 'Setting Program Studi', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/input_hasil_lain', 'Input Diterima Yudisium Lain', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/import_tes_cbt', 'Import Nilai CBT', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/import_xl', 'Import Excel', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_tes', 'Setting Master Tes Yudisium', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_yudisium', 'Setting Putaran Yudisium', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_config_yudisium', 'Setting Configurasi Yudisium', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_admin_yudisium', 'Setting Admin Yudisium', 'title=""').'</li>';
	$menu1.='<li class="submenu">'.anchor('yudisium/yudisium_c/setting_dokumen_yudisium', 'Setting Dokumen Yudisium', 'title=""').'</li>';
	$menu2='<li class="submenu">'.anchor('yudisium/yudisium_c/nilai_ujian_pmb', 'Form Yudisium', 'title=""').'</li>';
	$menu3='<li class="submenu">'.anchor('yudisium/yudisium_c/diterima_yudisium', 'Rekap Diterima Yudisium', 'title=""').'</li>';
	$menu3.='<li class="submenu">'.anchor('yudisium/yudisium_c/hasil_yudisium', 'Rekap Hasil Yudisium', 'title=""').'</li>';
	$menu3.='<li class="submenu">'.anchor('yudisium/yudisium_c/rekap_nilai', 'Rekap Nilai Yudisium', 'title=""').'</li>';
	
?>
		<li id="li-adminpmb_yudisium" class="item">
			<a href="#adminpmb_yudisium" class="item"><span>Yudisium</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb_yudisium" class="<?php echo $buka;?>" style="">
				<?php 
				if( in_array('AAZ001',$status) || in_array('AAZ002', $status) || in_array('AAZ006', $status))
				{
						echo $menu1;
						echo $menu2;
						echo $menu3;
				}
				else if(in_array('AAZ006', $status))
				{
						
						echo $menu2;
						echo $menu3;
				}

				?>
				</ol>
		</li>
<?php
  }

 ?>