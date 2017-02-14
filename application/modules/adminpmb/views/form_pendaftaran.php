<br>
<div>
	<h3>
		FORM PENDAFTARAN
	</h3>
	<br>
	<table>
		<tr>
			<td>
				NOMOR PENDAFTAR
			</td>
			<td>
				<input type="text" class="form-control input-md" id="nomor_pendaftar" name="nomor_pendaftar">
			</td>
		</tr>
			<tr>
				<td>
					
				</td>
				<td>
					<button class="btn btn-inverse btn-uin" type="button" onclick="lihat_form_private()"> FORM</button>
				</td>
			</tr>
	</table>
</div>
<br>
<div id="form-daftar"></div>
<script type="text/javascript">
function lihat_form_private() {
	$.ajax({
		url: "<?php echo base_url('adminpmb/jalur_pmb/ambil_kode_bayar') ?>",
		type: "POST",
		data: "nomor_pendaftar="+$('#nomor_pendaftar').val(),
		success: function(data)
		{
			$('#form-daftar').html(data);
			form();
		}
	});
}
</script>