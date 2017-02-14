<div>
<h3 style="margin-bottom:10px;">Form Input</h3>

	<form method="POST" class="form-horizontal" name="form_input" action="<?php echo base_url('adminpmb/form_control/simpan_data_form');  ?>">
		<table class="table table-nama">
			<tr>
				<td>
					Kode Form
				</td>
				<td>
					<input type="text" name="kode_form" class="form-control input-md">
				</td>
			</tr>
			<tr>
				<td>
					Nama Form
				</td>
				<td>
					<input type="text" name="nama_form" class="form-control input-md">
				</td>
			</tr>
			<tr>
			<td>
				<h>Status Form</h>
			</td>
			<td>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_form" id="optionsRadios1" value="1" checked>
    				Aktif
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_form" id="optionsRadios2" value="0">
    				Tidak Aktif
  				</label>
			</div>
			</td>
		</tr>
			<tr>
				
				<td colspan="2">
					<input type="submit" value="Simpan" class="btn btn-inverse btn-uin btn-small">
				</td>
			</tr>
		</table>
		

	</form>
</div>
<div id="tbl-form">
	<?php
	$this->load->view('v_table/view_table_form');
	?>
</div>