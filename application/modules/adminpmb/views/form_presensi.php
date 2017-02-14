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
<h3 style="margin-bottom:10px;">Album PMB</h3>
	<table class="table table-hover">
			<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td>
				<select name='kode_jalur' style="width:300px;" class="form-control input-md"  id="jalur" onchange="cari_gelombang(this.value)">
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
			<td>Tahun</td>
			<td>
				<select name='tahun' id="th" style="width:300px;" class="form-control input-sm" onchange="tahun_change(this.value)">
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
		<td>Jadwal Ujian</td>
			<td id='td-jadwal'><select name='kode_jadwal' style="width:300px;" id='jadwal' class='form-control input-md' onchange='jadwal=this.value'>";
				<option value=''>Pilih Jadwal Ujian</option>
		</tr>
		<tr>
		<td></td>
			<td colspan="2">
				<button class="btn btn-inverse btn-uin btn-small" onclick="cari_pres()">Cari</button>
			</td>
		</tr>
		</table>
	
</div>
<div id="table-presensi">
</div>
<script type="text/javascript">

		var jalur=$('#jalur').attr('value');
		var tahun=$('#th').attr('value');
		var jadwal;
	function jalur_change(jc)
	{
		jalur=jc;
		$('#th').get(0).selectedIndex = 0;
	}

	function tahun_change(thn)
	{
		tahun=thn;
		var kode_jalur=$('#jalur').val();
		var gelombang=$('#gelombang').val();
		$.ajax({
			url 	: "<?php echo base_url('adminpmb/input_data_c/cari_jadwal_ujian'); ?>",
			type	: "POST",            
			data: "kode_jalur="+kode_jalur+gelombang+tahun+"&tahun="+thn,
			success: function(jh)
			{
				$('#td-jadwal').html(jh);
				
			}
		});
		$('#jadwal').get(0).selectedIndex = 0;
	}
	function cari_pres()
	{

		$("#table-presensi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		
		var gelombang=$('#gelombang').val();
		var kode_jalur=$('#jalur').val();
		$.ajax({
			url 	: "<?php echo base_url('adminpmb/input_data_c/load_presensi'); ?>",
			type	: "POST",            
			data: "kode_jalur="+kode_jalur+"&gelombang="+gelombang+"&tahun="+tahun+"&kode_jadwal="+jadwal,
			success: function(s)
			{
				
				$('#table-presensi').html(s);
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