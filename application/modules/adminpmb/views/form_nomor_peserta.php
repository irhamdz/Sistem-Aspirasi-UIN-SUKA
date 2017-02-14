<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />    
<link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
--><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
<h3 style="margin-bottom:10px;">Peserta PMB</h3>

<form id="peserta" method="POST" >
<table>
			<tr id="cari_">
		<td>
			Cari Data Calon Mahasiswa
		</td>
		<td>
			<input type="text" id="cari_data" name="dicari" class="form-control input-md" style="width:250px;">
		</td>
	</tr>
	<tr style="display:none;" id="negara">
		<td>
			Negara
		</td>
		<td>
			<select name="negara" id="PILNEG" class="form-control input-md" style="width:400px">
				<option value=""> -- </option>
				<?php
				if(!is_null($data_negara))
				{
					foreach ($data_negara as $ng) {
						echo "<option value='".$ng->kode_negara."'>".$ng->nama_negara."</option>";
					}
				}

				
				?>
			</select>
		</td>
		<td>
			<input type="checkbox" value="99" id="wna_kabeh" onchange="cari_wna(this.value);"> SEMUA WNA
		</td>
	</tr>
	<tr style="display:none;" id="cari_jalur">
		<td>
			<select name="dicari" id="jalur" class="form-control input-md" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value=""> Jalur PMB </option>
				<?php
				if(!is_null($jalur))
				{
					foreach ($jalur as $jal) {
						echo "<option value='".$jal->kode_jalur."'>".$jal->jalur_masuk."</option>";
					}
				}
				?>
			</select>
		
		<hr>
			
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> Gelombang </option>
				</select>
		
		<hr>
	
				<select name='tahun' style="width:300px;" id="th"  class="form-control input-sm" onchange="tahun=this.value">
				<option value=''> Tahun </option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=20;
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
			Berdasarkan
		</td>
		<td>
			<div class="radio">
  				<label>
    				<input type="radio" name="pencarian" value="nama_lengkap" onchange="ktg=this.value; $('#cari_jalur').hide(); $('#cari_').slideDown('slow'); $('#negara').hide(); control_form(this.value)">
    				Nama
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="pencarian"  value="nomor_peserta" onchange="ktg=this.value; $('#cari_jalur').hide(); $('#cari_').slideDown('slow'); $('#negara').hide(); control_form(this.value)">
    				Nomor Peserta
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="pencarian"  value="warga_negara" onchange="ktg=this.value; $('#cari_jalur').hide(); $('#cari_').hide(); $('#negara').slideDown('slow');  control_form(this.value)">
    				Warga Negara
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="pencarian" value="nomor_pendaftar" onchange="ktg=this.value; $('#cari_jalur').hide(); $('#cari_').slideDown('slow'); $('#negara').hide(); control_form(this.value)">
    				Nomor Pendaftar
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="pencarian" value="kode_penawaran" onchange="ktg=this.value; $('#cari_').hide(); $('#cari_jalur').slideDown('slow'); $('#negara').hide(); control_form(this.value)">
    				Jalur
  				</label>
			</div>
		</td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="cari_mhs()"> Cari</button>
		</td>
	</tr>
		</table>
		
<div id="table-presensi">
</div>
<script type="text/javascript">
	
	function cari_mhs () {
		
		$("table-presensi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
		$.ajax({
			url : "<?php echo base_url('adminpmb/input_data_c/cari_mahasiswa'); ?>",
			type: "POST",
			data: $('#peserta').serialize(),
			success: function(damas)
			{
				$('#table-presensi').html(damas);
				
			}
		});


	}

	function control_form(cf)
	{
		switch(cf)
		{
			case 'nomor_pendaftar':
				$('#PILNEG').attr('disabled',true);
				$('#jalur').attr('disabled',true);
				$('#th').attr('disabled',true);
				$('#cari_data').attr('disabled',false);
				$('#gelombang').attr('disabled',true);
			break;
			case 'nomor_peserta':
				$('#PILNEG').attr('disabled',true);
				$('#jalur').attr('disabled',true);
				$('#th').attr('disabled',true);
				$('#cari_data').attr('disabled',false);
				$('#gelombang').attr('disabled',true);
			break;
			case 'kode_penawaran':
				$('#PILNEG').attr('disabled',true);
				$('#jalur').attr('disabled',false);
				$('#th').attr('disabled',false);
				$('#cari_data').attr('disabled',true);
				$('#gelombang').attr('disabled',false);
			break;
			case 'nama_lengkap':
				$('#PILNEG').attr('disabled',true);
				$('#jalur').attr('disabled',true);
				$('#th').attr('disabled',true);
				$('#cari_data').attr('disabled',false);
				$('#gelombang').attr('disabled',true);
			break;
			case 'warga_negara':
				$('#PILNEG').attr('disabled',false);
				$('#jalur').attr('disabled',true);
				$('#th').attr('disabled',true);
				$('#cari_data').attr('disabled',true);
				$('#gelombang').attr('disabled',true);
			break;

		}
	}

	function cari_wna(wna_mhs)
	{
		$("#table-presensi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
		if($('#wna_kabeh').prop('checked'))
		{
			$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/cari_mahasiswa') ?>",
			type: "POST",
			data: "negara="+wna_mhs+"&pencarian=warga_negara&key=1",
			success: function(org_asing){
				$('#table-presensi').html(org_asing);
			}
			});
		}
		else
		{
			$('#table-presensi').hide();
		}
		
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