<br>
<div>
	<h3>
		FORM MASALAH CETAK KARTU
	</h3>
	<br>
	<br>
	<form method="POST">
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
					<button class="btn btn-inverse btn-uin" type="button" onclick="selidiki()"> CEK</button>
				</td>
			</tr>
	</table>
</div>
</form>
<br>
<div id="eror-report"></div>
<script type="text/javascript">

function selidiki()
{
	
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/selidiki') ?>",
		type: "POST",
		data: "nomor_pendaftar="+$('#nomor_pendaftar').val(),
		success: function(msl)
		{
			$('#eror-report').html(msl);
		}
	});


}

function allow_login()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/login_lagi') ?>",
		type: "POST",
		data: "nomor_pendaftar="+$('#nomor_pendaftar').val(),
		success: function(fix)
		{
			$('#eror-report').html(fix);
		}
	});
}
</script>