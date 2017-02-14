<h3 style="margin-bottom:10px;">Setting Grup Form</h3>

<table class='table table-hover'>
<tr>
<td>
	<strong>Pilih Jalur</strong>
</td>
<td>
<select class="form-control input-md" name="jalur" id="jalur" onchange="ambil_jalur(this.value)">
	<option value="">Pilih Jalur</option>
	<?php
		if(!is_null($jalur))
		{
			foreach ($jalur as $datajalur) {
				echo "<option value='".$datajalur->kode_jalur."'>".strtoupper($datajalur->jalur_masuk)."</option>";
			}
		}
	?>
</select>
</td>
</table>
<div id="cekgrup">
</div>
<script language="javascript">

var kode_jalur;

function ambil_jalur(jalur)
{
	kode_jalur=jalur;

	$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/input_data_c/tampil_grup_form'); ?>",
						type	: "POST",            
						data    : "kode_jalur="+jalur,
						success: function(ssh)
						{
							
							
							document.getElementById('cekgrup').innerHTML=ssh;
							
						}

					});


}

function change_grup(grup)
{

	if($("#"+grup.id).is(':checked'))
	{
		alert("Untuk menambahkan form centang bagian item dari form");

	}
	else
	{
		
		$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/input_data_c/delete_grup_form'); ?>",
						type	: "POST",            
						data    : "kode_grup_form="+grup.id+"&kode_jalur="+kode_jalur,
						success: function(cihuahua)
						{

							document.getElementById('cekgrup').innerHTML=cihuahua;
							//$('#data-form').load("<?php echo base_url('adminpmb/form_control/tampil_data_form/"+id+"'); ?>");
					
						}

					});


	}
	
}

function change_form_item(itform)
{

	var grup=$('#'+itform.id).attr('value');
	var form=$('#'+itform.id).attr('isi');

	if($("#"+itform.id).is(':checked'))
	{
			
			$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/input_data_c/insert_grup_jalur'); ?>",
						type	: "POST",            
						data    : "kode_grup_form="+grup+"&kode_jalur="+kode_jalur+"&kode_form="+form,
						success: function(ckck)
						{
							
							document.getElementById('cekgrup').innerHTML=ckck;
							//$('#data-form').load("<?php echo base_url('adminpmb/form_control/tampil_data_form/"+id+"'); ?>");
					
						}

					});
		
	}
	else
	{
		
		$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/input_data_c/hapus_item_form'); ?>",
						type	: "POST",            
						data    : "kode_grup_form="+grup+"&kode_jalur="+kode_jalur+"&kode_form="+form,
						success: function(wkwk)
						{
							
							document.getElementById('cekgrup').innerHTML=wkwk;
							//$('#data-form').load("<?php echo base_url('adminpmb/form_control/tampil_data_form/"+id+"'); ?>");
					
						}

					});


	}
	
}
</script>