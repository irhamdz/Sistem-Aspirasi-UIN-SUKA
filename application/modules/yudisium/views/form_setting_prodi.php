<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    --><script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">FORM SETTING PRODI</h3>

<form id="prodi-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover table-bordered">
	<thead>
	<tr>
			<td>
				NO
			</td>
			<td>
				NAMA POGRAM STUDI (JENJANG)
			</td>
			<td>
				KODE SNMPTN
			</td>
			<td>
				KODE SPAN PTKIN
			</td>
		</tr>
	</thead>
	<tbody>
	<?php $num=0; if(!is_null($data_prodi)){ foreach ($data_prodi as $p) {?>
		<tr>
			<td>
				<?php  echo $num+=1; ?>
			</td>
			<td>
				<?php echo $p->nama_prodi." ( ".$p->nama_jenjang." ) ";  ?>
			</td>
			<td>
			<input type="hidden" name="prodi[]" value="<?php echo $p->id_prodi; ?>">
				<input type="text" class="form-control input-md" width="50px" name="snmptn[]" value="<?php echo $p->prodi_snmptn ?>">
			</td>
			<td>
				<input type="text" class="form-control input-md" width="50px" name="span[]" value="<?php echo $p->prodi_span_ptkin ?>">
			</td>
			
		</tr>
	<?php }} ?>
	</tbody>
		</table>
		</form>
<button type="button" onclick="simpan_setting_prodi()" class="btn btn-inverse btn-uin btn-small"> SIMPAN</button>	
</div>
<script type="text/javascript">
function simpan_setting_prodi () {
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/setting_prodi_yudisium'); ?>",
		type: "POST",
		data: $('#prodi-form').serialize(),
		success: function(s)
		{
			alert(s);
		}

	});
}
</script>
