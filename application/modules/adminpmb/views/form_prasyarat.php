
<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#jm,#js').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });
        });
    </script>
	<style>
	.day{
		font-size:14px;
	}
	</style>
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	
<div>
<h3 style="margin-bottom:10px;">Prasyarat</h3>
<input type="checkbox" id="jalur" value="j" onchange="show_jalur(this)"> JALUR
<br>
<input type="checkbox" id="sehat" value="k" onchange="show_jalur(this)"> KESEHATAN
<br>
<input type="checkbox" id="jur" value="jur" onchange="show_jalur(this)"> JURUSAN SEKOLAH
<br>
<br>
<div id="prasyarat-jalur" style="display:none;">
	<table class="table table-hover">
		<tr>
		<form method="POST" id="sarat-jalur">
			<td>
				<h>Jalur Masuk</h>
			</td>
			<td>
				<select name='kode_penawaran' class="form-control input-md" onchange="change_penawaran(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_penawaran."'>".$valjalur->jalur_masuk.' Gelombang '.$valjalur->gelombang."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				
					<?php
					if(!is_null($data_prasyarat))
					{
						foreach ($data_prasyarat as $pras) {
							
							echo "<input type='checkbox' value='".$pras->kode_prasyarat."' name='sarat[]' id='".$pras->kode_prasyarat."' onclick='simpan_prasyarat(this)'>";
							echo " ".$pras->nama_prasyarat."<br>";
							echo "<input type='text' id='min".$pras->kode_prasyarat."' name='skor[]' class='form-control input-md' placeholder='Skor minimal' style='display:none;'>";
						}
					}
					?>
		
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_sarat()"> Simpan</button>	
			</td>
		</tr>
		</form>
		</table>
</div>
	
<div id="prasyarat-kesehatan" style="display:none;">
	<table class="table table-hover">
		<tr>
		<form method="POST" id="sarat-sehat">
			<td>
				<h>Jalur Masuk</h>
			</td>
			<td colspan="2">
				<select name='kode_penawaran_kes' class="form-control input-md" onchange="change_penawaran_kes(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_penawaran."'>".$valjalur->jalur_masuk.' Gelombang '.$valjalur->gelombang."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Kelas
			</td>
			<td colspan="2">
			<div id="kel"><select name="kelas" id="k" class="form-control input-md" onchange="ambil_data(this)">
				<option value="">Pilih Kelas</option>
				
			</select></div>
			</td>
		</tr>
		</form>
		</table>
		<table>
			<tr id="jurus"></tr>
		</table>
</div>

<div id="prasyarat-jurusan" style="display:none;">
	<table class="table table-hover">
		<tr>
		<form method="POST" id="sarat-jurusan">
			<td>
				<h>Minat</h>
			</td>
			<td colspan="2">
				<select id='minat' class="form-control input-md" onchange="define_minat(this.value);">
				<option value="">Pilih Minat</option>
				<?php
				foreach ($data_minat as $minat) {
					echo "<option value='".$minat->kode_minat."'>".$minat->nama_minat."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<h>Jenjang Program Studi</h>
			</td>
			<td colspan="2">
				<select name='jenjang' id="jenjang" class="form-control input-md" onchange="change_jenjang(this.value)">
				<option value="">Pilih Jenjang</option>
				<?php
				foreach ($data_jenjang as $jenjang) {
					echo "<option value='".$jenjang->id_jenjang."'>".$jenjang->nama_jenjang."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		</form>
		</table>
		<table>
			<tr id="jurus"></tr>
		</table>
</div>

</div>
<br>
<div id="table-sarat">
</div>
<script type="text/javascript">
var penawaran;
var minat='';

function define_minat(curmin)
{
	minat=curmin;
	$('#table-sarat').slideUp('slow');
}

function ambil_data(kes)
	{
		kelas=kes.value;
		$.ajax({
			url:  "<?php echo base_url('adminpmb/input_data_c/tambah_prasyarat_prodi'); ?>",
			type: "POST",
			data: "kode_penawaran="+penawaran+"&id_kelas="+kes.value,
			success: function(kx)
			{
				$('#jurus').html(kx);

				
			}
		});
		

	}

function simpan_sarat_kes(abcd)
{
	var id_kes=abcd.value;
	var id_prod=$('#'+abcd.id).attr('isi');
	var kode_pen=penawaran;

	var cek=$('#'+abcd.id).prop('checked');
	if(cek)
	{
		//insert
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/simpan_prasyarat_prodi'); ?>",
			type: "POST",
			data: "kode_penawaran="+kode_pen+"&id_kesehatan="+id_kes+"&id_prodi="+id_prod,
			success: function(dikes)
			{
				alert(dikes);
			}
		});
	
	}
	else
	{
		//delete
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/delete_prasyarat_prodi'); ?>",
			type: "POST",
			data: "kode_penawaran="+kode_pen+"&id_kesehatan="+id_kes+"&id_prodi="+id_prod,
			success: function(delkes)
			{
				alert(delkes);
			}
		});
	}
	

}

