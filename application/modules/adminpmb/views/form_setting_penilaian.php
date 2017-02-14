<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
	<style>
	.day{
		font-size:14px;
	}

	</style>
	
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">Setting Penilaian</h3> 
<!--- <input type="checkbox" id="bobot" onchange="form_apa()"> Setting Bobot Perprodi-->
<br>
<div id="set_nilai">
<form id="form-set-nilai" >
<table>
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
			<select name="tes" class="form-control input-md">
				<option value="">--</option>
				<?php
				if(!is_null($data_tes))
				{
					foreach ($data_tes as $tes) {
						echo "<option value='".$tes->id_tes."'>".$tes->nama_tes."</option>";
					}
				}
				?>
			</select>
		</td>
		
	</tr>
	<td></td>
	<td>
	<button class="btn btn-inverse btn-small" type="button" onclick="tambah_sub()"> Tambah</button>
			<table id="tbl-sub">
			<tr>
			<td>
			NAMA SUB TES
			
			<select name="sub_tes[]" class="form-control input-md">
				<option value=""> -- </option>
				<?php
				if(!is_null($data_sub))
				{
					foreach ($data_sub as $das) {
						echo "<option value='".$das->id_sub."'>".$das->nama_sub."</option>";
					}
				}

				?>
			</select>
			</td>
			<td>
			<br>
			<input type="text" class="form-control input-md" name="awal[]" style="width:50px">
			</td>
			<td>
				<br>
				s.d
			</td>
			<td>
			<br>
			<input type="text" class="form-control input-md" name="akhir[]" style="width:50px">
			</td>
			<td>
				BOBOT %
			<input type="text" class="form-control input-md" name="bobot[]" style="width:50px">
			
			</td>
			</tr>
			<tr>
		<td>
			Jawaban Benar
		</td>
		<td>
			<input type="text" class="form-control input-md" name="benar[]" style="width:50px">
		</td>
	</tr>
	<tr>
		<td>
			Jawaban Salah
		</td>
		<td>
			<input type="text" class="form-control input-md" name="salah[]" style="width:50px">
		</td>
	</tr>
	<tr>
		<td>
			Tidak dijawab
		</td>
		<td>
			<input type="text" class="form-control input-md" name="kosong[]" style="width:50px">
		</td>
	</tr>
			</table>
			<table class="tbh"></table>
		</td>
	</tr>

	<tr>
		<td>
			
		</td>
		<td>
			<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="simpan_setting_nilai()"> Simpan</button>
		</td>
	</tr></form>
</table>

<br>
<div id="table-nilai">
<?php
$this->load->view('v_table/setting_nilai');
?>
</div></div>
<div id="form-bobot" style="display:none;">
	<form method="POST" id="form-bobot-prodi">
		<table>
			<tr>
		<td>
		Kode Penawaran
		</td>
		<td>
			<select name="kode_penawaran" class="form-control input-md" onchange="kode_jalur=this.value">
				<option value="">--</option>
				<?php
				if(!is_null($jalur_masuk))
				{
					foreach ($jalur_masuk as $jal2) {
						echo "<option value='".$jal2->kode_penawaran."'>".$jal2->jalur_masuk." Gelombang ".$jal2->gelombang."</option>";
					}
				}
				?>
			</select>
		</td>
		
	</tr>
	<tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:200px;" class="form-control input-sm" onchange="data_prodi(this.value)">
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
			Program studi
		</td>
			<td>
				<select name='prodi' id="prodi" style="width:200px;" class="form-control input-sm" onchange="id_prodi=this.value; tampil_form()">
				<option value=''> -- </option>					
				</select>
			</td>
		</tr>
		</table>
	</form>

<div id="form-simpan-bobot" style="display:none">
	<form method="POST" id="sb">
	<table>
		<tr>
			<td>
				NAMA SUB TES
			</td>
			<td>
				<select name="id_sub" class="form-control input-md">
				<option value=""> -- </option>
				<?php
				if(!is_null($data_sub))
				{
					foreach ($data_sub as $dasub) {
						echo "<option value='".$dasub->id_sub."'>".$dasub->nama_sub."</option>";
					}
				}

				?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
				BOBOT PILIHAN
			</td>
			<td>
				<input type="text" id="pil" name="bobot_pil" class="form-control input-sm">
			</td>
		</tr>
		<tr>
			<td>
				<input type="hidden" name="id_prodi" id="prod" class="form-control input-sm">
			</td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="simpan_bobot_sub()">SIMPAN</button>

			</td>
		</tr>
	</table>
		
	</form>
	
	</div>
	</form>
	<br>
	<div id="data-bobot" style="display:none">
		<?php
		$this->load->view('v_table/bobot_soal');
		?>
	</div>
</div>
	</div>
	</div>

<script type="text/javascript">
var kode_jalur;
var id_prodi;

function simpan_bobot_sub()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/simpan_bobot_sub') ?>",
		type: "POST",
		data: $('#sb').serialize(),
		success: function(hasil)
		{
			$('#data-bobot').html(hasil);
			$('#data-bobot').slideDown('slow');
		}
	});
}

function tampil_form()
{
	$('#form-simpan-bobot').hide();
	$('#form-simpan-bobot').slideDown('slow');
	$('#prod').attr('value',id_prodi);
}

function simpan_setting_nilai () {

 $("#table-nilai").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

$.ajax({
	url : "<?php echo base_url('adminpmb/input_data_c/simpan_setting_nilai') ?>",
	type: "POST",
	data: $('#form-set-nilai').serialize(),
	success: function(sn)
	{
		$('#table-nilai').html(sn);

	}
});

}


var jmlsub=0;
function tambah_sub()
	{	

		jmlsub++;
		$('.tbh').attr('id',jmlsub);

		var x=document.getElementById('tbl-sub').innerHTML;
		$('#'+jmlsub).append(x);
		$('tbh').slideDown('slow');
	
	}

function form_apa()
{
	if($('#bobot').prop('checked'))
	{
		
		$('#set_nilai').hide();
		$('#data-bobot').slideDown('slow');
		$('#form-bobot').slideDown('slow');
	
	}
	else
	{
		$('#form-bobot').hide();
		$('#data-bobot').hide();
		$('#set_nilai').slideDown('slow');
	}
}

function data_prodi(dp)
{
	
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/bobot_prodi'); ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&tahun="+dp,
		success: function(suc)
		{
			$('#prodi').html(suc);

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