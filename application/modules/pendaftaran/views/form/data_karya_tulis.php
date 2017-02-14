<br id="ganjel">
<div id="msg"></div> 
<div class="system-content-sia">
<form method="POST" name="form_karya" id="data_karya_tulis">
				<div class="bs-callout bs-callout-info">Untuk penginputkan Karya Tulis Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='3'><br /><strong>Data Karya Tulis</strong><br /></td>
			<input type="hidden" name="nomor_pendaftar" id="nomor" value="<?php echo $nomor_pendaftar; ?>">
		</tr>
		<tr id="JUDUL_KARYA" style="display:none;">
			<td width=150 >Judul</td>
			<td><div class="col-xs-7"><input type="text" id="judul" class="form-control input-sm" name="judul_karya_tulis" /></div> *)</td>
		</tr>
		<tr id="PENERBIT" style="display:none;">
			<td >Penerbit</td>
			<td><div class="col-xs-7"><input type="text"  class="form-control input-sm" name="penerbit" /></div> *)</td>
		</tr>
		<tr id="TAHUN" style="display:none;">
			<td >Tahun</td>
			<td><div class="col-xs-7"><input type="text"  class="form-control input-sm" name="tahun_karya_tulis" /></div> *)</td>
		</tr>
		<tr id="KARYA_TULIS" style="display:none;">
			<td >Upload Karya Tulis Pdf</td>
			<td><div class="col-xs-7"><input type="file" id="tulisInp" /></div> 
			<input type="hidden" id="tulisOut" name="tulisan">
		
			*)
			</td>
			</tr>
		<tr id="BUTTON_KARYA" style="display:none;">
			
				<td></td>
			<td><div class="col-xs-7">
			<input type="button" value="Simpan" onclick="simpan_karya_tulis()" class="btn-uin btn btn-inverse btn btn-small">
			</td>
		
		</div></tr>

	</tbody>
	</table>
	</form>
<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<th width=30>No</th>
			<th width=200 align=left>Judul</th>
			<th width=100>Penerbit</th>
			<th width=50>Tahun</th>
			<th width=50>File</th>
			<th width=100>Proses</th>
		</tr>
		<?php
		$num=0;
		if(!is_null($maba))
		{
			foreach ($maba as $data_maba) {
				if(!is_null($data_maba->judul))
				{

					echo "<tr>";
					echo "<td>"; echo $num+=1; echo "</td>";
					echo "<td>".$data_maba->judul."</td>";
					echo "<td>".$data_maba->penerbit."</td>";
					echo "<td>".$data_maba->tahun."</td>";
					echo "<td><a href='".pg_unescape_bytea($data_maba->upload_karya)."' download >Download</a></td>";
					echo "<td align='center'><a href='#' onclick='hapus_karya_tulis(".$data_maba->id_karya.")' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
					echo "</tr>"; 
				}
			}
		}
		?>
	</tbody>
	</table>
</div>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}

var id=$('#nomor').attr('value');
	function simpan_karya_tulis()
	{
			var filenya=$('#tulisOut').attr('value');
			var judul=$('#judul').attr('value');
			if(judul.length > 5)
			{
				if(filenya.length > 20)
				{
					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_karya_tulis'); ?>",
						type	: "POST",            
						data: $("#data_karya_tulis").serialize(),
						success: function(x)
						{
						
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_karya_tulis/"+id+"'); ?>");
					
						}

					});
				}
				else
				{
					alert("Silakan upload file karya tulis dengan format PDF");
				}
			}
			else
			{
				alert("Judul tidak valid!");
			}
		
	}
	function hapus_karya_tulis(x)
	{

			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/hapus_karya_tulis'); ?>",
						type	: "POST",            
						data    : "id="+x,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_karya_tulis/"+id+"'); ?>");
					}

					});
	}



function readURLTULIS(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#tulisOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#tulisInp").change(function(){

if((this.files[0].type) == "application/pdf")
{	
    readURLTULIS(this);
}
else
{	
	$("#tulisInp").attr('value',null);
	alert("Tipe File harus PDF.");
}
   
});
</script>


