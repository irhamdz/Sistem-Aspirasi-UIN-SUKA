<?php
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminpmb')? 'buka':'';
		
?>
		<li id="li-adminpmb" class="item">
			<a href="#adminpmb" class="item"><span>Admin Tools</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb" class="<?php echo $buka;?>" style="">
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_kode_pembayaran'); ?>">Setting Kode Pembayaran</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_jalur'); ?>">Setting Jalur</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_prodi'); ?>">Setting Program Studi</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_kelas'); ?>">Setting Kelas</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_minat'); ?>">Setting Minat</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_gedung'); ?>">Setting Gedung</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_fakultas'); ?>">Setting Fakultas</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/master_tes'); ?>">Setting Jenis Tes</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_penawaran_jalur'); ?>">Setting  Penawaran Jalur</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_penawaran_jurusan'); ?>">Setting Penawaran Jurusan</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_ruang'); ?>">Setting Ruang</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_jadwal_ujian'); ?>">Setting Jadwal Ujian</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_ruang_ujian'); ?>">Setting Tambah Ruang Ujian</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_lihat_ruang_ujian'); ?>">Setting Lihat Ruang Ujian</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_grup_form'); ?>">Setting Grup Form</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/jadwal_portofolio'); ?>">Setting Penjadwalan Portofolio</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_unit'); ?>">Setting Kartu dan Album PMB</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/prasyarat'); ?>">Setting Prasyarat</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/nomor_duplikat'); ?>">Nomor Ganda</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/pindah_ruang'); ?>">Pindah Ruang</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/masalah'); ?>">Masalah Cetak Kartu</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_pendaftaran'); ?>">Form Pendaftaran</a>
				</li>
				</ol>

		</li>