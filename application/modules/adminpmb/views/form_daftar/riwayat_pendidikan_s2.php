<?php
foreach ($maba as $data_maba);
?>
<?php
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_pendidikan" id="riwayat_pendidikan_s2'); 
?>
<br id="ganjel">
<div id="msg"></div> 
<form method="POST" id="riwayat_pendidikan_s2">
<input type="hidden" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>">
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi. Ukuran file Ijazah dan Transkrip maksimal <b>1,5MB</b></div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Pendidikan Sebelumnya</strong><br /></td>
		</tr>
		<tr id="LULUSAN" style="display:none;">
			<td >Lulusan Dari</td>
			<td><div class="col-xs-7"><select name='pmb1_lulusan_dari' id='lulusan_dari' onchange="lainnya(this)" class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php 
					if(!is_null($riwayat_pendidikan_s2))
					{
						foreach ($riwayat_pendidikan_s2 as $riwayat) {
							echo "<option "; if($data_maba->id_pendidikan==$riwayat->id_pendidikan){echo "selected";} echo " value='".$riwayat->id_pendidikan."'>".$riwayat->nama_pendidikan."</option>";
						}
					}
					?>
					
					<option value='99'>Lainnya</option>
				</select></div><br /><br />
				<div class="col-xs-7"><input type="text" id="pmb1_lulusan_dari" value="<?php echo $data_maba->pend_lain; ?>" class="form-control input-sm" name="lulusan_lain" style="display: none;"></div> *)</td>
		</tr>
		<tr id="NM_PT" style="display:none;">
			<td >Nama Perguruan Tinggi</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->nama_pt; ?>"  name='pmb1_nama_pt' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr id="TH_IJAZAH" style="display:none;">
			<td >Tahun Ijazah</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->tahun_ijazah; ?>" name='pmb1_tahun_ijazah' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr id="IPK" style="display:none;">
			<td >IPK</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->ipk; ?>" name='pmb1_ipk' class="form-control input-sm" /></div> *)
			<div class="col-xs-12"><div class="reg-info">Contoh Penulisan IPK -> 3.00.</div></div></td>
		</tr>
		<input type="hidden" id="r_p_s2_penawaran" name="r_p_s2_penawaran">
		<tr id="SCAN_IJAZAH" style="display:none;">
					<td >Scan Ijazah</td>
					<td><div class="col-xs-7"><input type='file' id="ijzInp" /></div>
					<input type="hidden" id="ijzOut" name="ijazah" value="">
					<input type="hidden" name="ijazah2" value="<?php echo $data_maba->ijazah; ?>"> *)

<?php
	if(strlen($data_maba->ijazah)>50)
	{
		
		echo "<a download href='".pg_unescape_bytea($data_maba->ijazah)."'>Download</a>";
	}
	
?>
					</td>
				</tr>
		<tr id="SCAN_TRANSKRIP" style="display:none;">
					<td >Transkrip Nilai</td>
					<td><div class="col-xs-7"><input type='file' id="trInp" /></div>
					<input type="hidden" id="trOut" name="tr" value="">
					<input type="hidden" name="tr2" value="<?php echo $data_maba->transkrip; ?>"> *)

<?php
	if(strlen($data_maba->transkrip)>50)
	{
		
		echo "<a download href='".pg_unescape_bytea($data_maba->transkrip)."'>Download</a>";
	}
	
?>
					</td>
				</tr>
		<tr id="AKREDITASI" >
			<td >Akreditasi</td>
			<td><div class="col-xs-7">
				<select name="akreditasi" class="form-control input-sm">
					<option value="">Pilih Akreditasi</option>
					<option <?php if($data_maba->akreditasi=='A'){echo "selected";} ?> value="A">A</option>
					<option <?php if($data_maba->akreditasi=='B'){echo "selected";} ?> value="B">B</option>
					<option <?php if($data_maba->akreditasi=='C'){echo "selected";} ?> value="C">C</option>
					<option <?php if($data_maba->akreditasi=='D'){echo "selected";} ?> value="D">D</option>
					<option <?php if($data_maba->akreditasi=='0'){echo "selected";} ?> value="TIDAK">Tidak Terakreditasi</option>
				</select>
			</div> *)
			<div class="col-xs-12"></div></td>
		</tr>
	</tbody>
	</table>
	</form>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
var validFileSize = 1.5 * 1024 * 1024;// 1,5 mb filter file size

$(document).ready(function(){
$('#r_p_s2_penawaran').attr('value',$('#kode_penawaran').attr('value'));

for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
});
	function lainnya(id){
		if(id.value=='99')
		{
			$('#pmb1_lulusan_dari').show();
		}
		else
		{
			$('#pmb1_lulusan_dari').hide();
		}
	}

function readURLIJ(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#ijzOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#ijzInp").change(function(){

	if((this.files[0].size)<= validFileSize)
	{
	readURLIJ(this);
	}
	else
	{
	alert("Ukuran file yang diijinkan maksimal 1,5 MB!");
	$('#ijzInp').attr('value',null);
	}
});

function readURLTR(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#trOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#trInp").change(function(){

if((this.files[0].size)<= validFileSize)
{
    readURLTR(this);
}
else
{
	alert("Ukuran file yang diijinkan maksimal 1,5 MB!");
	$('#trInp').attr('value',null);
}
   
});

</script>

