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
		<td><div class="col-xs-7"><input type="text" name='pmb2_nm_ibu' class="form-control input-sm" /></div> *)
		</td>
	</tr>
	<tr>
		<td>ALAMAT IBU</td>
		<td><div class="col-xs-7"><textarea style="width:400px;height:100px" name='pmb2_alamat_ibu' class="form-control input-sm"></textarea></div> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RT IBU  </td>
		<td class="reg-input"><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" style="width:50px" name="RT_IBU" maxlength="5" type="text" class="form-control input-sm inputx"></div> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RW IBU </td>
		<td class="reg-input">
			<div class="col-xs-7"><input onkeypress="return isNumberKey(event)" style="width:50px" name="RW_IBU" maxlength="5" type="text" class="form-control input-sm inputx"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KELURAHAN / DESA IBU </td>
		<td class="reg-input">	
			<div class="col-xs-7"><input name="DESA_IBU" maxlength="25" type="text" class="form-control input-sm inputx"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">PROPINSI IBU </td>
		<td class="reg-input">
			<div class="col-xs-7"><select name='KD_PROP_IBU' onchange="OnChangeProp(this)" class="form-control input-sm">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($KD_PROP==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KABUPATEN IBU</td>
		<td class="reg-input">
			
			<div class="col-xs-7"><select name='KD_KAB_IBU' id="kab" onchange="OnChangeKab(this)" class="form-control input-sm">
			
			</select></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KECAMATAN IBU  </td>
		<td class="reg-input">
		
			<div class="col-xs-7"><select name='KD_KEC_IBU' id="kec" class="form-control input-sm"></div>
				

			</select> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KODE POS IBU  </td>
		<td class="reg-input">
			<div class="col-xs-7"><input onkeypress="return isNumberKey(event)" name="KODE_POS_IBU" maxlength="5" type="text" class="form-control input-sm inputx"></div> *)
		</td>
	</tr>
	<tr>
		<td>NO. TELPON IBU</td>
		<td><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" type="text" name='pmb2_telp_ibu' class="form-control input-sm" /></div> *)</td>
	</tr>
		<tr>
		<td>NO. HP IBU</td>
		<td><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" type="text" name='pmb2_hp_ibu' class="form-control input-sm" /></div> *)</td>
	</tr>
	<tr>
		<td>PENGHASILAN IBU</td>
		<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb2_gaji_ibu' /></div> *)</td>
	</tr>
	<tr>
		<th colspan=2><strong>DATA AYAH</strong><br /><br /></th>
	</tr>
	<tr>
		<td>NAMA AYAH</td>
		<td><div class="col-xs-7"><input type="text" name='pmb2_nm_ayah' class="form-control input-sm" /></div> *)
		</td>
	</tr>
	<tr>
		<td>ALAMAT AYAH</td>
		<td><div class="col-xs-7"><textarea style="width:400px;height:100px" name='pmb2_alamat_ayah' class="form-control input-sm"></textarea></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">RT AYAH  </td>
		<td class="reg-input"><div class="col-xs-7"><input  onkeypress="return isNumberKey(event)" style="width:50px" name="RT_AYAH" maxlength="5" type="text" class="form-control input-sm inputx"></div> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RW AYAH </td>
		<td class="reg-input">
			<div class="col-xs-7"><input onkeypress="return isNumberKey(event)" style="width:50px" name="RW_AYAH" maxlength="5" type="text" class="form-control input-sm inputx"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KELURAHAN / DESA AYAH</td>
		<td class="reg-input">	
			<div class="col-xs-7"><input name="DESA_AYAH" maxlength="25" type="text" class="form-control input-sm inputx"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">PROPINSI AYAH</td>
		<td class="reg-input">
			<div class="col-xs-7"><select name='KD_PROP_AYAH' onchange="OnChangeProp2(this)" class="form-control input-sm">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($KD_PROP==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KABUPATEN AYAH</td>
		<td class="reg-input">
			
			<div class="col-xs-7"><select name='KD_KAB_AYAH' id="kab2" onchange="OnChangeKab2(this)" class="form-control input-sm">
			
			</select></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KECAMATAN AYAH  </td>
		<td class="reg-input">
		
			<div class="col-xs-7"><select name='KD_KEC_AYAH' id="kec2" class="form-control input-sm">
				

			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">KODE POS AYAH  </td>
		<td class="reg-input">
			<div class="col-xs-7"><input onkeypress="return isNumberKey(event)" name="KODE_POS_AYAH" maxlength="5" type="text" class="form-control input-sm inputx"></div> *)
		</td>
	</tr>
	<tr>
		<td>NO. TELPON AYAH</td>
		<td><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" type="text" name='pmb2_telp_ayah' class="form-control input-sm" /></div> *)</td>
	</tr>
		<tr>
		<td>NO. HP AYAH</td>
		<td><div class="col-xs-7"><input onkeypress="return isNumberKey(event)" type="text" name='pmb2_hp_ayah' class="form-control input-sm" /></div> *)</td>
	</tr>
	<tr>
		<td>PENGHASILAN AYAH</td>
		<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb2_gaji_ayah' /></div> *)</td>
	</tr>
	<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="22">
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