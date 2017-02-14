
<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"/>
<script type="text/javascript">

$(document).ajaxStart(function () {
        $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
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


var tgl3 = $("#bayar1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl3.hide();
	}).data('datepicker');

	var tgl4 = $("#bayar2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl4.hide();
	}).data('datepicker');



	$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});

	});
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$(".bs-callout").slideUp();
	}
//class="table table-hover" 
</script>
<h3 style="margin-bottom:10px;">Form Setting Jadwal Pengisian Data Profile</h3>
	<table class="table">
		<form method="post" id="penewaran_jalur">
		<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td colspan="3">
				<select name='jalur_masuk' id="pena" class="form-control input-md" onchange="jadwal_lihat()">
					<option value=''>Pilih Jalur</option>
					<?php
					if(!is_null($jalur))
					{
						foreach ($jalur as $valjalur) 
						{
							echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
						}
					}
					?>
				</select>	
			</td>
		</tr>
		
		<tr>
			<td>
				<h>Tanggal Mulai Pendaftaran</h>
			</td>
			
			<td colspan="2">
			<div id="tgl_mulai">
			   <div class="input-group date"  id="dp1" data-date="" data-date-format="dd/mm/yyyy">
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
			
		<tr>
			<td> 
				<h>Tanggal Selesai Pendaftaran</h>
			</td>
			<td colspan="2">
			   <div class="input-group date" id="dp2" data-date="" data-date-format="dd/mm/yyyy">
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
			<td>
				Keterangan
			</td>
			<td>
				<input type="text" class="form-control " id='ket' name="keterangan" style="width:300px;">
					
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="update_profile()"> Simpan / Perbaharui</button>
			</td>
		</tr>
		</form>
		</table>
<div id="tbl-jadwal">
<?php
$this->load->view('v_table/view_table_jadwal_profile');
?>
</div>
<script type="text/javascript">
function jadwal_lihat()
{
	keterangan();
}

function keterangan()
{
	var jalur=$("#pena option:selected").text();
	var gel=$("#gelombang option:selected").text();
	var tahun=$("#tahun option:selected").text();
	$('#ket').attr('value',jalur);
}

function update_profile()
{
	$("#tbl-jadwal").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
	var kode_jalur=$("#pena").val();
	var tgl_mulai=$('#tanggal_mulai').val()+" "+$('#jam_mulai').val();
	var tgl_selesai=$('#tanggal_selesai').val()+" "+$('#jam_selesai').val();
	var keterangan=$('#ket').val();

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/simpan_jadwal_pengisisan_profile') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&tgl_mulai="+tgl_mulai+"&tgl_selesai="+tgl_selesai+"&keterangan="+keterangan,
		success: function(up)
		{
			$('#tbl-jadwal').html(up);
		}
	});
}
</script>
