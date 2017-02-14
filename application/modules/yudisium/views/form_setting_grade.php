<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    --><script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">FORM GRADE YUDISIUM</h3>

<form id="grade-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value); $('#grade').attr('value','0');">
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
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cari_grade(this.value)">
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
				Grade
			</td>
			<td>
				<input type="text" id="grade" name="grade" class="form-control input-sm" style="width:300px;"> 
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" value="grade-form" onclick="update_grade(this.value)"> UPDATE</button>
			</td>
		</tr>
		</form>
		</table>
	
</div>
<script type="text/javascript">

function cari_grade(th)
{	
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();


	$.ajax({
		url: "<?php echo base_url('adminpmb/yudisium_c/cari_grade') ?>",
		type: "POST",
		data: "kode_jalur="+kode_jalur+"&gelombang="+gelombang+"&tahun="+tahun,
		success: function(h)
		{
			$('#grade').attr('value',h);

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

	$('#tahun').get(0).selectedIndex = 0;
}

function update_grade(jl)
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/yudisium_c/update_grade') ?>",
		type: "POST",
		data: $('#'+jl).serialize(),
		success: function (brh)
		{
			alert(brh);
		}
	});
	
}
</script>
