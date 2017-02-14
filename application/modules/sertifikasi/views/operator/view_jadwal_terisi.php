<script type="text/javascript">
	$(function () {
		$(".perr").change(function() {
			id = $(this).attr('id');
			val = $(this).val();
			perr = $("#perr").val();
			if(id == 'berr')
			{
			  $.ajax({
			  type: 'post',
			  data: {op: id, berr: val},
			  })
			  .done(function(x) {
				var qwe = $.parseJSON(x);
				$("#perr").html(qwe['dd_perr']);
				$("#tbl-rekap").load('jadwal/'+qwe['perr']);
			  }); 
			}
			
			if(id == 'perr')
			{
				$("#tbl-rekap").load('jadwal/'+val);
			}
		});
	});
	</script>
<?php
		$crumbs = array(
			array('Training & Sertifikasi' => 'training/admin'),
			array('Ujian Sertifikasi ICT' => '#'),
			array('Jadwal Ujian Sertifikasi ICT yang Telah Terisi' =>''),
		);
		if(! $this->session->userdata('ict_pst') ){
			echo '<h2 id="page_title">Jadwal Ujian Sertifikasi ICT yang Telah Terisi</h2>';
		}
		else{
			echo '<h2 id="page_title">Pemindahan Peserta Ujian Sertifikasi ICT</h2>';
		}
	$this->it00_lib_output->output_crumbs($crumbs);
 ?>

<div class="bs-callout bs-callout-info" id="informasi">Silakan pilih terlebih dahulu bulan dan periode Ujian Sertifikasi ICT untuk menampilkan jadwal.</div>
<h3 style="margin-bottom:10px;">Daftar Jadwal Ujian Sertifikasi ICT</h3>
<div id="mn-periode">
	<?php $this->load->view('sertifikasi/vw_dropdown/dd_ta_bln_prd'); ?>
</div>

<div id="tbl-rekap">
	<?php $this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal_terisi'); ?>
</div>
