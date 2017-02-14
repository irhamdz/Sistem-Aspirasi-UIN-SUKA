<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>
<h3 style="margin-bottom:10px;">REKAP NILAI DOKUMEN PORTOFOLIO</h3>
	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" onchange="cari_gelombang(this.value)" style="width:300px;">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
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
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="jadwal_lihat(this.value)">
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
			<td id='td-jadwal'><select name='kode_jadwal' style='width:300px;' id='jadwal' class='form-control input-md' >
				<option value=''>Pilih Jadwal Ujian</option>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="data_nilai_porto()"> LIHAT</button>
			</td>
		</tr>
		
		</table>
	
</div>
<div id="table-nilai">
	
</div>
<script type="text/javascript">


function data_nilai_porto () {


	var kode_jalur=$('#pena').val();

	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;			
	var jadwal_porto=$('#jadwal').val();

	$("#table-nilai").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_nilai_porto'); ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran+"&tahun="+tahun+"&kode_jadwal="+jadwal_porto+"&gelombang="+gelombang,
		success: function(docnil){
			$('#table-nilai').html(docnil);
		}
	});
	
}
function jadwal_lihat(jl)
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var kode_penawaran=kode_jalur+gelombang+jl;
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_jadwal_portofolio2'); ?>",
		type: "POST",
		data: "kode_jalur="+kode_penawaran+"&tahun="+jl,
		success: function(jd){
			$('#jadwal').html(jd);
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
<div id="table-doc-mhs">
</div>