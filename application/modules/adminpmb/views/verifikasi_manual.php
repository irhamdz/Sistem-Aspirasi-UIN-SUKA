<br>
<div>
	<h3>
		FORM VERIFIKASI
	</h3>
	<br>
	<br>
	<form method="POST" id="form-verif">
	<table>
		<tr>
			<td>
				NOMOR PENDAFTAR
			</td>
			<td>
				<input type="text" class="form-control input-md" name="nomor_pendaftar">
			</td>
		</tr>
			<tr>
				<td>
					
				</td>
				<td>
					<button class="btn btn-inverse btn-uin" type="button" onclick="verifikasi()"> VERIFIKASI</button>
				</td>
			</tr>
	</table>
	</form>
</div>
<script type="text/javascript">
	function cari_gelombang(jal)
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_gelombang') ?>",
		type: "POST",
		data: "kode_jalur="+jal,
		success: function (seljal)
		{
			$('#gelombang').html(seljal);
		}
	});
}

function verifikasi()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/verifikasi') ?>",
		type: "POST",
		data: $('#form-verif').serialize(),
		success: function(vr)
		{
			if(vr=='0')
			{
				alert("Calon Mahasiswa belum dapat diverifikasikan karena ada data yang belum terisi.");
			}
			else
			{
				window.open(vr,'_blank');
			}
		}
	});
}
</script>