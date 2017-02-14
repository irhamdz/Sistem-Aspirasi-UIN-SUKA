<?php
if (isset($kd_menu)==TRUE){
	if($kd_menu == 'nilai'):
		echo "<h2 id='page_title'>Input & Download Nilai Peserta ICT</h2>";
		$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Input & Download Nilai Peserta ICT' =>''),
			);
	elseif($kd_menu =='lihatnilai'):
		echo "<h2>Lihat Nilai ICT</h2>";
		$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Lihat Nilai Peserta ICT' =>''),
			);
	endif;
}
?>
<?php
	
?>
<div id="mn_breadcrumb"><?php $this->it00_lib_output->output_crumbs($crumbs); ?></div>

<div id="div_periode">
<div id="information" class="bs-callout bs-callout-info">Silakan pilih terlebih dahulu tahun akademik, periode, dan hari untuk melihat jadwal <b>ICT</b>.</div>
<?php $this->load->view('sertifikasi/vw_dropdown/dd_ta_bln_prd'); ?>
</div>
<div id="notif"></div>
<div id="tbl-rekap">
	<?php $this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_terisi'); ?>
</div>
<script type="text/javascript">

$(function() {
<?php if($kd_menu == 'nilai'): ?>
	$(window).load(function() {
		$("#tbl-rekap").load("nilai/<?php echo $kd_per; ?>");
	});
<?php elseif($kd_menu =='lihatnilai'): ?>
	$(window).load(function() {
		$("#tbl-rekap").load("lihatnilai/<?php echo $kd_per; ?>");
	});
<?php	endif; ?>

	//$("#dosen").tokenInput("http://akademik.uin-suka.ac.id/bkd/dosen/bebankerja/get_dosen");
	//$(".timajar").tokenInput("http://akademik.uin-suka.ac.id/toec/training/get_dosen",{tokenLimit: '1'});
});
</script>


