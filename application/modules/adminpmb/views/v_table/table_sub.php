<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NAMA SUB TES
			</td>
			<td>
				#
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_sub))
		{
			$num=0;
			foreach ($data_sub as $ds) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $ds->nama_sub;
				echo "</td>";
				echo "<td>";
				echo "<button class='btn btn-inverse' type='button' onclick='hapus_sub(".$ds->id_sub.")'>Hapus</button>";
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
	</tbody>
</table>

<script type="text/javascript">
	function hapus_sub (idsub) {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/hapus_sub'); ?>",
			type: "POST",
			data: "id_sub="+idsub,
			success: function(hs)
			{
				$('#table-sub').html(hs);
			}
		});
	}
</script>