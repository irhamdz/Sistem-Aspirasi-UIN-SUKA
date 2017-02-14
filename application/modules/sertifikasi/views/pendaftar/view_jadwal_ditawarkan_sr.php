<?php 
	$crumbs = array(
				array('Training & Sertifikasi' => 'pelatihan'),
				array('Ujian Sertifikasi ICT' => '#'),
				array('Jadwal Ujian Sertifikasi ICT Ditawarkan' => '#'),
			);
#$this->s00_lib_output->output_info_mhs();
$this->it00_lib_output->output_crumbs($crumbs);
?>
<h2>Jadwal Ujian Sertifikasi ICT yang Ditawarkan</h2>
<div id="tbl-rekap">
<?php
	echo '<div class="bs-callout bs-callout-info">
			Silakan klik <strong>Ambil</strong> untuk memilih jadwal Ujian Sertifikasi ICT yang ingin diikuti.
		</div>';
	$this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_ditawarkan');
?>
</div>