<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
	
<div>
<h3 style="margin-bottom:10px;">REKAP MAHASISWA</h3>
<br>
	<table class="table table-hover">
		<tr id="master-form">
		<td>Jalur PMB</td>
			<td>
			<form id="all-form" method="POST">
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px" onchange="cari_gelombang(this.value)">
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
			</tr>
			<td>Tahun</td>
			<td>
				<select name='tahun' id="th" style="width:300px;" class="form-control input-sm" onchange="tahun=this.value">
				<option value=''> Pilih Tahun </option>
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
		<tr>
			<td>
				Kategori Pencarian
			</td>
			<td>
				<table>
	<tr>
		<td>
			<input type="radio" value="j" name="ktg" id="jalur" onchange="tampil_kategori(this)">
		</td>
		<td>
			JUMLAH BERDASARKAN JALUR PMB
		</td>
	</tr>
	<tr>
		<td>
			<input type="radio" value="k" name="ktg" id="kelasj" onchange="tampil_kategori(this)">
		</td>
		<td>
			JUMLAH BERDASARKAN PILIHAN KELAS
		</td>
	</tr>
	<tr>
		<td>
			<input type="radio" value="p" name="ktg" id="prodi" onchange="tampil_kategori(this)">
		</td>
		<td>
			JUMLAH BERDASARKAN PILIHAN PROGRAM STUDI
		</td>
	</tr>
	<tr>
		<td>
			 <input type="radio" value="v" name="ktg" id="verifikasi" onchange="tampil_kategori(this)">
		</td>
		<td>
			STATISTIK PENDAFTAR
		</td>
	</tr>
	<tr>
		<td>
			 <input type="radio" value="d" name="ktg" id="difable" onchange="tampil_kategori(this)">
		</td>
		<td>
			MAHASISWA DIFABLE
		</td>
	</tr>

</table>
			</td>
		</tr>
			<tr>
			<td></td>
		<td>
			<button type="button" id="klik_ane" disabled class="btn btn-inverse btn-uin btn-small" onclick="berdasarkan()"> Cari</button>
		</td>
		</form>
		</tr>
		</table>

</div>
<div id="table-rekap-mhs" style="display:none;">
</div>
<script type="text/javascript">
var tahun;
var ktg;
var tujuan;

function tampil_kategori (ktg_cari) {

		ktg=ktg_cari.value;
		$('#klik_ane').attr('disabled',false);
}

function berdasarkan()
{

	switch(ktg)
	{
		case 'j':
		tujuan="berdasar_jalur";
		break;
		case 'p':
		tujuan="berdasar_prodi";
		break;
		case 'v':
		tujuan="cari_statistik";
		break;
		case 'k':
		tujuan="cari_rekap_kelas";
		break;
		case 'd':
		tujuan="cari_difable";
		break;
		
	}

	call_me_guys(tujuan);

}

function call_me_guys(wkwkwk)
{

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/"+wkwkwk+"'); ?>",
		type: "POST",
		data: $('#all-form').serialize(),
		success: function(data_nya){
			
			$('#table-rekap-mhs').html(data_nya);
			$('#table-rekap-mhs').slideDown('slow');


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