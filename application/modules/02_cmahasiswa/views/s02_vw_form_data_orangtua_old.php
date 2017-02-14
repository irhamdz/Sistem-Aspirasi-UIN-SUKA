<?php
$crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Orang Tua'=>''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
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
		<td>Nama Ibu</td>
		<td><input type="text" name='pmb2_nm_ibu' class='required' /> *)
		</td>
	</tr>
	<tr>
		<td>Alamat Ibu</td>
		<td><textarea style="width:400px;height:100px" name='pmb2_alamat_ibu' class='required'></textarea> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RT IBU  </td>
		<td class="reg-input"><input style="width:50px" name="RT_IBU" maxlength="5" type="text" class="inputx"> *)</td>
	</tr>
	<tr>
		<td class="reg-label">RW IBU </td>
		<td class="reg-input">
			<input style="width:50px" name="RW_IBU" maxlength="5" type="text" class="inputx">  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan / Desa IBU </td>
		<td class="reg-input">	
			<input name="DESA_IBU" maxlength="25" type="text" class="inputx">  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi IBU </td>
		<td class="reg-input">
			<select name='KD_PROP_IBU' onchange="OnChangeProp2(this)">
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
			</select> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten IBU</td>
		<td class="reg-input">
			
			<select name='KD_KAB_IBU' id="kab2" onchange="OnChangeKab2(this)">
			
			</select>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan IBU  </td>
		<td class="reg-input">
		
			<select name='KD_KEC_IBU' id="kec2">
				

			</select> *)
		</td>
	</tr>
<?php /*
	<tr>
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RT_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RW_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KEC_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KAB_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_PROP_IBU'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<input maxlength="50" name='NM_NEG_IBU'  type='text' class='inputx'/>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_IBU'  maxlength='6' style='width:50px' type='text'/>
		</td>
	</tr>

	<tr>
		<td>Kota</td>
		<td><input type="text" name='pmb2_kota_ibu' class='required' />*)</td>
	</tr>
*/
?>
	<tr>
		<td>No. Telpon Ibu</td>
		<td><input type="text" name='pmb2_telp_ibu' class='required' /> *)</td>
	</tr>
		<tr>
		<td>No. Hp Ibu</td>
		<td><input type="text" name='pmb2_hp_ibu' class='required' /> *)</td>
	</tr>
	<tr>
		<th colspan=2><strong>DATA AYAH</strong><br /><br /></th>
	</tr>
	<tr>
		<td>Nama Ayah</td>
		<td><input type="text" name='pmb2_nm_ayah' class='required' /> *)
		</td>
	</tr>
	<tr>
		<td>Alamat Lengkap</td>
		<td><textarea style="width:400px;height:100px" name='pmb2_alamat_ayah' class='required'></textarea> *)
		<br/>** Format Pengisian : Alamat Rumah, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos
		</td>
	</tr>
<?php /*
	<tr>
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RT_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px' name='RW_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KEC_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KAB_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_PROP_BPK'  type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<input maxlength="50" name='NM_NEG_BPK'  type='text' class='inputx'/>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_BPK'  maxlength='6' style='width:50px' type='text'/>
		</td>
	</tr>

	<tr>
		<td>Kota Ayah</td>
		<td><input type="text" name='pmb2_kota_ayah' class='required' />*)</td>
	</tr>
*/
?>
	<tr>
		<td>No. Telpon Ayah</td>
		<td><input type="text" name='pmb2_telp_ayah' class='required' /> *)</td>
	</tr>
		<tr>
		<td>No. Hp Ayah</td>
		<td><input type="text" name='pmb2_hp_ayah' class='required' /> *)</td>
	</tr>
	<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="22">
			<input type="hidden" name="lisensi" value="1"><hr /></td>
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