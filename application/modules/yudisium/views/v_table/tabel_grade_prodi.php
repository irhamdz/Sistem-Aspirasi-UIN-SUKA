	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				PROGRAM STUDI
			</td>
			<td>
				JENJANG
			</td>
			<td>
				GRADE
			</td>
			<td width="200px">#</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($data_prodi))
		{

			$num=0;
			foreach ($data_prodi as $dp) {
				# code...
				echo "<tr>";
				echo "<td>";
					echo $num+=1;
					echo "<input type='text' style='display:none;' id='id_prodi".$num."' value='".$dp->id_prodi."'>";
			
				echo "</td>";
				echo "<td>";
				echo $dp->nama_prodi;
				echo "</td>";
				echo "<td>";
					echo $dp->nama_jenjang;
				echo "</td>";
				echo "<td>";
					echo "<font id='grade".$num."'>".$dp->nilai_grade."</font>";
					echo "<input class='form-control input-sm' style='width:50px;display:none;' type='text' id='grade2".$num."' value='".$dp->nilai_grade."'>";
				echo "</td>";
				echo "<td>";
					echo "<button class='btn btn-inverse btn-small' type='button' id='".$num."' onclick='edit(this)'> EDIT</button>";
					echo "<button class='btn btn-inverse btn-small' type='button' id='simpanG".$num."' value='".$num."' style='display:none' pen='".$dp->kode_penawaran."' isi='".$dp->id_prodi."' onclick='simpan(this)'> SIMPAN</button>";
					echo " <button class='btn btn-inverse btn-small' type='button' id='batalG".$num."' value='".$num."' style='display:none' onclick='batalG(this)'> BATAL</button>";
					
				echo "</td>";
				echo "</tr>";
			}
		}
			
			
		?>
	</tbody>

	<script type="text/javascript">
	function edit(ed)
{

	$('#grade'+ed.id).hide();
	$('#grade2'+ed.id).slideDown('slow');
	$('#'+ed.id).hide();
	$('#simpanG'+ed.id).slideDown('slow');
	$('#batalG'+ed.id).slideDown('slow');
}
function batalG(b)
{
	$('#simpanG'+b.value).hide();
	$('#batalG'+b.value).hide();
	$('#grade2'+b.value).hide();
	$('#grade'+b.value).slideDown('slow');
	$('#'+b.value).slideDown('slow')
	
}

function simpan(pr)
{
	var no=pr.value;
	var prodi=$('#'+pr.id).attr('isi');
	var isi=$('#grade2'+no).val();
	var kode_penawaran=$('#'+pr.id).attr('pen');

	$.ajax({
		url : "<?php echo base_url('yudisium/yudisium_c/update_grade_prodi'); ?>",
		type : "POST",
		data : "id_prodi="+prodi+"&val="+isi+"&kode_penawaran="+kode_penawaran,
		success: function(haha)
		{
			lihat_grade_prodi();
		}
	});
}
</script>