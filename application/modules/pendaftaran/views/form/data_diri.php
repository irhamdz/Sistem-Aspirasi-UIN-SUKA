<?php
if(!is_null($maba))
{
	foreach ($maba as $data_maba);
}
if(!is_null($pekerjaan))
{
	foreach ($pekerjaan as $data_pekerjaan);
}

?>
 <script type="text/javascript">

$(document).ready(function(){

for(var i=0; i<data_item.length; i++)
    	{
    		
    		$('#'+data_item[i]).show();
    	}
});

    function OnChangeProp1(prop1)
    {

    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    :"aksi=prop&kd_prop="+prop1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kab1").innerHTML = obk['kab'];
			document.getElementById("kec1").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
		});
    }

    function OnChangeKab1(kab1)
    {

    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+kab1.value,
		success: function(r){
			var obk = $.parseJSON(r);
			
			document.getElementById("kec1").innerHTML = obk['kec'];
		}
		});
    }

    function changeprop2(prop2)
    {
    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    :"aksi=prop&kd_prop="+prop2.value,
		success: function(r){
			var obk = $.parseJSON(r);
		
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="0">KEC. LAINNYA</option>';
		}
		});
    }

    function changekab2(kab2) {
    
    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+kab2.value,
		success: function(r){
			var obk = $.parseJSON(r);
		
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
		});
    }

     function changeprop3(prop3)
    {
    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    :"aksi=prop&kd_prop="+prop3.value,
		success: function(r){
			var obk = $.parseJSON(r);
		
			document.getElementById("kab3").innerHTML = obk['kab'];
			document.getElementById("kec3").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
		});
    }

    function changekab3(kab3) {

    	$.ajax({
		url 	: "<?php echo base_url('pendaftaran/form_control/ajax_wilayah'); ?>",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+kab3.value,
		success: function(r){
			var obk = $.parseJSON(r);
		
			document.getElementById("kec3").innerHTML = obk['kec'];
		}
		});
    }
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

	$(function() 
	{
        
		var tgl = $("#dp1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	var tgl2 = $("#dp2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl2.hide();
	}).data('datepicker');


	$('.jam').timepicker({
		showMeridian: false,
		defaultTime: '07:00',
	});

	});
	
