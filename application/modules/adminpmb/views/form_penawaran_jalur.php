<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"/>
<!--
<script type="text/javascript" src="<?php //echo base_url().APPPATH."asset/js/moment.js" ?>"></script>
<script type="text/javascript" src="<?php //echo base_url().APPPATH."asset/js/moment-timezone.js" ?>"></script>
-->
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
<div>
<h3 style="margin-bottom:10px;">Form Penawaran Jalur</h3>
	<table class="table">
		<form method="post" id="penewaran_jalur">
		<tr>
			<td>
				<h>Kode Jalur</h>
			</td>
			<td colspan="3">
				<select name='jalur_masuk' id="jalur" class="form-control input-md">
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
				<h>Tanggal Mulai Pendaftaran</h>
			</td>
			
			<td colspan="2">
			<div id="tgl_mulai">
			   <div class="input-group date"  id="dp1" data-date="" data-date-format="dd/mm/yyyy">
						<input class="form-control" size="16" type="text" name="tanggal_mulai_daftar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
				</div>
				</td>
				<td colspan="2">
				<div class="input-group input-append col-md-6 bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai" name="jam_mulai_daftar" readonly="" style="margin-bottom:0px;" required>
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
						<input class="form-control" size="16" type="text" name="tanggal_selesai_daftar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
			</td>
		<td colspan="2">
		 		<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_selesai" name="jam_selesai_daftar" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span></td>
				</div>
				</td>
		</tr>
		<tr>
			<td>
				<h>Tahun</h>
			</td>
			<td colspan="3">
			<div id="tah">
				<select name='tahun' class="form-control input-md">
					<option> Pilih Tahun</option>
					<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=5;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>	
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<h>Minat</h>
			</td>
			<td colspan="3">
			<?php
			if(!is_null($data_minat))
			{
				foreach ($data_minat as $damin) {
				echo $damin->nama_minat;
				echo " <input type='checkbox' name='minat[]' value='".$damin->kode_minat."'>";
				echo "<input type='text' name='jum[]' class='form-control input-md'>";
				}
			}

			?>
			</td>
		</tr>
		<tr>
			<td>
				<h>Tambah Kelas</h>
			</td>
			<td id="kolom-kelas">
			<?php
			if(!is_null($data_kelas))
			{
				foreach ($data_kelas as $dakel) {
				echo strtoupper($dakel->nama_kelas);
				echo " <input type='checkbox' name='kelas[]' value='".$dakel->kode_kelas."'><br>";
				}
			}
			?>
				
			</td>
		</tr>
		<tr>
			<td>
				<h>Gelombang</h>
			</td>
			<td colspan="3">
				<input type="text" name="gelombang" class="form-control input-md">	
			</td>
		</tr>
		<tr>
			<td>
				<h>Tanggal Mulai Bayar</h>
			</td>
			
			<td colspan="2">
			   <div class="input-group date" id="bayar1" data-date="" data-date-format="dd/mm/yyyy">
						<input class="form-control" size="16" type="text" name="tanggal_mulai_bayar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		</td>
		<td colspan="2">
				<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai_bayar" name="jam_mulai_bayar" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>
		</td>
		</tr>
			<td> 
				<h>Tanggal Selesai Bayar</h>
			</td>
			<td colspan="2">
			   <div class="input-group date" id="bayar2" data-date="" data-date-format="dd/mm/yyyy">
						<input class="form-control" size="16" type="text" name="tanggal_selesai_bayar" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		</td>
		<td colspan="2">
				<div class="input-group input-append col-md-6  bootstrap-timepicker">
				<input class="jam form-control " type="text" id="jam_mulai_bayar" name="jam_selesai_bayar" readonly="" style="margin-bottom:0px;" required>
				<span class="input-group-addon add-on"><i class="icon-time"></i></span>
			</div>
		</td>
		</tr>
		<tr>
			<td>
				<h>Kode Pembayaran</h>
			</td>
			<td colspan="3">
				<select name='kode_pembayaran' class="form-control input-md">
					<option value=''>Pilih Kode Pembayaran</option>
					<?php
						foreach ($data_kode_pembayaran as $valkdbayar) 
						{
							echo "<option value='".$valkdbayar->kode_bayar."'>".$valkdbayar->nama_pembayaran."</option>";
						}
					?>
				</select>	
			</td>
		</tr>
		<tr>
			<td>
				<h>Kuota</h>
			</td>
			<td colspan="3">
				<input type="text" name="kuota" class="form-control input-md">	
			</td>
		</tr>
		<tr>
			<td>
				KETERANGAN
			</td>
			<td colspan="3">
				<textarea name="keterangan" id="keterangan" class="form-control input-md"></textarea>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
				<button class="btn btn-inverse btn-uin btn-small" onclick="simpan_penawaran_jalur()">Simpan</button>
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
<script type="text/javascript">
	function simpan_penawaran_jalur()
	{
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/penawaran_jalur_post') ?>",
			type:"POST",
			data: $('#penewaran_jalur').serialize(),

			success: function(jalur){
				
				$('#tbl-penawaran').load(jalur);
			//alert(jalur);
				
			}

		});
	}

var jml_kelas=0;

function tambah_kelas_form()
{
	jml_kelas++;
	 var x=document.getElementById('kls').innerHTML;
	 x+="<br><input type='text' id='kls' name='nama_kelas[]'' class='form-control input-md' >";
	 document.getElementById('kls').innerHTML=x;
}

</script>
