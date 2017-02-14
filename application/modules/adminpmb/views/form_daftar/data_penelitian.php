<?php
foreach ($maba as $data_maba);
?>
<br id="ganjel">
<div id="msg"></div> 
<div class="system-content-sia">
<form method="POST" id="data_penelitian">
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
<input type="hidden" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>">
<input type="hidden" name="pjalur" id="pjalur">
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='3'><br /><strong>Proposal Penelitian</strong><br /></td>
		</tr>
		<tr id="JUDUL" style="display:none;">
			<td width=150 >Judul</td>
			<td><div class="col-xs-7"><input type="text" value="<?php echo $data_maba->judul; ?>" required class="form-control input-sm" name="judul_penelitian" /></div> *)</td>
		</tr>
		<tr id="KEDUDUKAN" style="display:none;">
			<td >Kedudukan / Status</td>
			<td><div class="col-xs-7"><input type="text" value="<?php echo $data_maba->status; ?>" required class="form-control input-sm" name="kedudukan" /></div> *)</td>
		</tr>
		<tr id="TAHUN" style="display:none;">
			<td >Tahun Penelitian</td>
			<td><div class="col-xs-7"><input type="text" value="<?php echo $data_maba->tahun; ?>" required class="form-control input-sm" name="tahun_penelitian" /></div> *)</td>
		</tr>
		<tr id="SPONSOR" style="display:none;">
			<td >Sponsor</td>
			<td><div class="col-xs-7"><input type="text" value="<?php echo $data_maba->sponsor; ?>" required class="form-control input-sm" name="sponsor" /></div> *)</td>
		</tr>
		<tr id="REKOMENDASI" style="display:none;">
			<td >Dokumen rekomendasi</td>
			<td><div class="col-xs-7"><input type="file" id="RekInp" onchange="ambil_rekomendasi()" /></div> 
			<input type="hidden" id="RekOut" name="rekomendasi">
			<input type="hidden" id="RekOut" name="rekomendasi2" value="<?php echo $data_maba->rekomendasi; ?>">
			*)
<?php
	if(strlen($data_maba->rekomendasi)>50)
	{
	
		echo "<a download href='".pg_unescape_bytea($data_maba->rekomendasi)."'>Download</a>";
	}
?>
			</td>
		</tr>

	</tbody>
	</table>
<?php echo form_close() ?>; 
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}

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

$(document).ready(function(){
	$('#pjalur').attr('value',$('#jalur').attr('value'));
});
</script>
	


