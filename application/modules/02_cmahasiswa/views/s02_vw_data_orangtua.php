<?php
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Orang Tua'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<?php
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
#print_r($kecamatan);
echo "<div id='notif-upsbp'></div>";
echo form_open(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?>
<div class="bs-callout bs-callout-info">
<strong>Infomasi : </strong><br />
				Jika Data kedua orang tua ada yang sama -> <font color="red"><strong>Tetap Harus diisi</font></strong></div>
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tr>
		<th colspan=2><strong>DATA IBU</strong><br /><br /></th>
	</tr>
	<tr>
		<td>NAMA IBU</td>
		<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb2_nm_ibu' value="<?php echo  $ortu[0]->PMB_NAMA_LENGKAP_IBU ?>" required /></div> *)
		</td>
	</tr>
	<tr>
		<td>ALAMAT LENGKAP</td>
		<td><div class="col-xs-7"><textarea style="width:400px;height:100px" class="form-control input-sm" name='pmb2_alamat_ibu'class="form-control input-sm"><?php echo $ortu[0]->PMB_ALAMAT_LENGKAP_IBU;?></textarea></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">RT IBU  </td>
		<td class="reg-input"><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" style="width:50px" class="form-control input-sm" name="RT_IBU" maxlength="5" type="text" class="inputx" 
			value="<?php echo  $ortu[0]->RT_IBU ?>" ></div> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RW IBU </td>
		<td class="reg-input"><div class="col-xs-7">
			<input style="width:50px" name="RW_IBU" onkeypress="return isNumberKey(event)" maxlength="5" class="form-control input-sm" type="text" class="inputx"
			value="<?php echo  $ortu[0]->RW_IBU ?>"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KELURAHAN / DESA IBU </td>
		<td class="reg-input"><div class="col-xs-7">	
			<input name="DESA_IBU" maxlength="25" type="text" class="form-control input-sm" class="inputx" value="<?php echo  $ortu[0]->DESA_IBU ?>"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">PROPINSI IBU </td>
		<td class="reg-input"><div class="col-xs-7">
			<select name='KD_PROP_IBU' onchange="OnChangeProp(this)" class="form-control input-sm">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($ortu[0]->KD_PROP_IBU==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KABUPATEN IBU</td>
		<td class="reg-input">
			<div class="col-xs-7">
			<select name='KD_KAB_IBU' id="kab" onchange="OnChangeKab(this)" class="form-control input-sm">
				<?php
				foreach($KAB_LIST_IBU as $k2 => $v2){
					$KD_KABX=$v2['KD_KAB'];
					$NM_KABX=$v2['NM_KAB'];
					// if(ereg("LAINNYA",strtoupper($NM_KABX))){
						// $KD_KABX_LAIN=$KD_KABX;
						// continue;
					// }
					?>
					<option <?php if($ortu[0]->KD_KAB_IBU==$KD_KABX) echo 'selected'; ?> value='<?php echo $KD_KABX ?>'><?php echo $NM_KABX ?></option>
					<?php
				}
				?>
			</select></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KECAMATAN IBU  </td>
		<td class="reg-input">
		<div class="col-xs-7">
			<select name='KD_KEC_IBU' id="kec" class="form-control input-sm"> 
				<?php
				foreach($KEC_LIST_IBU as $k3 => $v3){
					$KD_KECX=$v3['KD_KEC'];
					$NM_KECX=$v3['NM_KEC'];
					?>
					<option <?php if($ortu[0]->KD_KEC_IBU==$KD_KECX) echo 'selected'; ?> value='<?php echo $KD_KECX ?>'><?php echo strtoupper($NM_KECX) ?></option>
					<?php
				}
				if($KD_KEC){
					?>
					<option <?php if($ortu[0]->KD_KEC_IBU=='999999') echo 'selected'; ?> value='999999'>KEC. LAINNYA</option>
					<?php
				}
				?>	

			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KODE POS IBU  </td>
		<td class="reg-input"><div class="col-xs-7">
			<input name="KODE_POS_IBU" maxlength="5" onkeypress="return isNumberKey(event)" type="text"  class="form-control input-sm" value="<?php echo  $ortu[0]->KODE_POS_IBU ?>"></div> *)
		</td>
	</tr>
	<tr>
		<td>NO. TELPON IBU</td>
		<td><div class="col-xs-7"><input type='text' onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_telp_ibu' VALUE='<?php echo $ortu[0]->PMB_TELP_IBU;?>'  /></div> *)</td>
	</tr>
		<tr>
		<td>NO. HP IBU</td>
		<td><div class="col-xs-7"><input type='text' onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_hp_ibu' VALUE='<?php echo $ortu[0]->PMB_NOHP_IBU;?>' /></div> *)</td>
	</tr>
	
	<tr>
		<td>PENGHASILAN IBU</td>
		<td><div class="col-xs-7"><input type='text'  onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_gaji_ibu' VALUE='<?php echo $ortu[0]->GAJI_IBU;?>' /></div> *)</td>
	</tr>
	<tr>
		<th colspan=2><strong>DATA AYAH</strong><br /><br /></th>
	</tr>
	<tr>
		<td>NAMA AYAH</td>
		<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb2_nm_ayah' value="<?php echo $ortu[0]->PMB_NAMA_LENGKAP_AYAH;?>"  /></div> *)
		</td>
	</tr>
	<tr>
		<td>ALAMAT LENGKAP</td>
		<td><div class="col-xs-7"><textarea style="width:400px;height:100px" name='pmb2_alamat_ayah' class="form-control input-sm"><?php echo $ortu[0]->PMB_ALAMAT_LENGKAP_AYAH;?></textarea></div> *)
		</td>
	</tr>
	
	
	<tr>
		<td class="reg-label">RT AYAH  </td>
		<td class="reg-input"><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" style="width:50px" class="form-control input-sm" name="RT_AYAH" maxlength="5" type="text" class="inputx"
		value="<?php echo  $ortu[0]->RT_AYAH ?>"></div> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RW AYAH </td>
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px"  onkeypress="return isNumberKey(event)" class="form-control input-sm" name="RW_AYAH" maxlength="5" type="text" class="inputx"
			value="<?php echo  $ortu[0]->RW_AYAH ?>"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KELURAHAN / DESA AYAH</td>
		<td class="reg-input">	
			<div class="col-xs-7"><input name="DESA_AYAH" class="form-control input-sm" maxlength="25" type="text" class="inputx"
			value="<?php echo  $ortu[0]->DESA_AYAH ?>"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">PROPINSI AYAH</td>
		<td class="reg-input">
			<div class="col-xs-7"><select name='KD_PROP_AYAH' class="form-control input-sm" onchange="OnChangeProp2(this)">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($ortu[0]->KD_PROP_AYAH==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KABUPATEN AYAH</td>
		<td class="reg-input">
			
			<div class="col-xs-7"><select name='KD_KAB_AYAH' class="form-control input-sm" id="kab2" onchange="OnChangeKab2(this)">
				<?php
				foreach($KAB_LIST_AYAH as $k2 => $v2){
					$KD_KABX=$v2['KD_KAB'];
					$NM_KABX=$v2['NM_KAB'];
					// if(ereg("LAINNYA",strtoupper($NM_KABX))){
						// $KD_KABX_LAIN=$KD_KABX;
						// continue;
					// }
					?>
					<option <?php if($ortu[0]->KD_KAB_AYAH==$KD_KABX) echo 'selected'; ?> value='<?php echo $KD_KABX ?>'><?php echo $NM_KABX ?></option>
					<?php
				}
				?>
			</select></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KECAMATAN AYAH  </td>
		<td class="reg-input">
		
			<div class="col-xs-7"><select name='KD_KEC_AYAH' class="form-control input-sm" id="kec2">
				<?php
				foreach($KEC_LIST_AYAH as $k3 => $v3){
					$KD_KECX=$v3['KD_KEC'];
					$NM_KECX=$v3['NM_KEC'];
					?>
					<option <?php if($ortu[0]->KD_KEC_AYAH==$KD_KECX) echo 'selected'; ?> value='<?php echo $KD_KECX ?>'><?php echo strtoupper($NM_KECX) ?></option>
					<?php
				}
				if($KD_KEC){
					?>
					<option <?php if($ortu[0]->KD_KEC_AYAH=='999999') echo 'selected'; ?> value='999999'>KEC. LAINNYA</option>
					<?php
				}
				?>	


			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KODE POS AYAH  </td>
		<td class="reg-input">
			<div class="col-xs-7"><input name="KODE_POS_AYAH" onkeypress="return isNumberKey(event)" class="form-control input-sm" maxlength="5" type="text" class="inputx"
			value="<?php echo  $ortu[0]->KODE_POS_AYAH ?>"></div> *)
		</td>
	</tr>
	<tr>
		<td>NO. TELPON AYAH</td>
		<td><div class="col-xs-7"><input type='text' onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_telp_ayah' VALUE='<?php echo $ortu[0]->PMB_TELP_AYAH;?>' class='required' /></div> *)</td>
	</tr>
		<tr>
		<td>NO. HP AYAH</td>
		<td><div class="col-xs-7"><input type='text' onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_hp_ayah' class='required' VALUE='<?php echo $ortu[0]->PMB_NOHP_AYAH;?>' /></div> *)</td>
	</tr>
	<tr>
		<td>PENGHASILAN AYAH</td>
		<td><div class="col-xs-7"><input type='text' onkeypress="return isNumberKey(event)" class="form-control input-sm" name='pmb2_gaji_ayah' VALUE='<?php echo $ortu[0]->GAJI_AYAH;?>' /></div> *)</td>
	</tr>
	<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="23">
			<input type="hidden" name="lisensi" value="1"></td>
		</tr>
	<tr>
			<td align='left' width='150'><a href='data-pendidikan_sebelumnya' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><?php echo form_submit('pmb2_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
	</tr>
</table>
</form>
</div>
<?php
$url_base=base_url().$this->session->userdata('status'); 	?>
<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(x) {
        var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(data['pesan']);
		$('html, body').animate({ scrollTop: 0 }, 200);
		if(data['hasil'] == 'sukses'){
			window.setTimeout( function(){
				window.location = '<?php echo "$url_base/data-prestasi"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>

<script>
function OnChangeProp(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=prop&kd_prop="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kab").innerHTML = obk['kab'];
			document.getElementById("kec").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
	});
}

function OnChangeKab(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kec").innerHTML = obk['kec'];
		}
	});
}


function OnChangeProp2(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=prop&kd_prop="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
	});
}

function OnChangeKab2(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
	});
}



</script>