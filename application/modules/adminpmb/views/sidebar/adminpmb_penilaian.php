<?php
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminpmb_nilai')? 'buka':'';
?>
		<li id="li-adminpmb_nilai" class="item">
			<a href="#adminpmb_nilai" class="item"><span>Admin Penilaian</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb_nilai" class="<?php echo $buka;?>" style="">
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/penilaian_dokumen'); ?>">Setting Penilaian Dokumen</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_penilaian_dokumen'); ?>">Setting Form Penilaian Dokumen</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_subtes'); ?>">Setting Master Subtes</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_penilaian'); ?>">Setting Penilaian Ujian Tertulis</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_kunci'); ?>">Setting Kunci Jawaban</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/kelola_dokumen_ljk'); ?>">Scan Dokumen LJK</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/koreksi_dokumen_ljk'); ?>">Form Koreksi LJK</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/input_nilai'); ?>">Form Input Nilai</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/export_nilai'); ?>">Export Nilai</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/penilaian_dokumen_portofolio'); ?>">Form Penilaian Dokumen Portofolio</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/rekap_penilaian_portofolio'); ?>">Data Rekap Nilai Portofolio</a>
				</li>
				</ol>

		</li>