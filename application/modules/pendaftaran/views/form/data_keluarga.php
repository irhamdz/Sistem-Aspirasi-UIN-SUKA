<?php

foreach ($maba as $data_maba);
?>
   <script type="text/javascript">
$(document).ready(function(){
	
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    
    	}
});

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}
    </script>
	<style>
	.thead th{
		text-transform: uppercase;
	}
	div.b128{
	    border-left: 1px black solid;
		height: 60px;
	}	
	table.tb128{
		border:1px solid;
		width:100px;
	}
	.add_tgl{
		width:80px;
	}
	td.reg-label{
		padding-right:20px;
		text-align:left;
		line-height:30px;
		vertical-align:top;
		width:180px;
	}
	td.reg-input{
		line-height:30px;
		vertical-align:top;
	}
	.reg-kolom-kanan{
		float:right;
		width:45%;
		text-align:right;
	}
	.reg-kolom-kiri{
		float:left;
		width:45%;
	}
	.ganjel{
		clear:both;
	}
	.ac_results ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results li {
		margin: 0px;		
		cursor: default;
		display: block;
		font: menu;		
		overflow: hidden;
		display:block;
		padding: 3px 5px;
		cursor:pointer;
	}
	.ac_results li a{
		display:block;
		padding: 3px 5px;
	}
	.ac_results li:hover{
		background:#dedede;
	}
	.ac_results li.nope{
		cursor:auto;
	}
	.ac_results li.nope:hover{
		background:none;
	}
	.suggestionsBox{
		border:1px solid #cccccc;
		position:absolute;
		z-index:5;	
		width: 250px;
		padding:0px;
		background:#FFFFFF;
		margin-top:-5px;
		color:#333;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
	.reg-info{
		font-size:11px;
		line-height:15px;
		margin-bottom:10px;
        color:#777777;
	}
	
	.error-message ul{
		text-align:left;
		padding:0px 15px 0px 15px;
	}
	.error-message{
		margin-bottom:5px;
	}
	a.link,a.link:visited  { text-decoration: underline;color:#333333}

	.bootstrap-datetimepicker-widget table td{
		font-size:12px;
		font-weight:normal;
	}
</style>

<form action='' method="post" enctype="multipart/form-data" id="data_keluarga" name='form_sakti'>
<input type='hidden' name='nomor_pendaftar' value="<?php echo $nomor_pendaftar; ?>" />
<br class='ganjel'/>
<div id="msg"></div>
	<div class="bs-callout bs-callout-info">
	Tanda *) bermakna bahwa kolom wajib diisi.<br/>
  Pada bagian ini, Anda wajib meng-<i>upload</i>:
	<ol>
		<li>File <i>scan</i> Kartu Keluarga.</li>
		<li>Salah satu file <i>scan</i> surat keterangan penghasilan (bapak atau ibu atau wali atau Kartu Miskin). Diharapkan semakin lengkap file <i>scan</i> yang Anda <i>upload</i> akan semakin bermanfaat bagi kelengkapan Data Pribadi Mahasiswa.</li>
		
	</ol>
</div>

<table class="table-snippet">
	<tbody>

	<tr>
			<td colspan='2'><strong>Data Keluarga</strong><br /></td>
		</tr>
	<tr id="ANAK_KE" style="display:none;">
		<td class="reg-label" style="width:300px">Anak Nomor Ke</td>
		<td class="reg-input">
			<input size='2' value="<?php echo $data_maba->anak_ke; ?>" style='width:50px' maxlength='2' class="form-control input-sm" onkeypress="return isNumberKey(event)" name='ANAK_KE' type='text' class='inputx'/>
		</td>
	</tr>
	<tr id="JML_SAUDARA" style="display:none;">
		<td class="reg-label">Dari Jumlah Saudara</td>
		<td class="reg-input">
			<input size='2' value="<?php echo $data_maba->jumlah_saudara; ?>" style='width:50px' class="form-control input-sm" maxlength='2' onkeypress="return isNumberKey(event)" name='JUM_SAUDARA' type='text' class='inputx'/>
		</td>
	</tr>
	<tr id="TANGGUNGAN_ORTU" style="display:none;">
		<td class="reg-label">Tanggungan Orang Tua</td>
		<td class="reg-input">
			<input size='2' style='width:50px' value="<?php echo $data_maba->tanggungan_orang_tua; ?>" class="form-control input-sm" maxlength='2' onkeypress="return isNumberKey(event)" name='JUM_TANGGUNGAN' type='text' class='inputx'/>
		</td>
	</tr>
	<tr id="GAJI_IBU" style="display:none;">
		<td class="reg-label">Gaji Ibu (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' value="<?php echo $data_maba->gaji_ibu; ?>" style='width:100px' class="form-control input-sm" name='GAJI_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/> *)
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki penghasilan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="TAB_IBU" style="display:none;">
		<td class="reg-label">Jumlah Tabungan Ibu (Rp.)</td>
		<td class="reg-input">
			<input size='12' value="<?php echo $data_maba->jumlah_tabungan_ibu; ?>" style='width:100px' class="form-control input-sm" name='JUM_TABUNGAN_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki tabungan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="HUTANG_IBU" style="display:none;">
		<td class="reg-label">Jumlah Hutang Ibu (Rp.)</td>
		<td class="reg-input">
			<input size='12' value="<?php echo $data_maba->jumlah_hutang_ibu; ?>" style='width:100px' class="form-control input-sm" name='JUM_HUTANG_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_HUTANG_IBU" style="display:none;">
		<td class="reg-label">Cicilan Hutang Ibu (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' value="<?php echo $data_maba->cicilan_hutang_ibu; ?>" style='width:100px' class="form-control input-sm" name='CICILAN_HUTANG_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki cicilan hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="PIUTANG_IBU" style="display:none;">
		<td class="reg-label">Jumlah Piutang Ibu (Rp.)</td>
		<td class="reg-input">
			<input size='12' value="<?php echo $data_maba->jumlah_piutang_ibu; ?>" style='width:100px' class="form-control input-sm" name='JUM_PIUTANG_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_PIUTANG_IBU" style="display:none;">
		<td class="reg-label">Cicilan Piutang Ibu (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->cicilan_piutang_ibu; ?>" class="form-control input-sm" name='CICILAN_PIUTANG_IBU' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Ibu tidak memiliki cicilan piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
	<tr id="GAJI_BPK" style="display:none;">
		<td class="reg-label">Gaji Bapak (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->gaji_ayah; ?>" class="form-control input-sm" maxlength='12' type='text' name='GAJI_BAPAK' onkeypress="return isNumberKey(event)" class='inputx'/> *)
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki penghasilan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="TAB_BPK" style="display:none;">
		<td class="reg-label">Jumlah Tabungan Bapak (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_tabungan_ayah; ?>" class="form-control input-sm" name='JUM_TABUNGAN_BPK' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki tabungan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="HUTANG_BPK" style="display:none;">
		<td class="reg-label">Jumlah Hutang Bapak (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_hutang_ayah; ?>" class="form-control input-sm" name='JUM_HUTANG_BPK' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_HUTANG_BPK" style="display:none;">
		<td class="reg-label">Cicilan Hutang Bapak (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->cicilan_hutang_ayah; ?>" class="form-control input-sm" name='CICILAN_HUTANG_BPK' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki cicilan hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="PIUTANG_BPK" style="display:none;">
		<td class="reg-label">Jumlah Piutang Bapak (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_piutang_ayah; ?>" class="form-control input-sm" name='JUM_PIUTANG_BPK' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_PIUTANG_BPK" style="display:none;">
		<td class="reg-label">Cicilan Piutang Bapak (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->cicilan_piutang_ayah; ?>" class="form-control input-sm" name='CICILAN_PIUTANG_BPK' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Bapak tidak memiliki cicilan piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
	<tr id="GAJI_WALI" style="display:none;">
		<td class="reg-label">Gaji Wali (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->gaji_wali; ?>" class="form-control input-sm" maxlength='12' type='text' name='GAJI_WALI' onkeypress="return isNumberKey(event)" class='inputx'/> *)
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki penghasilan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="TAB_WALI" style="display:none;">
		<td class="reg-label">Jumlah Tabungan Wali (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_tabungan_wali; ?>" class="form-control input-sm" name='JUM_TABUNGAN_WALI' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki tabungan, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="HUTANG_WALI" style="display:none;">
		<td class="reg-label">Jumlah Hutang Wali (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_hutang_wali; ?>" class="form-control input-sm" name='JUM_HUTANG_WALI' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_HUTANG_WALI" style="display:none;">
		<td class="reg-label">Cicilan Hutang Wali (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->cicilan_hutang_wali; ?>" class="form-control input-sm" name='CICILAN_HUTANG_WALI' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki cicilan hutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="PIUTANG_WALI" style="display:none;">
		<td class="reg-label">Jumlah Piutang Wali (Rp.)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->jumlah_piutang_wali; ?>" class="form-control input-sm" name='JUM_PIUTANG_WALI' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="CIL_PIUTANG_WALI" style="display:none;">
		<td class="reg-label">Cicilan Piutang Wali (Rp./bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:100px' value="<?php echo $data_maba->cicilan_piutang_wali; ?>" class="form-control input-sm" name='CICILAN_PIUTANG_WALI' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='inputx'/>
			<div class='reg-info'>Karakter yang diizinkan hanya berupa angka (tidak boleh menggunakan tanda titik atau koma). Apabila Wali tidak memiliki cicilan piutang, silakan diisi dengan angka <b>0</b>.</div>
		</td>
	</tr>
  <tr id="KK" style="display:none;">
		<td class="reg-label">Scan Kartu Keluarga
      <div class='reg-info'>
        Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
      </div>
    </td>
		<td class="reg-input">
			<input type='file' id='kkInp'/>
			<input type='hidden' value="<?php if(!is_null($data_maba->kartu_keluarga)){echo $data_maba->kartu_keluarga; } ?>" name='DOC_KK_NAME' id="kkOut" />
					</td>
	</tr>
  <tr id="KRT_PENGHASILAN_IBU" style="display:none;">
		<td class="reg-label">Scan Surat Keterangan Penghasilan Ibu
    <div class='reg-info'>
        Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
      </div>
    </td>
		<td class="reg-input">
			<input type='file' id="ketPenghasilanInp" />
			<input type='hidden' value="<?php if(!is_null($data_maba->surat_keterangan_penghasilan_ibu)){echo $data_maba->surat_keterangan_penghasilan_ibu; } ?>" name='DOC_PENGHASILAN_IBU_NAME' id="ketPenghasilanOut" />
					</td>
	</tr>
	<tr id="KRT_PENGHASILAN_BPK" style="display:none;">
		<td class="reg-label">Scan Surat Keterangan Penghasilan Bapak
    <div class='reg-info'>
        Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
      </div>
    </td>
		<td class="reg-input">
			<input type='file' id='ketPenghasilanbpkInp'/>
			<input type='hidden' value="<?php if(!is_null($data_maba->surat_keterangan_penghasilan_ayah)){echo $data_maba->surat_keterangan_penghasilan_ayah; } ?>" name='DOC_PENGHASILAN_BPK_NAME' id="ketPenghasilanbpkOut" />
					</td>
	</tr>
	<tr id="KRT_PENGHASILAN_WALI" style="display:none;">
		<td class="reg-label">Scan Surat Keterangan Penghasilan Wali
    <div class='reg-info'>
        Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
      </div>
    </td>
		<td class="reg-input">
			<input type='file' id="ketPenghasilanwaliInp" />
			<input type='hidden' value="<?php if(!is_null($data_maba->surat_keterangan_penghasilan_wali)){echo $data_maba->surat_keterangan_penghasilan_wali; } ?>" name='DOC_PENGHASILAN_WALI_NAME' id="ketPenghasilanwaliOut" />
					</td>
	</tr>
  <tr id="KRT_MISKIN" style="display:none;">
		<td class="reg-label">Scan Kartu Miskin/Kartu Menuju Sejahtera
    <div class='reg-info'>
        Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
      </div>
    </td>
		<td class="reg-input">
			<input type='file' id="kartuMiskinInp" />
			<input type='hidden' value="<?php if(!is_null($data_maba->kartu_miskin)){echo $data_maba->kartu_miskin; } ?>" name='DOC_KARTU_MISKIN_NAME' id="kartuMiskinOut" />
					</td>
	</tr>
	<tr id="STATUS_KAWIN" style="display:none;">
		<td class="reg-label">Status Perkawinan</td>
		<td class="reg-input">
			<select style='width:200px' name='STATUS_KAWIN' class="form-control input-sm">
			<option value="">Pilih Status</option>
				<option <?php if($data_maba->status_perkawinan=='K'){echo "selected";} ?> value='K' >Kawin</option>
				<option <?php if($data_maba->status_perkawinan=='B'){echo "selected";} ?> value='B'>Belum</option>
				<option <?php if($data_maba->status_perkawinan=='J'){echo "selected";} ?> value='J' >Janda</option>
				<option <?php if($data_maba->status_perkawinan=='D'){echo "selected";} ?> value='D' >Duda</option>
			</select>
		*)</td>
	</tr>
	<tr id="NM_PASANGAN" style="display:none;">
		<td class="reg-label">Nama Suami / Istri</td>
		<td class="reg-input"><input name='NM_PASANGAN' value="<?php echo $data_maba->nama_suami_istri; ?>" style='width:400px' class="form-control input-sm" maxlength="72" type='text' /></td>
	</tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>
		<td class="reg-input">
			<textarea name='KETERANGAN' style='width:400px;height:100px' class="form-control input-sm"><?php echo $data_maba->keterangan; ?></textarea>
		</td>
	</tr>
	</tbody>
</table>
<br class='ganjel'/></form>
<script type="text/javascript">



	function readURL(input,output) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#'+output).attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#kkInp").change(function(){

    readURL(this,'kkOut');
   
});

$("#ketPenghasilanInp").change(function(){

    readURL(this,'ketPenghasilanOut');
   
});

$("#ketPenghasilanbpkInp").change(function(){

    readURL(this,'ketPenghasilanbpkOut');
   
});

$("#ketPenghasilanwaliInp").change(function(){

    readURL(this,'ketPenghasilanwaliOut');
   
});

$("#kartuMiskinInp").change(function(){

    readURL(this,'kartuMiskinOut');
   
});
</script>