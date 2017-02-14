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
	<script type="text/javascript">
	function cek_jam()
{
	if( Date.parse('01/01/2011 '+$("#jam_mulai").val()) < Date.parse('01/01/2011 '+$("#jam_selesai").val()) ){ return true; }
	else { return false; }
}

function datepic(i)
{
	
	$(".date").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date;
		}
	}); 
}


	$(function() 
	{ 

$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
		});


	var tgljdwl = $("#tgl_jdwl").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgljdwl.hide();
	}).data('datepicker');


	$("form#finput").submit(function() {
		if(cek_jam() == true){
			var formData = new FormData($(this)[0]);
			var perr = $("#perr").val();
		   // console.log(perr);
			$.ajax({
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				dataType: 'html',
				processData: false
			})
			.done(function(x) {
				$("#error-msg").html(x);
				$("#tbl-rekap").load('penjadwalan/'+perr);
				setTimeout(function() { $("#error-msg").html(""); }, 500);

			});
			return false;
		} else { $("#error-msg").html("Pengaturan jam tidak valid. Silakan diperbaiki terlebih dahulu."); return false; }	
	});

	});
	

</script>
	<style>
		#tempat{
			display:none;
		}
	</style>
	<br>
	<br>
<div>
<h3 style="margin-bottom:10px;">Form Jadwal Ujian</h3>
	<table class="table table-hover">
		<form method="POST" id="jadwal-ujian">
		<!--
		<tr>
			<td colspan="2">
			<button id="tbh" type="button" onclick="tbh_form()" class='btn btn-inverse btn-uin btn-small'>Tambah</button>
			
			<table id="tbh-dt">
				
			<tr>
				<td>
				Tanggal
				<input type="date" name="tgl_detil[]" class="form-control a1" >
				
				</td>
				<td>
				Jam Mulai
				<input type="time" name="jam_detil1[]" class="form-control b1" >
			
				</td>
				<td>
				Jam Selesai
				<input type="time" name="jam_detil2[]" class="form-control c1" >
				</td>
				<td>
					<select name="id_tes_detil[]" class="form-control" onchange="alert(this.value);">
						<option value=""> Jenis Tes </option>
						<?php
						/*
						if(!is_null($data_tes))
						{
							foreach ($data_tes as $data_tes1) {
								echo "<option value='".$data_tes1->id_tes."'>".$data_tes1->nama_tes."</option>";
							}
						}
						*/
						?>
					</select>
				</td>
		
			</tr>
		</table>
		<table class="tbl1"></table>
	
			</td>
		</tr>
		-->
		<tr>
			<td>
				<h>Lokasi Ujian</h>
			</td>
			<td>
			
						<input class="form-control" style="width:300px;" size="16" type="text" name="lokasi_ujian">
						
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<h>Tanggal Pengumuman</h>
			</td>
			<td>
				<div class="input-group date"style="width:300px;" style="width:300px;" id="tgl_jdwl" data-date="" data-date-format="dd-mm-yyyy">
					<input class="form-control" size="16" type="text" value="" name="pengumuman" readonly="">
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
		</tr>
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
				<h>Kuota Jadwal</h>
			</td>
			<td>
			
						<input class="form-control" size="16" type="text" style="width:300px;" name="kuota">
						
				</div>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_jadwal()"> Simpan</button>
			</td>
		</tr>
		
		</table>
	</form>
</div>
<div id="tbh-dtl" style="display:none;">
<br id="ganjel">

<H4>Form Tambah Detail Jadwal</H4>
<button class='btn btn-inverse btn-uin btn-small' onclick="tambah_detail()">Tambah</button>

<form id="form-d">
		<table id="tbl-dtl">
			
			<tr>
				<td>
				Tanggal
				<!--<input type="date" name="dt[]" class="form-control detgl" > -->
				<div class="input-group date" data-date="" data-date-format="dd-mm-yyyy" onclick="datepic(this)" >
					<input class="form-control" size="16" type="text" value="" name="dt[]" readonly="">
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
				</td>
				<td>
				Jam Mulai
				<input type="time" name="tm1[]" class="form-control tm1" >
				
				</td>
				<td>
				Jam Selesai
				<input type="time" name="tm2[]" class="form-control tm2" >
				</td>
				<td>
				Jenis Tes
					<select name="tes[]" id="test" class="form-control input-md test">
						<option value=""> -- </option>
						<?php

						if(!is_null($data_tes))
						{
							foreach ($data_tes as $ds) {
								echo "<option value='".$ds->id_tes."'>".$ds->nama_tes."</option>";
							}
						}
						?>
					</select>
				
				</td>
				<input type="hidden" id="bla" name="kode_jadwal">
			</tr>
		</table>
		<table class="tbl"></table>
			</form>
	<button class='btn btn-inverse btn-uin btn-small' onclick="simpan_detail()">Simpan Detil</button>	
</div>
<div id="tbl-detil"></div>
<div id="tbl-jadwal-ujian">
<?php

$this->load->view('v_table/view_table_jadwal_ujian');
?>
</div>
<script type="text/javascript">
	var jml=1;
	var jmlform=1;

	function tbh_form()
	{	
		jmlform++;
		
		$('.tbl1').attr('id',jmlform);

		var fx=document.getElementById('tbh-dt').innerHTML;
		$('#'+jmlform).append(fx);
		
	}

	function tambah_detail()
	{	

		jml++;
		$('.tbl').attr('id',"dtj"+jml);

		var x=document.getElementById('tbl-dtl').innerHTML;
		$('#dtj'+jml).append(x);
		$('#tbl-dtl').slideDown('slow');
	}

	function simpan_detail()
	{
		
		$.ajax({
			url : "<?php echo base_url('adminpmb/input_data_c/insert_detail_jadwal') ?>",
			type : "POST",
			data : $('#form-d').serialize()+"&nama_jalur="+nama,
			success: function(wekeke){
				 $('#tbl-detil').html(wekeke);
				 $('.form-control').attr('value','');
			}
		});

	}

function simpan_jadwal()
{
	$("#tbl-jadwal-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
	
	$.ajax({
			url : "<?php echo base_url('adminpmb/input_data_c/jadwal_ujian_post') ?>",
			type : "POST",
			data : $('#jadwal-ujian').serialize(),
			success: function(cihui){
				 $('#tbl-jadwal-ujian').html(cihui);
				
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