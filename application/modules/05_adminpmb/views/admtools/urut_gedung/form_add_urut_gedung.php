<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admtools-urut_gedung',
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
<h2>Tambah Urut Gedung</h2>
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Tambah Urut Gedung' => 'adminpmb/admtools-urut_gedung/add'));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>"; */
#echo $tahun_awal;
?>
<div class="system-content-sia">
<form method='POST' id='fup_bp' >
<table class="table table-hover">
	<tbody>
			<tr>
				<td><label style="margin-top:5px;">Jalur Masuk</label></td>
				<td><div class="col-xs-6"><select name='GELOMBANG' id='GELOMBANG' class="form-control input-sm">
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
				<td><label style="margin-top:5px;">Tahun</label></td>
				<td><div class="col-xs-4"><select name='TAHUN' id='TAHUN' class="form-control input-sm" style="margin-bottom:0;">
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
				<td><label style="margin-top:5px;">Gedung</label></td>
				<td><div class="col-xs-6"><select name='GEDUNG' id='GEDUNG' style="margin-bottom:0;">
						<option value=''>Pilih Gedung</option>
						<?php 
						foreach($master_gedung as $value){ 
							echo "<option value='".$value->PMB_ID_GEDUNG."'>".$value->PMB_NAMA_GEDUNG."</option>";
						}
						?>
					</select></div>
				</td>
			</tr>
			<tr>
				<td><input type='hidden' name='add' value='sekarang' /></td>
				<td><div class="col-xs-6"><input type='submit' value='Tambah' class='btn-uin btn btn-inverse btn btn-small' /></div></td>
			</tr>
		</tbody>
	</table>
</form>
<div id='notif-upsbp'></div>
</div>