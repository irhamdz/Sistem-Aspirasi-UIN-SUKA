<?php
error_reporting(0);
// $crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Karya Tulis'=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform_karya_tulis" id="frm-input'); 
?>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='3'><br /><strong>Data Karya Tulis</strong><br /></td>
		</tr>
		<tr>
			<td width=150 >Judul</td>
			<td><div class="col-xs-7"><input type="text"  class="form-control input-sm" name="judul_karya_tulis" /></div> *)</td>
		</tr>
		<tr>
			<td >Penerbit</td>
			<td><div class="col-xs-7"><input type="text"  class="form-control input-sm" name="penerbit" /></div> *)</td>
		</tr>
		<tr>
			<td >Tahun</td>
			<td><div class="col-xs-7"><input type="text"  class="form-control input-sm" name="tahun_karya_tulis" /></div> *)</td>
		</tr>
		<tr>
			
				<td align='left'><input type="hidden" name="step" value="insert_karya" /></td>
			<td align='left'><?php echo form_submit('pmb1_karya_submit', 'Tambah', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); 
	$jenis=$this->session->userdata('jenis_penerimaan');
	switch($jenis){
		case 4: case 5: case 8:
			$url_pindah="karya_tulis";
		break;
	}
	#print_r($karya_tulis);

		?>
<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<th width=30>No</th>
			<th width=200 align=left>Judul</th>
			<th width=100>Penerbit</th>
			<th width=50>Tahun</th>
			<th width=100>Proses</th>
		</tr>
		
			<?php foreach($karya_tulis as $value){
					echo "<tr><td align=center>".$value->NO_."</td>";
					echo "<td>".$value->PMB_JUDUL_KARYA_TULIS."</td>";
					echo "<td align=center>".$value->PMB_PENERBIT_KARYA_TULIS."</td>";
					echo "<td align=center>".$value->PMB_TAHUN_KARYA_TULIS."</td>";
					echo "<td align=center><a href='$url_base/data-actionform_karya_tulis/hapus-karya-".$value->PMB_ID_KARYA_TULIS."' class='btn'><i class='icon-trash'></i> Hapus</a></td></tr>";
			} ?>
		
	</tbody>
	</table>
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
		<tr>
			<td align='left'><a href='data-penelitian' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td colspan=3></td>
			<td align='right'><a href='data-proposal_disertasi' class="btn-uin btn btn-inverse btn btn-small">Selanjutnya >>
		</tr>
	</table>
</div>
<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform_karya_tulis',
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


