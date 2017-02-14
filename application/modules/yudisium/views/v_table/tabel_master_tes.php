<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				KODE TES
			</td>
			<td>
				NAMA TES
			</td>
			<td>
				#
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_tes))
		{
			foreach ($data_tes as $t) {
				echo "<tr>";
				echo "<td>";
				echo $t->id_tes;
				echo "</td>";
				echo "<td>";
				echo $t->nama_tes;
				echo "</td>";
				echo "<td>";
				?>
				<button class="btn" type="button" id="<?php echo $t->id_tes; ?>" onclick="hapus_tes(this.id)">HAPUS</button>
				<?php
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
<script type="text/javascript">
	function hapus_tes (it) {
		$("#data-tes").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
        
		$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/hapus_tes') ?>",
			type: "POST",
			data: "id_tes="+it,
			success: function(ht)
			{
				$('#data-tes').html(ht);
			}
		});
	}
</script>



