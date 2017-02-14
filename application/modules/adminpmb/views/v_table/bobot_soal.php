<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th valign="top">
							NO
						</th>
						<th valign="top">
							NAMA PRODI
						</th>
						<th valign="top">
							JENJANG
						</th>
						<th valign="top">
							NAMA SUB TES
						</th>
						<th valign="top">
							BOBOT
						</th>
						<th valign="top">
							#
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if(!is_null($bobot_prodi))
				{
					$num=0;
					foreach ($bobot_prodi as $bp) {
						echo "<tr>";
						echo "<td>";
						echo $num+=1;
						echo "</td>";
						echo "<td>";
						echo $bp->nama_prodi;
						echo "</td>";
						echo "<td>";
						echo $bp->nama_jenjang;
						echo "</td>";
						echo "<td>";
						echo $bp->nama_sub;
						echo "</td>";
						echo "<td>";
						echo $bp->bobot_prodi." %";
						echo "</td>";
						echo "<td>";
						echo "<button class='btn btn-inverse btn-uin btn-small' type='button' value='".$bp->id_prodi."' isi='".$bp->id_sub."' id='".$num."' onclick='hapus_sub(this)'> Hapus</button>";
						echo "</td>";

						echo "</tr>";
					}
				}
				?>
	</tbody>
	</table>
	
	<script type="text/javascript">
	function hapus_sub (iam) {
		var id_sub=$('#'+iam.id).attr('isi');
		var id_prodi=iam.value;

		$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/hapus_bobot_sub') ?>",
		type: "POST",
		data: "id_prodi="+id_prodi+"&id_sub="+id_sub,
		success: function(hasilx)
		{
			$('#data-bobot').html(hasilx);
		}
	});
	}
	</script>