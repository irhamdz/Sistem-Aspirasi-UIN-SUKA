<?php
error_reporting(0);
$crumbs = array(array('Beranda'=>base_url()),array('Satatistik Pendaftar' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<form action='laporan-statistik_pendaftar/lihat' method='POST' id='fup_bp' >
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th colspan='3' align='center'>
			<strong>Statistik Pendaftar</strong>
			</th>
		</tr>
	<thead>
	<tbody>
		<tr>
			<td>Jenis PMB</td>
			<td>:</td>
			<td><select name='jenis_pmb'>
					<option value=''>Pilih Jalur</option>
					<?php 
					foreach($jalur_masuk as $value){ 
							echo "<option value='$value->PMB_KODE_JALUR_MASUK#$value->PMB_TANGGAL_MULAI_DAFTAR#$value->PMB_TANGGAL_AKHIR_DAFTAR'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
						}
					?>
				</select><br /></td>
		</tr>
		<?php /*
		<tr>
			<td>Pilih Jenis Data</td>
			<td></td>
			<td><input type='radio' name='jenis_lihat' value='1' />Jumlah Bayar<br />
				<input type='radio' name='jenis_lihat' value='2' />Jumlah Login<br />
				<input type='radio' name='jenis_lihat' value='3' />Jumlah Isi Belum Selesai<br />
				<input type='radio' name='jenis_lihat' value='4' />Jumlah Verifikasi<br />
				<input type='radio' name='jenis_lihat' value='5' />Jumlah Cetak<br />
				<input type='radio' name='jenis_lihat' value='6' />Jumlah Ruang Tersedia
			</td>
		</tr>
		*/ ?>
		<tr>
			<td><input type='hidden' name='lihat' value='saiki' /></td>
			<td></td>
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
        url: 'laporan-statistik_pendaftar/lihat',
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