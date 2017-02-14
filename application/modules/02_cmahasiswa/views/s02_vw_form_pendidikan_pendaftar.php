<?php
error_reporting(0);
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pendidikan Sebelumnya'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php #print_r($jenis_kesehatan); die(); 
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
#$attributes = array('id'=> 'id=frm-input');
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_pendidikan" id="frm-input'); 
?>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Pendidikan Sebelumnya</strong><br /></td>
		</tr>
		<tr>
			<td >Lulusan Dari</td>
			<td><div class="col-xs-7"><select name='pmb1_lulusan_dari' id='lulusan_dari' class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php 	foreach($master_lulusan as $value){ 	
								echo "<option value=".$value->PMB_ID_LULUSAN.">".$value->PMB_NAMA_LULUSAN."</option>";
							}
					?>
					<option value='lulusan_lain'>Lainnya</option>
				</select></div><br /><br />
				<div class="col-xs-7"><input type="text" id="pmb1_lulusan_dari" class="form-control input-sm" name="lulusan_lain" style="display: none;"></div> *)</td>
		</tr>
		<tr>
			<td >Nama Perguruan Tinggi</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_nama_pt' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr>
			<td >Tahun Ijazah</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_tahun_ijazah' class="form-control input-sm" /></div> *)</td>
		</tr>
		<tr>
			<td >IPK</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_ipk' class="form-control input-sm" /></div> *)
			<div class="col-xs-12"><div class="reg-info">Contoh Penulisan IPK -> 3.00.</div></div></td>
		</tr>
		<tr>
			
				<td align='left'><a href='data-kesehatan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type="hidden" name="step" value="insert_pendidikan"><?php echo form_submit('pmb1_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
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
				window.location = '<?php echo "$url_base/data-pekerjaan"; ?>';
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
			}else{
				$('#pmb1_agama').hide();
			
			}
	
	});
	
	$('#lulusan_dari').on('change',function(){
			var lulusan_dari=$('#lulusan_dari option:selected').val();
			if(lulusan_dari=="lulusan_lain"){
				$('#pmb1_lulusan_dari').show();
				$('#pmb1_lulusan_dari').focus();
			}else{
				$('#pmb1_lulusan_dari').hide();
			
			}
	
	});
	
	
	$('#pekerjaan').on('change',function(){
			var pekerjaan=$('#pekerjaan option:selected').val();
			if(pekerjaan=="pekerjaan_lain"){
				$('#pmb1_status_pekerjaan').show();
				$('#pmb1_status_pekerjaan').focus();
			}else{
				$('#pmb1_status_pekerjaan').hide();
			
			}
	
	});
	
	$('#biaya').on('change',function(){
			var biaya=$('#biaya option:selected').val();
			if(biaya=="biaya_lain"){
				$('#pmb1_rencana_biaya').show();
				$('#pmb1_rencana_biaya').focus();
			}else{
				$('#pmb1_rencana_biaya').hide();
			
			}
	
	});
		
	});
	</script>


