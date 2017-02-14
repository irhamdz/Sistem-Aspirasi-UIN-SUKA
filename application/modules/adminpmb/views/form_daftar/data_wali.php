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
	$(function() 
	{
    var tglwali = $("#lahirwali").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tglwali.hide();
	}).data('datepicker');

	});

	function OnChangePropwali(prop1)
    {

    	$.ajax({
		url 	: "<?php echo base_url('adminpmb/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    :"aksi=prop&kd_prop="+prop1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
		});
    }

    function OnChangeKabwali(kab1)
    {
    	$.ajax({
		url 	: "<?php echo base_url('adminpmb/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+kab1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
		});
    }
</script>
<br>
<div id="msg"></div> 
<form action='' name='form_sakti' method='POST' id="data_wali">
<input type='hidden' name='nomor_pendaftar' value="<?php echo $nomor_pendaftar; ?>" />
	<div class="bs-callout bs-callout-info">
	Apabila data wali tidak ada, maka isikan tulisan <b>TIDAK ADA</b> pada kolom Nama Wali.
</div>
<table class="table-snippet">
	<tbody><tr>
			<td colspan='2'><strong>Data Wali</strong><br /></td>
		</tr>
	<tr id="NM_WALI" style="display:none;">
		<td class="reg-label">Nama Wali</td>
		<td class="reg-input">
			<input type='text' class="form-control input-sm" value="<?php echo $data_maba->nama_wali; ?>" name='NM_WALI'/> *)
		</td>
	</tr>
	<tr id="TPT_LAHIR" style="display:none;">
		<td class="reg-label">Tempat Lahir Wali</td>
		<td class="reg-input">
			<input type='text' class="form-control input-sm" value="<?php echo $data_maba->tempat_lahir; ?>" name='TMP_LAHIR_WALI'/>
		</td>
	</tr>
	<tr id="TGL_LAHIR" style="display:none;">
			<td >Tgl. Lahir</td>
			<td>
					
					<div class="input-group date" id="lahirwali" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" value="<?php echo date('d/m/Y',strtotime($data_maba->tanggal_lahir)); ?>" name="tgl_lahir_wali" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div> *)
					</td>
		</tr>
	<tr id="AGAMA" style="display:none;">
		<td class="reg-label">Agama Wali</td>
		<td class="reg-input">
			<select name='KD_AGAMA_WALI' class="form-control input-sm">
							<option value="" >Pilih Agama</option>
							<?php 
							if(!is_null($data_agama))
							{
								foreach ($data_agama as $agama) {
									echo "<option "; if($data_maba->id_agama==$agama->id_agama){echo "selected";} echo " value='".$agama->id_agama."'>".$agama->nama_agama."</option>";
									# code...
								}
							}
							?>
								
			</select>
		</td>
	</tr>
	<tr id="PEND_WALI" style="display:none;">
		<td class="reg-label">Pendidikan Wali</td>
		<td class="reg-input">
			<select name='KD_PEND_WALI' class="form-control input-sm">
							<option value="" >Pilih Pendidikan</option>
								<?php
								if(!is_null($data_pendidikan))
								{
									foreach ($data_pendidikan as $pendidikan) {
										echo "<option "; if($data_maba->id_jenjang==$pendidikan->id_jenjang){echo "selected";} echo " value='".$pendidikan->id_jenjang."'>".$pendidikan->nama_jenjang."</option>";
									}
								}
								?>
							</select>
		</td>
	</tr>
	<tr id="PKJ_WALI" style="display:none;">
		<td class="reg-label">Pekerjaan Wali</td>
		<td class="reg-input">
			<select name='KD_KERJA_WALI' class="form-control input-sm" style='width:150px' onchange="pekerjaan_pilih(this.value,'ket')">
							<option value="">Pilih Pekerjaan</option>
							<?php
							if(!is_null($data_pk_ortu))
							{
								foreach ($data_pk_ortu as $pekerjaan) {
									echo "<option "; if($data_maba->id_pekerjaan==$pekerjaan->id_pekerjaan){echo "selected";} echo " value='".$pekerjaan->id_pekerjaan."'>".$pekerjaan->nama_pekerjaan."</option>";
									# code...
								}
							}
							?>
							</select>
			<span id='ket'>Golongan</span>
			<input class="form-control input-sm" style='width:250px' value="<?php echo $data_maba->golongan; ?>" type='text' name='KERJA_WALI_DETAIL'/> *)
		</td>
	</tr>
	<tr id="ALAMAT" style="display:none;">
		<td class="reg-label">Alamat Rumah</td>
		<td class="reg-input">
			<input name='ALAMAT_WALI' value="<?php echo $data_maba->alamat; ?>" style='width:350px;' type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="RT" style="display:none;">
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input style='width:50px' value="<?php echo $data_maba->rt; ?>" name='RT_WALI' onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="RW" style="display:none;">
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input style='width:50px' name='RW_WALI' value="<?php echo $data_maba->rw; ?>" onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="DESA" style="display:none;">
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input name='DESA_WALI' value="<?php echo $data_maba->kelurahan; ?>" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="PROVINSI" style="display:none;">
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<select name='KD_PROP_WALI' class="form-control input-sm" onchange="OnChangePropwali(this)">
				<option value="">Pilih Provinsi</option>
								<?php
								if(!is_null($data_provinsi))
								{
									foreach ($data_provinsi as $provinsi) {
										echo "<option "; if($data_maba->kode_provinsi==$provinsi->kode_provinsi){echo "selected";} echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
										# code...
									}
								}
								?>
								</select> *)
		</td>
	</tr>
	<tr id="KABUPATEN" style="display:none;">
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
						<select name='KD_KAB_WALI' class="form-control input-sm" id="kab2" onchange="OnChangeKabwali(this)">
						<option value="<?php echo $data_maba->kode_kabupaten; ?>">Pilih Kabupaten</option>
							</select> *)
		</td>
	</tr>
	<tr id="KECAMATAN" style="display:none;">
		<td class="reg-label">Kecamatan Asal</td>
		<td class="reg-input">
						<select class="form-control input-sm" name='KD_KEC_WALI' id="kec2">
						<option value="<?php echo $data_maba->kode_kecamatan; ?>">Pilih Kecamatan</option>
			</select> *)
		</td>
	</tr>
	<tr id="NEGARA" style="display:none;">
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select name='KD_NEGARA_WALI' class="form-control input-sm">
							<option  value=''>Pilih Negara</option>
							<?php 
							if(!is_null($data_negara))
							{
								foreach ($data_negara as $negara) {
									echo "<option "; if($data_maba->kode_negara==$negara->kode_negara){echo "selected";} echo " value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
									# code...
								}
							}
							?>
			</select>
		</td>
	</tr>
	<tr id="KODE_POS" style="display:none;">
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_WALI' value="<?php echo $data_maba->kode_pos; ?>" style='width:50px' class="form-control input-sm" type='text'/>
		</td>
	</tr>
	<tr id="TELP" style="display:none;">
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px' value="<?php echo $data_maba->telp; ?>" name='TELP_WALI' type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="HP" style="display:none;">
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px' value="<?php echo $data_maba->hp; ?>" name='HP_WALI' type='text' class="form-control input-sm"/>
			<div class='reg-info'>
			Apabila tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		</td>
	</tr>
	<tr id="EMAIL" style="display:none;">
		<td class="reg-label">Email</td>
		<td class="reg-input">
			<input name='EMAIL_WALI' value="<?php echo $data_maba->email; ?>" style='width:250px' type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="STATUS" style="display:none;">
		<td class="reg-label">Status Wali</td>
		<td class="reg-input">
			<select name='KD_STATUS_WALI' class="form-control input-sm" style='width:100px'>
				<option value=''>-</option>
				<option <?php if($data_maba->status_wali=='T'){echo "selected";} ?> value='T'>Tiri</option>
				<option <?php if($data_maba->status_wali=='A'){echo "selected";} ?> value='A'>Angkat</option>
				<option <?php if($data_maba->status_wali=='L'){echo "selected";} ?> value='L'>Lainnya</option>
			</select>
			Keterangan 
			<input name='STATUS_WALI' value="<?php echo $data_maba->keterangan; ?>" type='text' style='width:250px' class="form-control input-sm"/> *)
		</td>
	</tr>
	</tbody>
</table>

	<br/><br/>
<br class='ganjel'/></form>