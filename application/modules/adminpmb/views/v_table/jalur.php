
<table class='table table-bordered'>
	<thead>
	<tr>
		<td>
			NO
		</td>
		<td>
			KODE JALUR
		</td>
		<td>
			NAMA JALUR
		</td>
		<td>
			KETERANGAN
		</td>
		<td>
			#
		</td>
	</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($jalur))
		{
			$num=0;
			foreach ($jalur as $j) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $j->kode_jalur;
				echo "</td>";
				echo "<td>";
				echo $j->jalur_masuk;
				echo "</td>";
				echo "<td>";
				echo $j->keterangan;
				echo "</td>";
				echo "<td>";
				echo "<button class='btn btn-small' type='button' value='".$j->kode_jalur."' onclick='hapus_jalur(this.value)'>Hapus</button>";
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
<script type="text/javascript">
	function hapus_jalur (kj) {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/hapus_jalur') ?>",
			type: "POST",
			data: "kode_jalur="+kj,
			success: function(xx)
			{
				$('#data-jalur').html(xx);
			}
		});
	}
</script>