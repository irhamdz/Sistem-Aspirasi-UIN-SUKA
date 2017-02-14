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


	$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
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
<h3 style="margin-bottom:10px;">Form Jadwal Portofolio</h3>
	<table class="table table-hover">
		<form method="POST" id="jadwal-mhs-portofolio">
		<tr>
			<td>
				<h>Kode Penawaran</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md"  style="width:300px;" onchange="jalur=this.value">
				<option value=""> Pilih Jalur PMB</option>
				<?php
				if(!is_null($jalur_masuk))
				{
					foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_penawaran."'>".$valjalur->jalur_masuk.' - Gelombang '.$valjalur->gelombang."</option>";
					}
				}
				

				?>
			</select>
			</td>
			</tr>
			<tr>
			<td>Tahun</td>
			<td>
				<select name='tahun' id="tahun" style="width:300px;" class="form-control input-sm" onchange="tahun_portofolio=this.value;jadwal_lihat(this.value)">
				<option value=''> -- </option>
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
		<td>Jadwal Ujian</td>
			<td id='td-jadwal'><select name='kode_jadwal' style='width:200px;' id='jadwal' class='form-control input-md' onchange='jadwal_porto=this.value'>";
				<option value=''>Pilih Jadwal Ujian</option>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="cari_jadwal_portofolio()"> Cari</button>
			</td>
		</tr>
		</form>
		</table>
		
</div>
<div id="tbl-jadwal-portofolio">
</div>
</div>

<script type="text/javascript">
var jalur;
var tahun_portofolio;
var jadwal_porto;
	function cari_jadwal_portofolio()
	{
		var jadwal=$('#jadwal').val();
		var gelombang=$('#gelombang').val();
		var tahun=$('#tahun').val();
		
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_peserta_portofolio') ?>",
			type: "POST",
			data: "kode_jalur="+jalur+"&tahun="+tahun+"&kode_jadwal="+jadwal,
			success: function(jadwal_porto_ketemu)
			{
				$('#tbl-jadwal-portofolio').html(jadwal_porto_ketemu);
				
			}

		});
		
	}
function jadwal_lihat(jl)
{
	
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_jadwal_portofolio2'); ?>",
		type: "POST",
		data: "kode_jalur="+jalur+"&tahun="+jl,
		success: function(jd){
			$('#jadwal').html(jd);
		}
	});
}
</script>