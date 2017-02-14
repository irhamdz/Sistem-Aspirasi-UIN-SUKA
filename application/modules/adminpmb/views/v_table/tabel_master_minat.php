<table class="table table-bordered">
<thead>
	<tr>
		<td>
			KODE MINAT
		</td>
		<td>
			NAMA MINTA
		</td>
		<td>
			#
		</td>
	</tr>
</thead>
<tbody>
	<?php
	if(!is_null($data_minat))
	{
		
		foreach ($data_minat as $dm) {
			echo "<tr>";
			echo "<td>";
			echo $dm->kode_minat;
			echo "</td>";
			echo "<td>";
			echo $dm->nama_minat;
			echo "</td>";
			echo "<td>";
			?>
			<button class="btn btn-small" type="button" id="<?php echo $dm->kode_minat; ?>" onclick="hapus_minat(this)"> HAPUS</button>
			<?php
			echo "</td>";
			echo "</tr>";
		}
	}
	?>
</tbody>
	
</table>
<script type="text/javascript">
	function hapus_minat (hm) {
		$.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/hapus_minat'); ?>",
            type: "POST",
            data: "kode_minat="+hm.id,
            success: function(mi)
            {
                $('#data-minat').html(mi);
            }
        });
	}
</script>