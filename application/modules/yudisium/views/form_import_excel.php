<br>
<h3>FORM IMPORT EXCEL</h3>
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
				<div class="reg-info">Jika gelombang tidak muncul maka <b>ABAIKAN SAJA</b></div>
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
				
			</td>
			<td>
			<button class="btn btn-uin btn-inverse" type="button" onclick="ambil_format()">Download</button>	
			</td>
		</tr>
	</table>
	<div class="bs-callout bs-callout-info">Untuk mengupload data yudisium, silakan <b>Download</b> format file Excel.</div> 
	<h3>UPLOAD EXCEL</h3>
	<?php
	if(!empty($this->session->flashdata('message')))
	{
		echo $this->session->flashdata('message');
		
	}
	?>
	<table>
		<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('yudisium/yudisium_c/import_data_excel') ?>">
		<tr>
			<td>
				<input type="file" name="file">
			</td>
			<td>
				<button class="btn btn-uin btn-inverse btn-small" type="submit">Import</button>
			</td>
		</tr>
		</form>
	</table>
	<script type="text/javascript">

function ambil_format()
{
	
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();

	if(!gelombang)
	{
		gelombang="1";
	};
	var url="<?php echo base_url('yudisium/yudisium_c/download_excel/"+kode_jalur+"/"+gelombang+"/"+tahun+"') ?>";
	window.open(url,'_blank');
	
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