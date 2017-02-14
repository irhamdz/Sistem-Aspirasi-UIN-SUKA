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
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
	function OnChangePropdar(prop1)
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

    function OnChangeKabdar(kab1)
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

    function pilih_tipe_hub_kontak_darurat(hub)
    {
    	if(hub=='L')
    	{
    		$("#label_lain").show();
    	}
    	else
    	{
    		$("#label_lain").hide();
    	}
    }
</script>
<br id="ganjel">
<div id="msg"></div> 
<form  name='form_sakti' method='POST' id="data_kontak_darurat">
<input type='hidden' name='nomor_pendaftar' value='<?php echo $nomor_pendaftar; ?>'>
<br class='ganjel'/>
	<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Kontak Darurat</strong><br /></td>
		</tr>
	<tr id="NAMA" style="display:none;">
		<td class="reg-label" style='width:250px'>Nama Yang Bisa Dihubungi</td>
		<td class="reg-input">
			<input type='text' value="<?php echo $data_maba->nama_dihubungi; ?>" class="form-control input-sm" maxlength="75" name='NM_KONTAK'/> *)
		</td>
	</tr>
	<tr id="HUBUNGAN" style="display:none;">
		<td class="reg-label">Hubungan Dengan Yang Bersangkutan</td>
		<td class="reg-input">
			<select name='TIPE_HUBUNGAN' onchange='pilih_tipe_hub_kontak_darurat(this.value)' style='width:130px' class="form-control input-sm">
				<option <?php if($data_maba->hubungan=='BP'){echo "selected";} ?> value='BP'>Bapak</option>
				<option <?php if($data_maba->hubungan=='IB'){echo "selected";} ?> value='IB'>Ibu</option>
				<option <?php if($data_maba->hubungan=='W'){echo "selected";} ?> value='W'>Wali</option>
				<option <?php if($data_maba->hubungan=='S'){echo "selected";} ?> value='S'>Suami</option>
				<option <?php if($data_maba->hubungan=='IS'){echo "selected";} ?> value='IS'>Istri</option>
				<option <?php if($data_maba->hubungan=='AK'){echo "selected";} ?> value='AK'>Adik/Kakak</option>
				<option <?php if($data_maba->hubungan=='T'){echo "selected";} ?> value='T'>Teman</option>
				<option <?php if($data_maba->hubungan=='L'){echo "selected";} ?> value='L'>lainnya</option>
				  			</select> *) <span id='label_lain' style='display:none;'>Keterangan<input class="form-control input-sm" value="<?php echo $data_maba->keterangan_hubungan; ?>" type='text' name='KETERANGAN_TIPE_HUBUNGAN' style='width:200px;' maxlength='75'/></span>
		</td>
	</tr>
	<tr id="TELP" style="display:none;">
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px' value="<?php echo $data_maba->telp; ?>" name='TELP' type='text' class="form-control input-sm"/> *)
		</td>
	</tr>
	<tr id="HP" style="display:none;">
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px' value="<?php echo $data_maba->hp; ?>" name='HP' type='text' class="form-control input-sm"/> *)
			<div class='reg-info'>
			Apabila tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		</td>
	</tr>
	<tr id="ALAMAT" style="display:none;">
		<td class="reg-label">Alamat</td>
		<td class="reg-input"><input name='ALAMAT' value="<?php echo $data_maba->alamat; ?>" maxlength="72" type='text' style='width:350px' class="form-control input-sm"/>
		
	</tr>
	<tr id="RT" style="display:none;">
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RT' value="<?php echo $data_maba->rt; ?>" onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="RW" style="display:none;">
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RW' value="<?php echo $data_maba->rw; ?>" onkeypress="return isNumberKey(event)" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="KELURAHAN" style="display:none;">
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA' value="<?php echo $data_maba->kelurahan; ?>" type='text' class="form-control input-sm"/>
		</td>
	</tr>
	<tr id="PROVINSI" style="display:none;">
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<select name='KD_PROP' onchange="OnChangePropdar(this)" class="form-control input-sm">
				<option value="">Pilih Provinsi</option>
					<?php
					if(!is_null($data_provinsi))
					{
						foreach ($data_provinsi as $provinsi) {
							echo "<option "; if($data_maba->kode_provinsi==$provinsi->kode_provinsi){echo "selected";} echo " value='".$provinsi->kode_provinsi."'>".$provinsi->nama_provinsi."</option>";
						}
					}
					?>
								</select>
		</td>
	</tr>
	<tr id="KABUPATEN" style="display:none;">
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
						<select name='KD_KAB' id="kab1" onchange="OnChangeKabdar(this)" class="form-control input-sm">
									<option value='<?php echo $data_maba->kode_kabupaten; ?>'>Pilih Kabupaten</option>
									
							</select>
		</td>
	</tr>
	<tr id="KECAMATAN" style="display:none;">
		<td class="reg-label">Kecamatan Asal</td>
		<td class="reg-input">
						<select name='KD_KEC' id="kec1" class="form-control input-sm">
									<option  value='<?php echo $data_maba->kode_kecamatan; ?>'>Pilih Kecamatan</option>
			</select>
		</td>
	</tr>
	<tr id="NEGARA" style="display:none;">
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select name='KD_NEGARA' class="form-control input-sm">
							<option value="">Pilih Negara</option>
				<?php
					if(!is_null($data_negara))
					{
						foreach ($data_negara as $negara) {
							echo "<option "; if($data_maba->kode_negara==$negara->kode_negara){echo "selected";} echo " value='".$negara->kode_negara."'>".$negara->nama_negara."</option>";
						}
					}
				?>
			</select>
		</td>
	</tr>
	<tr id="KODE_POS" style="display:none;">
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS' value='<?php echo $data_maba->kode_pos; ?>' maxlength='6' style='width:100px' type='text' class="form-control input-sm"/>
		</td>
	</tr>
	</tbody>
</table>
	

	<br/><br/>
<br class='ganjel'/></form>