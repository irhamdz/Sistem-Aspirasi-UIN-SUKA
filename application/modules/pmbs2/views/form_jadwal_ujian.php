<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
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

	$(function() 
	{
        
		var tgl = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
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
		<?php echo form_open(base_url('adminpmb/input_data_c/jadwal_ujian_post'),array('name'=>'form_jadwal_ujian','method'=>'POST','class'=>'form-horizontal')); ?>
		<tr>
			<td>
				<h>Kode Jadwal</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'kode_jadwal','class'=>'form-control input-md')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>Hari</h>
			</td>
			<td>
				<select name='hari' class="form-control input-md">
				<option> Pilih Hari</option>
				<option value="SENIN">SENIN</option>
				<option value="SELASA">SELASA</option>
				<option value="RABU">RABU</option>
				<option value="KAMIS">KAMIS</option>
				<option value="JUMAT">JUM'AT</option>
				<option value="SABTU">SABTU</option>
				<option value="MINGGU">MINGGU</option>
			</select>
				</td>
		</tr>

		<tr>
			<td>
				<h>Tanggal Ujian</h>
			</td>
			<td>
				<div class="input-group date" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="" name="tanggal_ujian" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				Jam Mulai
			</td>
			<td class="">
				<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai_ujian" readonly="" style="margin-bottom:0px;">
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>

			</td>
			</tr>
			<tr>
		 	<td>
		 		Jam Selesai
		 	</td> 
		 	<td class="">
		 		<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai_ujian" readonly="" style="margin-bottom:0px;">
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
		</tr>

		<tr>
			<td>
				<h>Kode Penawaran</h>
			</td>
			<td>
				<select name='kode_penawaran' class="form-control input-md">
				<option> Pilih Jalur</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_penawaran."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
			</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td align="left">
				<?php echo form_submit(array('name'=>'btn_simpan_jadwal','value'=>'SIMPAN','class'=>'btn btn-inverse btn-uin btn-small')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>
<?php
$this->load->view('v_table/view_table_jadwal_ujian');
?>