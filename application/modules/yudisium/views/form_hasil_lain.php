<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    --><script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">FORM TAMBAH DITERIMA YUDISIUM</h3>

<form id="nilai-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
		<tr>
			<td>
				NOMOR PESERTA
			</td>
			<td>
				<input type="text" class="form-control input-md" style="width:300px;" id="nomor" name="nomor">
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" value="1" onclick="cari_mahasiswa()"> CARI</button>
			</td>
		</tr>
		</form>
		</table>
	
</div>
<div id="data-mhs">
	
</div>
<script type="text/javascript">
function cari_mahasiswa () {
	var nomor=$('#nomor').val();
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_mahasiswa') ?>",
		type: "POST",
		data: "nomor="+nomor,
		success: function(su)
		{
			$('#data-mhs').html(su);
		}
	});
}

</script>
