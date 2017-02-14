<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				KODE
			</td>
			<td>
				NAMA PROGRAM STUDI
			</td>
			<td>
				FAKULTAS
			</td>
			<td>
				JENJANG
			</td>
			<td>
				MINAT
			</td>
			<td>
				#
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_prodi))
		{
			$num=0;
			foreach ($data_prodi as $p) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $p->id_prodi;
				echo "</td>";
				echo "<td>";
				echo $p->nama_prodi;
				echo "</td>";
				echo "<td>";
				echo $p->nama_fakultas;
				echo "</td>";
				echo "<td>";
				echo $p->nama_jenjang;
				echo "</td>";
				echo "<td>";
				echo $p->nama_minat;
				echo "</td>";
				echo "<td>";
				?>

				<button class="btn" type="button" id="<?php echo $num; ?>" prodi="<?php echo $p->nama_prodi; ?>" value="<?php echo $p->id_prodi; ?>" onclick="hapus_prodi(this)"> HAPUS</button>
				<?php
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
	</tbody>
</table>
<script type="text/javascript">
	function hapus_prodi (hp) {
		$("#data-prodi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
        
		var prodi=$('#'+hp.id).attr('prodi');
		
			$.ajax({
				url: "<?php echo base_url('adminpmb/input_data_c/hapus_prodi') ?>",
				type: "POST",
				data: "id_prodi="+hp.value,
				success: function(hs){
					$('#data-prodi').html(hs);
				}	
			});
		
	}
</script>