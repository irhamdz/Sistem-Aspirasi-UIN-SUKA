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

	function OnChangePropIbu(prop1)
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

    function OnChangeKabIbu(kab1)
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
    var tgl = $("#lahirIbu").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	});
</script>
<form action='' name='form_sakti' method='POST' id="data_ibu">
<input type='hidden' name='nomor_pendaftar' value='<?php echo $nomor_pendaftar ?>'/>
<br class='ganjel'/>
<div id="msg"></div> 
	<div class="bs-callout bs-callout-info">
	Isi data Ibu dengan benar. Kolom bertanda *) wajib diisi. 
</div>
<table class="table-snippet">
	<tbody>
		<tr>
			<td colspan='2'><strong>Data Ibu</strong><br /></td>
		</tr>
	<tr id="NM_IBU" style="display:none;">
		<td class="reg-label">Nama Ibu Kandung</td>
		<td class="reg-input">
			<input type='text' value="<?php echo $data_maba->nama_lengkap_ibu; ?>" class="form-control input-sm" maxlength="75" name='NM_IBU_KANDUNG'/> *)
		</td>
	</tr>
	<tr id="STATUS_IBU" style="display:none;">
		<td class="reg-label">Status Ibu</td>
		<td class="reg-input">
			<select name='KD_STATUS_IBU' style='width:250px' class="form-control input-sm">
				<option <?php if($data_maba->status_ibu=='H'){echo "selected";} ?> value='H'>Masih Menikah Dengan Ayah</option>
                <option <?php if($data_maba->status_ibu=='L'){echo "selected";} ?> value='L'>Bercerai dengan Ayah</option>
				<option <?php if($data_maba->status_ibu=='W'){echo "selected";} ?> value='W'>Wafat</option>
			</select>*)
		</td>
	</tr>
	<tr id="TPT_LAHIR_IBU" style="display:none;">
		<td class="reg-label">Tempat Lahir Ibu</td>
		<td class="reg-input">
			<input type='text' value="<?php echo $data_maba->tempat_lahir_ibu; ?>" class="form-control input-sm" maxlength="75" name='TMP_LAHIR_IBU' />*)
		</td>
	</tr>
	<tr id="TGL_LAHIR_IBU" style="display:none;">
			<td >Tgl. Lahir</td>
			<td>
					
					<div class="input-group date" id="lahirIbu" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" value="<?php echo date('d/m/Y',strtotime($data_maba->tanggal_lahir_ibu)); ?>" type="text" name="tgl_lahir_Ibu" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div> *)
					</td>
		</tr>
	<tr id="AGAMA_IBU" style="display:none;">
		<td class="reg-label">Agama Ibu</td>
		<td class="reg-input">
			<select name='KD_AGAMA_IBU' class="form-control input-sm">
							<option value="">Pilih Agama</option>
								<?php
								if(!is_null($data_agama))
								{
									foreach ($data_agama as $agama) {
										echo "<option "; if($data_maba->id_agama_ibu==$agama->id_agama){echo "selected";} echo" value='".$agama->id_agama."'>".$agama->nama_agama."</option>";
									}
								}
									
								
								?>
			</select>*)
		</td>
	</tr>
	<tr id="PEND_IBU" style="display:none;">
		<td class="reg-label">Pendidikan Ibu</td>
		<td class="reg-input">
			<select name='KD_PEND_IBU' class="form-control input-sm">
							<option value="" >Pilih Pendidikan</option>
							<?php
							if(!is_null($data_pendidikan))
							{
								foreach ($data_pendidikan as $pendidikan) {
									echo "<option "; if($data_maba->id_jenjang_pendidikan_ibu==$pendidikan->id_jenjang){echo "selected";} echo" value='".$pendidikan->id_jenjang."'>".$pendidikan->nama_jenjang."</option>";
								}
							}
							?>
							</select>*)
		</td>
	</tr>
	<tr id="PEKERJAAN_IBU" style="display:none;">
		<td class="reg-label">Pekerjaan Ibu</td>
		<td class="reg-input">
			<select name='KD_KERJA_IBU' style='width:150px' onchange="pekerjaan_pilih(this.value,'ket')" class="form-control input-sm">
							<option value="" >Pilih Pekerjaan</option>
								
					<?php
					if(!is_null($data_pk_ortu))
					{
						foreach ($data_pk_ortu as $pk_ortu) {
							echo "<option "; if($data_maba->pekerjaan_ibu==$pk_ortu->id_pekerjaan){echo "selected";} echo" value='".$pk_ortu->id_pekerjaan."'>".$pk_ortu->nama_pekerjaan."</option>";
						}
					}
					?>
							</select>
			<span id='ket'>Golongan</span>
			<input class="form-control input-sm" value="<?php echo $data_maba->golongan_ibu; ?>" style='width:250px' type='text' name='KERJA_IBU_DETAIL'/> *)
		</td>
	</tr>
	<tr id="ALAMAT_RUMAH" style="display:none;">
		<td class="reg-label">Alamat Rumah</td>
		<td class="reg-input">
			<input maxlength="75" name='ALAMAT_IBU' value="<?php echo $data_maba->alamat_lengkap_ibu; ?>" style='width:350px;' type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="RT" style="display:none;">
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' value="<?php echo $data_maba->rt_ibu; ?>" name='RT_IBU' onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="RW" style="display:none;">
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' value="<?php echo $data_maba->rw_ibu; ?>" name='RW_IBU' onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	<tr id="KELURAHAN" style="display:none;">
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_IBU' value="<?php echo $data_maba->desa_ibu; ?>" type='text' class="form-control input-sm"/>*)
		</td>
	</tr>
	<tr id="PROVINSI" style="display:none;">
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<select name='KD_PROP_IBU' onchange="OnChangePropIbu(this)" class="form-control input-sm">
				<option value="">Pilih Provinsi</option>
									<?php
									if(!is_null($data_provinsi))
									{
										foreach ($data_provinsi as $provinsi) {
											echo "<option "; if($data_maba->prop_ibu==$provinsi->kode_provinsi){echo "selected";} echo" value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
										}
									}

									?>
								</select> *)
		</td>
	</tr>
	<tr id="KABUPATEN" style="display:none;">
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
						<select name='KD_KAB_IBU' id="kab2" class="form-control input-sm" onchange="OnChangeKabIbu(this)">
									<option value='<?php echo $data_maba->kab_ibu; ?>'>Pilih Kabupaten</option>
							</select> *)
		</td>
	</tr>
	<tr id="KECAMATAN" style="display:none;">
		<td class="reg-label">Kecamatan Asal</td>
		<td class="reg-input">
						<select name='KD_KEC_IBU' id="kec2" class="form-control input-sm">
									<option value='<?php echo $data_maba->kec_ibu; ?>'>Pilih Kecamatan</option>
							
					
			</select> *)
		</td>
	</tr>
	<tr id="NEGARA" style="display:none;">
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select name='KD_NEGARA_IBU' class="form-control input-sm">
							<option value=''>Pilih Negara</option>
								<?php
								if(!is_null($data_negara))
								{
									foreach ($data_negara as $negara) {
										echo "<option "; if($data_maba->id_negara_ibu==$negara->kode_negara){echo "selected";} echo" value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
									}
								}

								?>
			</select>
		*)</td>
	</tr>
	<tr id="KODE_POS" style="display:none;">
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_IBU' value="<?php echo $data_maba->kode_pos_ibu; ?>" class="form-control input-sm" maxlength='6' style='width:50px' type='text'/>
		*)</td>
	</tr>
	<tr id="TELP" style="display:none;">
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px' value="<?php echo $data_maba->telp_ibu; ?>" name='TELP_IBU' type='text' class="form-control input-sm"/>*)
		</td>
	</tr>
	<tr id="HP" style="display:none;">
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" value="<?php echo $data_maba->nohp_ibu; ?>" style='width:150px' name='HP_IBU' type='text' class="form-control input-sm"/>
			<div class='reg-info'>
			Apabila tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		*)</td>
	</tr>
	<tr id="EMAIL" style="display:none;">
		<td class="reg-label">Email</td>
		<td class="reg-input">
			<input maxlength="50" value="<?php echo $data_maba->email_ibu; ?>" name='EMAIL_IBU' style='width:250px' type='text' class="form-control input-sm"/>
		*)</td>
	</tr>
	</tbody>
</table>

	<br/><br/>
<br class='ganjel'/></form>