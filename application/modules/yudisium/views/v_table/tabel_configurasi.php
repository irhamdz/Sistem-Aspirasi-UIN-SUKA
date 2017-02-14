
<div id="config">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					NO
				</td>
				<td>
					Jalur
				</td>
				<td>
					Jenis
				</td>
				<td>
					Key
				</td>
				<td>
					Nilai
				</td>
				<td width="200">
					#
				</td>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!is_null($data_config))
			{
				$num=0;
				foreach ($data_config as $cf) {
					echo "<tr>";
						echo "<td>";
							echo $num+=1;
						echo "</td>";
						echo "<td>";
							echo $cf->jalur_masuk;
						echo "</td>";
						echo "<td>";
						echo "<font id='jenis0".$num."'>".$cf->nama_jenis."</font>";
								echo '<select class="form-control input-sm" style="display:none" id="jenis'.$num.'" style="width:300px;">';
								echo '<option value=""> Jenis Configurasi </option>';
							
								if(!is_null($jenis_config))
								{
								foreach ($jenis_config as $jc1) {
								echo "<option "; 
									if($cf->id_jenis==$jc1->id_jenis)
									{
										echo " selected ";
									}
								echo " value='".$jc1->id_jenis."'>".$jc1->nama_jenis."</option>";
								}
								}
								
								echo'</select>';
						echo "</td>";
						echo "<td>";
						echo "<font id='key0".$num."'>".$cf->keterangan."</font>";
							
								echo '<select class="form-control input-sm" id="key'.$num.'" style="display:none;" style="width:300px;">';
								echo '<option value=""> Key Configurasi </option>';
								
								if(!is_null($key_config))
								{
								foreach ($key_config as $kc2) {
								echo "<option "; 
									if($cf->key==$kc2->key)
									{
										echo " selected ";
									}
								echo " value='".$kc2->key."'>".$kc2->keterangan."</option>";
								}
								}
								
								
								echo '</select>';

						echo "</td>";
						echo "<td>";
							echo "<font id='val0".$num."'>".str_replace("#"," s.d ",$cf->isi)."</font>";
							echo '<input type="text" style="display:none;" style="width:30px;" class="form-control input-sm" id="val'.$num.'" value="'.$cf->isi.'" style="width:300px;">';
						echo "</td>";
						echo "<td id='btn_1".$num."'>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='edit".$num."' value='".$num."' kdp='".$cf->kode_penawaran."' jn='".$cf->id_jenis."' onclick='diedit(this);cari_prodi_update(this);'> Edit</button>";
							echo " <button class='btn btn-inverse btn-uin btn-small' onclick='dihapus(this)' kdp='".$cf->kode_penawaran."' jn='".$cf->id_jenis."' ky='".$cf->key."' type='button' id='hapus".$num."' value='".$num."'> Hapus</button>";
						echo "</td>";
						echo "<td id='btn_2".$num."' style='display:none'>";
							echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='btl".$num."' value='".$num."' onclick='batalin(this)'> Batal</button>";
							echo " <button class='btn btn-inverse btn-uin btn-small' onclick='disimpan(this);' kdp='".$cf->kode_penawaran."' jn='".$cf->id_jenis."' type='button' id='simpan".$num."' value='".$num."'> Simpan</button>";
						
						echo "</td>";
					echo "<tr>";
					# code...
				}
			}
			?>
		</tbody>
	</table>
	<form id="temp" method="POST">
		<input type="hidden" id="prodiEdit" name="id_prodi[]">
	</form>

</div><script type="text/javascript">
	function  diedit (ed) 
	{
		$('#jenis0'+ed.value).hide();
		$('#val0'+ed.value).hide();
		$('#key0'+ed.value).hide();
		$('#btn_1'+ed.value).hide();
		$('#btn_2'+ed.value).slideDown('slow');
		$('#jenis'+ed.value).slideDown('slow');
		$('#key'+ed.value).slideDown('slow');
		$('#val'+ed.value).slideDown('slow');
	}
	function batalin(btl)
	{
		$('#btn_2'+btl.value).hide();
		$('#jenis'+btl.value).hide();
		$('#key'+btl.value).hide();
		$('#val'+btl.value).hide();
		$('#btn_1'+btl.value).slideDown('slow');
		$('#jenis0'+btl.value).slideDown('slow');
		$('#key0'+btl.value).slideDown('slow');
		$('#val0'+btl.value).slideDown('slow');
	}

	function disimpan(dis)
	{
		
		var no=$('#'+dis.id).val();
		var kdp=$('#'+dis.id).attr('kdp');
		var idj=$('#'+dis.id).attr('jn');
		var key=$('#key'+dis.value).val();
		var val=$('#val'+no).val();

		$.ajax({
			url : "<?php echo base_url('yudisium/yudisium_c/update_config'); ?>",
			type: "POST",
			data : "kode_penawaran="+kdp+"&id_jenis="+idj+"&key="+key+"&val="+val+"&id_prodi="+$('#temp').serialize(),
			success: function(xxx)
			{
				$('#table-config').html(xxx);
			}
		});

	}


function cari_prodi_update(pr)
{
		
		var kdp=$('#'+pr.id).attr('kdp');
		var idj=$('#'+pr.id).attr('jn');

if(idj=='1')
{
	alert("1");
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/prodi_jalur') ?>",
		type: "POST",
		data: "kode_penawaran="+kdp,
		success: function(hxx)
		{
		
		$('#prodiEdit').html(hxx);

		
		}
	});

}

}

function dihapus(dis)
{
	var kdp=$('#'+dis.id).attr('kdp');
		var idj=$('#'+dis.id).attr('jn');
		var key=$('#key'+dis.value).val();
	$.ajax({
			url : "<?php echo base_url('yudisium/yudisium_c/delete_config'); ?>",
			type: "POST",
			data : "kode_penawaran="+kdp+"&id_jenis="+idj+"&key="+key,
			success: function(xxx)
			{
				$('#table-config').html(xxx);
			}
		});
}
</script>