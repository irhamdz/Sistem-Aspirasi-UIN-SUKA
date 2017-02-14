<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'laporan-daftar_peserta_belum_selesai',
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
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Pendaftar Belum Selesai' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>"; */
?>
<div class="system-content-sia">
<h2>Statistik Pendaftar</h2>
<form action='laporan-daftar_peserta_belum_selesai' method='POST' id='fup_bp' >
<table class="table table-hover">
	<tbody>
		<tr>
			<td><label style="margin-top:5px;">Jenis PMB</label></td>
			<td><div class="col-xs-6"><select name='jenis_pmb' class="form-control input-sm">
					<option value=''>Pilih Jalur</option>

					<?php 
					foreach($jalur_masuk as $value){ 
						//s1d3 -> reguler -> AAZF01
						//pasca -> S1S3 -> AAZF09
							echo "<option value='".$value->PMB_KODE_JALUR_MASUK."'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
						}
					?>
				</select></div>
				</td>
		</tr>
		<tr>
			<td></td>
			<td>
			
					<div class="radio">
					  <label>
						<input type="radio" value="1|1|OR" name="status" />Belum Selesai <br />
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" value="2|1|AND" name="status" />Sudah Selesai, Belum Verifikasi <br />
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" value="3|2|AND" name="status" />Sudah Selesai, Sudah Verifikasi, Belum Cetak</td>
					  </label>
					</div>
		</tr>
		<tr>
			<td><input type='hidden' name='form' value='now' /></td>
			<td><div class="col-xs-8"><input type='submit' name='lihat' value='Lihat' class='btn-uin btn btn-inverse btn btn-small' /></div></td>
		</tr>
	</tbody>
</table>
</form>
<div id='notif-upsbp'></div>
</div>