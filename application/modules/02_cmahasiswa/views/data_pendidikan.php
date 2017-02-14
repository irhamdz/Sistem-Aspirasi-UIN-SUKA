<script>
function pendidikan_cari(param_kd_pend){
	var param_kd_pend;
	$.ajax({
		type: "POST",
		cache:false,
		url: "http://admisi.uin-suka.ac.id/pmb/data-ajax_data_sekolah",
		data: {KD_PEND: ""+param_kd_pend+""}
		}).done(function(data) {	
			$('#jenjang_detail').html("<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
			if(data.length >0) {				
				$('#jenjang_detail').html(data);
			}else{
				$('#jenjang_detail').html('');
			}
		});
}



function npsn_cari2(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
    id_pend=document.getElementById('id_kd_pend').value;
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "http://admisi.uin-suka.ac.id/pmb/data-ajax_data_npsn2",
		data: {katakunci: ""+inputString+"",kd_pend:""+id_pend+"",lokasi_balik:""+param_lokasi_balik+"",lokasi:""+param_lokasi+"",lokasi_tampil:""+param_lokasi_tampil+""}
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



function npsn_isi(lokasi,isi){
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
$(function() {
	$('#jurusan_sekolah').on('change',function(){
			var jurusan_sekolah=$('#jurusan_sekolah option:selected').val();
			if( jurusan_sekolah=="jurusan_lain"){
				$('#pmb1_jurusan_sekolah').show();
				$('#pmb1_jurusan_sekolah').focus();
			}else {
				$('#pmb1_jurusan_sekolah').hide();
			}
	});
});
</script>
<?php 
// print_r($KD_PEND); 
if(!empty($KD_PEND)){
	$step="update_pendidikan";
	
}else{
	$step="insert_pendidikan";
}
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_pendidikan" id="frm-input'); 
			
?>
<input class="form-control input-sm" type='hidden' name='JENJANG_LAMA' value='<?php echo $JENJANG; ?>'/> 
<input class="form-control input-sm" type='hidden' name='NM_SEKOLAH_LAMA' value='<?php echo $NM_SEKOLAH; ?>'/> 
<input class="form-control input-sm" type='hidden' name='KD_PEND_LAMA' value='<?php echo $KD_PEND; ?>'/> 
<input class="form-control input-sm" type='hidden' name='NPSN_LAMA'  value='<?php echo $NPSN; ?>'/> 
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
	<tr>
			<td colspan='2'><strong>Pendidikan Sebelumnya</strong><br /></td>
		</tr>
	<tr>
		<td width='200' class="reg-label">Jenjang Pendidikan</td>
		<td class="reg-input">
		<div class="col-xs-7">
		<select required class="form-control input-sm" name='JENJANG' id='id_kd_pend' onchange="pendidikan_cari(this.value)">
			<option value='0'>-Pilih Jenjang-</option>
		<?php
		foreach($MASTER_DATA_PENDIDIKAN as $key => $val){
			?>
			<option <?php if($JENJANG==$val['KD_PEND']) echo "selected";?> value="<?php echo $val['KD_PEND']?>"><?php echo $val['NM_PEND']?></option>
			<?php
		}
		?>
		</select> 
		&nbsp;
		<span id='jenjang_detail'>
			<?php
			if($JENJANG){
				$hasilx=$this->lib_reg_fungsi->data_sekolah2($JENJANG);
				$data['hasil']=$hasilx;
				$data['KD_PEND']=$KD_PEND;
				$this->load->view("02_cmahasiswa/v_ajax_pendidikan",$data);
			}
			?>
		</span>
		</div> *) 
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nama Sekolah/PT</td>
		<td class="reg-input">
			<div class="col-xs-7">
				<input type='text' required class="form-control input-sm" name='NM_SEKOLAH' autocomplete="off" class='inputx' id="nm_sekolah" value='<?php echo $NM_SEKOLAH; ?>' onkeyup="npsn_cari2(this.value,'suggestions2','NPSN','nm_sekolah');return false;" onblur="hilangkan_ajax('suggestions2')"/> 
				<span id='suggestions2Loading'></span> 
			</div> *)
			<br />
			<div class="col-xs-7">
				<div class="suggestionsBox" id="suggestions2" style="display: none"> 
					<div class="ac_results" id="suggestions2List"> &nbsp; </div>
				</div>
			</div>
			<div class="col-xs-12">
            <div class='reg-info'>Silakan ketik Nama Sekolah/PT asal lalu pilih/klik Nama Sekolah/PT yang sesuai dengan Nama Sekolah/PT asal anda (dari daftar yang muncul). Bagi yang tidak menemukan Nama Sekolah/PT asal, silakan ketik lain lain lalu pilih/klik LAIN LAIN yang muncul di bawah kolom isian Nama Sekolah/PT. </div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">NPSN/KODE PT</td>
		<td class="reg-input">
		<div class="col-xs-7">
			<input required class="form-control input-sm" type='text' maxlength='12'  onkeypress="return isNumberKey(event)" name='NPSN' id='NPSN' value='<?php echo $NPSN ?>'/> 
			
			
			
		</div> *)
		</td>
	</tr>
	<?php /*
	<tr>
		<td class="reg-label">NISN/NIM</td>
		<td class="reg-input">
		<div class="col-xs-7">
			<input class="form-control input-sm" type='text' maxlength='12' name='NISN' id='NISN' value='<?php echo $NISN ?>'/>	
		</div>			*)
		<div class="col-xs-7">
             <div class='reg-info'>Bagi yang tidak memiliki/mengetahui NISN/NIM, silakan diketik 9876543210.</div>
		</div>
		</td>
	</tr> */ ?>
	<tr>
			<td >Jurusan Sekolah/PT</td>
			
			<td><div class="col-xs-7"><select required name='PMB1_JURUSAN_SEKOLAH' class="form-control input-sm" id='jurusan_sekolah' class="required">
					<option value=''>Pilih</option>
				<?php
				$jus=$pendidikan_s1d3[0]->PMB_JURUSAN_SEKOLAH;
				switch($jus){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					foreach($jurusan_sekolah as $value){ 
								if($value->PMB_ID_JURUSAN_SEKOLAH==$pendidikan_s1d3[0]->PMB_JURUSAN_SEKOLAH){
									echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH." selected>".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH.">".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
								}
						}
					break;
					default : foreach($jurusan_sekolah as $value){ 
						echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH.">".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
					}
					echo "<option value='$jus' selected>$jus</option>";
					break;
					}
				?>
					<option value='jurusan_lain'>LAINNYA</option>
				</select></div>	*)
				<br /><br />
				<div class="col-xs-7"><input type="text" class="form-control input-sm" id="pmb1_jurusan_sekolah" name="jurusan_lain" style="display: none;"></div></td>
		</tr>	
		<tr>
			<td >Alamat Sekolah/PT</td>
			
			<td><div class="col-xs-7"><textarea class="form-control input-sm" name='PMB1_ALAMAT_SEKOLAH' class="required" required><?php echo $pendidikan_s1d3[0]->PMB_ALAMAT_SEKOLAH; ?></textarea></div>	*)</td>
		</tr>
		<tr>
			<td >Tahun Lulus</td>
			
			<td><div class="col-xs-7"><input class="form-control input-sm" type='text' name='PMB1_TAHUN_LULUS' class="required" value='<?php echo $pendidikan_s1d3[0]->PMB_TAHUN_LULUS; ?>' required /></div>	*)</td>
		</tr>
		<tr>
			<td><a href='data-kesehatan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type="hidden" name="step" value="<?php echo $step; ?>"><?php echo form_submit('pmb1_update_pendidikans1d3', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); ?>
<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform_pendidikan',
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
				window.location = '<?php echo "$url_base/data-orangtua"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>