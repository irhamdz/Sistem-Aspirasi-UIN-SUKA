<?php
error_reporting(0);
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pekerjaan'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php #print_r($jenis_kesehatan); die(); 
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
#$attributes = array('id'=> 'id=frm-input');
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_pekerjaan" id="frm-input'); 
?>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><br /><strong>Pekerjaan</strong><br /></td>
		</tr>
		<tr>
			<td >Status Pekerjaan</td>
			<td><div class="col-xs-7"><select name='pmb1_status_pekerjaan' id='pekerjaan' class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php 
					foreach($master_pekerjaan as $value){ 	
							echo "<option value=".$value->PMB_ID_PEKERJAAN.">".$value->PMB_NAMA_PEKERJAAN."</option>";
						}
					?>
					<option value='pekerjaan_lain'>Lainnya</option>
				</select></div><br /><br />
				<div class="col-xs-7"><input type="text" id="pmb1_status_pekerjaan" class="form-control input-sm" name="pekerjaan_lain" style="display: none;"></div> *)</td>
		</tr>
		<tr>
			<td >Alamat Kantor</td>
			<td><div class="col-xs-7"><textarea name='pmb1_alamat_kantor' class="form-control input-sm"></textarea></div>
				<div class="col-xs-12"><div class="reg-info">Silahkan diisi dengan tanda " - " jika tidak ada.</div></div></td>
		</tr>
		<tr>
			<td >No. Telp./Fax</td>
			<td><div class="col-xs-7"><input type='text'  class="form-control input-sm" name='pmb1_telp_fax' /></div>
				<div class="col-xs-12"><div class="reg-info">Silahkan diisi dengan tanda " - " jika tidak ada.</div></div></td></td>
		</tr>
		<tr>
			<td >Rencana Biaya Studi</td>
			<td><div class="col-xs-7"><select name='pmb1_rencana_biaya' id='biaya' class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php 
					foreach($master_biaya as $value){ 	
							echo "<option value=".$value->PMB_ID_RENCANA_BIAYA.">".$value->PMB_NAMA_RENCANA_BIAYA."</option>";
						}
					?>
					<option value='biaya_lain'>Lainnya</option>
				</select></div><br /><br />
				<div class="col-xs-7"><input type="text" id="pmb1_rencana_biaya" class="form-control input-sm" name="biaya_lain" value="" style="display: none;"></div> *)</td>
		</tr>
		<tr>
			
				<td align='left'><a href='data-pendidikan_sebelumnya' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type='hidden' name='step' value='insert_pekerjaan' /><?php echo form_submit('pmb1_pekerjaan_submit', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); 
	$jenis=$this->session->userdata('jenis_penerimaan');
	switch($jenis){
		case 2:
			$url_pindah="pilihan_jurusan";
		break;
		case 4: case 5: case 8:
			$url_pindah="penelitian";
		break;
	}
		?>
</div>
<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform_pekerjaan',
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
				window.location = '<?php echo "$url_base/data-$url_pindah"; ?>';
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


