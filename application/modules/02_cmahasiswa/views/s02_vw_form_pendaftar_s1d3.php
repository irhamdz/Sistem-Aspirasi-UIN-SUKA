<?php
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pribadi'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?><div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 MB</br /></font> </div>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
				<div class="bs-callout bs-callout-warning"><font color="red"><strong>Isian untuk NISN, harus berupa angka yang terdiri dari 10 digit angka,</strong></font><br /><br />Tanyakan Ke Sekolah Anda, jika tidak memiliki NISN, karena Nomor NISN Anda nantinya akan digunakan untuk Pra Registrasi. Atau Anda juga bisa mencari NISN melalui laman <strong><a href='http://nisn.data.kemdiknas.go.id/' target="_blank">http://nisn.data.kemdiknas.go.id/</a></strong></div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Biodata Pribadi</strong><br /></td>
		</tr>
		<tr>
			<td  width='200'>NISN </td>
			
			<td><div class="col-xs-7">
				<input type='text' class="form-control input-sm" name='pmb1_nisn'  maxlength="10" class="form-control input-sm"  /></div> *)</td>
		</tr>
		<tr>
		<td class="reg-label">Gelar Depan Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7">
		<input maxlength="25" class="form-control input-sm" style="width:100px" type="text" name="GELAR_DEPAN_NA" value="" class="inputx"></div>
		<div class="col-xs-12"><div class="reg-info">contoh: Raden, R.A., H., Hj., Kyai, dll. Jika tidak ada mohon dikosongkan.</div></div></td>
	</tr>
	<tr>
		<td class="reg-label">Gelar Depan Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" class="form-control input-sm" style="width:100px" type="text" name="GELAR_DEPAN" value="" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: Drs., Ir., DR., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr>
		<td>Nama Peserta </td>
		
		<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_nama_lengkap' class="form-control input-sm" /></div>  *)
			<div class="col-xs-12"><div class="reg-info">Nama Sesuai Ijazah Terakhir.</div></div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gelar Belakang Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" class="form-control input-sm" style="width:100px" type="text" name="GELAR_BELAKANG" value="" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: S.Ag., S.H., S.E., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gelar Belakang Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25" class="form-control input-sm" style="width:100px" type="text" name="GELAR_BELAKANG_NA" value="" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: CCNA, CPA, CPM, dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tempat Lahir </td>
		
		<td class="reg-input"><div class="col-xs-7"><input id="dd_tempatlahir" class="form-control input-sm" name="TMP_LAHIR" maxlength="72" style="width:350px" type="text" class="inputx"></div>  *)
		<div class="col-xs-12"><div class="reg-info">
		Diisi sesuai nama tempat lahir yang tertera pada Akta Kelahiran / Kartu Keluarga / Ijazah Terakhir.<br>Maksimum 72 karakter.
		</div></div>
		</td>
	</tr>
	<?php /*
	<tr>
			<td >Tempat Lahir</td>
			
			<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_tempat_lahir' class="form-control input-sm" /> )</td>
		</tr>
		*/
	?>
	<tr>
		<td class="reg-label">Nama Kabupaten Lahir *)</td>
		
		<td class="reg-input">
			<input type="hidden" name="KD_KAB_LAHIR" id="KD_KAB_LAHIR" value="32091">
			<div class="col-xs-7"><input type="text" autocomplete="off" class="form-control input-sm" class="inputx" id="nama_kabupaten_lahir" style="width:200px" onkeyup="kabupaten_cari(this.value,'suggestions','KD_KAB_LAHIR','nama_kabupaten_lahir');return false;" onblur="hilangkan_ajax('suggestions')"></div>  *)
			<span id="suggestionsLoading"></span>
			<div class="suggestionsBox" id="suggestions" style="display: none"> 
				<div class="ac_results" id="suggestionsList"> &nbsp; </div>
			</div>
			<div class="col-xs-12"><div class="reg-info">Bagi yang tidak menemukan Nama Kabupaten, silakan diketik lainnya dan pilih sesuai Kabupaten Lahir. Bagi yang lahir di Luar Negeri, silakan diketik Luar Negeri.</div></div>
		</td>
	</tr>
	<tr>
		<td >Tgl. Lahir </td>
		
		<td>
					<div class="col-xs-7">
					<div class='input-group date' id='datetimepicker1'><div id="tgl" class="input-append">
					<input type="text" class="form-control input-sm" style="width:200px" name="pmb1_tgl_lahir" >
					<span class="add-on"><i data-time-icon="icon-timeq" data-date-icon="icon-calendar"></i></span> 
					</div></div></div> *)</td>
	</tr>
		<tr>
			<td >Jenis Kelamin  </td>
			
			<td>
					<div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='0' checked />Laki - Laki</label></div>
					<div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='1'/>Perempuan  *)</label></div>
			</td>
		</tr>
		<tr>
			<td >Golongan Darah </td>
			
			<td>
					<div class='radio'><label><input type='radio' name='GOL_DARAH' value='-' checked />BELUM CEK &nbsp;</label></div>
					<div class='radio'><label><input type='radio' name='GOL_DARAH' value='A' />A &nbsp;</label></div>
					<div class='radio'><label><input type='radio' name='GOL_DARAH' value='B'/>B  &nbsp;</label></div>
					<div class='radio'><label><input type='radio' name='GOL_DARAH' value='AB'/>AB  &nbsp;</label></div>
					<div class='radio'><label><input type='radio' name='GOL_DARAH' value='O'/>O  </label></div>
			</td>
		</tr>
		<tr>
			<td >Warga Negara </td>
			
			<td><div class="col-xs-7"><select name='pmb1_warga_negara' class="form-control input-sm">
					<option value='0'>Warga Negara Indonesia</option>
					<option value='1'>Warga Negara Asing</option>
				</select></div>  *) </td>
		</tr>
		<tr>
			<td >Alamat Asal  </td>
			
			<td><div class="col-xs-7"><textarea name='pmb1_alamat' style="width:400px;height:100px" class="form-control input-sm"></textarea></div> *)</td>
		</tr>
		<tr>
		<td class="reg-label">RT Asal  </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" name="RT_ASAL" maxlength="5" type="text" class="form-control input-sm" class="inputx"></div> *)
			
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" name="RW_ASAL" maxlength="5" type="text" class="form-control input-sm" class="inputx"></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan / Desa Asal </td>
		
		<td class="reg-input">	
			<div class="col-xs-7"><input name="DESA" maxlength="25" class="form-control input-sm" type="text" class="inputx"></div></div>  *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><select name='KD_PROP' class="form-control input-sm" onchange="OnChangeProp2(this)">
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
		<td class="reg-label">Kabupaten Asal</td>
		
		<td class="reg-input">
			
			<div class="col-xs-7"><select name='KD_KAB' class="form-control input-sm" id="kab2" onchange="OnChangeKab2(this)">
			
			</select></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan Asal  </td>
		
		<td class="reg-input">
		
			<div class="col-xs-7"><select name='KD_KEC' class="form-control input-sm" id="kec2">
				

			</select></div> *)
		</td>
	</tr>
	
	<tr>
		<td class="reg-label">Negara Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><select name="NEGARA_ASAL" class="form-control input-sm">
				<?php 
					foreach($negara as $value){
						if($value->NM_NEGARA=='INDONESIA'){
							echo "<option selected value='".$value->KD_NEGARA."'>".$value->NM_NEGARA."</option>";
						}else{
							echo "<option value='".$value->KD_NEGARA."'>".$value->NM_NEGARA."</option>";
						}
					}		
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kode Pos Asal  </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input name="KODE_POS" class="form-control input-sm" maxlength="5" type="text" class="inputx"></div> *)
		</td>
	</tr>
		<tr>
			<td >No. Telp / HP  </td>
			
			<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_nohp' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr>
			<td>Email  </td>
			
			<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_email' /></div> *)
			<div class="col-xs-12"><div class="reg-info">Apabila tidak punya ditulis <STRONG>TIDAK ADA</STRONG>.</div></div></td>
		</tr>
		<tr>
			<td >Agama </td>
			
			<td><div class="col-xs-7"><select name='pmb1_agama' id='agama' class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php foreach($master_agama as $value){ 	
							echo "<option value=".$value->PMB_ID_AGAMA.">".$value->PMB_NAMA_AGAMA."</option>";
						}
					?>
					<option value='agama_lain'>Lainnya</option>
				</select></div>  *)<br />
				<div class="col-xs-7"><input type="text" class="form-control input-sm" id="pmb1_agama" name="agama_lain" style="display: none;"></div> 
			</td>
		</tr>
		<?php /*
		<tr>
			<td >Kesehatan</td>
			
			<td>
				<?php foreach($jenis_kesehatan as $value){ ?>
				<input type="checkbox" name="pmb1_kesehatan[]" value="<?php echo $value->PMB_ID_JENIS_KESEHATAN; ?>" class="form-control input-sm"><?php echo $value->PMB_NAMA_JENIS_KESEHATAN; ?><br />
				
				<?php } ?>
			</td> 
		</tr>
		
		<tr>
			<td >Warga Negara</td>
			
			<td><select name='pmb1_warga_negara' class="form-control input-sm">
					<option value='0' selected>Pilih</option>
					<option value='0'>Warga Negara Indonesia</option>
					<option value='1'>Warga Negara Asing</option>
				</select> *)</td>
		</tr>
		*/ ?>
		<tr>
			<td >Foto </td>
			
			<td><div class="col-xs-7"><input type='file' name='userfile'  /></div>  *)</td>
		</tr>
		<?php /*
		<tr>
			<td colspan='3'>
			<div class="bs-callout bs-callout-warning">
			<input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="1"><strong> <font color="#4A991D">Yakinkan kami bahwa <font color="#FF0000">Data</font> yang Anda inputkan adalah benar adanya.</font>
			<br />
			<input type="checkbox" name="lisensi"> Ya, Saya Yakin *) </div><hr /></td>
		</tr>
		*/ ?>
		<tr>
			<td><input type="hidden" name="step" value="1"></td>
			<td align='right'><?php echo form_submit('pmb1_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); ?>
</div>
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
				window.location = '<?php echo "$url_base/data-pendidikan_sebelumnya"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
<script type="text/javascript">
	$(function() {
        
		$('#tgl').datetimepicker({
			language: 'en',
			format: 'dd-MM-yyyy',
			pick12HourFormat: false
		});
	$('#agama').on('change',function(){
			var agama=$('#agama option:selected').val();
			if(agama=="agama_lain"){
				$('#pmb1_agama').show();
				$('#pmb1_agama').focus();
			}else {
				$('#pmb1_agama').hide();
			}
	});
	
	});
</script>

<script>

function kabupaten_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "data-kabupaten_cari",
		data: {katakunci: ""+inputString+"",lokasi_balik:""+param_lokasi_balik+"",lokasi:""+param_lokasi+"",lokasi_tampil:""+param_lokasi_tampil+""}
		}).done(function( data ) {
			if(data.length >0) {
				$('#'+param_lokasi).fadeIn();
				$('#'+param_lokasi+"List").html(data);
				$('#'+param_lokasi+"Loading").html(' ');
				//$('#nama_kabupaten').removeClass('load');
			}
		});
	}
}

function kabupaten_isi(lokasi,isi){
	//LOKASI 
	var explode=lokasi.split('#');
	var x=explode[0];
	var y=explode[1];
	var lokasi_tampil=explode[2];
	//ISI
	var isinya=isi.split("#");
	var kd=isinya[0];
	var nm=isinya[1];
	/////
	document.getElementById(lokasi_tampil).value=nm;
	document.getElementById(y).value=kd;	
	setTimeout("$('#"+x+"').fadeOut();", 600);
}

function hilangkan_ajax(param){
	setTimeout("$('#"+param+"').fadeOut();", 600);
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