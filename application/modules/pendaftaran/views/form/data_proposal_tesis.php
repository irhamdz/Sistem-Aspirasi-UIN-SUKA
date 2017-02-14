<br id="ganjel">
<div id="msg"></div> 
<div id="form-tes" style="display:none">
<form method="POST" name="form_tesis" id="data_proposal_tesis">
<div class="system-content-sia" id="form-tesis">
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
<input type="hidden" name="nomor_pendaftar" id="nomor" value="<?php echo $nomor_pendaftar; ?>">
			<tbody>
				<tr>
					<td colspan='3'>
						<div class="bs-callout bs-callout-warning"><strong>Infomasi : </strong><br/>
						File -> TYPE = PDF, Ukuran = Maksimal 10 MB</font> </div>
					</td>
				</tr>
				<tr id="JUDUL_TESIS" style="display:none;">
					<td >Judul Tesis</td>
					<td><div class="col-xs-7"><input type="text" class="form-control input-sm" name="judul_tesis" /></div></td>
				</tr>
				<tr id="FILE_TESIS" style="display:none;">
					<td >File Tesis (Pdf)</td>
					<td><div class="col-xs-7"><input type='file' id="disInp" /></div>
					<input type="hidden" id="disOut" name="tesis">
					</td>
				</tr>
				<tr id="REKOMENDASI_TESIS" style="display:none;">
			<td >Dokumen rekomendasi</td>
			<td><div class="col-xs-7"><input type="file" id="RekInp" onchange="ambil_rekomendasi()" /></div> 
			<input type="hidden" id="RekOut" name="rekomendasi">
			*)
			</td>
		</tr>
				<tr id="BUTTON_TESIS" style="display:none;">
				<td></td>
				<td><div class="col-xs-7"><a href='#' onclick="simpan_tesis()" class="btn btn-small btn-inverse btn-uin-right">Simpan</button></a></div></td>
			</tr>
		</table>
</form>
</div>
</div>

<div class="system-content-sia" id="tabel-tesis" style="display:none">
<div class="bs-callout bs-callout-warning"><strong>Infomasi : </strong><br />
						Jika ingin merubah proposal, silahkan hapus data terlebih dahulu, Setelah itu Input Ulang Data Proposal Anda</font> 
</div>
<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<th width=30>No</th>
			<th width=200 align=left>Judul</th>
			<th width=200 align=left>File</th>
			<th width=200 align=left>Rekomendasi</th>
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
				
					echo "<td align='center'><a download href='".pg_unescape_bytea($data_maba->file_tesis)."' class='btn'><i class='icon-download'></i> Download</a></td>";
					echo "<td align='center'><a download href='".pg_unescape_bytea($data_maba->rekomendasi)."' class='btn'><i class='icon-download'></i> Download</a></td>";
					echo "<td align='center'><a href='#' onclick='hapus_tesis()' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
					echo "</tr>";
				}
			}
		}
		?>	
	</tbody>
	</table>
</div>
<script type="text/javascript">
var id=$('#nomor').attr('value');


$(document).ready(function(){
	
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}


					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/cek_tesis'); ?>",
						type	: "POST",            
						data: "id="+id,
						success: function(cek)
						{
							
							if(cek=='1')
							{
								$('#tabel-tesis').show();
								$('#form-tes').hdie();
							}
							else if(cek=='0')
							{
								$('#tabel-tesis').hide();
								$('#form-tes').show();
							}

							
						}

					});

});



function simpan_tesis()
	{

					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_tesis'); ?>",
						type	: "POST",            
						data: $("#data_proposal_tesis").serialize(),
						success: function(x)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_proposal_tesis/"+id+"'); ?>");
					
						}

					});

	}
function hapus_tesis()
	{
			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/hapus_tesis'); ?>",
						type	: "POST",            
						data    : "id="+id,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_proposal_tesis/"+id+"'); ?>");
					}

					});

	}

function readURLDIS(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#disOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#disInp").change(function(){

//if((this.files[0].type) == "application/pdf")
//{	
    readURLDIS(this);
//}
//else
//{	
//	$("#disInp").attr('value',null);
//	alert("Tipe File harus PDF.");
//}
});


function readURLREK(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#RekOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#RekInp").change(function(){

	
    readURLREK(this);
   
});

</script>