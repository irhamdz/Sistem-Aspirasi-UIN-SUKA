<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  	
<div>
<h3 style="margin-bottom:10px;">FORM TAMBAH NILAI</h3>
<form id="finput" name="finput" method="post" class=" form-horizontal" action="<?php echo base_url('adminpmb/input_data_c/simpan_nilai'); ?>" enctype="multipart/form-data">
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
				<select name="id_tes" class="form-control input-md" style="width:300px;" onchange="cari_subtes(this.value)">
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
				Sub Tes
			</td>
			<td>
				<select name="sub_tes" class="form-control input-md" id="sub_tes" style="width:300px;">
					<option value=""> -- </option>
					
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Bobot
			</td>
			<td><div class="input-group" style="width:100px" >
				<input type="text" id="bobot" name="bobot" class="form-control input-md">
				<span class="input-group-addon" id="basic-addon2"> % </span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				Upload Excel(.Xls)
			</td>
			<td>
				<input id="file" name="file"  type="file" />
				<div class="reg-info">Format File NOMOR PESERTA | NILAI | KODE SOAL</div>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="submit"> PROSES</button>
			
			</td>
		</tr>
		</table>
	</form>
</div>
<?php if(strlen($this->session->flashdata('message'))>3){ ?>
<div class="bs-callout bs-callout-success">
								<p><?php echo $this->session->flashdata('message'); ?></p>
</div>
<?php } ?>
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

function cari_subtes(kdt)
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_subtes') ?>",
		type: "POST",
		data: "id_tes="+kdt,
		success: function(st){
			$('#sub_tes').html(st);
		}	
	});
}

</script>