<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"/>
	
<div>
<script type="text/javascript">
	$(function() 
	{
        
	var tgl = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl2 = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl3 = $("#dp3").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});
});

	$(function(){
		setTimeout('closing_msg()', 4000);
	})

</script>
<h3 style="margin-bottom:10px;">FORM CONFIGURASI YUDISIUM</h3>

<form id="conf-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value); $('#grade').attr('value','0');">
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
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm">
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
				Jenis Configurasi
			</td>
			<td>
				<select class="form-control input-sm" name="jenis" id="jenis" style="width:300px;" onchange="cek_value(this.value)">
					<option value=""> Jenis Configurasi </option>
					<?php
						if(!is_null($jenis_config))
						{
							foreach ($jenis_config as $jc) {
								echo "<option value='".$jc->id_jenis."'>".$jc->nama_jenis."</option>";
							}
						}

					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				KEY Configurasi
			</td>
			<td>
				<select class="form-control input-sm" name="keys" style="width:300px;" >
					<option value=""> Key Configurasi </option>
					<?php
						if(!is_null($key_config))
						{
							foreach ($key_config as $kc) {
								echo "<option value='".$kc->key."'>".$kc->keterangan."</option>";
							}
						}

					?>
				</select>
			</td>
		</tr>
		<tr id="nilai">
			<td>
				Nilai Configurasi
			</td>
			<td>
				<input type="text" class="form-control input-sm" id="val" disabled name="valu" style="width:300px;">
			</td>
		</tr>
		<tr style="display:none" id="usia">
			<td>
				Tanggal Usia
			</td>
			<td>
				
					<div class="input-group date" id="dp1" data-date="" style="width:300px;" data-date-format="dd-mm-yyyy">
					<input class="form-control" size="16" id="sejak_tgl" type="text" disabled required name="valu">
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
			</td>
		</tr>
		<tr class='tgl_yudisium' style="display:none">
			<td>
				<h>Tanggal Mulai Yudisium</h>
			</td>
			
			<td colspan="2">
			<div id="tgl_mulai">
			   <div class="input-group date"  id="dp2" data-date="" data-date-format="dd/mm/yyyy">
						<input class="form-control" size="16" type="text" id="tanggal_mulai" name="tanggal_mulai" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
				</div>
				</td>
				<td colspan="2">
				<div class="input-group input-append col-md-6 bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>
		</td>
		</tr>
			
		<tr class='tgl_yudisium' style="display:none">
			<td> 
				<h>Tanggal Selesai Yudisium</h>
			</td>
			<td colspan="2">
			   <div class="input-group date" id="dp3" data-date="" data-date-format="dd/mm/yyyy">
						<input class="form-control" size="16" type="text" id="tanggal_selesai" name="tanggal_selesai" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
		<td colspan="2">
		 		<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
				</div>
				</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" value="conf-form" onclick="simpan_conf(this.value)"> SIMPAN</button>
			</td>
		</tr>
		<div style="display:none;" id="prodi"></div>
		</form>
		</table>
	
</div>
<div id="table-config">
	<?php
	$this->load->view('v_table/tabel_configurasi');
	?>
</div>
<br>
<div id="grade_prodi">
<button class="btn btn-inverse btn-uin btn-small" type="button" id="buka"  onclick="lihat_grade_prodi()"> GRADE PRODI</button>
<br><br>
<button class="btn btn-inverse btn-small" type="button" id="tutup" style="display:none" onclick="tutup()"> TUTUP GRADE PRODI</button>
<br><br>
<table class="table table-bordered" id="prodi_grade" style="display:none">
	
</table>
</div>

<script type="text/javascript">


function simpan_conf(f)
{
	var x=$('#jenis').val();
	if(x=='4')
	{
		var a=$('#tanggal_mulai').val();
		var s=$('#tanggal_selesai').val();
		if(a.length > 1 && s.length >1)
		{
			simpan(f);
		}
		else
		{
			alert("Isian tanggal masih kosong");
		}
	}
	else
	{
		simpan(f);
	}
}

function simpan(f)
{
	$("#table-config").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		$.ajax({
		url : "<?php echo base_url('yudisium/yudisium_c/simpan_conf') ?>",
		type: "POST",
		data: $('#'+f).serialize(),
		success: function(simpan)
		{
			
			$('#table-config').html(simpan);
			
		}
		});
}

function tutup()
{
		$('#prodi_grade').slideUp('slow');
		$('#tutup').slideUp('slow');
}

function tampil_grade_prodi()
{
	
	
}

function lihat_grade_prodi()
{
	
	$.ajax({
		url : "<?php echo base_url('yudisium/yudisium_c/request_grade_prodi'); ?>",
		type: "POST",
		success: function(gp)
		{
			$('#prodi_grade').html(gp);
			$('#prodi_grade').slideDown('slow');
			$('#tutup').slideDown('slow');
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

	$('#tahun').get(0).selectedIndex = 0;
}

function cari_prodi()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/prodi_jalur') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(hx)
		{
		
		$('#prodi').html(hx);

		}
	});

}

function cek_value(x)
{


	switch(x)
	{
		case '1':
		
		$('#usia').hide();
		$('#nilai').slideDown('slow');
		$('#val').attr('disabled',false);
		$('#sejak_tgl').attr('disabled',true);
		$('.tgl_yudisium').hide();
		cari_prodi();
		
		break;
		case '3':
		$('#nilai').hide();
		$('.tgl_yudisium').hide();
		$('#usia').slideDown('slow');
		$('#val').attr('disabled',true);
		$('#sejak_tgl').attr('disabled',false);
		$('#prodi').html('<div style="display:none;" id="prodi"></div>');
		break;
		case '4':
		$('#nilai').hide();
		$('#usia').hide();
		$('#val').attr('disabled',true);
		$('#sejak_tgl').attr('disabled',false);
		$('.tgl_yudisium').slideDown('slow');
		$('#prodi').html('<div style="display:none;" id="prodi"></div>');
		break;

		default:
		$('.tgl_yudisium').hide();
		$('#usia').hide();
		$('#nilai').slideDown('slow');
		$('#val').attr('disabled',false);
		$('#sejak_tgl').attr('disabled',true);
		$('.tgl_yudisium').hide();
		$('#prodi').html('<div style="display:none;" id="prodi"></div>');
		
		break;
	}
}

</script>
