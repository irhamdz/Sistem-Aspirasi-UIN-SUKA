
<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() 
	{
        
		var tgl1 = $("#dpxx").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enable' : '';
		}
	}).on('changeDate', function(ev) {
		tgl1.hide();
	}).data('datepicker');
}
);


</script>
<div>

<h3 style="margin-bottom:10px;">FORM DOKUMEN YUDISIUM</h3>

<form id="grade-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				JENIS DOKUMEN
			</td>
			<td>
			<select name="jenis" class="form-control input-md" id="jenis" onchange="cari_nomor(this.value)">
			<option value="">--</option>
				<?php
				if(!is_null($jenis_dokumen))
				{
					foreach ($jenis_dokumen as $doc) {
						echo "<option value='".$doc->id_dokumen."'>".$doc->nama_dokumen."</option>";
					}
				}
				?>
			</select>
			</td>
		</tr>	
		<tr>
			<td>
				NOMOR SURAT
			</td>
			<td>
			<select name="nomor" id="nomor" class="form-control input-md">
			<option value="">--</option>
			</select>
			</td>
		</tr>
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" id="cari_doc" value="grade-form" onclick="cari_setting()"> CARI</button>
			</td>
		</tr>
		</form>
		</table>
<br>
<div id="table-set"></div>
	
</div>
<script type="text/javascript">
function cari_nomor(cn)
{
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_nomor') ?>",
		type: "POST",
		data: "id_dokumen="+cn,
		success: function(fn)
		{
			$('#nomor').html(fn);
		}
	});
}
function cari_setting()
{
	var id_dokumen=$('#jenis').val();
	var nomor=$('#nomor').val();
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_setting_dokumen') ?>",
		type: "POST",
		data: "id_dokumen="+id_dokumen+"&nomor="+nomor,
		success: function(xn)
		{
			$('#table-set').html(xn);

		}
	});
}
</script>
