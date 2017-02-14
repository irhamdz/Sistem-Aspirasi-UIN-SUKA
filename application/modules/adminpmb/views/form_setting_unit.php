<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#jm,#js').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });
        });
$(function() 
	{
  var tgl1 = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl1.hide();
	}).data('datepicker');

	var tgl2 = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl2.hide();
	}).data('datepicker');

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
<h3 style="margin-bottom:10px;">Form UNIT</h3>
	<table class="table table-hover">
		<tr>
			<td>
			<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="view_logo()">Logo</button>
			</td>
			<td>
			<button class='btn btn-inverse btn-uin btn-small' onclick="view_unit()" type="button">Unit</button>
			</td>
			<td>
			<button class='btn btn-inverse btn-uin btn-small' onclick="view_agenda()" type="button">Agenda</button>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				
			</td>
			<td>
				
			</td>
			<td>
					<table id="table_logo" style="display:none"> 
						<tr>
						<form id="form_log" method="POST">
							<td>
								<input type="file" id="inpLOGO">
								<input type="hidden" id="OutLOGO" name="foto">
								<br>
							</td>
							</tr>
						<tr>
						<td>
							<div class="input-group date" id="dp1" data-date="" data-date-format="dd/mm/yyyy">
							<input class="form-control" size="16" type="text" name="tanggal_mulai" readonly="">
							<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
							</div>
						
						   s.d 
						
							<div class="input-group date" id="dp2" data-date="" data-date-format="dd/mm/yyyy">
							<input class="form-control" size="16" type="text" name="tanggal_selesai" readonly="">
							<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
							</div>
						</td>
						</tr>
						<tr>
						<td>
							<img style="width:40px" id="lihatfoto" class="sia-profile-image" style="display:none">
						</td>
						</tr>
						<tr>
							<td>
							<br>
								<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_logo()"> Simpan</button>
		
							</td>
						</tr>
						</table></form>


	<table style="display:none" id="table_form_unit">
	<form id="form_tbh_unit" method="POST">
		<tr>
			<td>
				Kementrian
			</td>
			<td>
				<input type="text" name="mentri" class="form-control input-md">
			</td>
		</tr>
		<tr>
			<td>
				Nama UNIT
			</td>
			<td>
				<input type="text" name="nama" class="form-control input-md">
			</td>
		</tr>
		<tr>
			<td>
				Alamat
			</td>
			<td>
				<textarea class="form-control input-md" name="alamat"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				Telp
			</td>
			<td>
				<input type="text" name="telp" class="form-control input-md">
			</td>
		</tr>
		<tr>
			<td>
				Email
			</td>
			<td>
				<input type="text" name="email" class="form-control input-md">
			</td>
		</tr>
		<tr>
			<td>
				Kota
			</td>
			<td>
				<input type="text" name="kota" class="form-control input-md">
			</td>
		</tr>
		<tr>
							<td>
								
							</td>
							<td>
							
								<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="tambah_unit()"> Simpan</button>
		
							</td>
						</tr>
		</form>
	</table>

	<table id="table-agenda" style="display:none;">
	<form id="form-agenda" method="POST">
		<tr>
			<td>
				Nama Agenda
			</td>
			<td>
				<textarea class="form-control input-md" name="agenda" style="width:300px" cols="7" rows="5"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				Tahun Akademik
			</td>
			<td>
				<input type="text" name="tahun" class="form-control input-md" style="width:300px">
			</td>
		</tr>
		<tr>
			<td>
								
			</td>
			<td>			
			<br>
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="tambah_agenda()"> Simpan</button>
		
			</td>
			</tr>
	</table>
			</td>
		</tr>
	</table>
	
				
</div>
<div id="table-unit">
<?php
$this->load->view('v_table/data_unit');
?>
</div>
<br>Setting Catatan Kartu Ujian
	<form id="form_catatan">
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
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="catatan_lihat(this.value)">
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
		
		</table>
	</form>
	<table>
	<tr>
		<td>
			
		</td>
		<td>
			<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="tambah_detail()"> Tambah Kolom</button>
		</td>
	</tr>
	</table>
		<form id="f-tb-cttn">
	<table  id="tbl-dtl">
		<tr>
			<td>
				Catatan
			</td>
			<td>
				<input type="text" name="ct[]" class="form-control input-md">
			</td>
		</tr>
	</table>
	<table class="tbl"></table>
	</form>
		<br>
		<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_ct_baru()"> Simpan catatan</button>
	<div id="tb-cttn" style="display:none;"></div>
