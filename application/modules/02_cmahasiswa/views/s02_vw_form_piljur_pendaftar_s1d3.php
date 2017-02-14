<?php
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Jalur Dan Jurusan'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
echo "<div id='notif-upsbp'></div>";
echo form_open(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?>
<div class="bs-callout bs-callout-info">
<strong>Infomasi : </strong><br />
				Pilihan Jurusan -> <font color="red"><strong>Tidak Boleh Sama</font></strong></div>
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<div class="bs-callout bs-callout-warning">Lihat Syarat Khusus Pemilihan Jurusan <a href='http://admisi.uin-suka.ac.id/downloads/syarat_peilihan_jurusan_reguler_2014.jpg'><strong>[klik disini]</strong></a>.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tr>
		<td colspan=2><strong>Pilihan Jalur dan Jurusan</strong><br /><br /></td>
	</tr>
	<tr>
		<td>Jalur</td>
		<td><div class="col-xs-7"><select name='pmb2_jalur' class="form-control input-sm">
				<option value=''>&nbsp; Pilih &nbsp;</option>
				<?php 
				foreach($master_jalur as $value){
									echo "<option value=".$value->PMB_KODE_JALUR_MASUK.">".$value->PMB_NAMA_JALUR_MASUK."</option>";
								
							}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Pilihan I</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_1' class="form-control input-sm">
			<option value=''>&nbsp; -- Pilih -- &nbsp;</option>
			<?php echo $piljur[0]->PMB_PILJUR_1;
				foreach($master_prodi as $value){
									echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
								
							}
							
		?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Pilihan II</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_2' class="form-control input-sm">
			<option value=''>&nbsp; -- Pilih -- &nbsp;</option>
			<?php echo $piljur[0]->PMB_PILJUR_1;
				foreach($master_prodi as $value){ 
									echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
								
							}
							
		?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Pilihan III</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_3' class="form-control input-sm">
			<option value=''>&nbsp; -- Pilih -- &nbsp;</option>
			<?php #echo $piljur[0]->PMB_PILJUR_1;
				foreach($master_prodi as $value){ 
									echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
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
			<td align='left'><a href='data-prestasi' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
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
					},
					
					pmb2_kelas: {
						required: "Kelas Tidak Boleh Kosong",
					},
					
					pmb2_pilihan_1: {
						required: "Pilihan 1 Tidak Boleh Kosong",
					},
					
					pmb2_pilihan_2: {
						required: "Pilihan 2 Tidak Boleh Kosong",
					}
				}
			});
		});
		</script>