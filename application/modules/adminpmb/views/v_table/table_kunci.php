<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="5px">
							NO
						</th>
						<th width="40px">
							JENIS TES
						</th>
						<th width="30px">
							KODE SOAL / JUMLAH SOAL
						</th>
						<th width="80px">
							KUNCI JAWABAN
						</th>
						<th width="130px">
							#
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if(!is_null($data_kunci))
				{
					$num=0;
					foreach ($data_kunci as $da) {
						$kunci=str_split($da->kunci);
						echo "<tr>";
						echo "<td>";
						echo $num+=1;
						echo "</td>";
						echo "<td>";
						echo "<font id='tes".$num."'>".$da->nama_tes."</font>";
						echo '<select id="tes2'.$num.'" class="form-control input-md" style="display:none">';
					echo '<option value=""> -- </option>';
					
					if(!is_null($data_tes))
					{
						foreach ($data_tes as $dt) {
							echo "<option "; 
							if($dt->id_tes==$da->id_tes)
							{
								echo " selected ";
							}
							echo " value='".$dt->id_tes."'>".$dt->nama_tes."</option>";
						}
						
					}
					
				echo '</select>';
						echo "</td>";
						echo "<td>";
						echo '<input type="text" style="display:none" id="soal2'.$num.'" value="'.$da->kode_soal.'" class="form-control input-md">';
						echo "<font id='soal".$num."'>".$da->kode_soal."</font> / ";
						echo "<font id='jml".$num."'>".$da->jumlah_soal."</font>";
						echo '<br><input type="text" style="display:none" id="jml2'.$num.'" value="'.$da->jumlah_soal.'" class="form-control input-md">';
						echo "</td>";
						echo "<td>";	
						echo "<font id='kunci".$num."'>";
						for($i=0; $i<count($kunci); $i++)
						{
							
							echo $kunci[$i];
							if($i==(count($kunci)/2))
							{
								echo "<br>";
							}
						}
						echo "</font>";
						echo "<div id='kunci2".$num."' style='display:none'>";
						echo '<textarea class="form-control input-md" id="kuncix'.$num.'" name="kunci" rows="5" onkeypress="validate(this)">'.$da->kunci.'</textarea>';
						echo "<div class='reg-info'>Jawaban BONUS isi dengan <b>X</b>.</div>";
						echo "</div>";
						echo "</td>";
						echo "<td>";
						echo '<button class="btn btn-inverse btn-uin btn-small" value="'.$num.'" id="ed'.$num.'" type="button" onclick="edit_kunci(this)"> Edit</button>';	
						echo '<button class="btn btn-inverse btn-uin btn-small" value="'.$da->id_tes.'" no="'.$num.'" soal="'.$da->kode_soal.'" id="hp'.$num.'" type="button" onclick="hapus_kunci(this)"> Hapus</button>';	
						echo '<button style="display:none" class="btn btn-inverse btn-uin btn-small" value="'.$da->id_tes.'" id="'.$num.'" isi="'.$da->kode_soal.'" type="button" onclick="simpan_edit(this)">Simpan</button>';
						echo ' <button style="display:none" class="btn btn-inverse btn-uin btn-small" value="'.$num.'" id="btl'.$num.'" type="button" onclick="batal_edit(this)">Batal</button>';	
						echo "</td>";
						echo "</tr>";
					}
				}
				?>
	</tbody>
	</table>

	<script type="text/javascript">
	function edit_kunci (edkun) {
		var no=edkun.value;
		$('#soal'+no).hide();
		$('#jml'+no).hide();
		$('#kunci'+no).hide();
		$('#tes'+no).hide();
		$('#soal2'+no).slideDown('slow');
		$('#jml2'+no).slideDown('slow');
		$('#kunci2'+no).slideDown('slow');
		$('#tes2'+no).slideDown('slow');
		$('#ed'+no).hide();
		$('#'+no).slideDown('slow');
		$('#btl'+no).slideDown('slow');
		}	

		function batal_edit(btl)
		{var no=btl.value;
			$('#'+no).hide();
			$('#btl'+no).hide();
			$('#soal2'+no).hide();
			$('#jml2'+no).hide();
			$('#kunci2'+no).hide();
			$('#tes2'+no).hide();
			$('#soal'+no).slideDown('slow');
			$('#jml'+no).slideDown('slow');
			$('#kunci'+no).slideDown('slow');
			$('#tes'+no).slideDown('slow');
			$('#ed'+no).slideDown('slow');
			
		}

		function simpan_edit(se)
		{
			var no=se.id;
			var id_tes=$('#tes2'+no).val();
			var kode_soal=$('#soal2'+no).val();
			var jml=$('#jml2'+no).val();
			var kunci=$('#kuncix'+no).val();

			$.ajax({
				url: "<?php echo base_url('adminpmb/input_data_c/update_kunci') ?>",
				type: "POST",
				data: "id_tes="+id_tes+"&kode_soal="+kode_soal+"&jumlah_soal="+jml+"&kunci="+kunci,
				success: function(berhasil)
				{
					$('#table-kunci').html(berhasil);
					
				}
			});

		}

		function hapus_kunci(hk)
		{
			var no =$('#'+hk.id).attr('no');
			var kode_soal=$('#'+hk.id).attr('soal');
			var id_tes=hk.value;
			$.ajax({
				url: "<?php echo base_url('adminpmb/input_data_c/hapus_kunci'); ?>",
				type: "POST",
				data: "kode_soal="+kode_soal+"&id_tes="+id_tes,
				success: function(hasi)
				{
			
					$('#table-kunci').html(hasi);

				}
			});
		}
	</script>