<br>
<h3>FORM REKAP PENDAFTAR PERKABUPATEN</h3>
<br>
<div>
<form id="form-rekap-kab">
	<table>
		<tr>
		<td>
			JALUR
		</td>
		<td>
			<select name="kode_jalur" id="kode_jalur" class="form-control input-md" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value=""> Jalur PMB </option>
				<?php
				if(!is_null($jalur))
				{
					foreach ($jalur as $jal) {
						echo "<option value='".$jal->kode_jalur."'>".$jal->jalur_masuk."</option>";
					}
				}
				?>
			</select>
		
		<tr>
		<td>
			GELOMBANG
		</td>
		<td>
			
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> Gelombang </option>
				</select>
		
		</td>
		</tr>
		<tr>
			<td>
				TAHUN
			</td>
			<td>
				<select name='tahun' style="width:300px;" id="th"  class="form-control input-sm" onchange="tahun=this.value">
				<option value=''> Tahun </option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=20;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
			</td>
		</tr>

	</tr>
	<tr>
		<td>
			
		</td>
		<td>
			<button class="btn btn-inverse btn-uin" type="button" onclick="cari_rekap()">LIHAT</button>
		</td>
	</tr>
	</table>
	</form>
</div>
<br>
<div id="rekap-kab">
	
</div>
<script type="text/javascript">
function cari_rekap()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/rekap_jalur_kab'); ?>",
		type: "POST",
		data: $('#form-rekap-kab').serialize(),
		success: function(rk)
		{
			$('#rekap-kab').html(rk);
		}
	});
}

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
</script>