<?php
if(empty($disertasi)){
$url_base=base_url().$this->session->userdata('status');
// $crumb="Form Proposal Disertasi";
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
$id_user=$this->session->userdata('id_user');
$jenis=$this->session->userdata('jenis_penerimaan');

echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_proposal_disertasi" id="fup_bp');
?>
<div class="system-content-sia">
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td colspan=3>
						<div class="bs-callout bs-callout-warning"><strong>Infomasi : </strong><br />
						File -> TYPE = PDF, Ukuran = Maksimal 10 MB</font> </div>
					</td>
				</tr>
				<tr>
					<td >Judul Disertasi</td>
					<td><div class="col-xs-7"><input type="text" class="form-control input-sm" name="judul_disertasi" /></div></td>
				</tr>
				<tr>
					<td >File Disertasi</td>
					<td><div class="col-xs-7"><input type='file' name='userfile' /></div></td>
				</tr>
				<tr>
				<td align='left'><a href='data-karya_tulis' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><input type='hidden' name='step' value='insert_disertasi' /><?php echo form_submit('pmb1_disertasi_submit', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
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
        url: 'data-actionform_proposal_disertasi',
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
				window.location = '<?php echo "$url_base/data-proposal_disertasi"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
<?php 
}else{
$url_base=base_url().$this->session->userdata('status');
// $crumb="Proposal Disertasi";
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<div class="bs-callout bs-callout-warning"><strong>Infomasi : </strong><br />
						Jika ingin merubah proposal, silahkan hapus data terlebih dahulu, Setelah itu Input Ulang Data Proposal Anda</font> </div>
<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<th width=30>No</th>
			<th width=200 align=left>Judul</th>
			<th width=200 align=left>File</th>
			<th width=100>Proses</th>
		</tr>
		
			<?php
			$jenis=$this->session->userdata('jenis_penerimaan');
			foreach($disertasi as $value){
					echo "<tr><td align=center>".$value->NO_."</td>";
					echo "<td>".$value->PMB_JUDUL_DISERTASI."</td>";
					echo "<td><a class='link-table' href='".base_url()."disertasi/$jenis/$value->PMB_FILE_DISERTASI'>".$value->PMB_FILE_DISERTASI."</td>";
					echo "<td align=center><a href='$url_base/data-actionform_proposal_disertasi/hapus-disertasi' class='btn'><i class='icon-trash'></i> Hapus</a></td></tr>";
			} ?>
		
	</tbody>
	</table>
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
				<td align='left'><a href='data-karya_tulis' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
				<td></td>
			<td align='right'><a href='data-pilihan_jurusan'  class="btn-uin btn btn-inverse btn btn-small">Selanjutnya >></td>
		</tr>
		</table>
</div>
<?php } ?>