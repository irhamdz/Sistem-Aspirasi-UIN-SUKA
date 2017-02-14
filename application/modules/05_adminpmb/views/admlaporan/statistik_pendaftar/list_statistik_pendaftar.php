<style type="text/css">
input.groovybutton {
   font-weight:bold;
   color:#000000;
   background-color:#FFFFFF;
   border-top-style:none;
   border-top-color:#FFFFFF;
   border-bottom-style:none;
   border-bottom-color:#FFFFFF;
   border-left-style:none;
   border-left-color:#FFFFFF;
   border-right-style:none;
   border-right-color:#FFFFFF;
}
</style>


<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admlaporan-statistik_pendaftar_detail',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'html',
		beforeSend: function(){
				$("#notif-dua").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
		},
		success: function(x){
			$("#notif-dua").html(x);
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
<div class="system-content-sia">
<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width='5%' >NO</th>
						<th width='70%' align='left'>STATUS</th>
						<th width='5%'>JUMLAH</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align='center' >1</td>
						<td align='left'>SUDAH BAYAR</td>
						<td align='center'><?php echo $SUDAH_BAYAR; ?></td>
					</tr>
					<tr>
						<td align='center' >2</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN</td>
						<td align='center'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN; ?></td>
					</tr>
					<tr>
						<td align='center' >3</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN BELUM ISI DATA</td>
						<td align='center'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN_BELUM_ISI_DATA; ?></td>
					</tr>
					<tr>
						<td  align='center'>4</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA BELUM PILIH JURUSAN BELUM VERIFIKASI BELUM CETAK</td>
						<td  align='center'>
						<form method='POST' style='margin:0px;' id='fup_bp'>
						<form method='POST' style='margin:0px;' id='fup_bp' name="groovyform">
							<input type='hidden' name='GELOMBANG' value='<?php echo $GELOMBANG; ?>' />
							<input type='hidden' name='TAHUN' value='<?php echo $TAHUN; ?>' />
							<input type='hidden' name='SIAPA' value='4' />
							<input type='hidden' name='tampil' value='sekarang' />
							<input type="submit" name="groovybtn1" class="groovybutton" title="" value='<?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_BELUM_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK; ?>'>
						</form>
						<?PHP /*
						<B><a class="link-table" href="<?php echo base_url().'adminpmb/admlaporan-statistik_pendaftar_detail/4/'.$TAHUN.'/'.$GELOMBANG.''; ?>" target='_blank'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_BELUM_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK; ?></a></B>
						*/ ?>
						</td>
						
					</tr>
					<tr>
						<td  align='center'>5</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA SUDAH PILIH JURUSAN BELUM VERIFIKASI BELUM CETAK</td>
						<td  align='center'>
						<form method='POST' style='margin:0px;' id='fup_bp' name="groovyform">
							<input type='hidden' name='GELOMBANG' value='<?php echo $GELOMBANG; ?>' />
							<input type='hidden' name='TAHUN' value='<?php echo $TAHUN; ?>' />
							<input type='hidden' name='SIAPA' value='5' />
							<input type='hidden' name='tampil' value='sekarang' />
							<input type="submit" name="groovybtn1" class="groovybutton" title="" value='<?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK; ?>'>
						</form>
						<?php /* <B><a class="link-table" href="<?php echo base_url().'adminpmb/admlaporan-statistik_pendaftar_detail/5/'.$TAHUN.'/'.$GELOMBANG.''; ?>" target='_blank'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_BLM_SELESAI_BELUM_CETAK; ?></a></B> */ ?>
						</td>
					</tr>
					<tr>
						<td align='center' >6</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA SUDAH PILIH JURUSAN SUDAH VERIFIKASI BELUM CETAK</td>
						<td  align='center'>
						<form method='POST' style='margin:0px;' id='fup_bp' name="groovyform">
							<input type='hidden' name='GELOMBANG' value='<?php echo $GELOMBANG; ?>' />
							<input type='hidden' name='TAHUN' value='<?php echo $TAHUN; ?>' />
							<input type='hidden' name='SIAPA' value='6' />
							<input type='hidden' name='tampil' value='sekarang' />
							<input type="submit" name="groovybtn1" class="groovybutton" title="" value='<?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_BELUM_CETAK; ?>'>
						</form>
						<?php /*
						<B><a class="link-table" href="<?php echo base_url().'adminpmb/admlaporan-statistik_pendaftar_detail/6/'.$TAHUN.'/'.$GELOMBANG.''; ?>" target='_blank'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_BELUM_CETAK; ?></a></B>
						*/ ?>
						</td>
					</tr>
					<tr>
						<td  align='center'>7</td>
						<td align='left'>SUDAH BAYAR SUDAH LOGIN SUDAH ISI DATA SUDAH PILIH JURUSAN SUDAH VERIFIKASI SUDAH CETAK</td>
						<td align='center'><form method='POST' style='margin:0px;' id='fup_bp' name="groovyform">
							<input type='hidden' name='GELOMBANG' value='<?php echo $GELOMBANG; ?>' />
							<input type='hidden' name='TAHUN' value='<?php echo $TAHUN; ?>' />
							<input type='hidden' name='SIAPA' value='7' />
							<input type='hidden' name='tampil' value='sekarang' />
							<input type="submit" name="groovybtn1" class="groovybutton" title="" value='<?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_SUDAH_CETAK; ?>'>
							
						</form>
					<?php /*	
						<B><a class="link-table" href="<?php echo base_url().'adminpmb/admlaporan-statistik_pendaftar_detail/7/'.$TAHUN.'/'.$GELOMBANG.''; ?>" target='_blank'><?php echo $SUDAH_BAYAR_SUDAH_LOGIN_SUDAH_ISI_DATA_SUDAH_PILIH_JURUSAN_SUDAH_SELESAI_SUDAH_CETAK; ?></a></B>
						*/ ?>
						</td>
					</tr>
				</tbody>
</table>
</div>



<div id='notif-dua'></div>