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
<h3 style="margin-bottom:10px;">DAFTAR MAHASISWA</h3>
	<table class="table table-hover">
		<tr>
			<td>
				<h>Jalur Masuk</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" onchange="cari_mhs(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
			</td>
		</tr>

		</table>
	
</div>
<div id="table-mhs">
</div>
<script type="text/javascript">

	function cari_mhs(jalurs)
	{
		$("#table-presensi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				

		$.ajax({
			url 	: "<?php echo base_url('adminpmb/input_data_c/load_data_mhs'); ?>",
			type	: "POST",            
			data: "kode_jalur="+jalurs,
			success: function(mhs)
			{
				
				$('#table-mhs').html(mhs);
			}
		});
		
	}
</script>