</script>
<div id="home-s2">
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td>
						<div id="msg"></div> 
						<div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 800 KB</font> </div>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
				
					</td>
				</tr>
				</tbody>
	</table>
	<form method="POST" id="data_diri" enctype="multipart/form-data">
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Biodata Pribadi</strong><br /></td>
		</tr>
		<tr id="NAMA" style="display:none;">
			<td>Nama Sesuai Ijazah Terakhir</td>
			<td><div class="col-xs-7"><input type='text' required name='nama_lengkap' value="<?php echo $data_maba->nama_lengkap; ?>" class="form-control input-sm" /></div> *)</td>
		</tr>
		<input type="hidden" value="<?php echo $nomor_pendaftar; ?>" name='nomor'>
		<tr id="GD_NA" style="display:none;">
		<td class="reg-label">Gelar Depan Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" value="<?php echo $data_maba->gelar_depan_na; ?>"  class="form-control input-sm" style="width:100px" type="text" name="gelar_depan_na" value=""  class="inputx"></div>
		<div class="col-xs-12"><div class="reg-info">contoh: Raden, R.A., H., Hj., Kyai, dll. Jika tidak ada mohon dikosongkan.</div></div></td>
	</tr>
	<tr id="GD_A" style="display:none;">
		<td class="reg-label">Gelar Depan Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" value="<?php echo $data_maba->gelar_depan; ?>"  class="form-control input-sm" style="width:100px" type="text" name="gelar_depan" value="" class="inputx"></div>
		<div class="col-xs-12"><div class="reg-info">contoh: Drs., Ir., DR., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr id="GB_A" style="display:none;">
		<td class="reg-label">Gelar Belakang Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" value="<?php echo $data_maba->gelar_belakang; ?>"  class="form-control input-sm" style="width:100px" type="text" name="gelar_belakang" value="" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: S.Ag., S.H., S.E., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr id="GB_NA" style="display:none;">
		<td class="reg-label">Gelar Belakang Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" value="<?php echo $data_maba->gelar_belakang_na; ?>" class="form-control input-sm" style="width:100px" type="text" name="gelar_belakang_na" value="" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: CCNA, CPA, CPM, dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr id="JK" style="display:none;">
			<td >Jenis Kelamin</td>
			<td><div class="col-xs-7">
				<select name="jenis_kelamin" class="form-control input-sm" required>
					<option <?php if($data_maba->jenis_kelamin=='L'){echo "selected";} ?> value="L">Laki-laki</option>
					<option <?php if($data_maba->jenis_kelamin=='P'){echo "selected";} ?> value="P">Perempuan</option>
				</select>
			</div> *)</td>
		</tr>
		<tr id="TL" style="display:none;">
			<td >Tempat Lahir</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->tempat_lahir; ?>" required name='tempat_lahir' class="form-control input-sm"  /></div> *)</td>
		</tr>
		<tr id="KAB_LAHIR" style="display:none;">
			<td>
				Nama Kabupaten Lahir
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kab_lahir" class="form-control input-sm" required>
					<option value="">Pilih Kabupaten</option>
					<?php
						if(!is_null($data_kabupaten))
						{
							foreach ($data_kabupaten as $kabupaten) {
								echo "<option ";if($data_maba->kabupaten_lahir==$kabupaten->kode_kabupaten){echo "selected";} echo " value='".$kabupaten->kode_kabupaten."'>".$kabupaten->nama_kabupaten."</option>";
							}
						}
					?>
				</select>
			</div>*)
			</td>
		</tr>
		<tr id="TGL_LAHIR" style="display:none;">
			<td >Tgl. Lahir</td>
			<td>
					<div class="col-xs-7">
					<div class="input-group date" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
					<input class="form-control" size="16" type="text" required value="<?php echo date('d/m/Y',strtotime($data_maba->tgl_lahir)); ?>" name="tgl_lahir" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div></div> *)</td>
		</tr>
		<tr id="AGAMA" style="display:none;">
			<td >Agama</td>
			<td><div class="col-xs-7">
			<select name='pmb1_agama' required id='agama' class="form-control input-sm">
					<option value=''>Pilih Agama</option>
					<?php
					if(!is_null($data_agama))
					{
						foreach ($data_agama as $agama) {
							echo "<option ";if($data_maba->id_agama==$agama->id_agama){echo "selected";} echo " value='".$agama->id_agama."'>".$agama->nama_agama."</option>";
						}
					}

					?>
					</select>
			</div>*)
			</td>
		</tr>
		<tr id="NEGARA" style="display:none;">
		<td class="reg-label">Warga Negara   </td>
		
		<td class="reg-input">
				<div class="col-xs-7">
				<select name="warga_negara" required class="form-control input-sm">
				<option value="">Pilih Negara</option>
				<?php
					if(!is_null($data_negara))
					{
						foreach ($data_negara as $negara) {
							echo "<option ";if($data_maba->warga_negara==$negara->kode_negara){echo "selected";}echo " value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
						}
					}
				?>
				</select></div>*)

				<!---<tr id="WNA" style="display:none;">
					<td class="reg-label">
					Sertifikat Menguasai Bahasa Indonesia (WNA)<br/>
					<div class='reg-info'>
					Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
					</div>
					</td>
					<td class="reg-input2"><div class="col-xs-7">
					<input type='file' id="wnaInp" required/>
					<input type='hidden' id="wnaOt"  name='wna' />
					<input type="hidden" name="wna2" value="<?php //echo $data_maba->sertifikat_wna; ?>">
					</div>*)</td>
			</tr>-->
		</td>
		</tr>
		<tr id="KTP" style="display:none;">
			<td>Nomor KTP / Passport</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->no_ktp; ?>" required onkeypress="return isNumberKey(event)" name='ktp_passport' class="form-control input-sm" /></div>*)</td>
		</tr>
		<tr id="TGL_KTP" style="display:none;">
			<td >Tanggal Berakhir KTP / Passport</td>
			<td>
					<div class="col-xs-7">
					<div class="input-group date" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" required type="text" value="<?php echo date('d/m/Y',strtotime($data_maba->tanggal_akhir_ktp)); ?>" onkeypress="return isNumberKey(event)" name="tgl_akhir_ktp_pas">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div></div>*)</td>
		</tr>
		<tr id="GOL_DARAH" style="display:none;">
			<td >Golongan Darah </td>
			
			<td>
				<div class="col-xs-7"><select style='width:80px' required class="form-control input-sm" name='gol_darah' class='inputx'>
				<option <?php if($data_maba->jenis_kelamin=='A'){echo "selected";} ?> value='A' >A</option>
				<option <?php if($data_maba->jenis_kelamin=='B'){echo "selected";} ?> value='B' >B</option>
				<option <?php if($data_maba->jenis_kelamin=='O'){echo "selected";} ?> value='O' >O</option>
				<option <?php if($data_maba->jenis_kelamin=='AB'){echo "selected";} ?> value='AB' >AB</option>
			</select> </div>*)<br />
			</td>
		</tr>
		<tr id="TBDN" style="display:none;">
			<td>Tinggi Badan</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->tinggi_badan; ?>" required onkeypress="return isNumberKey(event)" name='tinggi_bdn' class="form-control input-sm" /></div>*) </td>
		</tr>
		<tr id="BBDN" style="display:none;">
			<td>Berat Badan</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->berat_badan; ?>" required onkeypress="return isNumberKey(event)" name='berat_bdn' class="form-control input-sm" /></div>*) </td>
		</tr>
		<tr id="ALAMAT_ASAL" style="display:none;">
			<td >Alamat Asal </td>
			
			<td><div class="col-xs-7"><textarea style="width:400px;height:100px" required name='alamat_asal' class="form-control input-sm"><?php echo $data_maba->alamat_asal;?></textarea></div>
			<div class="col-xs-12"><div class="reg-info"> Format Pengisian : Alamat Rumah / Nama Jalan, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos</div></div>
		*)
		</td>
		</tr>
		<tr id="RT_ASAL" style="display:none;">
		<td class="reg-label">RT Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_maba->rt_asal; ?>" required name="rt_asal" onkeypress="return isNumberKey(event)" class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>  
			*)
		</td>
	</tr>
	<tr id="RW_ASAL" style="display:none;">
		<td class="reg-label">RW Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_maba->rw_asal; ?>" required name="rw_asal" onkeypress="return isNumberKey(event)" class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>   
		*)</td>
	</tr>
	<tr id="KELURAHAN_ASAL" style="display:none;">
		<td class="reg-label">Kelurahan / Desa Asal </td>
		
		<td class="reg-input">	
			<div class="col-xs-7"><input name="desa_asal" required value="<?php echo $data_maba->kelurahan_asal; ?>" maxlength="25" type="text" class="form-control input-sm" class="inputx"> </div> 
		*)</td>
	</tr>
	<tr id="PROV_ASAL" style="display:none;">
			<td>
				Provinsi Asal
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kd_prop" class="form-control input-sm" required onchange="OnChangeProp1(this)">
					<option value="">Pilih Provinsi</option>
					<?php
					if(!is_null($data_provinsi))
					{
						foreach ($data_provinsi as $provinsi) {
							echo "<option "; if($data_maba->kode_provinsi_asal==$provinsi->kode_provinsi){echo "selected";}echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
						}
					}
					

					?>
				</select>
			</div>*)
			</td>
		</tr>
	<tr id="KAB_ASAL" style="display:none;">
			<td>
				Kabupaten Asal
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kabupaten_asal" id="kab1" required class="form-control input-sm" onchange="OnChangeKab1(this)">
					<option value="">Pilih Kabupaten</option>
					<?php
						if(!is_null($data_kabupaten))
						{
							foreach ($data_kabupaten as $kabupaten1) {
								echo "<option ";if($data_maba->kode_kabupaten_asal==$kabupaten1->kode_kabupaten){echo "selected";} echo " value='".$data_maba->kode_kabupaten_asal."'>".$kabupaten1->nama_kabupaten."</option>";
							}
						}
					?>
				</select>
			</div>*)
			</td>
		</tr>
	<tr id="KEC_ASAL" style="display:none;">
			<td>
				Kecamatan Asal
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kecamatan_asal" id="kec1" required class="form-control input-sm">
					<option value="<?php echo $data_maba->kode_kecamatan_asal; ?>">Pilih Kecamatan</option>
				</select>
			</div>*)
			</td>
		</tr>
		<tr id="NEGARA_ASAL" style="display:none;">
		<td class="reg-label">Negara Asal   </td>
		
		<td class="reg-input">
				<div class="col-xs-7">
				<select name="negara_asal" required class="form-control input-sm">
				<option value="">Pilih Negara</option>
				<?php
					if(!is_null($data_negara))
					{
						foreach ($data_negara as $negara) {
							echo "<option "; if($data_maba->warga_negara==$negara->kode_negara){echo "selected";}echo " value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
						}
					}
				?>
				</select></div>*)
		</td>
		</tr>
		<tr id="KD_POS" style="display:none;">
			<td>Kode Pos Asal</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->kode_pos_asal; ?>" required onkeypress="return isNumberKey(event)" name='kode_pos_asal' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr id="ALAMAT_INI" style="display:none;">
			<td >Alamat Saat Ini</td>
			
			<td><div class="col-xs-7"><textarea style="width:400px;height:100px" required name='alamat_saat_ini' class="form-control input-sm"><?php echo $data_maba->alamat_lengkap; ?></textarea></div>
			<div class="col-xs-12"><div class="reg-info"> Format Pengisian : Alamat Rumah / Nama Jalan, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos</div>*)</div>
	
		</td>
		</tr>
		<tr id="RT_INI" style="display:none;">
		<td class="reg-label">RT Saat Ini </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_maba->rt; ?>" required onkeypress="return isNumberKey(event)" name="rt_saat_ini"  class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>  
		*)	
		</td>
	</tr>
	<tr id="RW_INI" style="display:none;">
		<td class="reg-label">RW Saat Ini </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_maba->rw; ?>" required onkeypress="return isNumberKey(event)" name="rw_saat_ini" class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>   
		*)
		</td>
	</tr>
	<tr id="DESA_INI" style="display:none;">
		<td class="reg-label">Kelurahan / Desa Saat Ini </td>
		
		<td class="reg-input">	
			<div class="col-xs-7"><input name="desa_saat_ini" value="<?php echo $data_maba->kelurahan; ?>" maxlength="25" required type="text" class="form-control input-sm"> </div> 
		*)
		</td>
	</tr>
	<tr id="PROV_INI" style="display:none;">
			<td>
				Provinsi Saat Ini
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="provinsi_saat_ini" class="form-control input-sm" required onchange="changeprop2(this)">
					<option value="">Pilih Provinsi</option>
					<?php
					if(!is_null($data_provinsi))
					{
						foreach ($data_provinsi as $provinsi) {
							echo "<option ";if($data_maba->kode_provinsi==$provinsi->kode_provinsi){echo "selected";}echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
						}
					}
					

					?>
				</select>
			</div>*)
			</td>
		</tr>
	<tr id="KAB_INI" style="display:none;">
			<td>
				Kabupaten Saat Ini
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kabupaten_saat_ini" id="kab2" required class="form-control input-sm" onchange="changekab2(this)">
					<option value="<?php echo $data_maba->kode_kabupaten; ?>">Pilih Kabupaten</option>
					<?php
						if(!is_null($data_kabupaten))
						{
							foreach ($data_kabupaten as $kabupaten) {
								echo "<option ";if($data_maba->kode_kabupaten==$kabupaten->kode_kabupaten){echo "selected";} echo " value='".$data_maba->kode_kabupaten."'>".$kabupaten->nama_kabupaten."</option>";
							}
						}
					?>
				</select>
			</div>*)
			</td>
		</tr>
	<tr id="KEC_INI" style="display:none;">
			<td>
				Kecamatan Saat Ini
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kecamatan_saat_ini" id="kec2" required class="form-control input-sm">
					<option value="<?php echo $data_maba->kode_kecamatan; ?>">Pilih Kecamatan</option>
					
				</select>
			</div>*)
			</td>
		</tr>
		<tr id="KD_POS_INI" style="display:none;">
			<td>Kode Pos Saat Ini</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->kode_pos; ?>" required onkeypress="return isNumberKey(event)" name='kode_pos_saat_ini' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr id="NAMA_PKJ" style="display:none;">
			<td>Nama Pekerjaan</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_pekerjaan->nama_pekerjaan; ?>"  name='pekerjaan_mhs' class="form-control input-sm" /></div></td>
		</tr>
	
				<tr id="ALAMAT_PKJ" style="display:none;">
			<td >Alamat Tempat Kerja</td>
			
			<td><div class="col-xs-7"><textarea style="width:400px;height:100px" name='alamat_kerja' class="form-control input-sm"><?php echo $data_pekerjaan->alamat; ?></textarea></div> 
			<div class="col-xs-12"><div class="reg-info"> Format Pengisian : Alamat Rumah / Nama Jalan, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos</div></div>
		</td>
		</tr>
		<tr id="RT_PKJ" style="display:none;">
		<td class="reg-label">RT Tempat Kerja </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_pekerjaan->rt; ?>" onkeypress="return isNumberKey(event)" name="rt_kerja"  class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>
			
		</td>
	</tr>
	<tr id="RW_PKJ" style="display:none;">
		<td class="reg-label">RW Tempat Kerja </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" value="<?php echo $data_pekerjaan->rw; ?>" onkeypress="return isNumberKey(event)" name="rw_kerja" class="form-control input-sm" maxlength="5" type="text" class="inputx"></div>
		</td>
	</tr>
	<tr id="DESA_PKJ" style="display:none;">
		<td class="reg-label">Kelurahan / Desa Tempat Kerja </td>
		
		<td class="reg-input">	
			<div class="col-xs-7"><input name="desa_kerja" value="<?php echo $data_pekerjaan->kode_kelurahan; ?>" maxlength="25" type="text" class="form-control input-sm" class="inputx"> </div>
		</td>
	</tr>
	<tr id="PROV_PKJ" style="display:none;">
			<td>
				Provinsi Tempat Kerja
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="provinsi_kerja" class="form-control input-sm" onchange="changeprop3(this)">
					<option value="">Pilih Provinsi</option>
					<?php
					if(!is_null($data_provinsi))
					{
						foreach ($data_provinsi as $provinsi) {
							echo "<option "; if($data_pekerjaan->kode_provinsi==$provinsi->kode_provinsi){echo "selected";}echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
						}
					}
					

					?>
				</select>
			</div>
			</td>
		</tr>
	<tr id="KAB_PKJ" style="display:none;">
			<td>
				Kabupaten Tempat Kerja
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kabupaten_kerja" class="form-control input-sm" id="kab3" onchange="changekab3(this)">
					<option value="<?php echo $data_pekerjaan->kode_kabupaten; ?>">Pilih Kabupaten</option>
				</select>
			</div>
			</td>
		</tr>
	<tr id="KEC_PKJ" style="display:none;">
			<td>
				Kecamatan Tempat Kerja
			</td>
			<td width=200>
			<div class="col-xs-7">
				<select name="kecamatan_kerja" id="kec3" class="form-control input-sm">
					<option value="<?php echo $data_pekerjaan->kode_kecamatan; ?>">Pilih Kecamatan</option>
				</select>
			</div>
			</td>
		</tr>
		<tr id="KD_POS_PKJ" style="display:none;">
			<td>Kode Pos Tempat Kerja</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_pekerjaan->kode_pos; ?>" onkeypress="return isNumberKey(event)" name='kode_pos_kerja' class="form-control input-sm" /></div></td>
		</tr>
		<tr id="TELP_PKJ" style="display:none;">
			<td>Telepon Tempat Kerja</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_pekerjaan->telp; ?>" name='telp_kerja' class="form-control input-sm" /></div></td>
		</tr>
		<tr id="FAX_PKJ" style="display:none;">
			<td>Fax Tempat Kerja</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_pekerjaan->fax; ?>" name='fax_kerja' class="form-control input-sm" /></div></td>
		</tr>
		<tr id="EMAIL_PKJ" style="display:none;">
			<td>Email Tempat Kerja</td>
			<td><div class="col-xs-7"><input type='text' name='email_kerja' value="<?php echo $data_pekerjaan->email; ?>" class="form-control input-sm" /></div></td>
		</tr>

		<tr id="TELP" style="display:none;">
			<td>No Telepon</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->telp; ?>" name='telp' class="form-control input-sm" /></div></td>
		</tr>
		<tr id="HP" style="display:none;">
			<td>No Handphone</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->nohp; ?>" required name='hp' class="form-control input-sm" /></div>*)</td>
		</tr>
		<tr id="EMAIL" style="display:none;">
			<td>Email</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->email; ?>" name='email' class="form-control input-sm" /></div>*)</td>
		</tr>
		<tr id="WEB" style="display:none;">
			<td>Website</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->website; ?>" name='web' class="form-control input-sm" /></div></td>
		</tr>
		<tr id="BLOG" style="display:none;">
			<td>Blog</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->blog; ?>" name='blog' class="form-control input-sm" /></div> </td>
		</tr>
		<tr id="TWIT" style="display:none;">
			<td>Twitter</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->twitter; ?>" name='twitter' class="form-control input-sm" /></div> </td>
		</tr>
		<tr id="FB" style="display:none;">
			<td>Facebook</td>
			<td><div class="col-xs-7"><input type='text' value="<?php echo $data_maba->facebook; ?>" name='fb' class="form-control input-sm" /></div> </td>
		</tr>
		<tr id="AKTA" style="display:none;">
		<td class="reg-label">
            Scan Akta Kelahiran<br/>
            <div class='reg-info'>
                Tipe file yang diizinkan adalah jpg, jpeg dan berukuran maksimum 800 KB
            </div>
        </td>
		<td class="reg-input2"><div class="col-xs-7">
			<input type='file' id="aktaInp" required/>
			<input type='hidden' id="aktaOt"  name='akta' />
			<input type="hidden" name="akta2" value="<?php echo $data_maba->akta_kelahiran; ?>">
		
		</div>*)</td>
	</tr>
	<tr id="FOTO" style="display:none;">
		<td class="reg-label">
            Foto<br/>
            <div class='reg-info'>
                Tipe file yang diizinkan adalah jpg atau jpeg dan berukuran maksimum 400 KB
            </div>
        </td>
		<td class="reg-input2">
		<div class="col-xs-7">
			<input type='file' id="imgInp" required/>
			<input type="hidden" id="nama_foto" name="foto">
			<input type="hidden" id="nama_foto2" name="foto2" value="<?php echo $data_maba->foto;?>">
			<br>
			<img src="<?php if(!is_null($data_maba->foto)){echo pg_unescape_bytea($data_maba->foto);} ?>" id="img_url" class="sia-profile-image">
					</div>
					*)
					</td>
	</tr>

			</tbody>
			</table>
