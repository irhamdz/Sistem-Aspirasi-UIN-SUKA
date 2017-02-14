<?php
error_reporting(0);
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pendidikan Sebelumnya'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<div id='notif-upsbp'></div>
<?php #print_r($pendidikan); 
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
#$attributes = array('id'=> 'id=frm-input');
echo form_open(''.$this->session->userdata('status').'/data-actionform_pendidikan" id="frm-pendidikan'); 
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
				<?php 
				$lulusan=$pendidikan[0]->PMB_LULUSAN_DARI;
				switch($lulusan){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					case 7: 
							foreach($master_lulusan as $value){ 
								if($value->PMB_ID_LULUSAN==$lulusan){
									echo "<option value=".$value->PMB_ID_LULUSAN." selected>".$value->PMB_NAMA_LULUSAN."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_LULUSAN.">".$value->PMB_NAMA_LULUSAN."</option>";
								}
							}
					break;
					default : 
						foreach($master_lulusan as $value){ 	
							echo "<option value=".$value->PMB_ID_LULUSAN.">".$value->PMB_NAMA_LULUSAN."</option>";
						}
						echo "<option value='$lulusan' selected>$lulusan</option>";
					break;
				}
				  ?>
				 <option value='lulusan_lain'>Lainnya</option></select></div><br /><br />
				<div class="col-xs-7"><input type="text" id="pmb1_lulusan_dari" class="form-control input-sm" name="lulusan_lain" value="" style="display: none;"></div> *)</td>
		</tr>
		<tr>
			<td >Nama Perguruan Tinggi</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_nama_pt' class="form-control input-sm" value="<?php echo $pendidikan[0]->PMB_NAMA_PERGURUAN_TINGGI; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td >Tahun Ijazah</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_tahun_ijazah' class="form-control input-sm" value="<?php echo $pendidikan[0]->PMB_TAHUN_IJAZAH; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td >IPK</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_ipk' class="form-control input-sm" value="<?php echo $pendidikan[0]->PMB_IPK_CPASCA; ?>" /></div> *)
			<div class="col-xs-12"><div class="reg-info">Contoh Penulisan IPK -> 3.00</div></div></td>
		</tr>
		<tr>
			
				<td align='left'><a href='data-kesehatan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type="hidden" name="step" value="update_pendidikan"><?php echo form_submit('pmb1_update_pendidikan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); ?>
</div>
<script>
$(function() {
$("form#frm-pendidikan").submit(function() {
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
		//alert(data['hasil']);
        // console.log(data);
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

	$('#lulusan_dari').on('change',function(){
			var lulusan_dari=$('#lulusan_dari option:selected').val();
			if(lulusan_dari=="lulusan_lain"){
				$('#pmb1_lulusan_dari').show();
				$('#pmb1_lulusan_dari').focus();
			}else{
				$('#pmb1_lulusan_dari').hide();
			
			}
	
	});
		
	});
	</script>


