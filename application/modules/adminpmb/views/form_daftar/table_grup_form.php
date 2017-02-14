<h3 style="margin-bottom:10px;">Setting Grup Form</h3>

<table class='table table-hover'>
<tr>
<td>
	<h4 style="margin-bottom:10px;">Pilih Grup Jalur</h4>
</td>
<td>
<select class="form-control input-md" onchange="ambilid(this.value)">
	<option value="">Pilih Grup</option>
	<?php
		if(!is_null($data_grup_form))
		{
			foreach ($data_grup_form as $datagrup) {
				echo "<option value='".$datagrup->kode_grup_form."'>".$datagrup->nama_grup_form."</option>";
			}
		}
	?>
</select>
</td>
</tr>
</table>
<div id="data-form">
	
</div>
<script language="javascript">
function ambilid (id) 
{
	
	if(id != '')
	{ 
		$("#data-form").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

		$('#data-form').load("<?php echo base_url('adminpmb/form_control/tampil_data_form/"+id+"'); ?>");
	}
	else
	{
		document.getElementById("data-form").innerHTML = "<div id='data-form'></div>";
	}
}
</script>