<br class='ganjel'/>
			</form>
		</table>
</div>
<script type="text/javascript">

function readURLIMG(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_url').attr('src', e.target.result);
            $('#FP').attr('src', e.target.result);
         	$('#nama_foto').attr('value', e.target.result);
         	$('#nama_foto2').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

function readURLAKT(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#aktaOt').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#imgInp").change(function(){

	if(this.files[0].type=='image/jpeg')
	{
		
		if((this.files[0].size/1024) <= 200 && (this.files[0].size/1024) >= 50 )
		{
			readURLIMG(this);
		}
		else
		{
			alert('Ukuran foto yang diijinkan 50kb - 200kb. Ulangi Upload!');
			$("#imgInp").attr('value',null);
		}
		
	
	}
	else
	{
		alert("Tipe File Salah");
		$("#imgInp").attr('value',null);
	}
    
   
});

$("#aktaInp").change(function(){

	
    
    if((this.files[0].size/1024) <= 800 )//maks 800 kb
		{
			readURLAKT(this);
		}
		else
		{
			alert('Ukuran file yang diijinkan maksimal 1 Mb. Ulangi Upload!');
			$("#aktaInp").attr('value',null);
		}
		
   
});


function readURLWNA(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#wnaOt').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#wnaInp").change(function(){

	
    readURLWNA(this);
   
});

</script>