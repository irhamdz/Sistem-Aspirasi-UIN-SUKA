<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NAMA KELAS
			</td>
			<td>
				#
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_kelas))
		{
			$num=0;
			foreach ($data_kelas as $k) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $k->nama_kelas;
				echo "</td>";
				echo "<td>";
				?>
				<button class="btn btn-small" type="button" id="<?php echo $k->kode_kelas; ?>" onclick="hapus_kelas(this)">HAPUS</button>
				<?php
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
<script type="text/javascript">
	function hapus_kelas (hk) {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/hapus_kelas') ?>",
			type: "POST",
			data: "kode_kelas="+hk.id,
			success: function(hs)
			{
				$('#data-kelas').html(hs);
			}
		});
	}
</script>