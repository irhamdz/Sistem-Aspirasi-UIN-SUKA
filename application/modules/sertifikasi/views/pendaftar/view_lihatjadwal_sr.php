<?php 
	$crumbs = array(
				array('Training & Sertifikasi' => 'pendaftar'),
				array('Ujian Sertifikasi ICT' => '#'),
				array('Jadwal Ujian Sertifikasi ICT' => 'pendaftar/jadwalsertifikasi'),
			);
//$this->s00_lib_output->output_info_mhs();
$this->it00_lib_output->output_crumbs($crumbs);
?>
<h2>Jadwal Ujian Sertifikasi ICT yang Sedang Berlangsung atau Akan Diikuti</h2>
<?php
	$this->load->view('sertifikasi/pendaftar/vw_tabel/tbl_jadwal_akan_ikut');
?>
<h2>Jadwal Ujian Sertifikasi ICT yang Pernah Diselenggarakan</h2>
<div id="mn-periode">
	<script type="text/javascript">
$(function () { 
	$(".perr").change(function(){
		id = $(this).attr('id');
		val = $(this).val();
		if(id=='thn'){
			$.ajax({
			  type: 'post',
			  dataType: 'html',
			  data: {op: id, kd: val},
			  })
			  .done(function(x) {
				$("#bln").html(x);
				$("#tbl-rekap").html('');

			  });
		 }
		else if(id=='bln'){
			$.ajax({
			  type: 'post',
			  dataType: 'html',
			  data: {op: id, kd: val},
			  })
			  .done(function(x) {
				$("#tbl-rekap").html(x);
			});
		}
	});
});
</script>

<table id="mn_periode" class="table table-hover">
  <tbody>
  <tr>
    <td class="col-md-1"><strong>Tahun</strong></td>
    <td><select class="perr form-control col-md-2 input-sm" id="thn" style="margin-bottom:0px;"><?php echo $dd_thn;?></select></td>
  </tr>
  <tr>
    <td class="input-medium"><strong>Bulan</strong></td>
    <td>
    <select class="perr form-control col-md-3 input-sm" id="bln" name="perr" style="margin-bottom:0px;"><?php echo $dd_bln;?></select>
    </td>
  </tr>
  </tbody>
</table>
</div>
<div id="tbl-rekap">
	<?php $this->load->view('sertifikasi/pendaftar/vw_tabel/tbl_jadwal_udah_lalu'); ?>
</div>