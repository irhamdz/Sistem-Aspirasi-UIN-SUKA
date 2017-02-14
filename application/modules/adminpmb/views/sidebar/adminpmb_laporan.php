<?php
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminlaporan')? 'buka':'';
		
?>
		<li id="li-adminlaporan" class="item">
			<a href="#adminlaporan" class="item"><span>Admin Laporan</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminlaporan" class="<?php echo $buka;?>" style="">
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_nomor'); ?>">Data Nomor Peserta</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/jadwal_peserta_portofolio'); ?>">Data Jadwal Peserta Portofolio</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/dokumen'); ?>">Data Dokumen PMB</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/data_maba_all'); ?>">Data Peserta PMB</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/presensi_mahasiswa'); ?>">Data Album PMB</a>
				</li>
				
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/rekap_peserta'); ?>">Data Rekap Peserta PMB</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/rekap_peserta_kabupaten'); ?>">Data Rekap Perkabupaten</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/rekap_peserta_sekolah'); ?>">Data Rekap Asal Sekolah/PT</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/rekap_peserta_jk'); ?>">Data Rekap Jenis Kelamin</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/jadwal_pengisian_profile'); ?>">Data Jadwal Pengisian Profile</a>
				</li>
				</ol>

		</li>