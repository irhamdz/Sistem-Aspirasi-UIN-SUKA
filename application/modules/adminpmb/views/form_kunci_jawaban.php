<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  	
<div>
<h3 style="margin-bottom:10px;">Setting Kunci Jawaban</h3>
<form method="POST" id="form-kunci">
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
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" class="form-control input-sm" onchange="jadwal_lihat(this)">
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
				Jenis Tes
			</td>
			<td>
				<select name="id_tes" class="form-control input-md" style="width:300px;">
					<option value=""> -- </option>
					<?php
					if(!is_null($data_tes))
					{
						foreach ($data_tes as $dt) {
							echo "<option value='".$dt->id_tes."'>".$dt->nama_tes."</option>";
						}
						
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Kode Soal
			</td>
			<td>
				<input type="text" name="kode_soal"  class="form-control input-md" style="width:300px;">
			</td>
		</tr>
		<tr>
			<td>
				Jumlah Soal
			</td>
			<td>
				<input type="text" name="jml_soal" id="jml_soal" class="form-control input-md" style="width:300px;">
			</td>
		</tr>
		<tr>
			<td>
				Kunci
			</td>
			<td>
				<textarea class="form-control input-md" id="kunci" name="kunci" rows="5" onkeypress="validate(this)"></textarea>
				<div class='reg-info'>Jawaban BONUS isi dengan <b>X</b>.</div>
		
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="simpan_kunci()"> SIMPAN</button>
			
			</td>
		</tr>
		</table>
	</form>
</div>
<div id="table-kunci">
<?php
$this->load->view('v_table/table_kunci');
?>
</div>
<script type="text/javascript">
	function validate (k) {
		var str=k.value;
		var jml=$('#jml_soal').val();

		if(str.length > (jml-1))
		{
			
			alert('Kunci jawaban melebihi jumlah soal!');
			
		}
		
	}

	function simpan_kunci()
	{
		
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/simpan_kunci') ?>",
			type: "POST",
			data: $('#form-kunci').serialize(),
			success: function(oke)
			{
				$('#table-kunci').html(oke);
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