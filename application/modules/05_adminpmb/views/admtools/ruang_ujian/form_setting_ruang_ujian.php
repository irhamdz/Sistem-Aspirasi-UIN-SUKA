<table class="table table-hover">
	<tbody>
		<tr>
			<td>1</td>
			<td>Download format setting ruang ujian</td>
			<td><form method='POST' action='<?php echo base_url('adminpmb/admtools-setting_ruang_ujian'); ?>'>
					<input type='hidden' name='TAHUN' value='<?php echo $_POST['TAHUN']; ?>' />
					<input type='hidden' name='GELOMBANG' value='<?php echo $_POST['GELOMBANG']; ?>' />
					<button type='submit' name='setting' value="DOWNLOAD" class='btn btn-small' ><i class='icon-download'></i> DOWNLOAD</button>
					</form></td>
		</tr>
		<tr>
			<td colspan='3'></td>
		</tr>
		<tr>
			<td>2</td>
			<td>Upload setting ruang ujian</td>
			<td><form method='POST' action='<?php echo base_url('adminpmb/admtools-setting_ruang_ujian'); ?>' enctype="multipart/form-data">
					<input type='hidden' name='TAHUN' value='<?php echo $_POST['TAHUN']; ?>' />
					<input type='hidden' name='GELOMBANG' value='<?php echo $_POST['GELOMBANG']; ?>' />
					<input type='file' name='file' />
					<input type='submit' name='setting' value='UPLOAD' class='btn-uin btn btn-inverse btn btn-small' /></form>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>