function change_penawaran_kes(pen_kes)
{
	penawaran=pen_kes;

	$.ajax({
			url:  "<?php echo base_url('adminpmb/input_data_c/cari_kelas'); ?>",
			type: "POST",
			data: "kode_penawaran="+pen_kes,
			success: function(kls)
			{
				$('#kel').html(kls);
				//alert(kls);
			}
		});


}

function change_penawaran(pen)
{
	penawaran=pen;

	$.ajax({
		url : "<?php echo base_url('adminpmb/input_data_c/lihat_prasyarat_jalur') ?>",
		type: "POST",
		data: "kode_penawaran="+pen,
		success: function(vsar){
			$('#table-sarat').html(vsar);
		}
	});
}
function simpan_prasyarat(prasyarat)
{
	if($('#'+prasyarat.id).prop('checked'))
	{
		$('#min'+prasyarat.value).slideDown('slow');
	}
	else
	{
			document.getElementById('min'+prasyarat.id).value='';
			$('#min'+prasyarat.value).slideUp('slow');
	}
	
}

function simpan_sarat()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/insert_sarat_jalur') ?>",
		type: "POST",
		data: $('#sarat-jalur').serialize(),
		success : function(wx){
			alert(wx);
		}	
	});
}

function show_jalur(jal)
{
	
	if($('#'+jal.id).prop('checked'))
	{
		if(jal.value=='j')
		{
			$('#prasyarat-kesehatan').hide();
			$('#prasyarat-jurusan').hide();
			$('#prasyarat-jalur').slideDown('slow');
		}
		else if(jal.value=='k')
		{
			$('#prasyarat-jalur').hide();
			$('#prasyarat-jurusan').hide();
			$('#prasyarat-kesehatan').slideDown('slow');
		}
		else if(jal.value=='jur')
		{
			$('#prasyarat-jalur').hide();
			$('#prasyarat-kesehatan').hide();
			$('#prasyarat-jurusan').slideDown('slow');
		}
	}
	else
	{
		$('#prasyarat-jalur').slideUp('slow');
		$('#prasyarat-kesehatan').slideUp('slow');
		$('#table-sarat').slideUp('slow');
		$('#prasyarat-jurusan').slideUp('slow');
	}
}

function change_jenjang(jen)
{
	if(minat != '')
	{

		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_prodi_jur'); ?>",
			type: "POST",
			data: "kode_minat="+minat+"&id_jenjang="+jen,
			success: function(promin)
			{
				$('#table-sarat').html(promin);
				$('#table-sarat').slideDown('slow');
			}
		});
	}
	else
	{
		
		alert('Pilih minat dulu.');
       $("#jenjang").val($("#jenjang").data("default-value"));
    }
	
}

</script>