<h3 style="margin-bottom:10px;">Data Ruangan Ujian</h3>
<table>
	<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td>
				<select name='kode_jalur' style="width:300px;" class="form-control input-md"  id="pena" onchange="cari_gelombang(this.value)">
				<option value=""> Pilih Jalur</option>
				<?php
				if(!is_null($jalur_masuk))
				{
					foreach ($jalur_masuk as $valjalur) {
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
			Jadwal
		</td>
		<td>
			<select name="kode_jadwal" id="jadwal_jalur2" class="form-control input-md" style="width:300px">
			<option value="">Pilih Jadwal</option>
			</select>
		</td>
	</tr>
	<TR>
		<td>
			
		</td>
		<td>
			<button class="btn btn-uin btn-inverse" type="button" onclick="grup_ruang_jadwal()">CARI</button>
		</td>
	</TR>
</table>
<div id="pesan"></div>
<div id="table-ruang-ujian">
</div>
<script type="text/javascript">
	function tahun_change(tahun) {
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	$.ajax({
		url : "<?php echo base_url('adminpmb/input_data_c/cari_detail_jadwal2') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function (isi) {
			$('#jadwal_jalur2').html(isi);
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

function grup_ruang_jadwal()
{
	var gj=$('#jadwal_jalur2').val();
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	$("#table-ruang-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
	$.ajax({
			url:"<?php echo base_url('adminpmb/input_data_c/ruang_ujian_grup') ?>",
			type:"POST",
			data: "kode_jadwal="+gj+"&kode_penawaran="+kode_penawaran,
			success : function(gjx)
			{
				
				$('#table-ruang-ujian').html(gjx);
				
			}
	});
}

</script>