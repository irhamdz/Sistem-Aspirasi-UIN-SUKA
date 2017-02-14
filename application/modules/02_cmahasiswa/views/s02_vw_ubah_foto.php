<?php
$url_base=base_url().$this->session->userdata('status');
// $crumb="Ubah Foto";
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
$id_user=$this->session->userdata('id_user');
$jenis=$this->session->userdata('jenis_penerimaan');
echo form_open_multipart(''.$this->session->userdata('status').'/data-init_upload" id="fup_bp');
?>
<div class="system-content-sia">
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td colspan=3>
						<div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 M</font> </div>
					</td>
				</tr>
				<tr>
					<td >Foto</td>
					<td>:</td>
					<td><div class='btn-uin btn btn-inverse btn btn-small'>
							
							<img height='200' src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$pendaftar[0]->PMB_TAHUN_PENDAFTARAN.'/'.$pendaftar[0]->PMB_GELOMBANG_PENDAFTAR.'/'.$pendaftar[0]->PMB_FOTO_PENDAFTAR.''; ?>' />
							
						</div></td>
				</tr>
				<tr>
					<td >Ganti Foto</td>
					<td>:</td>
					<td><input type='file' name='userfile' />
					<input type='hidden' name='TAHUN_DAFTAR' value='<?php echo $pendaftar[0]->PMB_TAHUN_PENDAFTARAN; ?>'/>
					<input type='hidden' name='GELOMBANG' value='<?php echo $pendaftar[0]->PMB_GELOMBANG_PENDAFTAR; ?>'/></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><?php echo form_submit('pmb1_ubah_foto', 'Simpan', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
				</tr>
		</table>
</form>
</div>
<?php $url_base=base_url().$this->session->userdata('status'); 	?>
<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-init_upload',
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
				window.location = '<?php echo "$url_base/data-pendaftar"; ?>';
			}, 1000);
		}else if(data['hasil'] == 'tidak_berubah'){
			window.setTimeout( function(){
				window.location = '<?php echo "$url_base/data-pendaftar"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>