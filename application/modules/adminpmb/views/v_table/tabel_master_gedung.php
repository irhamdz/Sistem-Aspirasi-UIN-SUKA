<table class="table table-bordered">
<thead>
	<tr>
		<td>
			KODE GEDUNG
		</td>
		<td>
			NAMA GEDUNG
		</td>
		<td>
			STATUS
		</td>
		<td>
			#
		</td>
	</tr>
</thead>
<tbody>
	<?php
	if(!is_null($data_gedung))
	{
		
		foreach ($data_gedung as $dg) {
			echo "<tr>";
			echo "<td>";
			echo $dg->id_gedung;
			echo "</td>";
			echo "<td>";
			echo $dg->nama_gedung;
			echo "</td>";
			echo "<td>";
			if($dg->status_gedung=='1'){echo "AKTIF";}else{echo "TIDAK AKTIF";}
			echo "</td>";
			echo "<td>";
			?>
			<button class="btn btn-small" type="button" id="<?php echo $dg->id_gedung; ?>" onclick="hapus_gedung(this)"> HAPUS</button>
			<?php
			echo "</td>";
			echo "</tr>";
		}
	}
	?>
</tbody>
	
</table>
<script type="text/javascript">
	function hapus_gedung (hg) {
		$("#data-gedung").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
        
		$.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/hapus_gedung'); ?>",
            type: "POST",
            data: "kode="+hg.id,
            success: function(mi)
            {
                $('#data-gedung').html(mi);
            }
        });
	}

</script>