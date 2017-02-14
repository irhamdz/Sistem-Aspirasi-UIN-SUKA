<div>
	<h3>
		FORM PINDAH RUANG
	</h3>
	<table>
		<tr>
			<td>
				NOMOR PENDAFTAR
			</td>
			<td>
				<input type="text" name="nomor_pendaftar" id="nomor_pendaftar" class="form-control input-md">
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class="btn btn-uin btn-inverse" type="button" onclick="cari_mhs()">CARI</button>
			</td>
		</tr>
	</table>
	<br>
	<div id="data-mhs">
		
	</div>
	<br>
	<div id="log">
		<?php $this->load->view('v_table/log_eror'); ?>
	</div>
</div>
<script type="text/javascript">
	function cari_mhs () {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_mahasiswa_lagi') ?>",
			type: "POST",
			data: "nomor_pendaftar="+$('#nomor_pendaftar').val(),
			success: function(mhs)
			{
				$('#data-mhs').html(mhs);
				cari_log($('#nomor_pendaftar').val());
			}
		});
	}

	function cari_log (nomor) {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_log') ?>",
			type: "POST",
			data: "nomor_pendaftar="+nomor,
			success: function(log)
			{
				$('#log').html(log);
			}
		});
	}


</script>