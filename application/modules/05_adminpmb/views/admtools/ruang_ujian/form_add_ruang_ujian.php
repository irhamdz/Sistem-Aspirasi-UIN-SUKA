<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admtools-ruang_ujian',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'html',
		beforeSend: function(){
				$("#notif-upsbp").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
		},
		success: function(x){
			$("#notif-upsbp").html(x);
			$('html, body').animate({ scrollTop: 0 }, 200);
		}
    });
    /* .done(function(x) {
        //var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(x);
		$('html, body').animate({ scrollTop: 0 }, 200);
    }); */
 
    return false;
        });
});
</script>
<h2>Tambah Ruang Ujian</h2>
<?php
// $crumbs = array(array('Beranda'=>base_url()),array('Tambah Ruang Ujian' => 'adminpmb/admtools-ruang_ujian/add'));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $tahun_awal;
?>
<div class="system-content-sia">
<form method='POST' id='fup_bp' >
<table class="table table-hover">
	<tbody>
		<tr>
			<td><label for="GELOMBANG" style="margin-top:5px;">Jalur Masuk</label></td>
			<td><div class="col-xs-6"><select name='GELOMBANG' class="form-control input-sm" id='GELOMBANG' style="margin-bottom:0;">
					<option value=''>Pilih Jalur</option>
					<?php 
					foreach($jalur_masuk as $value){ 
							echo "<option value='$value->PMB_KODE_JALUR_MASUK'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
						}
					?>
				</select></div>
			</td>
		</tr>
		<tr>
			<td><label for="TAHUN" style="margin-top:5px;">Tahun</label></td>
			<td><div class="col-xs-6"><select name='TAHUN' class="form-control input-sm" id='TAHUN' style="margin-bottom:0;">
					<option value=''>Pilih Tahun</option>
					<?php 
					foreach($tahun_priode as $value){ 
						echo "<option value='".$value->PMB_TAHUN_PENDAFTARAN."'>".$value->PMB_TAHUN_PENDAFTARAN."</option>";
					}
					?>
				</select></div>
			</td>
		</tr>
		<tr>
			<td><input type='hidden' name='add' value='sekarang' /></td>
			<td><input type='submit' value='SETTING' class='btn-uin btn btn-inverse btn btn-small' /></td>
		</tr>
	</tbody>
</table>
</form>
<div id='notif-upsbp'></div>
</div>