<script type="text/javascript">

function simpan_ct_baru()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	if(kode_jalur.length > 0 && gelombang.length >0 && tahun.length >0)
	{
		$('#tb-cttn').hide();
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/simpan_ct_baru') ?>",
			type: "POST",
			data: $('#f-tb-cttn').serialize()+"&kode_penawaran="+kode_penawaran,
			success: function(cx)
			{	
				$('#tb-cttn').html(cx);
				$('#tb-cttn').slideDown('slow');
				alert("Berhasil");
			}

		});
	}
	else
	{
		alert("Isi form dengan benar.");
	}
}

var jml=0;
function tambah_detail()
	{	

		jml++;
		$('.tbl').attr('id',"dtj"+jml);

		var x=document.getElementById('tbl-dtl').innerHTML;
		$('#dtj'+jml).append(x);
		
	}
function view_logo()
{
	$('#table_form_unit').hide();
	$('#table-agenda').hide();
	$('#table_logo').slideDown('slow');

}
function view_unit()
{
	$('#table-agenda').hide();
	$('#table_logo').hide();
	$('#table_form_unit').slideDown('slow');
}

function gel_change()
{
	document.getElementById('tahun').selectedIndex=0;
}

function view_agenda()
{
	$('#table_logo').hide();
	$('#table_form_unit').hide();
	$('#table-agenda').slideDown('slow');
}

	

	function simpan_logo()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/simpan_logo') ?>",
			type: "POST",
			data: $('#form_log').serialize(),
			success: function(lg)
			{
				alert(lg);
			}
		});
	}

	function tambah_unit()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/tambah_unit') ?>",
			type: "POST",
			data: $('#form_tbh_unit').serialize(),
			success: function(un)
			{
				alert(un);
			}
		});
	}

	function tambah_agenda()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/tambah_agenda') ?>",
			type: "POST",
			data: $('#form-agenda').serialize(),
			success: function(ag)
			{
				alert(ag);
			}
		});
	}


	function lihatya(xxxx)
	{
	
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_logo') ?>",
			type: "POST",
			data: "id_logo="+xxxx,
			success: function(logoxx)
			{
				
				$('#logo').attr('src',logoxx);
				$('#logo').slideDown('slow');
				
			}
		});

	}

	function readFOTO(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (lg) {
         	$('#OutLOGO').attr('value', lg.target.result);	  
         	$('#lihatfoto').attr('src',lg.target.result);
         	$('#lihatfoto').slideDown('slow');
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#inpLOGO").change(function(){

	
    readFOTO(this);
   
});

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

function catatan_lihat(th)
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=th;
	var kode_penawaran=kode_jalur+gelombang+tahun;
	
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/lihat_catatan') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(ct)
		{
			$('#tb-cttn').html(ct);
			$('#tb-cttn').slideDown('slow');
		}
	});
}

function edit_catatan(ec)
{
	var no=$('#'+ec.id).attr('no');
	$('#tp'+no).hide();
	$('#'+ec.id).hide();
	$('#hp'+no).hide();
	$('#smp'+no).slideDown('slow');
	$('#ct'+no).slideDown('slow');
	$('#btl'+no).slideDown('slow');

}

function batal_catatan(no)
{
	$('#smp'+no).hide();
	$('#ct'+no).hide();
	$('#btl'+no).hide();
	$('#tp'+no).slideDown('slow');
	$('#ed'+no).slideDown('slow');
	$('#hp'+no).slideDown('slow');
}

function hapus_catatan(hc)
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/hapus_catatan') ?>",
		type: "POST",
		data: "id_catatan="+hc.value+"&kode_penawaran="+kode_penawaran,
		success: function(hf)
		{
			$('#tb-cttn').html(hf);
			$('#tb-cttn').slideDown('slow');
		}
	});
}

function simpan_catatan(x)//update
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;

	var id_catatan=$('#'+x.id).attr('value');
	var no=$('#'+x.id).attr('no');
	var cat=$('#ct'+no).val();
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/update_catatan') ?>",
		type: "POST",
		data: "id_catatan="+id_catatan+"&catatan="+cat+"&kode_penawaran="+kode_penawaran,
		success: function(xy)
		{
			$('#tb-cttn').html(xy);
			$('#tb-cttn').slideDown('slow');
		}
	});
}

</script>







