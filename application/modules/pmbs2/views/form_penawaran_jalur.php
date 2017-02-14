
<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function cek_jam()
{
	if( Date.parse('01/01/2011 '+$("#jam_mulai").val()) < Date.parse('01/01/2011 '+$("#jam_selesai").val()) ){ return true; }
	else { return false; }
}
$(document).ajaxStart(function () {
        $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });
	$(function() 
	{
        
		var tgl = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');


	$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});

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
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$(".bs-callout").slideUp();
	}

</script>
<div>
<h3 style="margin-bottom:10px;">Form Penawaran Jalur</h3>
	<table  class="table table-hover">
		<?php echo form_open(base_url('adminpmb/input_data_c/penawaran_jalur_post'),array('name'=>'form_penawaran_jalur','method'=>'POST','class'=>'form-horizontal')); ?>
		<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td colspan="3">
				<select name='jalur_masuk' class="form-control input-md">
					<option value=''>Pilih Jalur</option>
					<?php
						foreach ($jalur_masuk as $valjalur) 
						{
							echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
						}
					?>
				</select>	
			</td>
		</tr>
		<tr>
			<td>
				<h>Tanggal</h>
			</td>
			
			<td>
			   <div class="input-group date" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="" name="tanggal_mulai_daftar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		</td>
			<td> 
				<h>s.d</h>
			</td>
			<td>
			   <div class="input-group date" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="" name="tanggal_selesai_daftar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		</td>
		</tr>
		<tr>
			<td>
				Jam Mulai
			</td>
			<td class="" colspan="3">
				<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai_daftar" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>

			</td>
			</tr>
			<tr>
		 	<td>
		 		Jam Selesai
		 	</td> 
		 	<td class="" colspan="3">
		 		<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai_daftar" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
		</tr>
		<tr>
			<td>
				<h>Tahun</h>
			</td>
			<td colspan="3">
				<select name='tahun' class="form-control input-md">
					<option> Pilih Tahun</option>
					<option value="2016">2016</option>
					<option value="2015">2015</option>
					<option value="2014">2014</option>
					<option value="2013">2013</option>
					<option value="2012">2012</option>
					<option value="2011">2011</option>
					<option value="2010">2010</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
				<?php echo form_submit(array('name'=>'btn_simpan_rpenawaran_jalur','value'=>'SIMPAN','class'=>'btn btn-inverse btn-uin btn-small')); ?>
				
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	</form>
	<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
</div>
<div id="tbl-penawaran">
<?php
$this->load->view('v_table/view_table_penawaran');
?>
</div>
