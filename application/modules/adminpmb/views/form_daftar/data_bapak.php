<?php 
foreach ($maba as $data_maba);
?>
		<style>
	thead th{
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
<script type="text/javascript">
$(document).ready(function(){

for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
});

	function OnChangePropayah(prop1)
    {

    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    :"aksi=prop&kd_prop="+prop1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
		});
    }

    function OnChangeKabayah(kab1)
    {
    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+kab1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
		});
    }



	$(function() 
	{
    var tgl = $("#lahirayah").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	});
</script>
<form action='' name='form_sakti' method='POST' id="data_bapak">
<input type='hidden' name='nomor_pendaftar' value='<?php echo $nomor_pendaftar ?>'/>
<br class='ganjel'/>
<div id="msg"></div> 
	<div class="bs-callout bs-callout-info">
	Isi data Ayah dengan benar. Kolom bertanda *) wajib diisi. 
</div>
<table class="table-snippet">
	<tbody>
		<tr style="display:none;">
			<td colspan='2'><strong>Data Ayah</strong><br /></td>
		</tr>
	<tr id="NM_BPK" style="display:none;">
		<td class="reg-label">Nama Bapak Kandung</td>
		<td class="reg-input">
			<input type='text' value="<?php echo $data_maba->nama_lengkap_ayah; ?>" class="form-control input-sm" maxlength="75" name='NM_BPK_KANDUNG'/> *)
		</td>
	</tr>
	<tr id="STATUS_BPK" style="display:none;">
		<td class="reg-label">Status Bapak</td>
		<td class="reg-input">
			<select name='KD_STATUS_BPK' style='width:250px' class="form-control input-sm">
				<option <?php if($data_maba->status_ayah=='H') {echo "selected";}?> value='H'>Masih Menikah Dengan Ibu</option>
                <option <?php if($data_maba->status_ayah=='L') {echo "selected";}?> value='L'>Bercerai dengan Ibu</option>
				<option <?php if($data_maba->status_ayah=='W') {echo "selected";}?> value='W'>Wafat</option>
			</select>
		*)</td>
	</tr>
	<tr id="TPT_LAHIR" style="display:none;">
		<td class="reg-label">Tempat Lahir Bapak</td>
		<td class="reg-input">
			<input type='text' value="<?php echo $data_maba->tempat_lahir_ayah; ?>" class="form-control input-sm" maxlength="75" name='TMP_LAHIR_BPK' />
		*)</td>
	</tr>
	<tr id="TGL_LAHIR" style="display:none;">
			<td >Tgl. Lahir</td>
			<td>
					
					<div class="input-group date" id="lahirayah" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" value="<?php echo date('d/m/Y',strtotime($data_maba->tanggal_lahir_ayah)); ?>" name="tgl_lahir_ayah" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div> *)
					</td>
		</tr>
	<tr id="AGAMA" style="display:none;">
		<td class="reg-label">Agama Bapak</td>
		<td class="reg-input">
			<select name='KD_AGAMA_BPK' class="form-control input-sm">
							<option value="">Pilih Agama</option>
								<?php
								if(!is_null($data_agama))
								{
									foreach ($data_agama as $agama) {
										echo "<option "; if($data_maba->id_agama_ayah==$agama->id_agama){echo "selected";} echo " value='".$agama->id_agama."'>".$agama->nama_agama."</option>";
									}
								}
									
								
								?>
			</select>*)
		</td>
	</tr>
	<tr id="PEND_BPK" style="display:none;">
		<td class="reg-label">Pendidikan Bapak</td>
		<td class="reg-input">
			<select name='KD_PEND_BPK' class="form-control input-sm">
							<option value="" >Pilih Pendidikan</option>
							<?php
							if(!is_null($data_pendidikan))
							{
								foreach ($data_pendidikan as $pendidikan) {
									echo "<option "; if($data_maba->id_jenjang_pendidikan_ayah==$pendidikan->id_jenjang){echo "selected";} echo " value='".$pendidikan->id_jenjang."'>".$pendidikan->nama_jenjang."</option>";
								}
							}
							?>
							</select>*)
		</td>
	</tr>
	<tr id="PKJ_BPK" style="display:none;">
		<td class="reg-label">Pekerjaan Bapak</td>
		<td class="reg-input">
			<select name='KD_KERJA_BPK' style='width:150px' onchange="pekerjaan_pilih(this.value,'ket')" class="form-control input-sm">
							<option value="" >Pilih Pekerjaan</option>
								
					<?php
					if(!is_null($data_pk_ortu))
					{
						foreach ($data_pk_ortu as $pk_ortu) {
							echo "<option "; if($data_maba->pekerjaan_ayah==$pk_ortu->id_pekerjaan){echo "selected";} echo " value='".$pk_ortu->id_pekerjaan."'>".$pk_ortu->nama_pekerjaan."</option>";
						}
					}
					?>
							</select>*)
			<span id='ket'>Golongan</span>
			<input class="form-control input-sm" value="<?php echo $data_maba->golongan_ayah; ?>" style='width:250px' type='text' name='KERJA_BPK_DETAIL'/> *)
		</td>
	</tr>
	<tr id="ALAMAT_RUMAH" style="display:none;">
		<td class="reg-label">Alamat Rumah</td>
		<td class="reg-input">
			<input maxlength="75" name='ALAMAT_BPK' value="<?php echo $data_maba->alamat_lengkap_ayah; ?>" style='width:350px;' type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="RT" style="display:none;">
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' value="<?php echo $data_maba->rt_ayah; ?>" name='RT_BPK' onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="RW" style="display:none;">
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' value="<?php echo $data_maba->rw_ayah; ?>" name='RW_BPK' onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="KELURAHAN" style="display:none;">
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_BPK' value="<?php echo $data_maba->desa_ayah; ?>" type='text' class="form-control input-sm"/>*)
		</td>
	</tr>
	<tr id="PROVINSI" style="display:none;">
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<select name='KD_PROP_BPK' onchange="OnChangePropayah(this)" class="form-control input-sm">
				<option value="">Pilih Provinsi</option>
									<?php
									if(!is_null($data_provinsi))
									{
										foreach ($data_provinsi as $provinsi) {
											echo "<option "; if($data_maba->prop_ayah==$provinsi->kode_provinsi){echo "selected";} echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
										}
									}
									


									?>
								</select> *)
		</td>
	</tr>
	<tr id="KABUPATEN" style="display:none;">
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
						<select name='KD_KAB_BPK' id="kab2" class="form-control input-sm" onchange="OnChangeKabayah(this)">
									<option value='<?php echo $data_maba->kab_ayah; ?>'>Pilih Kabupaten</option>
							</select> *)
		</td>
	</tr>
	<tr id="KECAMATAN" style="display:none;">
		<td class="reg-label">Kecamatan Asal</td>
		<td class="reg-input">
						<select name='KD_KEC_BPK' id="kec2" class="form-control input-sm">
									<option value='<?php echo $data_maba->kec_ayah; ?>'>Pilih Kecamatan</option>
							
					
			</select> *)
		</td>
	</tr>
	<tr id="NEGARA" style="display:none;">
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select name='KD_NEGARA_BPK' class="form-control input-sm">
							<option value=''>Pilih Negara</option>
								<?php
								if(!is_null($data_negara))
								{
									foreach ($data_negara as $negara) {
										echo "<option "; if($data_maba->id_negara_ayah==$negara->kode_negara){echo "selected";} echo " value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
									}
								}

								?>
			</select>*)
		</td>
	</tr>
	<tr id="KODE_POS" style="display:none;">
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_BPK' value='<?php echo $data_maba->kode_pos_ayah; ?>' class="form-control input-sm" maxlength='6' style='width:50px' type='text'/>
		*)</td>
	</tr>
	<tr id="TELP" style="display:none;">
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" value='<?php echo $data_maba->telp_ayah; ?>' style='width:150px' name='TELP_BPK' type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="HP" style="display:none;">
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" value='<?php echo $data_maba->nohp_ayah; ?>' style='width:150px' name='HP_BPK' type='text' class="form-control input-sm"/>
			<div class='reg-info'>
			Apabila tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		*)</td>
	</tr>
	<tr id="EMAIL" style="display:none;">
		<td class="reg-label">Email</td>
		<td class="reg-input">
			<input maxlength="50" value='<?php echo $data_maba->email_ayah; ?>' name='EMAIL_BPK' style='width:250px' type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	</tbody>
</table>

	<br/><br/>
<br class='ganjel'/></form>