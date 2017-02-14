<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>
<h3 style="margin-bottom:10px;">SCAN LJK</h3>
<form id="ljk-form" method="POST" enctype="multipart/form-data">
	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" onchange="cari_gelombang(this.value)" style="width:300px;">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
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
				<select name='tahun' style="width:300px;" class="form-control input-sm" onchange="tahun=this.value">
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
		Jenis Tes
		</td>
		<td>
			<select name="jenis_tes" class="form-control input-md" style="width:300px;">
				<option value="">--</option>
				<?php
				if(!is_null($data_tes))
				{
					foreach ($data_tes as $tes) {
						echo "<option value='".$tes->id_tes."'>".$tes->nama_tes."</option>";
					}
				}
				?>
			</select>
		</td>
		
	</tr>
	<tr>
		<td>
			File Hasil scan [.dat]
		</td>
		<td>
			<input type="file" id="datInp" />
			<input type="hidden" id="datOt" name="datfile">
		</td>
	</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="post_data()"> SCAN LJK</button>
			</td>
		</tr>
		</form>
		</table>
	
</div>
<div id="data-ljk">
	
</div>
<script type="text/javascript">
function readURLDAT(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (dt) {
        	var f=dt.target.result; //.replace('data:;base64,','')
         	$('#datOt').attr('value', f);	
         	
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#datInp").change(function(){
	var types=this.files[0].name.split('.').pop();
	if(types == 'dat')
	{
   		 readURLDAT(this);
   	}
   	else
   	{
   		$("#datInp").attr('value',null);
   		alert("Tipe file "+types+" tidak diijinkan");
   		
   	}
    
   
});

function post_data()
{
	$("#data-ljk").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/read_ljk') ?>",
		type: "POST",
		data: $('#ljk-form').serialize(),
		success: function(hore)
		{
			$('#data-ljk').html(hore);
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
