<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admlaporan-statistik_pendaftar',
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
<h2>Statistik Pendaftar</h2>
<?php
$crumbs = array(array('Beranda'=>base_url()),array('Statistik Pendaftar' => 'adminpmb/admlaporan-statistik_pendaftar'));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $tahun_awal;
?>
<div class="system-content-sia">
<form method='POST' id='fup_bp' >
<table class="table table-hover">
	<tbody>
		<tr>
			<td>Jalur Masuk</td>
			<td>:</td>
			<td><select name='GELOMBANG' id='GELOMBANG' style="margin-bottom:0;">
					<option value=''>Pilih Jalur</option>
					<?php 
					foreach($jalur_masuk as $value){ 
							echo "<option value='".$value->PMB_KODE_JALUR_MASUK."#".$value->PMB_TANGGAL_MULAI_DAFTAR."#".$value->PMB_TANGGAL_AKHIR_DAFTAR."'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><select name='TAHUN' id='TAHUN' style="margin-bottom:0;">
					<option value=''>Pilih Tahun</option>
					<?php 
					foreach($tahun_priode as $value){ 
						echo "<option value='".$value->PMB_TAHUN_PENDAFTARAN."'>".$value->PMB_TAHUN_PENDAFTARAN."</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>:</td>
			<td>
					 <input type="radio" value="JUMLAH_BAYAR" name="STATUS" /> Jumlah Bayar<br />
					 <input type="radio" value="JUMLAH_LOGIN" name="STATUS" /> Jumlah Login<br />
					 <input type="radio" value="JUMLAH_LOGIN_BELUM_ISI_DATA" name="STATUS" /> Jumlah Login, Belum Isi Data<br />
					 <input type="radio" value="1|1|OR" name="STATUS" /> Data Pendaftar Belum Selesai<br />
					 <input type="radio" value="2|1|AND" name="STATUS" /> Data Pendaftar Sudah Selesai, Belum Verifikasi<br />
					 <input type="radio" value="3|2|AND" name="STATUS" /> Data Pendaftar Sudah Selesai, Sudah Verifikasi, Belum Cetak<br />
			</td>
		</tr>		
		<tr>
			<td><input type='hidden' name='tampil' value='sekarang' /></td>
			<td></td>
			<td><input type='submit' value='Lihat' class='btn-uin btn btn-inverse btn btn-small' /></td>
		</tr>
	</tbody>
</table>
</form>
<div id='notif-upsbp'></div>
</div>