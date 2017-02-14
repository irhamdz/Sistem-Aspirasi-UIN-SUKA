<?php
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pendidikan Sebelumnya'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_pendidikan" id="frm-input'); 
?>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><br /><strong>Pendidikan Sebelumnya</strong><br /></td>
		</tr>
		<tr>
			<td >Jenis Sekolah</td>
			
			<td><div class="col-xs-7"><select  class="form-control input-sm" name='pmb1_jenis_sekolah' id='jenis_sekolah' class="required">
					<option value=''>Pilih</option>
					<?php 
				$js=$pendidikan_s1d3[0]->PMB_JENIS_SEKOLAH;
				switch($js){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
						foreach($jenis_sekolah as $value){ 
								if($value->PMB_ID_JENIS_SEKOLAH==$pendidikan_s1d3[0]->PMB_JENIS_SEKOLAH){
									echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH." selected>".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH.">".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
								}
						}
					break;
					default : foreach($jenis_sekolah as $value){ 
						echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH.">".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
					}
					echo "<option value='$js' selected>$js</option>";
					break;
					}
					?>
					<option value='jenis_sekolah_lain'>LAINNYA</option>
				
				</select></div>	*)<br /><br />
				<div class="col-xs-7"><input type="text" class="form-control input-sm" id="pmb1_jenis_sekolah" name="jenis_sekolah_lain" style="display: none;"></div>
			</td>
		</tr>
		<tr>
			<td >Jurusan Sekolah</td>
			
			<td><div class="col-xs-7"><select name='pmb1_jurusan_sekolah' class="form-control input-sm" id='jurusan_sekolah' class="required">
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
		</tr>	<tr>
			<td >Nama Sekolah</td>
			
			<td><?php 
				$kode_sekolah=$pendidikan_s1d3[0]->PMB_KODE_SEKOLAH;
				$kd_s=substr($kode_sekolah,4,4);
				if($kd_s==9999){
					$nama_sekolah = $pendidikan_s1d3[0]->PMB_SEKOLAH_LAIN;
					echo "<input type='hidden'  name='nama_sekolah' value='$nama_sekolah'>";
				}else{
					$nama_sekolah = $nama_sekolah_peserta[0]->NAMA_SEKOLAH;
					echo "<input type='hidden'  name='nama_sekolah' value='$nama_sekolah'>";
				}
				
				$nama_sekolah=str_replace("#39;", "'", $nama_sekolah);
			?>
			<input type="hidden"  name="sekolah_lama" value="<?php echo $nama_sekolah; ?>">
			<input type="hidden"  name="kode_sekolah_lama" value='<?php echo $kode_sekolah; ?>'>
			<div class="col-xs-7">
			<select id="ubah_sekolah" class="form-control input-sm" name="u_s">
				<option value='<?php echo $kode_sekolah ?>'><?php echo $nama_sekolah; ?></option>
				<option value='ubah_s'>Ubah Nama Sekolah</option>
			</select>
			</div> *)<br />			<br />
			<div class="col-xs-7">
					<select  class="wil form-control input-sm" id="prop" name='propinsi' style="display: none;">
					<option value=''>-Pilih Propinsi-</option>
					<?php 
						foreach($propinsi as $value){ 
								echo "<option value=".$value->KODE_PROPINSI.">".$value->NAMA_PROPINSI."</option>";
						}?>
			</select>
			</div>
						<br />			<br />
			<div class="col-xs-7">
						<select class="wil form-control input-sm"  id="kab" name='kabupaten' style="display: none;">
							<option value="">-Pilih Kabupaten-</option>
						</select>
			</div>
						<br />			<br />
			<div class="col-xs-7">
						<select class="wil form-control input-sm"  id="sek" name='sekolah' style="display: none;">
							<option value="">-Pilih Sekolah-</option>
							</select>
			</div><br /><br />
			<div class="col-xs-7">	<input type="text" class="form-control input-sm" id="sekolah" name="sekolah_lain" class='required' style="display: none;">	</div>
			</td>
		</tr>
		<tr>
			<td >Alamat Sekolah</td>
			
			<td><div class="col-xs-7"><textarea class="form-control input-sm" name='pmb1_alamat_sekolah' class="required"><?php echo $pendidikan_s1d3[0]->PMB_ALAMAT_SEKOLAH; ?></textarea></div>	*)</td>
		</tr>
		<tr>
			<td >Tahun Lulus</td>
			
			<td><div class="col-xs-7"><input class="form-control input-sm" type='text' name='pmb1_tahun_lulus' class="required" value='<?php echo $pendidikan_s1d3[0]->PMB_TAHUN_LULUS; ?>' /></div>	*)</td>
		</tr>
		<tr>
			<td><a href='data-kesehatan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type="hidden" name="step" value="update_pendidikan"><?php echo form_submit('pmb1_update_pendidikans1d3', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
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


