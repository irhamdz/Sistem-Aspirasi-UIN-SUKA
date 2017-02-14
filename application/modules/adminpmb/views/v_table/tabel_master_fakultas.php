<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				KODE FAKULTAS
			</td>
			<td>	
				NAMA FAKULTAS
			</td>
			<td>
				#
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_fakultas))
		{
			foreach ($data_fakultas as $df) {
				echo "<tr>";
				echo "<td>";
				echo $df->id_fakultas;
				echo "</td>";
				echo "<td>";
				echo $df->nama_fakultas;
				echo "</td>";
				echo "<td>";
					?>
					<button class="btn" id="<?php echo $df->id_fakultas; ?>" type="button" onclick="hapus_fakultas(this.id)">HAPUS</button>
					<?php
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
<script type="text/javascript">
	function  hapus_fakultas (ifa) {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/hapus_fakultas') ?>",
			type: "POST",
			data: "id_fakultas="+ifa,
			success: function(hf)
			{
				$('#data-fak').html(hf);
			}
		});
	}
</script>