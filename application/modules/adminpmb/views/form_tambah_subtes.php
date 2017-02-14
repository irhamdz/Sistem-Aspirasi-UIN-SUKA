<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  	
<div>
	<h3>FORM MASTER SUBTES</h3>
	<form method="POST" id="form-sub">
	<table>
		<tr>
			<td>
				NAMA SUB
			</td>
			<td>
				<input type="text" name="nama_sub" class="form-control input-md" style="width:300px;">				
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class="btn btn-inverse btn-uin" type="button" onclick="simpan_sub()">SIMPAN</button>
			</td>
		</tr>
	</table>
	</form>
</div>
<br>
<div id="table-sub">
	<?php  $this->load->view('v_table/table_sub'); ?>
</div>
<script type="text/javascript">
	function simpan_sub () {
		$.ajax({
			url: "<?php echo base_url('adminpmb/input_data_c/simpan_sub') ?>",
			type: "POST",
			data: $('#form-sub').serialize(),
			success: function(ss)
			{
				$('#table-sub').html(ss);
			}
		});
	}
</script>