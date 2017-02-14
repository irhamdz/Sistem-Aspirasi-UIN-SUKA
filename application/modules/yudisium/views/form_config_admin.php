<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"/>
	
<div>
<script type="text/javascript">
	$(function() 
	{
        
	var tgl = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl2 = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl3 = $("#dp3").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});
});

	$(function(){
		setTimeout('closing_msg()', 4000);
	})

</script>
<h3 style="margin-bottom:10px;">FORM CONFIGURASI ADMIN YUDISIUM</h3>

<form id="conf-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
				</select>
			</td>
			<input type="hidden" id="ptr" name="pilihan">
		</tr>
		<tr>
			<td>
				Gelombang
			</td>
			<td>
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cari_kelas()">
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
				Kelas
			</td>
			<td>
				<select id="kelas" name="kelas" class="form-control input-sm" style="width:300px;"> 
				<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				NIP Pegawai
			</td>
			<td>
			
					<input type="text" class="form-control input-md" id="nip2" style="width:300px">
				
			</td>

		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" value="1" onclick="cari_prodi()"> CARI</button>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<div id="tb-pgw"></div>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<div id="prodi-admin"></div>
			</td>
		</tr>
		</table>
		
		</form>
</div>
<div id="table-admin">
	<?php
	//$this->load->view('v_table/tabel_configurasi');
	?>
</div>
</div>

<script type="text/javascript">
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
	
	$('#tahun').get(0).selectedIndex = 0;
}



function cari_prodi()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kelas=$('#kelas').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	var nip=$('#nip2').val();
	
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/prodi_yudisium') ?>",
		type: "POST",
		data: "nip="+nip+"&kode_penawaran="+kode_penawaran+"&kode_jalur="+kode_jalur+"&gelombang="+gelombang+"&tahun="+tahun+"&kelas="+kelas,
		success: function(hx)
		{
			cari_pegawai();
			$('#prodi-admin').html(hx);
		
		}
	});

}

function tambah_akses (xid) {
	var inpnip=$('#nip2').val();
	var nip=inpnip.replace(/\s+/g, '');
	var fakultas=$('#'+xid.id).val();
	var prodi=xid.id;
	var jalur=$('#pena').val();
	var gel=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kelas=$('#kelas').val();
	if(gel==null)
	{
		gel='1';
	}
	if(kelas==null)
	{
		kelas='1';
	}

	if($('#'+xid.id).prop('checked'))
	{

		$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/simpan_admin') ?>",
		type: "POST",
		data: "NIP="+nip+"&prodi="+prodi+"&fakultas="+fakultas+"&jalur="+jalur+"&gelombang="+gel+"&tahun="+tahun+"&kelas="+kelas,
		success: function (xx) {
			
		}
		});
	}
	else
	{
		$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/delete_admin') ?>",
		type: "POST",
		data: "NIP="+nip+"&prodi="+prodi+"&fakultas="+fakultas,
		success: function (xx) {
			
		}
		});
	}
}

function cari_kelas()
{	
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_kelas') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(h)
		{
			$('#kelas').html(h);

		}
	});
}

function cari_pegawai()
	{
		var nip=$('#nip2').val();
		$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/cari_petugas') ?>",
			type: "POST",
			data: "nip="+nip,
			success: function(x)
			{
				$('#tb-pgw').html(x);
			}
		});

	}
</script>