<script type="text/javascript">
$(function () {
        $(".wil").change(function() {
         id = $(this).attr('id');
                val = $(this).val();
                if(id == 'kab'){
                        propinsi = $("#prop").val();
                        $.ajax({
						url:'data-dropdown_nama_sekolah',
                        type: 'post',
                        dataType: 'html',
                        data: {op: id, prop: propinsi, kab: val},
                        })
						.done(function(x) {
                                $("#sek").html(x);
                        });
								
				}else{	
                        $.ajax({
						url:'data-dropdown_nama_sekolah',
                        type: 'post',
                        dataType: 'html',
                        data: {op: id, val: val},
                        })
                        .done(function(x) {
                                $("#kab").html(x);	
								
                        });
                }              
        });
		
		$('#prop').on('change',function(){
			var prop=$('#prop option:selected').val();
			if(prop){
				$('#kab').show();
				$('#kab').focus();
				
			}else {
				$('#kab').hide();

			}
			$('#sek').hide();
			$('#sekolah').hide();
		});
		
		$('#kab').on('change',function(){
			var prop=$('#prop option:selected').val();
			var kab=$('#kab option:selected').val();
			if(kab){
				$('#sek').show();
				$('#sek').focus();
			}else{
				$('#sek').hide();
			}
		});
		
		$('#sek').on('change',function(){
			var sek=$('#sek option:selected').val();
			var skl = sek.substr(4, 4);
			if(skl == 9999){
				$('#sekolah').show();
				$('#sekolah').focus();
				$('#kab').hide();
			}else{
				$('#sekolah').hide();
				$('#kab').hide();
			}
		});
});
</script>
<script type="text/javascript">
	$(function() {
	$('#jenis_sekolah').on('change',function(){
			var jenis_sekolah=$('#jenis_sekolah option:selected').val();
			if(jenis_sekolah=="jenis_sekolah_lain"){
				$('#pmb1_jenis_sekolah').show();
				$('#pmb1_jenis_sekolah').focus();
			}else {
				$('#pmb1_jenis_sekolah').hide();
			}
	});
	
	$('#jurusan_sekolah').on('change',function(){
			var jurusan_sekolah=$('#jurusan_sekolah option:selected').val();
			if( jurusan_sekolah=="jurusan_lain"){
				$('#pmb1_jurusan_sekolah').show();
				$('#pmb1_jurusan_sekolah').focus();
			}else {
				$('#pmb1_jurusan_sekolah').hide();
			}
	});
	
	$('#ubah_sekolah').on('change',function(){
			var ubah_sekolah=$('#ubah_sekolah option:selected').val();
			if( ubah_sekolah=="ubah_s"){
				$('#prop').show();
				$('#prop').focus();
			}else {
				$('#prop').hide();
				$('#sek').hide();
				$('#sekolah').hide();
				$('#kab').hide();
			}
	});
	
	});
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#frm-input').validate({
				
				messages: {
				   	sekolah_lain: {
						required: "Sekolah Tidak Boleh Kosong",
					}
					
					
				}
			});
		});
		</script>
		</script>