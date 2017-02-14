<?php
$jml_bayar=0;
$jml_bayar_login=0;
$jml_belum_isi_data=0;
$jml_belum_piljur=0;
$jml_verifikasi=0;
$jml_sudah_semua=0;

if(!is_null($data_mhs))
{
	foreach ($data_mhs as $d) {
		$jml_bayar_login=$d->login;
		$jml_belum_isi_data=$d->isi_data;
		$jml_belum_piljur=$d->blm_piljur_verifikasi;
		$jml_verifikasi=$d->blm_verifikasi;
		$jml_sudah_semua=$d->sudah_semua;
	}
}

?>
<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="5%">NO</th>
						<th width="70%" align="left">STATUS</th>
						<th width="5%">JUMLAH</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="center">1</td>
						<td align="left">SUDAH BAYAR</td>
						<td align="center"><?php echo $jumlah_bayar; ?></td>
					</tr>
					<tr>
						<td align="center">2</td>
						<td align="left">SUDAH BAYAR SUDAH LOGIN</td>
						<td align="center"><?php echo $jml_bayar_login; ?></td>
					</tr>
					<tr>
						<td align="center">3</td>
						<td align="left">SUDAH BAYAR SUDAH LOGIN BELUM ISI DATA</td>
						<td align="center"><?php echo $jml_belum_isi_data; ?></td>
					</tr>
					<tr>
						<td align="center">4</td>
						<td align="left">SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA BELUM PILIH JURUSAN BELUM VERIFIKASI BELUM CETAK</td>
						<td align="center">
						<form method="POST" style="margin:0px;" id="blm-piljur" >
						
							<input type="hidden" name="nama" value="<?php if(!is_null($data_mhs)){echo $d->kode_penawaran;} ?>">
							<input type="hidden" name="index" value="1">
							
							<a href="#" onclick="data_mhs('blm-piljur')"><strong><?php echo $jml_belum_piljur; ?></strong></a>
						</form>
						</td>
						
					</tr>
					<tr>
						<td align="center">5</td>
						<td align="left">SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA SUDAH PILIH JURUSAN BELUM VERIFIKASI BELUM CETAK</td>
						<td align="center">
						<form method="POST" style="margin:0px;" id="blm-verif" >
						
							<input type="hidden" name="nama" value="<?php if(!is_null($data_mhs)){echo $d->kode_penawaran;} ?>">
							<input type="hidden" name="index" value="2">
							
							<a href="#" onclick="data_mhs('blm-verif')" ><strong><?php echo $jml_verifikasi; ?></strong></a>
						</form>
												</td>
					</tr>
					<tr>
						<td align="center">6</td>
						<td align="left">SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA SUDAH PILIH JURUSAN SUDAH VERIFIKASI SUDAH CETAK</td>
						<td align="center"><form method="POST" style="margin:0px;" id="sdh-semua" >
						
							<input type="hidden" name="nama" value="<?php if(!is_null($data_mhs)){ echo $d->kode_penawaran;} ?>">
							<input type="hidden" name="index" value="3">
							
							<a href="#" onclick="data_mhs('sdh-semua')"> <strong><?php echo $jml_sudah_semua; ?></a></strong>
						</form>
											</td>
					</tr>
				</tbody>
</table>
<table id="data_mhs" class="table table-bordered table-hover"></table>
<script type="text/javascript">
	function  data_mhs(form) {
		
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/belum_piljur'); ?>",
			type: "POST",
			data: $('#'+form).serialize(),
			success: function(data_mhs){
				$('#data_mhs').html(data_mhs);
			}
		});

	}
</script>