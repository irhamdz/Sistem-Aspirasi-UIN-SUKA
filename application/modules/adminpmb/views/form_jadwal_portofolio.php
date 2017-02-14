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
<h3 style="margin-bottom:10px;">Form Setting Jadwal Portofolio</h3>
	<table class="table table-hover">
		<form method="POST" id="jadwal-portofolio">
		<tr>
			<td>
				<h>Kode Penawaran</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" onchange="jalur=this.value">
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
			<td>
				<select name='tahun' id="tahun_porto" style="width:200px;" class="form-control input-sm" onchange="tahun_portofolio=this.value">
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
			<td></td>
			<td colspan="2">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="cari_jadwal()"> Cari</button>
			</td>
		</tr>
		</form>
		</table>
		<br>
		<br>
		<table>
		<tr>
		<td>
		<form method="POST" id="setting_jadwal">
			<h>Jadwal Ujian Portofolio</h>
		</td>
			<td colspan="2">
			<div id="jadwal">
				<select class="form-control input-md" name='kode_jadwal'>
				<option value="">--</option>
				</select>
			</div>
				
			</td>
		</tr>
		<input type="hidden" name="kode_jalur" id="ambil_jalur">
		<tr>
			<td>
				<h>Tanggal Mulai Verifikasi</h>
			</td>
			<td>
				<div class="input-group date" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" id="mulai_verifikasi" name="mulai_verifikasi" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
			<td>
				<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<h>Tanggal Akhir Verifikasi</h>
			</td>
			<td>
				<div class="input-group date" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" id="akhir_verifikasi" name="akhir_verifikasi" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
			<td>
				<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
				</div>
			</td>
		</tr>

		<tr>
			<td></td>
			<td colspan="2">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_jadwal_porto()"> Simpan</button>
			</td>
		</tr>
		
		</table>
	</form>
</div>
<div id="tbl-jadwal-portofolio">
<?php
	$this->load->view('v_table/view_table_jadwal_portofolio');
?>
</div>
</div>

<script type="text/javascript">
var jalur;
var tahun_portofolio;
var jadwal_porto;
	function cari_jadwal()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_jadwal_portofolio') ?>",
			type: "POST",
			data: "kode_jalur="+jalur+"&tahun="+tahun_portofolio,
			success: function(jadwal_ketemu)
			{
				$('#jadwal').html(jadwal_ketemu);
				
			}

		});
		$('#ambil_jalur').attr('value',jalur);
	}

	function simpan_jadwal_porto()
	{
		
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/insert_jadwal_porto') ?>",
			type: "POST",
			data: $('#setting_jadwal').serialize()+"&kode_jadwal="+jadwal_porto,
			success: function(porto_simpan)
			{
				$('#tbl-jadwal-portofolio').html(porto_simpan);
			}
		});

	}
</script>