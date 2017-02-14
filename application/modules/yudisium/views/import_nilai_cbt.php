<br>
<h3>FORM IMPORT NILAI CBT</h3>
<table class="table table-hover">
	
		<tr>
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
				</select>
			</td>
			<input type="hidden" id="ptr" name="pilihan">
		</tr>
		<tr>
			<td>
				Gelombang
			</td>
			<td>
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cari_jadwal(this.value)">
				<option value=''> Pilih Tahun </option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=10;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
			</td>
		</tr>
		<tr>
			<td>
				JADWAL
			</td>
			<td>
				<select name='kode_jadwal' id="kode_jadwal" style='width:300px;' class='form-control input-md'>
				<option value=''>--</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
			<button class="btn btn-uin btn-inverse" type="button" onclick="import_nilai()">IMPORT</button>	
			</td>
		</tr>
	</table>
	<br>
	<div id="msg"></div>
	<script type="text/javascript">

function import_nilai()
{
	$("#msg").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/import_nilai') ?>",
		type: "POST",
		data: "kode_jalur="+$('#pena').val()+"&gelombang="+$('#gelombang').val()+"&tahun="+$("#tahun").val()+"&kode_jadwal="+$('#kode_jadwal').val(),
		success: function(inx)
		{
			$('#msg').html(inx);
		}
	});
}


function cari_gelombang(jal)
{
	
	$('#tahun').get(0).selectedIndex = 0;
	
	
		$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_gelombang') ?>",
		type: "POST",
		data: "kode_jalur="+jal,
		success: function (seljal)
		{
			$('#gelombang').html(seljal);

		}
		});
	
}

function cari_jadwal(th)
{
	var kode_jalur=$('#pena').val()+$('#gelombang').val();
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_jadwal') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&tahun="+th,
		success: function(jd)
		{
			$('#kode_jadwal').html(jd);

		}
	});
}
</script>