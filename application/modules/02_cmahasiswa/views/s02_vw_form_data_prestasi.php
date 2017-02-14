<?php
$url_base=base_url().$this->session->userdata('status');
// $crumb="FORM -> Prestasi";
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
				Jika IYA, Silahkan upload scan sertifikat Tahfidz 30 Juz!<br /> 
				Jika Tidak, Silahkan Tekan Tombol Selanjutnya!!<br />
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 M</font></div>
					</td>
				</tr>
				<?php /* 
				<tr>
					<td>Tahfidz 30 Juz</td>
					<td>:</td>
					<td><select name='status_prestasi'>
							<option value=''>Pilih</option>
							<option value='1'>Ya</option>
							<option value='2'>Tidak</option>
						</select></td>
				</tr>
				<tr>
					<td>Hasil Scan</td>
					<td>:</td>
					<td><div class='btn-uin btn btn-inverse btn btn-small'>
							<img height='200' src='<?php echo base_url().'sertifikat_files/'.$this->session->userdata('status').'/'.$id_user.'-sertifikat-'.$jenis.'.jpg'; ?>' />
						</div></td>
				</tr>
				*/ ?>
				<tr>
					<td>Scan Sertifikat</td>
					<td>:</td>
					<td>
					<?php if($prestasi==true){
							echo "Sudah Upload";
							echo "<input type='hidden' name='status_prestasi' value='1' />";
					}else{ ?> 
						<input type='file' name='userfile' />
					<?php } ?></td>
					
				</tr>
				<tr>
					<td colspan=3><input type='hidden' name='TAHUN_DAFTAR' value='<?php echo $TAHUN_DAFTAR; ?>'/>
					<input type='hidden' name='GELOMBANG' value='<?php echo $GELOMBANG; ?>'/></td>
				</tr>
				<tr>
					
			<td align='left' ><input type='hidden' name='step' value='prestasi' /><a href='data-orangtua' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td><td></td>
			<td align='right'><?php echo form_submit('pmb3_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
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
				window.location = '<?php echo "$url_base/data-pilihan_jurusan_s1d3"; ?>';
			}, 1000);
		}else if(data['hasil'] == 'tidak_berubah'){
			window.setTimeout( function(){
				window.location = '<?php echo "$url_base/data-pilihan_jurusan_s1d3"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>