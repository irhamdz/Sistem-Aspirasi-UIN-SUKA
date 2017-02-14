<h2>Cetak Sertifikat ICT</h2>
<?php
	$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('Ujian Sertifikasi ICT' => '#'),
				array('Cetak Sertifikat ICT' =>'operator/cetaksertifikat'),
			);
	$this->it00_lib_output->output_crumbs($crumbs);

?>
<div id = "info" class="bs-callout bs-callout-info">Silakan masukan Nomor Registrasi untuk melihat jadwal ICT yang diambil mahasiswa.</div>
<div id="input_nim" style="margin-bottom:20px;">
	<form name="fnim"  id="fnim" method="post" action="">
	<input type="hidden" name="op" value="search">
		<table>
			<tr>
				<td class="input-medium">Nomor Registrasi</td>
				<td><input id="nim" class="form-control" type="text" value="<?php if(isset($nim)){echo $nim;} else{ echo '';}?>" name="nim"> </td>
			</tr>
			<tr>
				<td></td>
				<td><button class="btn btn-inverse btn-small"><i class="icon-search icon-white"></i> Cari Mahasiswa</button>
			</tr>
		</table>
	</form>
</div>
<div id="tbl-rekap"></div>

<script type="text/javascript">

$(function() {
	 $(document).ajaxStart(function () {
         $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
     });

	$("form#fnim").submit(function() {
	    var formData = new FormData($(this)[0]);
	    $.ajax({
	        type: 'POST',
	        data: formData,
	        cache: false,
	        contentType: false,
	       	dataType: 'html',
	        processData: false
	    })
	    .done(function(x) {
			$("#tbl-rekap").html(x);
		});
	    
	    return false;
	});
});
</script>