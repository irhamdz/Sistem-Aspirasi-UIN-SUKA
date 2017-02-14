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
			<td><div class="col-xs-7"><select class="form-control input-sm"  name='pmb1_jenis_sekolah' id='jenis_sekolah' class="required">
					<option value=''>Pilih</option>
					<option value='1'>SMA NEGERI</option>
					<option value='2'>SMA SWASTA</option>
					<option value='3'>MA NEGERI</option>
					<option value='4'>MA SWASTA</option>
					<option value='5'>SMK NEGERI</option>
					<option value='6'>SMK SWASTA</option>
					<option value='jenis_sekolah_lain'>LAINNYA</option>
				</select>
				</div><br /><br />
				<div class="col-xs-7"><input type="text" class="form-control input-sm" id="pmb1_jenis_sekolah" name="jenis_sekolah_lain" style="display: none;"></div> *)
				</td>
		</tr>
		<tr>
			<td >Jurusan Sekolah</td>
			<td><div class="col-xs-7"><select class="form-control input-sm" name='pmb1_jurusan_sekolah' id='jurusan_sekolah' class="required">
					<option value=''>Pilih</option>
					<option value='1'>IPA</option>
					<option value='2'>IPS</option>
					<option value='3'>BAHASA</option>
					<option value='4'>AGAMA</option>
					<option value='5'>TEKNIK</option>
					<option value='6'>SENI</option>
					<option value='jurusan_lain'>LAINNYA</option>
				</select></div>
				<br /><br />
				<div class="col-xs-7"><input type="text" class="form-control input-sm" id="pmb1_jurusan_sekolah" name="jurusan_lain" style="display: none;"></div> *)</td>
		</tr>	<tr>
			<td >Nama Sekolah</td>
			<td><div class="col-xs-7"><select class="wil form-control input-sm" id="prop" name='propinsi'>
					<option value=''>-Pilih Propinsi-</option>
					<?php 
						foreach($propinsi as $value){ 
								echo "<option value=".$value->KODE_PROPINSI.">".$value->NAMA_PROPINSI."</option>";
						}?></select></div> *)
						<br /><br />
						<div class="col-xs-7"><select class="wil form-control input-sm"  id="kab" name='kabupaten' style="display: none;">
							<option value="">-Pilih Kabupaten-</option>
						</select></div>
						<br /><br />
						<div class="col-xs-7"><select class="wil form-control input-sm" id="sek" name='sekolah' style="display: none;">
							<option value="">-Pilih Sekolah-</option>
							</select></div><br /><br />
						<div class="col-xs-7"><input type="text" class="form-control input-sm" id="sekolah" name="sekolah_lain" class='required' style="display: none;"> </div>
			</td>
		</tr>
		<tr>
			<td >Alamat Sekolah</td>
			<td><div class="col-xs-7"><textarea class="form-control input-sm" name='pmb1_alamat_sekolah' class="required"></textarea></div> *)</td>
		</tr>
		<tr>
			<td >Tahun Lulus</td>
			<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_tahun_lulus' class="required" /></div> *)</td>
		</tr>
		<tr>
			<td><a href='data-kesehatan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type="hidden" name="step" value="insert_pendidikan"><?php echo form_submit('pmb1_simpan_pendidikans1d3', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
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