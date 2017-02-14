<?php
$crumbs = array(array('Beranda'=>base_url()),array('Cetak Kartu Peserta Ujian' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<form action='tools-cetak_kartu_ujian/lihat' method='POST' id='fup_bp' >
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th colspan='3' align='center'>
			<strong>Cetak Kartu Peserta Ujian</strong>
			</th>
		</tr>
	<thead>
	<tbody>
		<tr>
			<td>Kata Kunci</td>
			<td><input type='text' name='kunci' /><input type='hidden' name='lihat' value='sekarang' /></td>
		</tr>
		<tr>
			<td>Berdasarkan</td>
			<td><input type='radio' name='jenis_lihat' value='1' />PIN Peserta<br />
				<input type='radio' name='jenis_lihat' value='2' />No. Peserta<br />
				<input type='radio' name='jenis_lihat' value='3' />Nama Peserta<br />
			</td>
		</tr>
		<tr>
			<td><input type='hidden' name='lihat' value='saiki' /></td>
			<td><input type='submit' name='lihat' value='Lihat' class='btn-uin btn btn-inverse btn btn-small' /></td>
		</tr>
	</tbody>
</table>
</form>
<div id='notif-upsbp'></div>
</div>
<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'tools-cetak_kartu_ujian/lihat',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(x) {
        var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(data['pesan']);
		$('html, body').animate({ scrollTop: 0 }, 200);
    });
 
    return false;
        });
});
</script>