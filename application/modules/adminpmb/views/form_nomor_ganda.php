<table>
	<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td>
				<select name='kode_jalur' style="width:300px;" class="form-control input-md"  id="pena" onchange="cari_gelombang(this.value)">
				<option value=""> Pilih Jalur</option>
				<?php
				if(!is_null($jalur))
				{
					foreach ($jalur as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
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
			<td>
				
			</td>
			<td>
				<button class="btn btn-uin btn-inverse" type="button" onclick="cari_nomor()">CARI</button>
			</td>
		</tr>
</table>
<br>
<div id="data-duplikat"></div>
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

function cari_nomor()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_duplikat') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&gelombang="+gelombang+"&tahun="+tahun,
		success: function (selno)
		{
			$('#data-duplikat').html(selno);
		}
	});
}
</script>