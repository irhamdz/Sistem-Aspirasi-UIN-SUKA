<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	
<div>
<h3 style="margin-bottom:10px;">Form Pembobotan</h3>

	<table class="table table-hover">
	<tr>
		<td>
				<button class="btn btn-inverse btn-uin btn-small" onclick="lihat_form_setting()" type="button">Setting Putaran</button>
		</td>
		<td>
				<button class="btn btn-inverse btn-uin btn-small" onclick="tambah_kolom()" type="button">Tambah / Edit Bobot Tes</button>
		</td>
		<input type="hidden" id="who" value='setting_putaran'>
	</tr>
	</table>
<form id="setting_putaran" method="POST">
	<table id="setting" >
	<tr>
	<td>
				<select name="kode_penawaran" class="form-control input-md" id="penawaran" width='200px' onchange="cari_kelas(this.value)">
					<option value=""> Jalur PMB </option>
					<?php
					if(!is_null($jalur_masuk))
					{
						foreach ($jalur_masuk as $j) {
							echo "<option value='".$j->kode_penawaran."'>".$j->jalur_masuk." Gelombang ".$j->gelombang."</option>";
						}
					}
					?>
				</select>
			</td>
			<td>
				<select name="kelas" id="kelas" class="form-control input-md" onchange='ambil_data(this.value)'>
					<option value=""> Kelas </option>
				</select>
			</td>
			<td>
			<select  class="form-control input-md" name="putaran" id="putaran">
				<option value=""> -- </option>
				<option value="1"> 1</option>
				<option value="2"> 2</option>
				<option value="3"> 3</option>
			</select>
		</td>
	</tr>
	
	<tr id="pembobotan">
		
	</tr>
		
		</form>
	</table>
	<form id="tambah_item_bobot" method="POST">
	
		<button class="btn btn-inverse btn-uin btn-small" id="tbh" style="display:none;" onclick="tambah_kolom_form()" type="button">Tambah Kolom</button>
		
	<table id="kolom" style="display:none;" >
		<tr>
			<td>
			JALUR
				<select name="kode_penawaran[]" class="form-control input-md" width='100px' onchange="cari_kelas(this.value)">
					<option value=""> -- </option>
					<?php
					if(!is_null($jalur_masuk))
					{
						foreach ($jalur_masuk as $j2) {
							echo "<option value='".$j2->kode_penawaran."'>".$j2->jalur_masuk." Gelombang ".$j2->gelombang."</option>";
						}
					}
					?>
				</select>
			</td>
		
		<td>
			<td>
			NAMA
				<input type="text" name="nama[]" class="form-control input-md">
			</td>
			<td>
			BOBOT
			<div class="input-group">
				<input type="text" name="bobot[]" class="form-control input-md" style="width:50px">
			<span class="input-group-addon" id="basic-addon2"> % </span>
				</div>
			</td>
			<td>
			KODE
				<select name="kode[]" class="form-control input-md" style="width:150px">
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
			<td>
			STATUS
				<select name="status[]" class="form-control input-md" style="width:70px">
					<option value=""> -- </option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
			</td>
		</tr>
		<table class="cpy_colom">
		<tr >
			
		</tr>
	</table>
	</table>

	
		<hr>
			
			<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="simpan_bobot()">Simpan</button>

</form>
	
</div>
<div id="table-item-bobot">

</div>
<script type="text/javascript">
	var jml_bbt=0;

function tambah_kolom_form()
{	
		jml_bbt++;
		$('.cpy_colom').attr('id',jml_bbt);
		
		var x=document.getElementById('kolom').innerHTML;
		$('#'+jml_bbt).append(x);
		$('#kolom').slideDown('slow');
}

function simpan_bobot()
{
	var siapa=$('#who').val();
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/"+siapa+"'); ?>",
		type: "POST",
		data: $('#'+siapa).serialize(),
		success: function(sukses)
		{	
			alert(sukses);
		}
	});
}

function tambah_kolom()
{
		$('#setting').hide();
		$('#who').attr('value','tambah_item_bobot');
		$('#kolom').slideDown('slow');
		$('#tbh').slideDown('slow');
		$('.cpy_colom').slideDown('slow');
}

function lihat_form_setting()
{
	window.open("http://admisi.uin-suka.ac.id/yudisium/yudisium_c/setting_yudisium",'_self');
	$('#who').attr('value','setting_putaran');
	$('#kolom').hide();
	$('.cpy_colom').hide();
	$('#setting').slideDown('slow');
}

function ambil_data(kel)
{
	var kode_penawaran=$('#penawaran').val();
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_putaran3'); ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran+"&id_kelas="+kel,
		success: function(ptr2)
		{	
			if(ptr2 != '0')
			{
				$('#putaran').html(ptr2);

			}

			

		}
	});
}

function cari_kelas(pen)
{

	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_pembobotan'); ?>",
		type: "POST",
		data: "kode_penawaran="+pen,
		success: function(bbt)
		{	
			$('#pembobotan').html(bbt);
			
		}
	});


	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_kelas_fokus'); ?>",
		type: "POST",
		data: "kode_penawaran="+pen,
		success: function(kls)
		{	
			$('#kelas').html(kls);
			
		}
	});

	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_putaran'); ?>",
		type: "POST",
		data: "kode_penawaran="+pen,
		success: function(ptr)
		{	
			if(ptr != '0')
			{
				$('#putaran').html(ptr)

			}
			
			

		}
	});


}
</script>