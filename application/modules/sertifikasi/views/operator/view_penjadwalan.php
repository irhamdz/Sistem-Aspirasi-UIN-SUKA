<h2>Pengaturan Jadwal ICT</h2>
<?php
	$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Pengaturan Jadwal ICT' =>'ict/sertifikasi/penjadwalan'),
			);
	$this->it00_lib_output->output_crumbs($crumbs);

?>
<style type="text/css">
	input, select{
		margin-bottom: 0px;
	}
</style>
<div id="mn-tambah-jadwal">
	<div id="information" class="bs-callout bs-callout-info">Silakan isi terlebih dahulu data jadwal pelaksanaan <b>ICT</b>. Kemudian klik tombol <b>Tambah Jadwal</b> untuk menambahkan  jadwal.</div>
	<h3 style="margin-bottom:10px;">Form Penambahan Jadwal ICT</h3>
<form name="finput" id="finput">
<input type="hidden" name="op" value="tmbh">
	<div id="mn-periode"> <?php $this->load->view('sertifikasi/vw_dropdown/dd_periode_sr'); ?> </div>
	<div>
	<table class="table table-hover" id="">
	<tr>
		<td class="col-md-2 ">Ruang</td>
		<td  ><select name="ruang" id="ruang" class="form-control input-sm col-md-3"><?php echo $dd_ruang;?></select>&nbsp;<span style="margin-top:7px;" id="ru_kap" class="badge"></span></td>
	</tr>
	<tr>
		<td>Jam Mulai</td>
		<td class="">
			<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai" readonly="" style="margin-bottom:0px;">
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>
		</td>
	</tr>
	<tr>
		<td>Jam Selesai</td>
		<td class="">
			<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai" readonly="" style="margin-bottom:0px;">
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>
		</td>
	</tr>
	<tr>
	<td class="input-small "></td>
	<td ><button class="btn btn-inverse btn-small btn-uin">Tambah Jadwal</button>&nbsp;<span style="font-weight:bold;" id="error-msg"></span></td>
	</tr>
	</table>
</div>

</form>
</div>
<h3 style="margin-bottom:10px;">Daftar Jadwal ICT</h3>
<div id="tbl-rekap">
	<?php  $this->load->view('sertifikasi/operator/vw_tabel/tbl_jadwal'); ?>
</div>
<script type="text/javascript">
function cek_jam()
{
	if( Date.parse('01/01/2011 '+$("#jam_mulai").val()) < Date.parse('01/01/2011 '+$("#jam_selesai").val()) ){ return true; }
	else { return false; }
}

$(function() {
	aa = $("#ruang").val().split("#");
	$("span#ru_kap").html(aa[1]);

	$("form#finput").submit(function() {
		if(cek_jam() == true){
			var formData = new FormData($(this)[0]);
			var perr = $("#perr").val();
		   // console.log(perr);
			$.ajax({
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				dataType: 'html',
				processData: false
			})
			.done(function(x) {
				$("#error-msg").html(x);
				$("#tbl-rekap").load('penjadwalan/'+perr);
				setTimeout(function() { $("#error-msg").html(""); }, 500);

			});
			return false;
		} else { $("#error-msg").html("Pengaturan jam tidak valid. Silakan diperbaiki terlebih dahulu."); return false; }	
	});
	
	$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});


  $("#ruang").change(function() {
  	aa = $("#ruang").val().split("#");
	$("span#ru_kap").html(aa[1]);
  });

  $(".perr").change(function() {
    id = $(this).attr('id');
    val = $(this).val();
    if(id == 'perr')
    {
      $.ajax({
      type: 'post',
      dataType: 'html',
      data: {op: id, kd: val},
      })
      .done(function(x) {
      	//alert(x);
       $("#ruang").html(x);
       $("#tbl-rekap").load('penjadwalan/'+val);
       if($("#ruang").val() != null)
       {
        aa = $("#ruang").val().split("#");
		$("span#ru_kap").html(aa[1]);
       }
       else{  $("span#ru_kap").html(""); }
      }); 
    }
  });
});
</script>