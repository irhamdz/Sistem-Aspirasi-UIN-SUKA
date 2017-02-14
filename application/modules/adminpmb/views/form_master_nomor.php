<br>
<h3>DATA NOMOR PESERTA</h3>
<br>
<form method="POST" id="form-nomor">
<table class="table table-hover">
	<tr>
			<td>
				Jalur PMB
			</td>
			<td>
				<select name="kode_jalur" class="form-control input-md" style="width:300px;" id="pena" onchange="cari_gelombang(this.value)">
					<option value=""> -- </option>
					<?php
					if(!is_null($jalur_masuk))
					{
						foreach ($jalur_masuk as $jm) {
							echo "<option value='".$jm->kode_jalur."'>".$jm->jalur_masuk."</option>";
						}
						
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Gelombang
			</td>
			<td>
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;" onchange="gel_change()">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-md" onchange="tahun_change(this.value)">
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
		<td>Jadwal Ujian</td>
			<td id="td-jadwal"><select name='kode_jadwal' style='width:300px;' id='jadwal'  onchange="cari_ruang()" class='form-control input-md' >
				<option value=''>Pilih Jadwal Ujian</option>
		</tr>
		<tr>
			<td>
				Gedung : Ruang
			</td>
			<td>
				<select name="ruang" id="ruang" style='width:300px;' class="form-control input-md">
					<option value="">--</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class="btn btn-uin btn-inverse" type="button" onclick="cari_nomor()"> CEK</button>
			</td>
		</tr>
		</table>
		</form>
		<br>
<div id="data-nomor"></div>
<script type="text/javascript">
function cari_gelombang(jal)
{
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

function tahun_change(thn)
	{
		var jalur=$('#pena').val()+$('#gelombang').val();
		$.ajax({
			url 	: "<?php echo base_url('adminpmb/input_data_c/cari_jadwal_ujian'); ?>",
			type	: "POST",            
			data: "kode_jalur="+jalur+"&tahun="+thn,
			success: function(jh)
			{
				$('#td-jadwal').html(jh);
				
			}
		});
		
	}

	function cari_nomor()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_nomor') ?>",
			type: "POST",
			data: $('#form-nomor').serialize(),
			success: function(cn)
			{
				$('#data-nomor').html(cn);
			}
		});
	}

function cari_ruang()
{
	var kode_jalur=$('#pena').val();
	var kode_jadwal=$('#jadwal').val();
	var tahun=$('#tahun').val();

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_ruang_ujian'); ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&kode_jadwal="+kode_jadwal+"&tahun="+tahun,
		success: function(ru)
		{
			$('#ruang').html(ru);

		}
	});
}
</script>