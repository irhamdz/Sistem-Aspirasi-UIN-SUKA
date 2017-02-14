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
<h3 style="margin-bottom:10px;">Form Detail Jadwal</h3>
	<table class="table table-hover">
		<?php //echo form_open(base_url('adminpmb/input_data_c/jadwal_ujian_post'),array('name'=>'form_jadwal_ujian','method'=>'POST','class'=>'form-horizontal')); ?>
		<form method="POST" id="detail_jadwal">
		<tr>
			<td>
				Jadwal
			</td>
			<td>
				<select name="kode_jadwal" class="form-control input-md">
					<option value="">--</option>
					<?php
					if(!is_null($data_jadwal))
					{
						foreach ($data_jadwal as $jadwal) {
							echo "<option value='".$jadwal->kode_jadwal."'>".$jadwal->jalur_masuk.' '.date_format(date_create($jadwal->tanggal_ujian),'d-m-Y')."</option>";
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<h>Hari</h>
			</td>
			<td>
				<select name='hari' class="form-control input-md">
				<option value=""> Pilih Hari</option>
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
				Jam Mulai
			</td>
			<td class="">
				<div class="input-group input-append col-md-3  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai" readonly="" style="margin-bottom:0px;">
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
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai" readonly="" style="margin-bottom:0px;">
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
		</tr>

		<tr>
			<td>
				<h>Nama Ujian</h>
			</td>
			<td>
				<select name='kode_ujian' class="form-control input-md">
				<option> Pilih Ujian</option>
				
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
<div id="tbl-jadwal-ujian">
<?php
//$this->load->view('v_table/view_table_jadwal_ujian');
?>
</div>