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
<h3 style="margin-bottom:10px;">Form Penawaran Jurusan</h3>
	<table class="table table-hover">
		<?php //echo form_open(base_url('adminpmb/input_data_c/simpan_penawaran_jurusan'),array('name'=>'form_penawaran_jurusan','method'=>'POST','class'=>'form-horizontal')); ?>
		<form method="POST" id="tawarkan-prodi">
		<tr>
			<td>
				<h>Jalur Masuk</h>
			</td>
			<td>
				<select name='kode_jalur' id="pena" style="width:300px;" class="form-control input-md" required='' onchange="cari_gelombang(this.value)">
				<option value=""> Pilih Jalur</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option id value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
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
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cek_minat(this.value)">
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
			<div id="kel"><select name="kelas" id="k" class="form-control input-md" style="width:300px;" onchange="ambil_data(this)">
				<option value="">Pilih Kelas</option>
				
			</select></div>
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<div id="jurusan">
				</div>
			</td>
		
		</tr>
		
		
		</form>
		</table>
	
</div>
<script type="text/javascript">


	function tawar_prodi(pilprod)
	{

		var kode_jalur=$('#pena').val();
		var gelombang=$('#gelombang').val();
		var tahun=$('#tahun').val();
		var kode_penawaran=kode_jalur+gelombang+tahun;
		var kelas=$('#k').val();

		if($('#'+pilprod.id).prop('checked'))
		{
			
		
			$.ajax({
				url:"<?php echo base_url('adminpmb/input_data_c/simpan_penawaran_jurusan') ?>",
				type:"POST",
				data:"kode_penawaran="+kode_penawaran+"&id_prodi="+pilprod.id+"&kode_minat="+pilprod.value+"&id_kelas="+kelas,
				success:function(sucprodi)
				{
					alert(sucprodi);
				}
			});
		
			
		}
		else
		{
			$.ajax({
				url:"<?php echo base_url('adminpmb/input_data_c/hapus_penawaran_jurusan') ?>",
				type:"POST",
				data:"kode_penawaran="+kode_penawaran+"&id_prodi="+pilprod.id+"&kode_minat="+pilprod.value+"&id_kelas="+kelas,
				success:function(hpsprodi)
				{
					alert(hpsprodi);
				}
			});
		}
		
	}

	function cek_minat(th)
	{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=th;
	var kode_penawaran=kode_jalur+gelombang+tahun;

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_kelas') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(h)
		{
			$('#k').html(h);

		}
	});
	}
	
	function ambil_data(ke)
	{
		var kode_jalur=$('#pena').val();
		var gelombang=$('#gelombang').val();
		var tahun=$('#tahun').val();
		var kode_penawaran=kode_jalur+gelombang+tahun;

		$.ajax({
			url:  "<?php echo base_url('adminpmb/input_data_c/cek_minat_prodi'); ?>",
			type: "POST",
			data: "kode_penawaran="+kode_penawaran+"&id_kelas="+ke.value,
			success: function(km)
			{
				$('#jurusan').html(km);

				
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