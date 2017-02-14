<?php
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Jalur Dan Jurusan'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
// print_r($master_prodi); die();
?>
<div class="system-content-sia">
<?php
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
echo "<div id='notif-upsbp'></div>";
echo form_open(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?>
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tr>
		<td colspan=2><strong>Pilihan Jalur dan Jurusan</strong><br /><br /></td>
	</tr> 
	<?php /*
	<tr>
		<td>Jalur</td>
		<td><select name='pmb2_jalur' class='required'>
				<option value=''>&nbsp; Pilih &nbsp;</option> 
				<option value='30'>Jalur Reguler</option>
			</select> *)
		</td>
	</tr>
	*/ 
	$jenis=$this->session->userdata('jenis_penerimaan');
	switch($jenis){
			case 4:
				echo "<input type='hidden' name='pmb2_jalur' value='40'";
			break;
			case 5:
				echo "<input type='hidden' name='pmb2_jalur' value='50'";
			break;
			case 8:
				echo "<input type='hidden' name='pmb2_jalur' value='80'";
			break;
		}
	
	?>
	<tr>
		<td>Pilihan Jurusan</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_1' class="form-control input-sm">
			<?php #echo $piljur[0]->PMB_PILJUR_1;
			echo "<option value='' selected>-- Pilih Jurusan --</option>";
			$jenis=$this->session->userdata('jenis_penerimaan');
			switch($jenis){
			case 4: 
			foreach($master_prodi as $value){
				if($value->PMB_ID_PRODI!=61){
					echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
				}
			}
			break;
			case 5 :
			foreach($master_prodi as $value){
				if($value->PMB_ID_PRODI==61 || $value->PMB_ID_PRODI==83 || $value->PMB_ID_PRODI==84){
					echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
				}
			}
			break;
			case 8 :
			foreach($master_prodi as $value){
				if($value->PMB_ID_PRODI!=61 && $value->PMB_ID_PRODI!=80 && $value->PMB_ID_PRODI!=81 && $value->PMB_ID_PRODI!=82 && $value->PMB_ID_PRODI!=83 && $value->PMB_ID_PRODI!=84){
					echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
				}
			}
			break;
			}			
		?>
			</select></div> *)
		</td>
	</tr>
	<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="2">
			<input type="hidden" name="lisensi" value="1"></td>
		</tr>
	<tr>
			<td align='left'><a href='data-proposal_disertasi' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
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
				window.location = '<?php echo "$url_base/data-verifikasi_data"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#frm-input').validate({
				messages: {
				   	pmb2_jalur: {
						required: "Jalur Pendaftaran Tidak Boleh Kosong",
					}
					
					pmb2_pilihan_1: {
						required: "Pilihan Jurusan Tidak Boleh Kosong",
					}
				}
			});
		});
		</script>