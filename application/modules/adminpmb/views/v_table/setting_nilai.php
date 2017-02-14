<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th valign="top">
							NO
						</th>
						<th valign="top">
							NAMA JENIS
						</th>
						<th valign="top">
							JALUR PMB
						</th>
						<th valign="top">
							PROSES
						</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$num=0;
					if(!is_null($data_set_nilai))
					{

						foreach ($data_set_nilai as $nil) {
							echo "<tr>";
							echo "<td>";
								echo $num+=1;
							echo "</td>";
							echo "<td>";
								echo $nil->nama_tes;
							echo "</td>";
							echo "<td>";
								echo "<font id='pen".$num."'>".$nil->jalur_masuk. "Gelombang ".$nil->gelombang.' '.$nil->tahun."</font>";
								?>
								<select id="pen2<?php echo $num; ?>" style='display:none;' class="form-control input-md">
								<option value=""> -- </option>
								<?php
								if(!is_null($jalur_masuk))
								{
								foreach ($jalur_masuk as $jal) {
								echo "<option value='".$jal->kode_penawaran."'";
								if($jal->kode_penawaran==$nil->kode_penawaran)
								{
									echo " selected ";
								}
								echo " >".$jal->jalur_masuk." Gelombang ".$jal->gelombang."</option>";
								}
								}
								?>
								</select>

								<?php
							echo "</td>";
							echo "<td>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='dt".$num."' value='".$num."' onclick='tampil_detail(this)'> Lihat Detail</button>";
							echo "<hr>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='hps".$num."' tes='".$nil->id_tes."' value='".$nil->kode_penawaran."' onclick='hapus_data(this)'> Hapus</button>";
							echo "<hr>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='edit".$num."' value='".$num."' onclick='edit_sub(this)'> Edit</button>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='simpan".$num."' value='".$num."' isi='".$nil->id_tes."' style='display:none;' onclick='simpan_sub_tes(this)'> Simpan</button>";
							echo "<hr>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='btl".$num."' value='".$num."' style='display:none;' onclick='batal(this)'> Batal</button>";
					
							echo "</td>";
							echo "</tr>";
							
							echo "<tr>";
							echo "<td colspan='8' id='detail".$num."' style='display:none;'>";
								echo "<table class='table table-bordered table-hover'>";
								echo "<tr>";
									echo "<td>";
									echo "NO";
									echo "</td>";
									echo "<td>";
									echo "NAMA SOAL";
									echo "</td>";
									echo "<td>";
									echo "NO AWAL";
									echo "</td>";
									echo "<td>";
									echo "NO AKHIR";
									echo "</td>";
									echo "<td>";
									echo "BOBOT NORMAL";
									echo "</td>";
								echo "</tr>";
								
								if(!is_null($sub_tes))
								{
									$no=0;
									foreach ($sub_tes as $st) {
										if($st->id_tes==$nil->id_tes && ($st->kode_jalur.$st->gelombang.$st->tahun)==$nil->kode_penawaran)
										{
											echo "<tr>";
											echo "<td>";
											echo $no+=1;
											echo "</td>";
											echo "<td>";
											echo $st->nama_sub;
											echo "</td>";
											echo "<td>";
											echo $st->no_awal;
											echo "</td>";
											echo "<td>";
											echo $st->no_akhir;
											echo "</td>";
											echo "<td>";
											echo $st->bobot_normal." %";
											echo "<hr>";
											echo "Benar: ".$st->benar;
											echo "<hr>";
											echo "Salah: ".$st->salah;
											echo "<hr>";
											echo "Kosong: ".$st->kosong;
											echo "</td>";
											echo "</tr>";
										}
									}
								}
								echo "</table>";
	
							echo "</td>";
							echo "</tr>";

						}
					}
					?>
				</tbody>
</table>
<script type="text/javascript">
	function tampil_detail (tpd) {

		$('#detail'+tpd.value).slideDown('slow');
	}

	function edit_sub(eds)
	{
		$('#pen'+eds.value).hide();
		$('#pen2'+eds.value).slideDown('slow');
		$('#benar'+eds.value).hide();
		$('#benar2'+eds.value).slideDown('slow');
		$('#salah'+eds.value).hide();
		$('#salah2'+eds.value).slideDown('slow');
		$('#kosong'+eds.value).hide();
		$('#kosong2'+eds.value).slideDown('slow');
		$('#'+eds.id).hide();
		$('#btl'+eds.value).slideDown('slow');
		$('#simpan'+eds.value).slideDown('slow');
	}

	function batal(betek)
	{
		$('#pen'+betek.value).slideDown('slow');
		$('#pen2'+betek.value).hide();
		$('#benar'+betek.value).slideDown('slow');
		$('#benar2'+betek.value).hide();
		$('#salah'+betek.value).slideDown('slow');
		$('#salah2'+betek.value).hide();
		$('#kosong'+betek.value).slideDown('slow');
		$('#kosong2'+betek.value).hide();

		$('#btl'+betek.value).hide();
		$('#simpan'+betek.value).hide();
		$('#edit'+betek.value).slideDown('slow');
	}
	function simpan_sub_tes(idt)
	{
		$("#table-nilai").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		
		var id_tes=$('#'+idt.id).attr('isi');
		var kdpen=$('#pen2'+idt.value).val();
		var benar=$('#benar2'+idt.value).val();
		var salah=$('#salah2'+idt.value).val();
		var kosong=$('#kosong2'+idt.value).val();

		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/update_sub_tes'); ?>",
			type: "POST",
			data: "id_tes="+id_tes+"&kode_penawaran="+kdpen+"&benar="+benar+"&salah="+salah+"&kosong="+kosong,
			success: function(hasil_idt)
			{
				$('#table-nilai').html(hasil_idt);
			}
		});

	}
	function hapus_data (hd) {
		var tes=$('#'+hd.id).attr('tes');
		var kode_penawaran=hd.value;
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/hapus_sub_tes'); ?>",
			type: "POST",
			data: "kode_penawaran="+kode_penawaran+"&tes="+tes,
			success: function(hs)
			{
				$('#table-nilai').html(hs);
			}	
		});
	}
</script>